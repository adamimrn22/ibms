<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('cable.index', function ($trail) {
    $trail->push('UIT', route('uit.Hdmi.index'));
    $trail->push('Cable', route('uit.Hdmi.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('cable.create', function ($trail) {
    $trail->parent('cable.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('cable.show', function ($trail, $cable) {
    $trail->parent('cable.index');
    $trail->push($cable->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('cable.edit', function ($trail, $cable) {
    $trail->parent('cable.index');
    $trail->push($cable->name);
    $trail->push('Edit');
});

