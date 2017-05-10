<ul class="nav navbar-right top-nav">
    <li><a href="/backoffice/settings">  <i class="fa fa-fw fa-gear"></i>  Settings</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >
            <i class="fa fa-fw fa-sign-out"></i> Logout
        </a>
    </li>
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>