<?php

class VideoController extends BaseController {

    public function show($id) {
        try {
            $video = Video::where("id", "=", $id)->firstOrFail();
        } catch (Exception $e) {
            Session::flash("message", "Video not found.");
            Redirect::to("/videos");
        }

        // Update the view count
        $video->views += 1;
        $video->save();

        $data = array(
            'title' => $video->title,
            "video" => $video
        );

        return View::make("/videos/show")->with($data);
    }

    public function index() {
        $videos = Video::all();

        $data = array(
            "title" => "Videos",
            "videos" => $videos,
            "owner" => false,
        );

        return View::make("/videos/index")->with($data);
    }

    public function from($username) {
        // If own user's list of a videos also give administration privledges.
        try {
            $user = User::where("username", "=", $username)->firstOrFail();
        } catch (Exception $e) {
            Session::flash("message", "Not a valid user.");
            Redirect::to("/videos");
        }

        // Ok so we have the user now lets find the videos
        $videos = $user->videos;
        $owner = false;
        if (Auth::check()) {
            $owner = ($username == Auth::user()->username);
        }

        $data = array(  "title" => "$username's videos",
                        "owner" => $owner,
                        "videos" => $videos,
                        "username" => $username);

        return View::make("videos/from")->with($data);
    }


    public function doCreate() {
       if (Auth::check())  {
           $video = new Video;
           $video->title = Input::get("title");
           $video->description = Input::get("description");
           $video->user_id = Auth::user()->id;
           $video->views = 0;

           // We need to extract the YouTube video ID.
           preg_match('/.youtube\.com\/watch\?v=(.+)&?/', Input::get("video"), $matches);
            if (count($matches) <= 0) {
                Session::flash("message","An invalid YouTube link was submitted");
                return Redirect::back();
           }
            $video->video = $matches[1];

           $validator = Video::validate(Input::all());
           if ($validator->failed())  {
               Session::flash("errors", $validator->messages()->all());
               Redirect::back();
           } else {
               $video->save();
              Session::flash("message", "$video->title added successfully.");
           }
       } else {
           Session::flash("message", "You do not have permission to access this.");
           return Redirect::to("videos/");
       }
    }

    public function showCreate() {
        if (Auth::check()) {
            $data = array (
                'title' => "Add Video"
            );
            return View::make("videos/new")->with($data);
        } else {
            Session::flash("message", "You must be logged in to add a video.");
            return Redirect::to("/videos");
        }
    }

}