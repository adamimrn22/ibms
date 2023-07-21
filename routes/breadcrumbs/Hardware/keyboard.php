<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('keyboard.index', function ($trail) {
    $trail->push('UIT', route('uit.Keyboard.index'));
    $trail->push('Keyboard', route('uit.Keyboard.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('keyboard.create', function ($trail) {
    $trail->parent('keyboard.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('keyboard.show', function ($trail, $keyboard) {
    $trail->parent('keyboard.index');
    $trail->push($keyboard->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('keyboard.edit', function ($trail, $keyboard) {
    $trail->parent('keyboard.index');
    $trail->push($keyboard->name);
    $trail->push('Edit');
});

