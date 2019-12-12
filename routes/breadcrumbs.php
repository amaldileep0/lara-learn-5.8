<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('banner.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Banners', route('banner.index'));
});

Breadcrumbs::for('banner.create', function ($trail) {
    $trail->parent('banner.index');
    $trail->push('Add Banner', route('banner.create'));
});

Breadcrumbs::for('banner.edit', function ($trail, $banner) {
    $trail->parent('banner.index');
    $trail->push($banner->title, route('banner.edit', $banner->id));
});

Breadcrumbs::for('banner.show', function ($trail, $banner) {
    $trail->parent('banner.index');
    $trail->push($banner->title, route('banner.show', $banner->id));
});