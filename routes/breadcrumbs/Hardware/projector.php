<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('projector.index', function ($trail) {
    $trail->push('UIT', route('uit.Projector.index'));
    $trail->push('Projector', route('uit.Projector.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('projector.create', function ($trail) {
    $trail->parent('projector.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('projector.show', function ($trail, $projector) {
    $trail->parent('projector.index');
    $trail->push($projector->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('projector.edit', function ($trail, $projector) {
    $trail->parent('projector.index');
    $trail->push($projector->name);
    $trail->push('Edit');
});

