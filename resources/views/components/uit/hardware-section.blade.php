<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    @foreach ($hardwares as $hardware)
        <li class="nav-item">
            <a class="nav-link
                {{ request()->routeIs('uit.' . ucfirst(strtolower($hardware->subcategory_name)) . '.index') ? 'active' : '' }}"
                href="{{ route('uit.' . ucfirst(strtolower($hardware->subcategory_name)) . '.index') }}" role="tab">
                {{ $hardware->subcategory_name }}
            </a>
        </li>
    @endforeach
</ul>
