@if (count($lowerStock) > 0)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Warning! There is an item that is lower in stock.</h4>
        <div class="alert-body">
            @foreach ($lowerStock as $lowStock)
                <ul class="m-0">
                    <li class="m-0">{{ $lowStock->name }} - {{ $lowStock->current_quantity }}x</li>
                </ul>
            @endforeach
        </div>
    </div>
@endif
