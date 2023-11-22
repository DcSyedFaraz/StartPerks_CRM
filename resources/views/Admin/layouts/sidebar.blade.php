<div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item me-auto">
            <a class="navbar-brand" href="{{url('/')}}">
                <img class="logo" src="{{asset('/images/logo/logo.png')}}">
            </a>
        </li>
        <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
            </a>
        </li>
    </ul>
</div>
<div class="shadow-bottom"></div>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    @can('dashboard')
        <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{url('/')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
            </a>
        </li>
    @endcan
    @can('announcements')
        <li  class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'announcements' ? 'active' : '' }} ">
            <a  class="d-flex align-items-center"  href="{{url('announcements')}}">
              <i data-feather='package'></i>
                <span class="menu-title text-truncate" data-i18n="announcement">Announcements</span>
            </a>
        </li>
    @endcan
    @can('customers')
        <li class="nav-item  {{ \Route::getFacadeRoot()->current()->uri() == 'customers' ? 'active' : '' }} ">
            <a  class="d-flex align-items-center"  href="{{url('customers')}}">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate" data-i18n="Customers">Customers</span>
            </a>
        </li>
    @endcan
    @can('salesmen')
        <li class="nav-item  {{ \Route::getFacadeRoot()->current()->uri() == 'salesmen' ? 'active' : '' }} ">
            <a  class="d-flex align-items-center"  href="{{url('salesmen')}}">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate" data-i18n="salesman">Salesmen</span>
            </a>
        </li>
    @endcan
    @can('categories')
         <li class="nav-item  {{ \Route::getFacadeRoot()->current()->uri() == 'category' ? 'active' : '' }} ">
            <a  class="d-flex align-items-center"  href="{{url('category')}}">
                <i data-feather='tag'></i>
                <span class="menu-tite text-truncate" data-i18n="categories">Categories</span>
            </a>
        </li>
    @endcan
    @can('products')
        <li class="nav-item  {{ \Route::getFacadeRoot()->current()->uri() == 'products' ? 'active' : '' }}">
            <a  class="d-flex align-items-center"  href="{{url('products')}}">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate" data-i18n="Products">Products</span>
            </a>
        </li>
    @endcan
    @can('sales')
        <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'products-sales' ? 'active' : '' }}">
            <a  class="d-flex align-items-center"  href="{{url('products-sales')}}">
                <i data-feather="trending-up"></i>
                <span class="menu-item text-truncate" data-i18n="Sales">Sales</span>
            </a>
        </li>
    @endcan
    @can('banks')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'banks' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="#">
            <i data-feather='home'></i>
            <span class="menu-item" data-i18n="Agreements">Banks</span>
        </a>
        <ul class="menu-content">
            <li><a class="d-flex align-items-center" href="{{ route('banks.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Banks</span></a></li>
            <li><a class="d-flex align-items-center" href="{{ route('bank_cards.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Bank Cards</span></a></li>
       </ul>
    </li>
    @endcan
    @can('agreement')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'agreement' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="#">
            <i data-feather='link'></i>
            <span class="menu-item" data-i18n="Agreements">Agreements</span>
        </a>
        <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ url('aggreament') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List"> List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center"  href="{{ url('aggreament/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Add </span></a>
                        </li>
                        <li><a class="d-flex align-items-center"  href="{{ url('/aggreamentdata') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Latest </span></a>
                        </li>
        </ul>
    </li>
    @endcan
    @can('Payment Gateways')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'plan' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="{{url('plan')}}">
            <i data-feather='dollar-sign'></i>
            <span class="menu-item text-truncate" data-i18n="Payment">Payment Package</span>
        </a>
    </li>
    @endcan
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'cust' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="{{url('cust')}}">
            <i data-feather='dollar-sign'></i>
            <span class="menu-item text-truncate" data-i18n="Payment">Add Subscriber</span>
        </a>
    </li>
    @can('support')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'support' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="#">
            <i data-feather='paperclip'></i>
            <span class="menu-title text-truncate" data-i18n="Email">Support</span>
        </a>
    </li>
    @endcan
    @can('logs')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'logs' ? 'active' : '' }}">
            <a href="/logs">
                <i data-feather='save'></i>
                <span class="menu-item text-truncate" data-i18n="Sales">Logs</span>
            </a>
    </li>
    @endcan
    @can('Roles and Permissions')
    <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'roles' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="/roles">
            <i data-feather="settings"></i>
            <span class="menu-title text-truncate" data-i18n="Account Settings">Role Permissions </span>
        </a>
    </li>
    @endcan
    </ul>
</div>
