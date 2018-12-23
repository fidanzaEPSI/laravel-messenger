<a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
    Déconnexion
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
    {{ csrf_field() }}
</form>