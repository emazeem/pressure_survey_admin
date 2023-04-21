<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header text-center d-flex" style="justify-content: space-between">
        <div>
            <img src="{{ url('SSGC_logo.png') }}" alt="connectSocial" style="width: 50px">
        </div>
        <div>
            <i class='pt-2 toggle-icon ms-auto bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        {{-- <li class="menu-label">Menus</li> --}}
        <li>
            <a href="{{ url('home') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('team') }}">
                <div class="parent-icon"><i class='bx bxl-microsoft-teams'></i>
                </div>
                <div class="menu-title">Teams</div>
            </a>
        </li>
        <li>
            <a href="{{ route('member') }}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
        </li>
        <li>
            <a href="{{ route('import') }}">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">File Imports</div>
            </a>
        </li>

        <li class="d-none">
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-list-ul'></i>
                </div>
                <div class="menu-title">All Users</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('users.index', ['type' => 'users']) }}">
                        <div class="parent-icon"><i class='bx bx-right-arrow-alt'></i></div>
                        <div class="menu-title">User</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
