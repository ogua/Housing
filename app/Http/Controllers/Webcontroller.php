<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\syncRoles;
use App\Models\User;
use App\Models\Car;

class Webcontroller extends Controller
{
    

    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function signup()
    {
        return view('signup');
    }

    public function book()
    {
        $data = Car::where('status',1)->get();

        return view('book',compact('data'));
    }

    public function carinfo($id)
    {
        $car = Car::where('id',$id)->first();

        return view('book-info',compact('car'));
    }

    public function register(Request $request)
    {
        //dd($request);
        
        $this->validate($request,[
            'password' => 'required|min:6|confirmed'
        ]);

        $data = [
            'username' => $request->email,
            'name' => $request->fullname,
            'phone' => $request->phone,
            'location' => $request->location,
            'avatar' => $request->has('pic') ? $request->file('pic')
            ->store('profile','admin') : '',
            'password' => bcrypt($request->password),
        ];

        $new = new User($data);
        $new->save();

        $new->syncRoles("User");

        return Redirect()->back()->with('success','User registered Successfully!');
    }
}
