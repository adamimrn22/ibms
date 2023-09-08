<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('software.index', function ($trail) {
    $trail->push('UIT', route('uit.Software.index'));
    $trail->push('Software', route('uit.Software.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('software.create', function ($trail) {
    $trail->parent('software.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('software.show', function ($trail, $software) {
    $trail->parent('software.index');
    $trail->push($software->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('software.edit', function ($trail, $software) {
    $trail->parent('software.index');
    $trail->push($software->name);
    $trail->push('Edit');
});

