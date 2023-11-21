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
        <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{url('/')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
            </a>
     </li>
     <?php $category  =  App\Models\Category::where('parent_id', '=', null)->get(); ?>
        @foreach($category as $cat)
            <li class=" nav-item  {{ \Route::getFacadeRoot()->current()->uri() == $cat->slug ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ url('products', ['slug'=>$cat->slug] ) }}">
                        <i data-feather="{{ $cat->icon }}"></i><span class="menu-title text-truncate" data-i18n="Category">{{ $cat->name }}</span>
                    </a>
                    @if(count($cat->childs))
                        @include('Salesman.layouts.categorymenu',['childs' => $cat->childs])
                    @endif
            </li>
        @endforeach
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="/announcements">
                <i data-feather="grid"></i>
                <span class="menu-title text-truncate" data-i18n="Announcements">Announcements</span>
            </a>
                </li>
        <li class="is-shown">
                    <a href="/refreals">
                        <i data-feather="shopping-cart"></i>
                        <span class="menu-item" data-i18n="View">Referals</span>
                    </a>
                </li>


    </ul>
</div>
