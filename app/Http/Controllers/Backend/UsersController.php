<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Backend;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\User;

use App\Role;


class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users= User::orderBy('name')->paginate($this->limit);
        $usersCount=User::count();
        return view("backend.users.index", compact('users','usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=new User();
        return view('backend.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'role'=>'required'
        ]);
        $user=new User();
        $data = $request->all();
        //$data->attachRole($request->role);
        $data['password'] = bcrypt($data['password']);
        $data['slug']=$user->getSlugforName($request->input('name'));
        //$request->request->add(['slug' => $user->getSlugforName($request->input('name'))]);
        $user= User::create($data);//pass data to create
        $user->roles()->attach($request->input('role')); //attach role to user
        return redirect('/backend/users')->with('message', 'New User is created sucessfully!');     
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
        $user=User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
        
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
        $this->validate($request, [
            'name'=>'required|',
            'email'=>'email|required|unique:users,email,'.$id,
            'password'=>'required_with:password_confirmation|confirmed',
            'role'=>'required',
        ]);
        $User=User::findOrFail($id);
        $User->name=$request->input('name');
        $User->email=$request->input('email');
        $User->bio=$request->input('bio');
        $User->detachRoles();
        $User->attachRole($request->role);
        $User->slug=$User->getSlugforName($request->input('name'));
        if ( ! $request->input('password') == '')
        {
            $User->password = bcrypt($request->input('password'));
        }
        $User->save();
        return redirect('/backend/users')->with('message', 'User is updated sucessfully!');  
        
        /**
         *  $user = Auth::user();
    
         *  $user->username = Request::input('username');
         *  $user->email = Request::input('email');

         *  if ( ! Request::input('password') == '')
         *{
         *$user->password = bcrypt(Request::input('password'));
         *}

         *$user->save();
         */
           

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
            $deleteOption=$request->delete_option;
            $selectedUser=$request->select_user;
            $User=User::findOrFail($id);
            if($deleteOption=='delete')
            {
                $User->post()->withTrashed()->forceDelete();
            }elseif($deleteOption=='attribute'){
                $User->post()->update(['author_id'=>$selectedUser]);
            }            
            $User->delete();
            return redirect('/backend/users')->with('message', 'User is Deleted sucessfully!');
    }

    public function confirm($id)
    {
        //
            $user=User::findOrFail($id);
            $users=User::where('id','!=', $user->id)->pluck('name','id');
            return view('backend.users.confirm', compact('user','users'));
    }
}
