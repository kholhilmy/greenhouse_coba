<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{
    // public function index() {

    //     $users = User::all();

    //     // untuk mwngambil keyword yang dimasukkan dalam search box
    //     // if(request('search')) {
    //     //     $pemiliks->where('nama', 'like', '%' . request('search') . '%')
    //     //         ->orWhere('alamat', 'like', '%' . request('search') . '%');
    //     // }
        
    //     return view('laravel-examples/user-management')->with('users', $users);
        
    // }

    public function index(Request $request) {
        $users = User::all();

        // Handle the search functionality
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%')
                         ->get();
        }

        // Get the view name from the query parameter, default to 'user-management'
        $view = $request->query('view', 'user-management');

        // Ensure the view exists to prevent errors
        $allowedViews = ['user-management', 'user-profile'];
        if (!in_array($view, $allowedViews)) {
            abort(404); // View not allowed
        }

        return view("laravel-examples.{$view}")->with('users', $users);
    }
    
    
    public function create()
    {
        // return view('laravel-examples/user-profile');
        return view('laravel-examples.create-user');
    }

    public function store(Request $request) {
        // Validate the request data
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['max:50'],
            'location' => ['max:70'],
            'about_me' => ['max:150'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        }
    
        // $user = User::create([
        //     'name' => $attributes['name'],
        //     'email' => $attributes['email'],
        //     'phone' => $attributes['phone'],
        //     'location' => $attributes['location'],
        //     'about_me' => $attributes['about_me'],
        //     // 'password' => bcrypt($attributes['password']), // Encrypt the password
        // ]);
        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes["about_me"],
        ]);
    
        return redirect('/users?view=user-profile')->with('success', 'User created successfully');
    
        // Redirect to the user management page with a success message
        
    }
    

    // public function store(Request $request)
    // {

    //     $attributes = request()->validate([
    //         'name' => ['required', 'max:50'],
    //         'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
    //         'phone'     => ['max:50'],
    //         'location' => ['max:70'],
    //         'about_me'    => ['max:150'],
    //     ]);
    //     if($request->get('email') != Auth::user()->email)
    //     {
    //         if(env('IS_DEMO') && Auth::user()->id == 1)
    //         {
    //             return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                
    //         }
            
    //     }
    //     else{
    //         $attribute = request()->validate([
    //             'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
    //         ]);
    //     }
        
        
    //     User::where('id',Auth::user()->id)
    //     ->update([
    //         'name'    => $attributes['name'],
    //         'email' => $attribute['email'],
    //         'phone'     => $attributes['phone'],
    //         'location' => $attributes['location'],
    //         'about_me'    => $attributes["about_me"],
    //     ]);


    //     return redirect('/user-profile')->with('success','Profile updated successfully');
    // }
}
