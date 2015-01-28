<?php

class UserController extends BaseController {

    
    public function index() {
        $users = User::all(); 
        $data = array(  'users' =>  $users,
            'title' => 'Users');

        return View::make('users/index')->with($data);
    }


    public function show($username) {
        try {
            $user = User::where('username','=',$username)->firstOrFail();
        } catch (Exception $e) {
            Session::flash('message', "$username not a valid user.");
            return Redirect::to('users');
        }
        $data = array(  'user' => $user,
            'title' => "$username's profile");
        return View::make('users/show')->with($data);
    }

    public function update() {
        $user = User::where('username', '=', Auth::user()->username)->firstOrFail();

        if (Hash::check(Input::get('old_password'), $user->password)) {
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            Session::flash('message', "$user->username  updated sucessfully!  Thank you.");
            return Redirect::to("users/show/$user->username");
        } else {
            // User got wrong password.
            Session::flash('message', "You have entered your current password incorrectly.");
            return Redirect::to("users/edit");
        }

    }

    public function edit() {
        if (Auth::check()) { 
            $user = User::where('username','=', Auth::user()->username)->firstOrFail();

            $data = array(  "title" => "Edit Profile",
                "user"  => $user); 
            return View::make('users/edit')->with($data);
        } else {
            Session::flash("message", "You are not autorized to view this page."); 
            return Redirect::to("/");
        }

    }

    public function showRegister() {
        return View::make('users/register')->with('title',  'Register');
    }

    public function doRegister() {
        $input = Input::all();
        $validator = User::validate($input);

        if ($validator->fails()) {
            Session::flash("errors", $validator->messages()->all());
            return Redirect::to('users/register');

        } else {
            $user = new User;
            $user->email = Input::get('email');
            $user->username = Input::get('username');

            // Explain why it's good to hash.
            $user->password = Hash::make(Input::get('password'));

            $user->save();


            $username = Input::get('username');
            $data = array (
                'title' => 'Registered',
                'username' => 'Username');
            Session::flash('message', "$username sucessfully registered!  Thank you.");
            return Redirect::to('/');
        }
    }

    public function login() {
        $credentials = Input::only('username', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::to("/");
        } else {
            Session::flash('message', 'Invalid credentials');
            return Redirect::to('/');
        }
    }

    public function logout() {
        Auth::logout();
        Session::flash("message", "Sucessfully logged out.");
        return Redirect::to('/');
    }

}
