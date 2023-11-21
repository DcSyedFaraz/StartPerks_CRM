<?php

namespace App\Http\Controllers;



use DataTables;
use App\Models\User;
use App\Models\Comment;
use App\Models\Aggreament;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Throwable;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomersController extends Controller
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
        if($request->ajax()){    
            
            $users =  User::role('customer')  
            ->orderBy('updated_at', 'desc')
            ->get();
            foreach ($users as $index => $user) {
                $user->username = $user->username;
                if(empty($user->username )){
                    $user["username"] = strtolower(str_replace(' ', '_', $user["name"]));
                }
               
            }
            return Datatables::of($users)->make(true);
        }
        $Users =  User::role('customer') 
         ->orderBy('updated_at', 'desc')
        ->get();
        return view('Admin.customers.customers',compact('Users')); 
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
            $this->validate($request, [
                'username' => 'required|string|max:255|unique:users',
                'email' =>  'required|string|email|max:255|unique:users',
                'name' => 'required',
                'phoneNumber' => 'string|max:255',
                'gender'=> 'required',
                'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                            ]);

              if($request->hasfile('profileImage')){
                    $file = $request->file('profileImage');
                    $profile_image_name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/profile/user-upload',$profile_image_name);
                }
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                
                
                $user->username = $request->username;
                $user->phone_no = $request->phoneNumber;
                $user->address = $request->address;
                $user->country = $request->country;
                $user->city = $request->city;
                $user->is_active = '1';
                $user->profile_image =  $profile_image_name;
                $dob = date("Y-m-d", strtotime($request->dob));
                $user->date_of_birth = $dob ;
                $user->twitter_url = $request->twitter;
                $user->facebook_url = $request->facebook;
                $user->google_url = $request->google;
                $user->linkdin_url = $request->linkedin;
                $user->bio= $request->bio;
                $user->gender = $request->gender;
                $user->postal_code = $request->pincode;
                $user->assignRole('customer');
                $user->save();
                return ['code' => '200', 'message' => 'success'];    
        } catch (Exception   $e) {
                return ['code' => '400', 'error' => $e];   
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
        $data = User::with(["views"=>function($q){
            $q->with("product");
        }])->find($id) ;
       
            if($data->profile_image == null || $data->profile_image == ''){
                $data->profile_image = 'profile.png';
            }
            if($data->username == null || $data->username == ''){
                $data->username = strtolower(str_replace(' ', '_',  $data["name"]));
            }
          
        $announcemts = DB::table('announcements')
        ->orderBy('updated_at', 'desc')
        ->get();
        $comments = Comment::join('users','comments.user_id','=','users.id')
        ->select('comments.*','users.name','users.profile_image')->get();
        foreach ($announcemts as $key => $value) {
            $announcemts[$key]->comments = [];
            foreach ($comments as $key2 => $value2) {
                if($value2->post_id == $value->id){
                    $announcemts[$key]->comments[] = $value2;
                }
            }
        }
      
        $announcemts = $announcemts->filter(function($value)  use ($id) {
            return (new Collection($value->comments))->filter(function($q) use ($id){
              return  $q->user_id == $id;
            })->count() > 0;
        });
       
    
        $agreements = Aggreament::whereHas('contracts',function ($query) use ($id) {
            $query->where('user_id', $id);
        })->with('contracts',function ($query ) use ($id)
        {
            return $query->where('user_id', $id)->first();
        })->get();
           
        return view('Admin.customers.viewCustomers',compact('data','announcemts','agreements'));
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
        $data = User::find($id);
        
        foreach($data as $key => $value){
            if($data['profile_image'] == null || $data['profile_image'] == ''){
                $data->profile_image = 'profile.png';
            }
            if($data['username'] == null || $data['username'] == ''){
                $data->username = strtolower(str_replace(' ', '_',  $data["name"]));
            }
        }
        return view('Admin.customers.editCustomers',compact('data'));
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
            $data = User::find($id);
            if($data->profile_image != null || $data->profile_image != ''){
                $image_path = public_path().'/images/profile/user-upload/'.$data->profile_image;
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                
            }
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
  
     
    public function updateCustomer(Request $request,$id)
    {
        try {
            $this->validate($request, [
                'username' => 'required|string|max:255|unique:users',
                'email' =>  'required|string|email|max:255|unique:users',
                'name' => 'required',
                'phoneNumber' => 'string|max:255',
                'gender'=> 'required',
                'address' => 'required',
                'country' => 'required',
                'pincode' => 'required',
                'city'=> 'required',
                'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                            ]);
                $user = User::find($id);
        
                if($request->hasfile('profileImage')){
                    unlink(public_path().'/images/profile/user-upload/'.$user->profile_image);
                    $file = $request->file('profileImage');
                    $profile_image_name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/profile/user-upload',$profile_image_name);
                }
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->phone_no = $request->phoneNumber;
                $user->address = $request->address;
                $user->country = $request->country;
                $user->city = $request->city;
                $user->postal_code = $request->pincode;
                $user->is_active = '1';
                $user->profile_image =  $profile_image_name;
                $user->date_of_birth = $request->dob;
                $user->twitter_url = $request->twitter;
                $user->facebook_url = $request->facebook;
                $user->google_url = $request->google;
                $user->linkdin_url = $request->linkedin;
                $user->bio= $request->bio;
                $user->save();
            return ['code' => '200', 'message' => 'success'];
        } catch (\Exception | ValidationException $e) {
            if ($e instanceof ValidationException) {
                return ['code' => '400', 'errors' => $e->errors()];
            } else {
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }
}
