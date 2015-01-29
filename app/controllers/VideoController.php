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
    }

    public function showCreate() {

    }

}