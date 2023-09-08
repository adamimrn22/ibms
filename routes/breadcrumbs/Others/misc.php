<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('misc.index', function ($trail) {
    $trail->push('UIT', route('uit.Miscellaneous.index'));
    $trail->push('Miscellaneous', route('uit.Miscellaneous.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('misc.create', function ($trail) {
    $trail->parent('misc.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('misc.show', function ($trail, $misc) {
    $trail->parent('misc.index');
    $trail->push($misc->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('misc.edit', function ($trail, $misc) {
    $trail->parent('misc.index');
    $trail->push($misc->name);
    $trail->push('Edit');
});

