<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('clasroom.index', function ($trail) {
    $trail->push('UPSM', route('upsm.Classroom.index'));
    $trail->push('Classroom', route('upsm.Classroom.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('clasroom.create', function ($trail) {
    $trail->parent('clasroom.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('clasroom.show', function ($trail, $classroom) {
    $trail->parent('clasroom.index');
    $trail->push($classroom->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('clasroom.edit', function ($trail, $classroom) {
    $trail->parent('clasroom.index');
    $trail->push($classroom->name);
    $trail->push('Edit');
});

