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