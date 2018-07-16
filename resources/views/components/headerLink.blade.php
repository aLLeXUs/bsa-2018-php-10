<li class="nav-item {{ isset($active) && $active == true ? 'active' : '' }}">
    <a class="nav-link" href="{{ $link }}">{{ $slot }}</a>
</li>