<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\ClientDocs;
use Auth;
use App\Models\Bank_cards;
use App\Models\Funding_detail;
use Illuminate\Validation\ValidationException;

class BussinessFundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data["clientdocs"] = ClientDocs::where("user_id",auth::id())->get();
        $data["banks"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
        "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
        "banks.bank_name")
        ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
        ->where("bank_cards.stage","stage_1")->get();
        
      //    dd($data["banks"][3]->funding_detail);
        $data["banks_1"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
        "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
        "banks.bank_name")
        ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
        ->where("bank_cards.stage","stage_2")->get();
        
        
        $data["banks_2"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
        "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
        "banks.bank_name")
        ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
        ->where("bank_cards.stage","stage_3")->get();
        
  
        $data["banks_3"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
        "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
        "banks.bank_name")
        ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
        ->where("bank_cards.stage","stage_4")->get();



        dd($data["banks"]);
        return view('Client.bussiness_funding',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }
}
