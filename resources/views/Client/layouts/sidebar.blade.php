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
      <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'customer_dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{route('client.dashboard')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
            </a>
      </li>
      
     <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'customer/dashboard' ? 'active' : '' }}">
        <a  class="d-flex align-items-center"  href="{{route('client.dashboard')}}">
            <i data-feather='link'></i>
            <span class="menu-item" data-i18n="Agreements">Funding</span>
        </a>
        <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('client.dashboard')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List"> Dashboard</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('client.pf')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List"> Personal Funding</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('client.bf')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List"> Bussiness Funding</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('client.pf')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List"> Bank Funding</span></a>
                    </li>
                    
        </ul>
      </li>
      <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'customer_dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{route('client.dashboard')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Bussiness Credit</span>
            </a>
        </li>
        <li class="nav-item {{ \Route::getFacadeRoot()->current()->uri() == 'customer_dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{route('client.pf')}}">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Diy credit repair</span>
            </a>
        </li>

        {{-- <?php $category  =  App\Models\Category::where('parent_id', '=', null)->get(); ?>
        @foreach($category as $cat)
            <li class=" nav-item  {{ \Route::getFacadeRoot()->current()->uri() == $cat->slug ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ url('products', ['slug'=>$cat->slug] ) }}  ">
                        <i data-feather="{{ $cat->icon }}"></i><span class="menu-title text-truncate" data-i18n="Category">{{ $cat->name }}</span>
                    </a>
                    @if(count($cat->childs))
                        @include('Client.layouts.categorymenu',['childs' => $cat->childs])
                    @endif
            </li>
        @endforeach
                 <li class="nav-item">
            <a  class="d-flex align-items-center"  href="#">
                <i data-feather='paperclip'></i>
                <span class="menu-title text-truncate" data-i18n="Email">Support</span>
            </a>
        </li> --}}
    </ul>
</div>
@section('scripts')
<script>
  $(document).ready(function() {
    var settings = {
        "async": true,
        url: "{{ url('/sidebarCategory') }}",
        "method": "GET",
        "headers": {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "processData": false,
        "contentType": false,
        "responsive": true,
    }
    $.ajax(settings).done(function(response) {
        if(response.errors){
            $.each( response.errors, function( index, value ){
                Toast.fire({
                    icon: 'error',
                    title: value
                })
            });
        }
        else if(response.error_message){
            Toast.fire({
                icon: 'error',
                title: response.error_message
            })
        }
        else{
            console.log(response.data);

        }



    });

    });



</script>
@endsection
