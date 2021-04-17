
<li class="nav-item {{ Request::is('coins*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('coins.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Coins</span>
    </a>
</li>
<li class="nav-item {{ Request::is('conversions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('conversions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Conversions</span>
    </a>
</li>
