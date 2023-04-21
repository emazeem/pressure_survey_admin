<style>
    .pcoded-mtext,.pcoded-mtext-submenu{
        color: black;
    }
</style>
<nav class="pcoded-navbar menupos-fixed menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label class="text-capitalize">Navigation</label>
                </li>

                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="fa fa-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('team') }}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">Teams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member') }}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="fa fa-user"></i></span>
                        <span class="pcoded-mtext">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('import') }}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="fa fa-file"></i></span>
                        <span class="pcoded-mtext">File Imports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            href="{{route('logout')}}"
                            class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="fa fa-sign-out-alt"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            </ul>
        </div>
    </div>
</nav>



