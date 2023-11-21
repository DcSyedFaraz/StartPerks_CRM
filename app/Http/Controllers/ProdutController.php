<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Dusterio\LinkPreview\Client;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use App\Models\ProductClickHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;

class ProdutController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Support\Collection $paginatedData
     */
    public function index(Request $request)
    {
        $editorpage = $request->query("editorpage") ? $request->query("editorpage") : null;
        $peerpage = $request->query("peerpage") ? $request->query("peerpage") : null;
        $normalpage = $request->query("normalpage") ? $request->query("normalpage") : null;
         $paginatedData = $this->getAllProducts($editorpage,$peerpage,$normalpage );
        if($editorpage || $normalpage || $peerpage){
            return $paginatedData;
        }
        return view('Admin.products.products', compact('paginatedData'));
    }
    /**
     * Fetching all Products.
     *@param integer $editorpage
     *@param integer $peerpage
     *@param integer $normalpage
     * @return \Illuminate\Support\Collection $paginatedData
     */
    public function getAllProducts($editorpage = null,$peerpage = null,$normalpage = null){
        $editorProducts = Product::with(["categories","histories"=> function ($query) {
            return  $query->with("user");
        }])
        ->where("is_editor_choice",true)
        ->paginate(6, ["*"], "page", $editorpage);

        $peerProducts = Product::with(["categories","histories"=> function ($query) {
            return $query->with("user");
                            }])
                        ->whereHas("histories")
                        ->withCount("histories")
                        ->orderBy("histories_count", "desc")
                        ->paginate(6, ["*"], "page", $peerpage);
                      
        $normalProducts = Product::with(["categories","histories"=> function ($query) {
                         return $query->with("user");
                            }])
                        ->withCount("histories")
                        ->orderBy("histories_count", "desc")
                        ->paginate(6, ["*"], "page", $normalpage);
        $products = new Collection(["peerProducts"=>$peerProducts,"editorProducts"=>$editorProducts,"normalProducts"=>$normalProducts]);
        $paginatedData = $products->map(function ($items, $key) {
            return [
                'total' => $items->total(),
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'last_page' => $items->lastPage(),
                "items" => $items->items()
            ];
        });
        return $paginatedData;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{


        $validatedData = $this->validate($request, [
            'link'      => 'required|url',
      ]);
        $product = new Product();
        $product->link = $request->link;
         $product->category_id = $request->catagory;
         $product->title =  $request->product_title;
         $product->description = $request->product_description;
         $product->description = $request->product_description;
         $product->image = $request->product_image;
         $product->is_editor_choice = $request->is_editor_choice == 'true' ? 1 : 0;
         $newDate = date("Y-m-d", strtotime($request->scheduled_date));
         $product->scheduled_at =  $newDate;
         $product->save();
        if($request->announcements == 'true'){
            $announcement = new Announcement();
            $announcement->description =  $request->product_description;
            $announcement->image =   $request->product_image;;
            $announcement->save();
        }

        return ['code' => '200','message'=>'Successfully Data is Inserted' ,'data'=>''];
      }
      catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Product::find($id);

            $data->delete();
            return ['code' => '200','message'=>'success'];
        }
        catch(\Exception $e){
            return ['code' => '200','error_message'=>$e->getMessage()];
        }
    }
    
    /**
     * Redirect the Url.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirectUrl(Request $request){
       $id =  $request->route()->parameter("id");
       $redirect_url =  $request->query("redirect_url");
      
       $prouducthistory = ProductClickHistory::create([
        "user_id" => Auth::user()->id,
        "product_id" => $id,
       ]);
       $productClientHistory = ProductClickHistory::where("product_id","=" ,$id )->get();
     
       return response($productClientHistory,200);
    }
    public function addProduct(){

        $Categories = Category::all();
        return view('Admin.products.addProducts',compact('Categories'));
    }

    public function scrapUrlData(Request $request){
        try {

            $url = $request->input('url');
            $previewClient = new Client($url);
            $previews = $previewClient->getPreviews();
            $preview = $previewClient->getPreview('general');
            $preview = $preview->toArray();

            if(!empty($preview['cover'])){
                $image =  $preview['cover'];
           }
            else{
                if(!empty($preview['images'])){
                    $image =  $preview['images'][0];
                }
                else{
                    $image = config('app.logo_image_url');
                }
            }
            $data = [
                'title' => $preview['title'],
                'description' => $preview['description'],
                'image' => $image,
                'url' => $url,  //$preview['url'],

            ];
            return ['code' => '200','message'=>'success' ,'data'=>$data];
        } catch (\Throwable $th) {
            return ['code' => '200','error_message'=>$th->getMessage()];
        }


    }
    public function salesList(Request $request){
        $editorpage = $request->query("editorpage") ? $request->query("editorpage") : null;
        $peerpage = $request->query("peerpage") ? $request->query("peerpage") : null;
        $normalpage = $request->query("normalpage") ? $request->query("normalpage") : null;
         $paginatedData = $this->getAllProducts($editorpage,$peerpage,$normalpage );
        if($editorpage || $normalpage || $peerpage){
            return $paginatedData;
        }
        return view('Admin.sales.index', compact('paginatedData'));     
    }
    public function getProducts(Request $request){
        try {
            
             $url = $request->slug;
             $now = Carbon::now()->toDateString();    
            $editorpage = $request->query("editorpage") ? $request->query("editorpage") : null;
            $peerpage = $request->query("peerpage") ? $request->query("peerpage") : null;
            $normalpage = $request->query("normalpage") ? $request->query("normalpage") : null;
            $editorProducts = Product::with(["categories","histories"  => function ($query) {
                            $query->with("user");
                                }])
                            ->withCount("histories")
                            ->where("is_editor_choice",true)
                            ->whereHas('categories', function ($query) use ($url) {
                                $query->where('slug', $url);
                            })  
                            ->orWhere(function($q) use ($now){
                                $q->orWhere('scheduled_at',"<=", $now)
                                    ->orWhereNull('scheduled_at');
                                
                            })  
                       
                            ->orderBy("histories_count", "desc")    
                            ->paginate(6, ["*"], "page", $editorpage);
               
                                    
            $peerProducts = Product::with(["categories","histories" => function ($query) {
                            $query->with("user");
                                }])
                            ->whereHas("histories")
                            ->withCount("histories")
                            ->whereHas('categories', function ($query) use ($url) {
                                $query->where('slug', $url);
                            })  
                            ->orWhere(function($q) use ($now){
                                $q->orWhere('scheduled_at',"<=", $now)
                                    ->orWhereNull('scheduled_at');
                                
                            })  
                            ->orderBy("histories_count", "desc")
                            ->paginate(6, ["*"], "page", $peerpage);
                       
            $normalProducts = Product::with(["categories","histories" => function ($query) {
                            $query->with("user");
                                }])
                            ->withCount("histories")
                            ->whereHas('categories', function ($query) use ($url) {
                                $query->where('slug', $url);
                            })
                            ->orWhere(function($q) use ($now){
                                $q->orWhere('scheduled_at',"<=", $now)
                                    ->orWhereNull('scheduled_at');
                                
                            })  
                            ->orderBy("histories_count", "desc")
                            ->paginate(6, ["*"], "page", $normalpage);
            $products = new Collection(["peerProducts"=>$peerProducts,"editorProducts"=>$editorProducts,"normalProducts"=>$normalProducts]);
            $paginatedData = $products->map(function ($items, $key) {
                return [
                    'total' => $items->total(),
                    'current_page' => $items->currentPage(),
                    'per_page' => $items->perPage(),
                    'last_page' => $items->lastPage(),
                    "items" => $items->items()
                ];
            });
            if($editorpage || $normalpage || $peerpage){
                return $paginatedData;
            }
            

            if (Auth::user()->hasRole('Salesman')) {
            return view('Salesman.products',compact('paginatedData'));
            }
            elseif(Auth::user()->hasRole('Customer')){
                return view('Client.products',compact('paginatedData'));
            }
        } catch (\Throwable $th) {
            return ['code' => '200','error_message'=>$th->getMessage()];
        }
    }
    
}
