<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('car.index', function ($trail) {
    $trail->push('UPSM', route('upsm.Kenderaan.index'));
    $trail->push('Kenderaan', route('upsm.Kenderaan.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('car.create', function ($trail) {
    $trail->parent('car.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('car.show', function ($trail, $car) {
    $trail->parent('car.index');
    $trail->push($car->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('car.edit', function ($trail, $car) {
    $trail->parent('car.index');
    $trail->push($car->name);
    $trail->push('Edit');
});

