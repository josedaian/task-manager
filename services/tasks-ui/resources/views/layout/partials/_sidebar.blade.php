<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-yellow elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('tasks.index') }}" class="brand-link">
        <img src="{{ asset('img/menu-logo.ico') }}" width="20%" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ __('Tasks') }} <b>{{ __('<Manager>') }}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 d-flex">
            <div class="image d-flex flex-wrap align-items-center">
                <img src="{{ asset('img/user.webp') }}" width="20%" class="img-circle elevation-2">
            </div>
            <div class="info">
                <span class="text-white">
                    {{ __('Logued as') }}
                </span>
                <a href="javascript:void(0)" class="d-block">{{ session('_user')->name }}</a>
            </div>
            
        </div>
        <div class="mt-0 mb-0 pb-0 pt-0 bg-danger rounded text-center">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('logout') }}
                        </p>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">{{ __('Menu') }}</li>
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link @route('tasks.*') active @endroute">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Tasks') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('scheduled_tasks.index') }}" class="nav-link @route('scheduled_tasks.*') active @endroute">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            {{ __('Schedule') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
