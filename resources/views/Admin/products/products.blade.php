@extends('Admin.layouts.master')
@section('title', 'Products')
@section('style')
<link rel="stylesheet" type="text/css" href={{asset('app-assets/css/plugins/forms/form-valid')}}"tion.css">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">
<link rel="stylesheet" type="text/css" href={{asset('app-assets/css/plugins/forms/form-w')}}"zard.css">
<link rel="stylesheet" type="text/css" href={{asset('app-assets/vendors/css/pickers/pickadate/pick')}}"date.css">
<link rel="stylesheet" type="text/css" href={{asset('app-assets/vendors/css/pickers/flatpickr/flatpick')}}".min.css">
<link rel="stylesheet" type="text/css" href={{asset('app-assets/css/plugins/forms/pickers/form-flat-')}}"ickr.css">
<style>
   @media (min-width: 576px){
   .modal-dialog {
   max-width: 900px !important;
   margin: 6.75rem auto !important;
   }
   }
   .bs-stepper{
   box-shadow:none !important;
   }
   .no-data_card{
        min-height: 250px;
        background-color: #fff;
        display: grid;
        justify-content: center;
        align-items: center;
    }
    .nodata svg.feather.feather-hard-drive{
        height: 4rem;
         width: 4rem;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper container-xxl p-0">
   <div class="content-header row">
   </div>
   <div class="content-body">
   <section id="default-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Products</h4>
                        </div>
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
      <!-- Basic and Outline Pills start -->
      <section id="basic-and-outline-pills">
            <div class="row match-height" style="justify-content:flex-end">
                <a style="margin: 0px 18px 15px;width:23%;" href="/addProduct"  class="btn btn-primary">Add Product</a>   
            </div>
                    <div class="row match-height">
                        <!-- Basic pills starts -->
                        <div class="col-xl-12 col-lg-12">
                            
                                <div class="card-body">
                                         <div id="editor-tab" class="row match-height">
                                            <a class="btn btn-primary w-100 text-center mb-2 mx-1"> Editor Products</a>
                                            @if(count($paginatedData["editorProducts"]["items"])==0)
                                            <div class="col-md-12 col-lg-12">
                                                <div class="card no-data_card">
                                                    <div class="nodata">
                                                        <i data-feather='hard-drive'></i>
                                                        <p>No Data</p>  
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($paginatedData["editorProducts"]["items"] as $product)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <img class="card-img-top"  src="{{ $product->image }}" alt="Card image cap" />
                                                        <div class="card-body">
                                                            <div class="card-img-overlay">
                                                            
                                                                <button class="btn btn-outline-danger text-nowrap px-1 waves-effect" style="float: right;" product_id="{{ $product->id}}"  onclick="deleteProduct(<?=  $product->id; ?>)" type="button">
                                                                    <i data-feather='trash-2'></i>
                                                                </button>
                                                            </div>
                                                        @if (!empty($product->scheduled_at) && $product->scheduled_at > now())
                                                            <div style="float:right;" class="bg-info-gradient d-flex">
                                                                <i style="margin-right: 10px; height: 1.4rem; color: #1aeaff; width: 2rem;" data-feather='clock'></i>
                                                                <p class="card-text text-dark">{{  date("d-m-Y", strtotime($product->scheduled_at)) }}</p>
                                                            </div>
                                                                @else
                                                                <p class="card-text text-white"></p>
                                                                @endif
                                                            <h4 class="card-title">{{ $product->title }}</h4>
                                                            <p class="card-text" >
                                                            {{ strlen($product->description) > 120 ? substr($product->description, 0, 120)."..." : $product->description }}   
                                                        </p>
                                                            <div style="display: flex; flex-direction :row;justify-content:space-between">
                                                                <a onclick="viewProduct({{ $product->id }},'{{ $product->link }}')" id="view-histories" class="btn btn-outline-primary">Visit Website</a>
                                                                <a class="waves-effect px-1" data-bs-toggle="modal" onclick="viweHistory({{$product->id}})" data-bs-target="#productClickHistory">
                                                                    <i style="width:1.2rem;height:2rem" data-feather="eye"></i><span class="histories-count-{{ $product->id }}">  {{$product->histories->count() }} </span>
                                                                </a>
                                                                {{-- <a style="font-size:1.3rem" class="btn btn-default"><i style="height: 1.3rem; width: 1.8rem;" data-feather='activity'></i><span class="histories-count-{{ $product->id }}">  {{ $product->histories && count($product->histories) > 0  ? count($product->histories    ) : 0  }} </span></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- reload button -->
                                        @if($paginatedData["editorProducts"]["last_page"] >$paginatedData["editorProducts"]["current_page"] )
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button type="button" class="btn btn-lg btn-primary block-element border-0 mb-1 load_editor" onclick="loadPaginatedData('editor',{{ $paginatedData['editorProducts']['current_page'] }})">Load More</button>
                                            </div>
                                        </div>
                                        @endif
                                        <!--/ reload button -->

                                           
                                        <div id="peer-tab" class="row match-height">
                                            <a class="btn btn-primary w-100 text-center mb-2 mx-1"> Peer Products</a>
                                            @if(count($paginatedData["peerProducts"]["items"])==0)
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="card no-data_card">
                                                        <div class="nodata">
                                                            <i data-feather='hard-drive'></i>
                                                            <p>No Data</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach($paginatedData["peerProducts"]["items"] as $product)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <img class="card-img-top"  src="{{ $product->image }}" alt="Card image cap" />
                                                        <div class="card-body">
                                                            <div class="card-img-overlay">
                                                                <button class="btn btn-outline-danger text-nowrap px-1 waves-effect" style="float: right;" product_id="{{ $product->id}}"  onclick="deleteProduct(<?=  $product->id; ?>)" type="button">
                                                                    <i data-feather='trash-2'></i>
                                                                </button>
                                                            </div>
                                                        @if (!empty($product->scheduled_at) && $product->scheduled_at > now())
                                                            <div style="float:right;" class="bg-info-gradient d-flex">
                                                                <i style="margin-right: 10px; height: 1.4rem; color: #1aeaff; width: 2rem;" data-feather='clock'></i>
                                                                <p class="card-text text-dark">{{  date("d-m-Y", strtotime($product->scheduled_at)) }}</p>
                                                            </div>
                                                                @else
                                                                <p class="card-text text-white"></p>
                                                                @endif
                                                            <h4 class="card-title">{{ $product->title }}</h4>
                                                            <p class="card-text" >
                                                            {{ strlen($product->description) > 120 ? substr($product->description, 0, 120)."..." : $product->description }}   
                                                        </p>
                                                            <div style="display: flex; flex-direction :row;justify-content:space-between">
                                                                <a onclick="viewProduct({{ $product->id }},'{{ $product->link }}')" id="view-histories" class="btn btn-outline-primary">Visit Website</a>
                                                                <a class="waves-effect px-1" data-bs-toggle="modal" onclick="viweHistory({{$product->id}})" data-bs-target="#productClickHistory">
                                                                    <i style="width:1.2rem;height:2rem" data-feather="eye"></i><span class="histories-count-{{ $product->id }}">  {{$product->histories->count() }} </span>
                                                                </a>
                                                            
                                                                {{-- <a style="font-size:1.3rem" class="btn btn-default"><i style="height: 1.3rem; width: 1.8rem;" data-feather='activity'></i><span class="histories-count-{{ $product->id }}">  {{ $product->histories && count($product->histories) > 0  ? count($product->histories    ) : 0  }} </span></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
         <!-- reload button -->
                                        @if($paginatedData["peerProducts"]["last_page"] >$paginatedData["peerProducts"]["current_page"] )
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-lg btn-primary block-element border-0 mb-1 load_peer" onclick="loadPaginatedData('peer',{{ $paginatedData['peerProducts']['current_page'] }})">Load More</button>
                </div>
            </div>
            @endif
            <!--/ reload button -->

       
                                        <div id="normal-tab" class="row match-height">
                                            <a class="btn btn-primary w-100 text-center mb-2 mx-1"> Normal Products</a>
                                            @if(count($paginatedData["normalProducts"]["items"]) == 0)
                                            <div class="col-md-12 col-lg-12">
                                                <div class="card no-data_card">
                                                    <div class="nodata">
                                                        <i data-feather='hard-drive'></i>
                                                        <p>No Data</p>  
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                        @foreach($paginatedData["normalProducts"]["items"] as $product)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <img class="card-img-top"  src="{{ $product->image }}" alt="Card image cap" />
                                                        <div class="card-body">
                                                            <div class="card-img-overlay">
                                                                <button class="btn btn-outline-danger text-nowrap px-1 waves-effect" style="float: right;" product_id="{{ $product->id}}"  onclick="deleteProduct(<?=  $product->id; ?>)" type="button">
                                                                    <i data-feather='trash-2'></i>
                                                                </button>
                                                            </div>
                                                        @if (!empty($product->scheduled_at) && $product->scheduled_at > now())
                                                            <div style="float:right;" class="bg-info-gradient d-flex">
                                                                <i style="margin-right: 10px; height: 1.4rem; color: #1aeaff; width: 2rem;" data-feather='clock'></i>
                                                                <p class="card-text text-dark">{{  date("d-m-Y", strtotime($product->scheduled_at)) }}</p>
                                                            </div>
                                                                @else
                                                                <p class="card-text text-white"></p>
                                                                @endif
                                                            <h4 class="card-title">{{ $product->title }}</h4>
                                                            <p class="card-text" >
                                                            {{ strlen($product->description) > 120 ? substr($product->description, 0, 120)."..." : $product->description }}   
                                                        </p>
                                                            <div style="display: flex; flex-direction :row;justify-content:space-between">
                                                                <a onclick="viewProduct({{ $product->id }},'{{ $product->link }}')" id="view-histories" class="btn btn-outline-primary">Visit Website</a>
                                                                   
                                                                        <a class="waves-effect px-1" data-bs-toggle="modal" onclick="viweHistory({{$product->id}})" data-bs-target="#productClickHistory">
                                                                                <i style="width:1.2rem;height:2rem" data-feather="eye"></i><span class="histories-count-{{ $product->id }}">  {{$product->histories->count() }} </span>
                                                                        </a>
                                                                   
                                                                            {{-- <div class="avatar ">
                                                                                <a  data-bs-toggle="modal" onclick="viweHistory({{$product->id}})" data-bs-target="#productClickHistory">
                                                                                    <div class="avatar-content bg-primary">{{"+".$product->histories->count() - 3}}</div>
                                                                                </a> --}}
                                                                            {{-- </div> --}}
                                                                           
                                                                   
                                                                    
                                                                {{-- <a style="font-size:1.3rem" class="btn btn-default"><i style="height: 1.3rem; width: 1.8rem;" data-feather='activity'></i><span class="histories-count-{{ $product->id }}">  {{ $product->histories && count($product->histories) > 0  ? count($product->histories    ) : 0  }} </span></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- reload button -->
                                        @if($paginatedData["normalProducts"]["last_page"] >$paginatedData["normalProducts"]["current_page"] )
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-lg btn-primary block-element border-0 mb-1 load_normal" onclick="loadPaginatedData('normal',{{ $paginatedData['normalProducts']['current_page'] }})">Load More</button>
                                                </div>
                                            </div>
                                            @endif
                                            <!--/ reload button -->

                                       
                                       
                                 
                                </div>
                                </div>
                       
                        <!-- Basic pills ends -->
                     </div>
                </section>
                <!-- Basic and Outline Pills end -->

    <div class="modal fade" id="productClickHistory" tabindex="-1" aria-labelledby="productClickHistory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productClickHistoryTitle">Product Click History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="product-history-data">
                                
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            
            </div>
        </div>
    </div>

     
  
    </div>
</div>
@endsection

@section('scripts')
 
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/pages/app-user-edit.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/components/components-navs.js')}}"></script>
    <!-- END: Page JS-->

<script>
    function viweHistory(productId){
        let products = @json($paginatedData["normalProducts"]["items"]);
        productHistory= products.find(x=>x.id == productId).histories;
       let html = '';
        $("#product-history-data").html(html);
        $("#productClickHistoryTitle").text(products.find(x=>x.id == productId).title + " Click History");
        productHistory.map(x=>{
            console.log("🚀 ~ file: products.blade.php:419 ~ viweHistory ~ productHistory =>x:", x);
            html += '<tr>';
            html += '<td>';
             let output = x?.user?.profile_image && x?.user?.profile_image != '' ? ` <img src="/images/profile/user-upload/${x?.user?.profile_image}" alt="Avatar" height="32" width="32" />` : x.user.name.split(" ").filter(x=>!!x).map(x=>x[0]).join("");
               let username = x.user.username ?  x.user.username : x.user.name.split(" ").join("_");
             html += '<div class="d-flex justify-content-left align-items-center">' +
                    '<div class="avatar-wrapper">' +
                    '<div class="avatar ' +
                    ' {{ \App\Helpers\randomElementOfArray(['bg-secondary','bg-primary','bg-success','bg-danger','bg-warning','bg-info'])}}' +
                    ' me-1">' +
                    output +
                    '</div>' +
                    '</div>' +
                    '<div class="d-flex flex-column">' +
                    '<a href="#" class="user_name text-truncate"><span class="fw-bold">' +
                    x.user.name +
                    '</span></a>' +
                    '<small class="emp_post text-muted">@' +
                    username +
                    '</small>' +
                    '</div>' +
                    '</div>';
                html += '</td>';
                html += '<td>';
                html += (new Date(x.created_at)).toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric",
                hour12: true
                });
                html += '</td>';
                html += '</tr>';

        })
        console.log("🚀 ~ file: products.blaxde.php:467 ~ viweHistory ~ html:", html)
        $("#product-history-data").html(html);
    }
    function loadPaginatedData(type,page){
    ++page;
    let queryParam = "?editorpage="+page;
    switch(type){
        case 'editor':
             queryParam = "?editorpage="+page;
             break;
        case 'normal':
             queryParam = "?normalpage="+page;
            break;
        case 'peer':
            queryParam = "?peerpage="+page;
            break;
            default:
            break
    }

        $.ajax({
        url: `products/${queryParam}`,
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.error_message) {
                Toast.fire({
                    icon: 'error',
                    title: 'An error has been occured! Please Contact Administrator.'
                })

            } else {
              
                let group = "editorProducts";
                switch(type){
                    case 'editor':
                        group = "editorProducts";
                    break;
                case 'normal':
                    group = "normalProducts";
                    break;
                case 'peer':
                    group = "peerProducts";
                    break;
                    default:
                            break
                    }
                    console.log("🚀 ~ file: products.blade.php:240 ~ loadPaginatedData ~ group:", group)
                    response[group].items.map(x=>{
                        let paginateCard = "";
                        paginateCard += '<div class="col-md-6 col-lg-4">';
                        paginateCard += '<div class="card">';
                        paginateCard += ` <img class="card-img-top"  src="${x.image}" alt="Card image cap" />`;
                        paginateCard += '<div class="card-body">';
                        paginateCard += '<div class="card-img-overlay">';
                        paginateCard += `<button class="btn btn-outline-danger text-nowrap px-1 waves-effect" style="float: right;" product_id="${x.id}"  onclick="deleteProduct(${x.id})" type="button">`;
                        paginateCard += `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>`;
                        paginateCard += '</button>';
                        paginateCard += '</div>';
                    
                        paginateCard += '<div style="float:right;" class="bg-info-gradient d-flex">';
                        paginateCard += `<i style="margin-right: 10px; height: 1.4rem; color: #1aeaff; width: 2rem;" data-feather='clock'></i>`;
                        paginateCard += `<p class="card-text text-dark">${formatDate(x.scheduled_at)}</p>`;
                        paginateCard += '</div>';
                        paginateCard += '<p class="card-text text-white"></p>';
                        paginateCard += `<h4 class="card-title">${ x.title }</h4>`;
                        paginateCard += '<p class="card-text" >';
                        paginateCard += x.description && x.description.length > 120 ? x.description.substring(0, 120) + "..." : x.description;
                        paginateCard += ' </p>';
                        paginateCard += '  <div style="display: flex; flex-direction :row;justify-content:space-between">';
                        paginateCard += `<a onclick="viewProduct(${x.id},'${x.link}')" id="view-histories" class="btn btn-outline-primary waves-effect">Visit Website</a>`;
                        paginateCard += `<a class="waves-effect px-1" data-bs-toggle="modal" onclick="viweHistory(${x.id})" data-bs-target="#productClickHistory">`;  
                        paginateCard += `<svg style="height:2rem;width:1.2rem" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg><span class=" mx-2 histories-count-${x.id}">${x.histories.length}</span></a>`;
                        paginateCard += '</div></div></div></div>';
                        let load_button_identefier = "load_editor";
                        switch(type){
                        case 'editor':
                            $("#editor-tab").append(paginateCard);
                            load_button_identefier = "load_editor";
                            break;
                        case 'normal':
                            $("#normal-tab").append(paginateCard);
                            load_button_identefier = "load_normal";
                            break;
                        case 'peer':
                            $("#peer-tab").append(paginateCard);
                            load_button_identefier = "load_peer";
                            break;
                        default:
                            break
                        }
                      
                        if(response[group].current_page >= response[group].last_page){
                         
                            $("."+load_button_identefier).css("display","none");
                        
                    }
                      
                    });    
            }
        }
    });   
    }
function formatDate(date){
    const scheduledAt = new Date(date); // Replace with your own value
    const day = scheduledAt.getDate().toString().padStart(2, '0');
    const month = (scheduledAt.getMonth() + 1).toString().padStart(2, '0');
    const year = scheduledAt.getFullYear().toString();
    const formattedDate = `${day}-${month}-${year}`;
   return formattedDate;
}
function viewProduct(id,url){
    $.ajax({
            url: `products/${id}/view?redirect_url=${url}` ,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.error_message) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })

                } else {
                    Toast.fire({
                        icon: "success",
                        title: "Product is successfully Viewed!"
                    });
                    $(".histories-count-"+id).html(response.length);
                    window.open(url);
                }
            }
        });
           
}
function deleteProduct(id) {
    if (confirm("Are You sure want to Delete Product ! ")) {
        $.ajax({
            url: "products/" + id,
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.error_message) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })

                } else {


                    Toast.fire({
                        icon: "success",
                        title: "Product is successfully deleted !"
                    })
                    location.reload();
                }
            }
        });
    }
}
$(".nav-tab").click(function(event){
    event.preventDefault();
    var id = $(this).attr("id");
    console.log("🚀 ~ file: products.blade.php:411 ~ $ ~ id:", id)
    $(`.tab-pane`).removeClass('active');
    $(`[aria-labelledby="${id}"]`).addClass('active');
})
</script>

@endsection
