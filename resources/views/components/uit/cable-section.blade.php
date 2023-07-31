<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    @foreach ($cables as $cable)
        <li class="nav-item">
            <a class="nav-link
                {{ request()->routeIs('uit.' . ucfirst(strtolower($cable->subcategory_name)) . '.index') ? 'active' : '' }}"
                href="{{ route('uit.' . ucfirst(strtolower($cable->subcategory_name)) . '.index') }}" role="tab">
                {{ $cable->subcategory_name }}
            </a>
        </li>
    @endforeach
</ul>
