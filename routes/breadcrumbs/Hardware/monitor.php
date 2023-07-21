<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('monitor.index', function ($trail) {
    $trail->push('UIT', route('uit.Monitor.index'));
    $trail->push('Monitor', route('uit.Monitor.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('monitor.create', function ($trail) {
    $trail->parent('monitor.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('monitor.show', function ($trail, $monitor) {
    $trail->parent('monitor.index');
    $trail->push($monitor->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('monitor.edit', function ($trail, $monitor) {
    $trail->parent('monitor.index');
    $trail->push($monitor->name);
    $trail->push('Edit');
});

