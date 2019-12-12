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
        if (request()->ajax()) {
            return datatables()->of(Banner::latest()->with('createdBy')->get())
                ->addColumn('action', function($data) {
                    $html = '<a href="/banner/'. $data->id 
                            .'" class="btn btn-primary btn-sm"> 
                                <i class="fas fa-folder"></i> View</a>';
                    $html .= '&nbsp&nbsp';
                    $html .= '<a href="/banner/'. $data->id 
                            .'/edit" class="btn btn-info btn-sm"> 
                                <i class="fas fa-pencil-alt"></i> Edit</a>';
                    $html .= '&nbsp&nbsp';
                    $html .= '<button class="btn btn-danger btn-sm btn-banner-del" 
                              data-id="'.$data->id.'" > <i class="fas fa-trash">
                              </i> Delete</button>';
                return $html;
            })->rawColumns(['action'])->make(true);;
        }
        return view('banner.index');
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

        if ($banner->save()) {
            return redirect('/banner')->with('flash', '<i class="icon fas fa-check"></i> Banner saved successfully');
        }
        return redirect('/banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('banner.view', ['banner' => $banner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('banner.edit', ['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBanner $request, Banner $banner)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banner $banner)
    {   

        $deleted = Storage::disk('public')->delete($banner->file);
        
        if ($deleted && $banner->delete()) {
            $request->session()->flash('flash', '<i class="icon fas fa-check"></i>Banner deleted successfully');
            return response('', 204);
        }
        
        $request->session()->flash('flash', '<i class="fas fa-exclamation-triangle"></i>Sorry! We are unable to process your request for deleting the selected banner');
        
        return response('', 422);  
    }
}
