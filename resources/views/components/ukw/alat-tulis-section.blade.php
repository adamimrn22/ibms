<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    @foreach ($supplies as $supply)
        <li class="nav-item">
            <a class="nav-link
                {{ request()->routeIs('ukw.' . ucfirst(strtolower($supply->subcategory_name)) . '.index') ? 'active' : '' }}"
                href="{{ route('ukw.' . ucfirst(strtolower($supply->subcategory_name)) . '.index') }}" role="tab">
                {{ $supply->subcategory_name }}
            </a>
        </li>
    @endforeach
</ul>
