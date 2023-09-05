<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    @foreach ($hardwares as $hardware)
        <li class="nav-item">
            @php
                $routeName = 'uit.' . ucwords(str_replace(' ', '-', $hardware->subcategory_name)) . '.index';
            @endphp
            <a class="nav-link
                {{ request()->routeIs($routeName) ? 'active' : '' }}"
                href="{{ route($routeName) }}" role="tab">
                {{ ucwords($hardware->subcategory_name) }}
            </a>
        </li>
    @endforeach
</ul>
