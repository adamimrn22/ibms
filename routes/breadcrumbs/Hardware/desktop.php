<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('desktop.index', function ($trail) {
    $trail->push('UIT', route('uit.Desktop.index'));
    $trail->push('Desktop', route('uit.Desktop.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('desktop.create', function ($trail) {
    $trail->parent('desktop.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('desktop.show', function ($trail, $desktop) {
    $trail->parent('desktop.index');
    $trail->push($desktop->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('desktop.edit', function ($trail, $desktop) {
    $trail->parent('desktop.index');
    $trail->push($desktop->name);
    $trail->push('Edit');
});

