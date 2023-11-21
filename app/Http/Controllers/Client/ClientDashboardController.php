<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ClientDocs;
use Auth;
use App\Models\Bank_cards;
use App\Models\Funding_detail;
use App\Models\funding_form_status;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $data["total_funding"] = Funding_detail::select(DB::raw("sum(funding_details.amount) as totalamount"))->where("user_id",Auth::id())->first();
        $data["last_funding"] = Funding_detail::select(DB::raw("sum(funding_details.amount) as totalamount"))
        ->where('created_at', '>=', Carbon::now()->subDay())
            ->first();
        $data["approved_amounts"] = Funding_detail::select(DB::raw("Concat(banks.bank_name,' ',bank_cards.card_name) as name"),"amount")
        ->join('banks', 'bank_id', '=', 'banks.id')
        ->join('bank_cards', 'card_id', '=', 'bank_cards.id')
        ->where("user_id",Auth::id())
        ->where("aprroval_status","accept")
        ->orderby("funding_details.id","desc")
        ->get();
        return view('Client.dashboard',$data);
    }
    public function products(){
         return view('Client.products');
    }
     
      public function profile(){
         return view('Client.profile');
    }
    

    public function step_process(request $request)
    {
        
        $cards_count = Bank_cards::join("categories", 'bank_cards.cat_id', '=', 'categories.id')
        ->where("categories.slug",$request->type)
        ->where("stage",$request->stage)
        ->count();
        $fd_count =  Funding_detail::join("categories", 'funding_details.cat_id', '=', 'categories.id')
        ->where("categories.slug",$request->type)
        ->where("funding_details.stage",$request->stage)
        ->count();
        if($cards_count == $fd_count)
        {
            funding_form_status::where("user_id",Auth::id())->update([
                $request->stage_enabled => true
            ]); 
            return response()->json(["status" => true,"message" => "successfully Stage Enabled"], 200);
        }
        return response()->json(["status" => false ,"error_message" => "Please Complete Your all Stage Requirments"], 200);
    
    }
}
