<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use App\Models\Comment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\returnSelf;

use Illuminate\Validation\ValidationException;

class AnnouncementsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $announcments = DB::table('announcements')
        ->orderBy('updated_at', 'desc')
        ->get();
        $comments = Comment::join('users','comments.user_id','=','users.id')
        ->select('comments.*','users.name','users.profile_image')->get();
        foreach ($announcments as $key => $value) {
            $announcments[$key]->comments = [];
            foreach ($comments as $key2 => $value2) {
                if($value2->post_id == $value->id){
                    $announcments[$key]->comments[] = $value2;
                }
            }
        }
        
        if (Auth::user()->hasRole('Salesman')) {
        return view('Salesman.announcements',compact('announcments'));
        }
        elseif(Auth::user()->hasRole('Customer')){
            return view('Client.announcements',compact('announcments'));
        }else{
            return view('Admin.announcements',compact('announcments'));
        }


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

        try {
            $validatedData = $this->validate($request, [
                'description'      => 'required',
                'image'      => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           if($request->hasFile('image')){
            $file = $request->file('image');
            $announcement_image_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/announcements',$announcement_image_name);
            }
            $announcement = new Announcement();
            $announcement->description = $request->description;
            $announcement->image = $announcement_image_name;
            $announcement->save();
            return ['code' => '200','message'=>'success'];;
        } catch (ValidationException $e) {
            return ['code' => '500' , 'error' => $e];
        } catch (Exception   $e) {
                return ['code' => '500' , 'error' => $e];

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        // dd($request->hasfile('profileImage'));
        // echo $request['twitter'];
        // die;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


        public function imagesupload(Request $request,){
        if($request){
           return true;
        }
        else{
            return false;
        }
        return view('Admin.salesman.imagesupload');
    }
    public function PostComment(Request $request)
    {
        try{
        $validatedData =  $request->validate( [
            'comment'      => 'required|min:3|max:255|string',
            'post_id'      => 'required',
        ]);
      $post_id =  substr($request->post_id, 7 );
        //    string to int
        $post_id = (int)$post_id;

        // show validation error message
            $comment = new Comment();
            $comment->body = $request->comment;
            $comment->post_id =  $post_id;
            $comment->user_id = Auth::user()->id;
            $comment->save();
            //json response
            return response()->json(['code'=> 200 , 'error' => 'false' , 'success'=>'You have successfully created a Comment!']);
                }
    catch(\Exception | ValidateException $e){
        if($e instanceof ValidateException){

            return ['code' => '400', 'error' => $e->errors()];
        }
        else{
            return ['code' => '400', 'error_message' => $e->getMessage()];
        }
    }


    }
}
