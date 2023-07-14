<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('laptop.index', function ($trail) {
    $trail->push('UIT', route('uit.Laptop.index'));
    $trail->push('Laptop', route('uit.Laptop.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('laptop.create', function ($trail) {
    $trail->parent('laptop.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('laptop.show', function ($trail, $laptop) {
    $trail->parent('laptop.index');
    $trail->push($laptop->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('laptop.edit', function ($trail, $laptop) {
    $trail->parent('laptop.index');
    $trail->push($laptop->name);
    $trail->push('Edit');
});

