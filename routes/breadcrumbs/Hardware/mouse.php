<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('mouse.index', function ($trail) {
    $trail->push('UIT', route('uit.Mouse.index'));
    $trail->push('Mouse', route('uit.Mouse.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('mouse.create', function ($trail) {
    $trail->parent('mouse.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('mouse.show', function ($trail, $mouse) {
    $trail->parent('mouse.index');
    $trail->push($mouse->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('mouse.edit', function ($trail, $mouse) {
    $trail->parent('mouse.index');
    $trail->push($mouse->name);
    $trail->push('Edit');
});

