<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;
use App\Http\Controllers\Throwable;
use Illuminate\Support\Facades\Hash;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $categories =  DB::table('categories')
                        ->select('*')
                        ->get();
            foreach ($categories as $key => $value) {
                $categories[$key]->parent_name = "";
                if(!empty($value->parent_id)){
                    $parent = DB::table('categories')
                    ->select('*')
                    ->where('id',$value->parent_id)
                    ->first();
                    $categories[$key]->parent_name = $parent->name;
            }
        }
            return Datatables::of($categories)->make(true);
        }
        $categories =  DB::table('categories')
                        ->select('*')
                        ->get();
        foreach ($categories as $key => $value) {
            $categories[$key]->parent_name = "";
            if(!empty($value->parent_id)){
                $parent = DB::table('categories')
                ->select('*')
                ->where('id',$value->parent_id)
                ->first();
                $categories[$key]->parent_name = $parent->name;
        }
    }
        return view('Admin.categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $this->validate($request, [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
            'icon'      => 'sometimes|nullable|string',
      ]);
        $slug = strtolower(str_replace(' ', '_', $request->name)).'_'.time();
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = $slug;
        $category->icon = $request->icon;
        $category->status = "active";
        $category->save();


      return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
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
            $data = Category::find($id);

            $data->delete();
            return ['code' => '200','message'=>'success'];
        }
        catch(\Exception $e){
            return ['code' => '200','error_message'=>$e->getMessage()];
        }
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sidebarCategory()
    {
        try{

            $categories = Category::where('parent_id', '=', null)->get();

            return ['code' => '200','message'=>'success' ,'categories'=>$categories];
        }
        catch(\Exception $e){
            return ['code' => '200','error_message'=>$e->getMessage()];
        }
    }
    public function Sidebar( $data = [] , $last_inserted = 0 , $dataIndex = 0 , $disallow_id = [] ){
        if(!empty($disallow_id)){
            $data2 = DB::select("select * from categories where status = 'active' and parent_id = $last_inserted AND Not in (".implode(',',$disallow_id).")");
            // $disallow_id.array_push( $data2->id);
            if(count($data)>0){
                $data[$dataIndex]->child = $data2;
                $dataIndex++;
                $last_inserted = $data2->id;
                $disallow_id.array_push( $data2->id);
                $this->Sidebar( $data , $last_inserted , $dataIndex , $disallow_id );
            }
            else{
                $data3 = DB::select("select * from categories where status = 'active' and parent_id = null AND Not in (".implode(',',$disallow_id).")")->first();
                if(count($data3)>0){

                    foreach($data3 as $key => $value){
                        $data[$dataIndex].array_push($value);
                        $dataIndex++;
                        $last_inserted = $value->id;
                        $disallow_id.array_push( $value->id);
                        $this->Sidebar( $data , $last_inserted , $dataIndex , $disallow_id );
                    }

                }else{
                    return $data;
                }
            }
        }else{
            $data2 = DB::select("select * from categories where status = 'active' and parent_id = " .$last_inserted. "");
            foreach($data2 as $key => $value){
                    $disallow_id.array_push( $value->id);
                    $dataIndex = 0;
                    $last_inserted = $value->id;
                    $data.array_push( $value);
                    return $data;
                    $this->Sidebar( $data , $last_inserted , $dataIndex , $disallow_id );
                }
            }

        return $data;
    }

}
