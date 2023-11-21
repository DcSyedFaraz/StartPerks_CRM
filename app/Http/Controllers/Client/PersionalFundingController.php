<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\ClientDocs;
use Auth;
use App\Models\Bank_cards;
use App\Models\Funding_detail;
use App\Models\funding_form_status;

use Illuminate\Validation\ValidationException;


class PersionalFundingController extends Controller
{
    public function index()
    {
     

      $catogery = 'personal_funding_1696265149';
      $data["form_stage"] = funding_form_status::where("Type","personal_funding_1696265149")
      ->where("user_id",Auth::id())->first();
      if(empty($data["form_stage"]))
      {
        funding_form_status::insert([
            "user_id" => Auth::id(),
            "Type" => $catogery,
        ]);
        $data["form_stage"] = funding_form_status::where("Type","personal_funding_1696265149")
        ->where("user_id",Auth::id())->first();
      }  
      $data["clientdocs"] = ClientDocs::where("user_id",auth::id())->get();
      $data["banks"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
      "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
      "banks.bank_name","categories.slug")
      ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
      ->join('categories', 'bank_cards.cat_id', '=', 'categories.id')
      ->where("bank_cards.stage","stage_1")
      ->where("categories.slug", $catogery)->get();
      $data["banks_1"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
      "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
      "banks.bank_name")
      ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
      ->join('categories', 'bank_cards.cat_id', '=', 'categories.id')
      ->where("bank_cards.stage","stage_2")
      ->where("categories.slug", $catogery)->get();
      
      
      
      $data["banks_2"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
      "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
      "banks.bank_name")
      ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
      ->join('categories', 'bank_cards.cat_id', '=', 'categories.id')
      ->where("bank_cards.stage","stage_3")
      ->where("categories.slug", $catogery)->get();



       $data["banks_3"] = Bank_cards::with("funding_detail")->select("bank_cards.id","bank_cards.url","bank_cards.image",
      "bank_cards.card_name","bank_cards.bank_id","bank_cards.cat_id","bank_cards.stage",
      "banks.bank_name")
      ->join('banks', 'bank_cards.bank_id', '=', 'banks.id')
      ->join('categories', 'bank_cards.cat_id', '=', 'categories.id')
      ->where("bank_cards.stage","stage_4")
      ->where("categories.slug", $catogery)->get();
      
       return view('Client.personal_funding',$data);
    }

    public function doc_upload(request $request)
    {
        try{
            $this->validate($request, [
                'driving_licence' => 'required|file|mimes:jpeg,png,pdf',
                'proof_of_address' => 'required|file|mimes:jpeg,png,pdf',
                'social_sercuity_card' => 'required|file|mimes:jpeg,png,pdf',
            ]);
            if($request->hasFile("driving_licence")){
                $uploadedFile = $request->file('driving_licence');
                $path = $uploadedFile->store('uploads/documents', 'public');
                // Generate a URL for the uploaded file
                $image = Storage::disk('public')->url($path);
                $data["driving_licence"] = $image; 
            }
            if($request->hasFile("proof_of_address")){
                $uploadedFile = $request->file('proof_of_address');
                $path = $uploadedFile->store('uploads/documents', 'public');
                // Generate a URL for the uploaded file
                $image = Storage::disk('public')->url($path);
                $data["proof_of_address"] = $image; 
            }
            if($request->hasFile("social_sercuity_card"))
            {
                $uploadedFile = $request->file('social_sercuity_card');
                $path = $uploadedFile->store('uploads/documents', 'public');
                // Generate a URL for the uploaded file
                $image = Storage::disk('public')->url($path);
                $data["social_sercuity_card"] = $image; 
            }
            $data["user_id"] = Auth::id();
            ClientDocs::create($data);
            funding_form_status::where("user_id",Auth::id())->update([
                "stage_1" => true,
            ]);
            return ['code' => '200','status' => true, 'message' => "Record Successfully Saved"];
        }


        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException)
            {
                return ['code' => '400', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '500', 'error_message' => $e->getMessage()];
            }
        }
    }

    public function card_detail_upload(request $request)
    {
        
        // dd($request->all());
        try{
            $this->validate($request, [
                'bank_id' => 'required|integer',
                'card_id' => 'required',
                'aprroval_status' => 'required|string',
                'amount' => 'required',
            ]);
           $data = array(
                "card_id" => $request->card_id,
                "bank_id" => $request->bank_id,
                "cat_id" => $request->cat_id,
                "aprroval_status" => $request->aprroval_status,
                "amount" => $request->amount,
                "stage" => $request->stage,
                "user_id" => Auth::id()
           );
           $funding_Detail = Funding_detail::where("card_id",$request->card_id)
           ->where("bank_id",$request->bank_id)
           ->where("cat_id",$request->cat_id)
           ->where("user_id",Auth::id())->first();
            if(empty($funding_Detail))
            {
              Funding_detail::create($data);
              funding_form_status::where("user_id",Auth::id())->update([
            ]);
            }
            else
            {
              $funding_Detail->fill($data)->save();
            }
   
           return ['code' => '200', 'message' => "Record Successfully Saved"];
        }


        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException)
            {
                return ['code' => '400', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '500', 'error_message' => $e->getMessage()];
            }
        }
        
    }
}
