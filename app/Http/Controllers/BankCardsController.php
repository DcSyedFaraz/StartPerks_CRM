<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\Bank_cards;
use App\Models\Category;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;


class BankCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //
        if($request->ajax()){
            return Datatables::eloquent(Bank_cards::query())->make(true);
        }
        $data["catogeries"]  = Category::all();
        $data["Banks"]  = Banks::all();
        $data["stages"]  = array(
            [
                "value" => "stage_1",
                "text" => "First Stage" 
            ],
            [
                "value" => "stage_2",
                "text" => "Second Stage" 
            ],
            [
                "value" => "stage_3",
                "text" => "third Stage" 
            ],
            [
                "value" => "stage_4",
                "text" => "fourth Stage" 
            ]            
        );
        return view('Admin.bank_cards.index',$data);
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

        try{
            $this->validate($request, [
                'category_id' => 'required',
                'stage' => 'required',
                'bank_id' => 'required',
                'card_name' => 'required',
                'url' => 'required',
                'image' => 'required|file|mimes:jpeg,png,pdf'
            ]);
            $data = array(
                "bank_id" => $request->bank_id,
                "cat_id" => $request->category_id,
                "stage" => $request->stage,
                "card_name" => $request->card_name,
                "card_name_slug" => Str::slug($request->card_name),
                "url" => Str::slug($request->url),
                "status" => true
            );

            $uploadedFile = $request->file('image');
            $path = $uploadedFile->store('uploads/cards', 'public');
            // Generate a URL for the uploaded file
            $image = Storage::disk('public')->url($path);
            $data["image"] = $image; 
            Bank_cards::create($data);
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '400', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '200', 'error_message' => $e->getMessage()];
            }
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
        $data = Bank_cards::find($id);
        return response()->json($data);
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
        try{
            $this->validate($request, [
                'category_id' => 'required',
                'stage' => 'required',
                'bank_id' => 'required',
                'card_name' => 'required',
                'url' => 'required',
            ]);
            $data = array(
                "bank_id" => $request->bank_id,
                "cat_id" => $request->category_id,
                "stage" => $request->stage,
                "card_name" => $request->card_name,
                "card_name_slug" => Str::slug($request->card_name),
                "url" => Str::slug($request->url),
                "status" => true
            );

            if($request->hasFile("image")){
                $uploadedFile = $request->file('image');
                $path = $uploadedFile->store('uploads/cards', 'public');
                // Generate a URL for the uploaded file
                $image = Storage::disk('public')->url($path);
                $data["image"] = $image; 
            }
            $Bank_cards = Bank_cards::find($id);
            $Bank_cards->fill($data)->save();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '400', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '200', 'error_message' => $e->getMessage()];
            }
        }
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
