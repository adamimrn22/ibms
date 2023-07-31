<?php

// Breadcrumbs for desktop index page
Breadcrumbs::for('printer.index', function ($trail) {
    $trail->push('UIT', route('uit.Printer.index'));
    $trail->push('Printer', route('uit.Printer.index'));
});

// Breadcrumbs for create desktop form page
Breadcrumbs::for('printer.create', function ($trail) {
    $trail->parent('printer.index');
    $trail->push('Create');
});

// Breadcrumbs for desktop details page
Breadcrumbs::for('printer.show', function ($trail, $printer) {
    $trail->parent('printer.index');
    $trail->push($printer->name);
    $trail->push('Details');
});

// Breadcrumbs for edit desktop page
Breadcrumbs::for('printer.edit', function ($trail, $printer) {
    $trail->parent('printer.index');
    $trail->push($printer->name);
    $trail->push('Edit');
});

