<?php


class UserController extends BaseController {


    /**
     * Produces a list of users.
     */
    public function index() {
        $users = User::all();
        $data = array(  'users' =>  $users,
            'title' => 'Users');

        return View::make('users/index')->with($data);
    }

    /**
     *
     */
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
            $user_input = Input::all();

            if ($user_input['email'] == $user->email) 
                $user_input['email'] = null;
            if ($user_input['username'] == $user->username)
                $user_input['username'] = null;

            $validator = User::update_validate($user_input);
            if ($validator->fails()) {
                Session::flash("errors", $validator->messages()->all());
                return Redirect::back();
            } else {
                if ($user_input['email'])
                    $user->email = Input::get('email');

                if ($user_input['username'])
                    $user->username = Input::get('username');

                if ($user_input['password'])
                    $user->password = Hash::make(Input::get('password'));

                $user->bio = $user_input['bio'];

                $user->save();

                Session::flash('message', "$user->username  updated sucessfully!  Thank you.");
                return Redirect::to("users/show/$user->username");
            }
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
        $validator = User::register_validate($input);

        if ($validator->fails()) {
            Session::flash("errors", $validator->messages()->all());
            return Redirect::to('users/register');

        } else {
            $user = new User;
            $user->email = Input::get('email');
            $user->username = Input::get('username');

            $user->password = Hash::make(Input::get('password'));

            $user->save();


            $username = Input::get('username');
            $data = array (
                'title' => 'Registered');
            Session::flash('message', "$username sucessfully registered!  Thank you.");
            return Redirect::to('/');
        }
    }
    public function Destroy() {
        if (Auth::check()) {
            $user = User::where('username','=', Auth::user()->username)->firstOrFail();

            if (Hash::check(Input::get('password'), $user->password)) {
                Auth::logout();
                Session::flash("message", "User: " . $user['username'] ." deleted!");

                // We also should delete all videos belonging to the user.
                $videos = $user->videos;
                foreach ($videos as $video) {
                    $video->delete();
                }
                $user->delete();
                return Redirect::to("/users"); 
            } else {
                Session::flash('message', "Incorrect password");
                return Redirect::to("/users/destroy");

            }
        } else {
            Session::flash("message", "You are not authorized to do this acount.");
            return Redirect::to("/users");
        }
    }


    public function showDestroy() {
        if (Auth::check()) {
            $data = array (
                'title' => 'Delete Account');
            return View::make("users/destroy")->with($data);
        } else {
            Session::flash("message", "You are not authorized to do this action.");
            return Redirect::to("/users");
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
