<ul class="menu-content">
    @foreach($childs as $child)
    <li class=" nav-item  {{ \Route::getFacadeRoot()->current()->uri() == $child->slug ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ url('products', ['slug'=>$cat->slug] ) }}">
            <i data-feather="{{ $cat->icon }}"></i><span class="menu-item text-truncate" data-i18n="Product 2">{{ $child->name }}</span>
        </a>
        @if(count($child->childs))
            @include('Salesman.layouts.categorymenu',['childs' => $child->childs])
        @endif
    </li>
    @endforeach
</ul>
