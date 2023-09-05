<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('ExtensionCord.index', function ($trail) {
    $trail->push('UIT', route('uit.Extension-cord.index'));
    $trail->push('Extension Cord', route('uit.Extension-cord.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('ExtensionCord.create', function ($trail) {
    $trail->parent('ExtensionCord.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('ExtensionCord.show', function ($trail, $extensionCord) {
    $trail->parent('ExtensionCord.index');
    $trail->push($extensionCord->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('ExtensionCord.edit', function ($trail, $extensionCord) {
    $trail->parent('ExtensionCord.index');
    $trail->push($extensionCord->name);
    $trail->push('Edit');
});

