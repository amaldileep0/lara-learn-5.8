<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBanner;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{   
    use UploadTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $banners = Banner::paginate(5);
        return view('banner.index', ['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanner $request)
    {   
        $banner = new Banner();

        // Retrieve the validated input data...
        $validated = $request->validated();
        
        //current user as created_by
        $banner->created_by = auth()->user()->id;
        
        $banner->fill($validated);
        
        // Check if a profile image has been uploaded
        if ($request->hasFile('file')) {
            
            // Get image file
            $image = $request->file('file');
            
            // Make a image name based on title and current timestamp
            $name = Str::slug($request->input('title')).'_'.time();

            // Define folder path
            $folder = '/uploads/images/banner/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' 
                        . $image->getClientOriginalExtension();

            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            
            // Set user profile image path in database to filePath
            $banner->file = $filePath;
        }

        $banner->save();
        return redirect('/banner')->with('success', 'Banner saved successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {   
        $deleted = Storage::disk('public')->delete($banner->file);
        
        /*if ($deleted && $banner->delete())
            return redirect('/banner')->with('success', 'Select banner deleted successfully.');*/

        //return redirect('/banner')->with('error', 'Unable to delete select banner.');  

    }
}
