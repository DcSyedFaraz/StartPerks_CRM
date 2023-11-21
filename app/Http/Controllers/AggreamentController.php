<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Aggreament;
use DataTables;
use DB;
class AggreamentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $aggreaments =  DB::table('aggreaments')
                        ->select('*')
                        ->get();
            return Datatables::of($aggreaments)->make(true);
        }
        $aggreaments =  DB::table('aggreaments')
                        ->select('*')
                        ->get();
        return view('Admin.aggreaments.index',compact('aggreaments'));
    }
        // Aggreament::all().;




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.aggreaments.create');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aggreament = new Aggreament();
        $aggreament->title = $request->title;
        $aggreament->body = $request->body;
        $aggreament->save();
        return ['code' => 200, 'success' => 'true' , 'message' => 'Aggreament created successfully'];
        //
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
    public function update(Request $request)
    {
        $aggreament = Aggreament::find($request->id);
        $aggreament->title = $request->title;
        $aggreament->body = $request->body;
        $aggreament->save();
        return ['code' => 200, 'success' => 'true' , 'message' => 'Aggreament updated successfully'];
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $aggreament = Aggreament::find($request->id);
        $aggreament->delete();
        return ['code' => 200, 'success' => 'true' , 'message' => 'Aggreament deleted successfully'];
        //
    }

    public function changeStatus(Request $request)
    {
        $aggreament = Aggreament::find($request->id);
        $aggreament->is_applied = $request->status;
        $aggreament->save();
        DB::table('aggreaments')->where('id','!=', $request->id)->update(['is_applied' => $request->status == "1" ? "0" : "1"]);
        return ['code' => 200, 'success' => 'true' , 'message' => 'Aggreament status changed successfully'];
    }
    public function currentAggreament(){
        $aggreament = Aggreament::where('is_applied',"1")->first();
        return view('Admin.aggreaments.view',compact('aggreament'));
    }

}
