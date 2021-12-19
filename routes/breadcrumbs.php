<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Backend Breadcrumbs
 */
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {

    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('User', route('admin.user.index'));
});

Breadcrumbs::for('admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Category', route('admin.category.index'));
});

Breadcrumbs::for('admin.product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Products', route('admin.product.index'));
});
