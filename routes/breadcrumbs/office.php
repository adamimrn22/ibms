<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('office.index', function ($trail) {
    $trail->push('UPSM', route('upsm.Office.index'));
    $trail->push('Office', route('upsm.Office.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('office.create', function ($trail) {
    $trail->parent('office.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('office.show', function ($trail, $office) {
    $trail->parent('office.index');
    $trail->push($office->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('office.edit', function ($trail, $office) {
    $trail->parent('office.index');
    $trail->push($office->name);
    $trail->push('Edit');
});

