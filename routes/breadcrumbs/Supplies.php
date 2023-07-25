<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('supply.index', function ($trail) {
    $trail->push('UKW', route('ukw.Paper.index'));
    $trail->push('Alat Tulis', route('ukw.Paper.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('supply.create', function ($trail) {
    $trail->parent('supply.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('supply.show', function ($trail, $supply) {
    $trail->parent('supply.index');
    $trail->push($supply->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('supply.edit', function ($trail, $supply) {
    $trail->parent('supply.index');
    $trail->push($supply->name);
    $trail->push('Edit');
});

