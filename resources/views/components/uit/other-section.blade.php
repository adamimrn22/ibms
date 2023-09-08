<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link
                {{ request()->routeIs('uit.Software.index') ? 'active' : '' }}"
            href="{{ route('uit.Software.index') }}" role="tab">
            Software
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link
                {{ request()->routeIs('uit.Miscellaneous.index') ? 'active' : '' }}"
            href="{{ route('uit.Miscellaneous.index') }}" role="tab">
            Miscellaneous
        </a>
    </li>
</ul>
