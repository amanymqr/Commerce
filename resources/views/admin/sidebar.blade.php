
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('site.index') }}">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href={{ route('admin.index') }}>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('admin.dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    {{--  Categories  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatygo"
            aria-expanded="true" aria-controls="collapseCatygo">
            <i class="fas fa-fw fa-tags"></i>
            <span>{{ __('admin.categories') }}</span>
        </a>

        <div id="collapseCatygo" class="collapse {{ str_contains(request()->url(), 'categories')?'show':'' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.categories.index')?'active':'' }} " href="{{ route('admin.categories.index') }}">{{ __('admin.allcategories') }}</a>

                <a class="collapse-item {{ request()->routeIs('admin.categories.create')?'active':'' }}" href="{{ route('admin.categories.create') }}">{{ __('admin.addnew') }}</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider  my-0">


    {{--  Products  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
            aria-expanded="true" aria-controls="collapseProduct">
            <i class="fas fa-fw fa-heart"></i>
            <span>{{ __('admin.products') }}</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">{{ __('admin.addnew') }}</a>
                <a class="collapse-item" href="cards.html">{{ __('admin.allproducts') }}</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider   my-0">


    {{--  Orders  --}}
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw  fa-cart-plus"></i>
            <span>{{ __('admin.orders') }}</span></a>
    </li>
    <hr class="sidebar-divider  my-0">


    {{--  Payments  --}}
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>{{ __('admin.users') }}</span></a>
    </li>
    <hr class="sidebar-divider  my-0">


    {{--  user  --}}
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('admin.payments') }}</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
