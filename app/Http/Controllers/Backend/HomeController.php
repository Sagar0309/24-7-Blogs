<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\User;

class HomeController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.home.home');
    }

    public function edit(Request $request){
        $user=$request->user();
        return view('backend.home.edit',compact('user') );

    }

    public function update(Request $request, $id){
        //dd('hello');
        $this->validate($request, [
            'name'=>'required|',
            'email'=>'email|required|unique:users,email',
            'password'=>'required_with:password_confirmation|confirmed'
        ]);
        $User=User::findOrFail($id);
        $User->name=$request->input('name');
        $User->email=$request->input('email');
        $User->bio=$request->input('bio');
        if ( ! $request->input('password') == '')
        {
            $User->password = bcrypt($request->input('password'));
        }
        $User->save();
        return redirect()->back()->with("message","Account was updated sucessfully.");

    }
}
