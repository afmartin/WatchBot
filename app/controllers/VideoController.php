<?php

/***********************************
 * WatchBot
 *
 * Alexander Martin
 * MacEwan University
 * CMPT 395 - AS40
 * January 30th, 2014
 ***********************************/

class VideoController extends BaseController {

    /**
     * Show an individual video
     *
     * @param $id
     * @return View
     */
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


    /**
     * Show a list of videos from oldest to newest
     *
     * @return View
     */

    public function index() {
        $videos = Video::orderBy("id", "desc")->get();

        $data = array(
            "title" => "Videos",
            "videos" => $videos,
        );

        return View::make("/videos/index")->with($data);
    }


    /**
     * Get all videos from a user
     *
     * @param $username
     * @return View
     */
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


        $data = array(  "title" => "$username's videos",
                        "videos" => $videos,
                        "username" => $username);

        return View::make("videos/from")->with($data);
    }

    /**
     * Process a form and add a video to a database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doCreate() {
       if (Auth::check()) {
           $video = new Video;

           $video->title = Input::get("title");
           $video->description = Input::get("description");
           $video->user_id = Auth::user()->id;
           $video->views = 0;

           $validate = Input::all();
           // We need to extract the YouTube video ID.
           preg_match('/youtube\.[a-zA-Z]+\/watch\?v=([^&]+)/', Input::get("video"), $matches);
           if (count($matches) <= 0 || strlen($matches[1]) != 11) {
               Session::flash("message", "An invalid YouTube link was submitted");
               return Redirect::back();
           }
           $video->video = $matches[1];
           $validate['video'] = $video->video;

           $validator = Video::validate($validate);
           if ($validator->fails())  {
               Session::flash("errors", $validator->messages()->all());
               return Redirect::back();
           } else {
               $video->save();
               Session::flash("message", "$video->title added successfully.");
               return Redirect::to("videos/show/" . $video->id);
           }
       } else {
           Session::flash("message", "You do not have permission to access this.");
           return Redirect::to("videos/");
       }
    }

    /**
     * Checks authentication and renders
     * a form for adding videos
     *
     * @return View
     */
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

    /**
     * Deletes specified video
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        if (Auth::check()) {
            try {
                $video = Video::where("id", "=", $id)->firstOrFail();
            } catch (Exception $e) {
                Session::flash("message", "Video does not exist.");
                return Redirect::to("/videos");
            }

            // Current user should own said video.
            if ($video->user != Auth::user()) {
                Session::flash("message","Not authorized to do this action");
                return Redirect::to("/videos");
            } else {
                Session::flash("message", "$video->title deleted");
                $video->delete();
                return Redirect::to("/videos");
            }
        } else {
            Session::flash("message", "You are not signed in");
            return Redirect::to("/videos");
        }
    }

    /**
     * Renders video edit page
     *
     * @param $id
     * @return View
     */
    public function edit($id) {
        if (Auth::check()) {
            try {
                $video = Video::where("id", "=", $id)->firstOrFail();
            } catch (Exception $e) {
                Session::flash("message", "Video does not exist.");
                return Redirect::to("/videos/");
            }

            if (Auth::user() != $video->user) {
                Session::flash("message", "You are not authorized to edit this video");
                return Redirect::to("/videos");
            }

            $data = array (
                'title' => "Edit Video",
                'video' => $video
            );

            return View::make("videos/edit")->with($data);
        } else {
            Session::flash("message", "You are not logged in");
            return Redirect::to("/videos");
        }
    }

    /**
     * Updates the video from form submission
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function update($id) {
       if (Auth::check()) {
           try {
               $video = Video::where("id", "=", $id)->firstOrFail();
           } catch (Exception $e) {
               Session::flash("message", "Video does not exist.");
               return Redirect::to("/videos/");
           }

           if (Auth::user() != $video->user) {
               Session::flash("message", "You are not authorized to edit this video");
               return Redirect::to("/videos");
           }

           // Since our validator will complain that username already exists when user doesn't change username.
           // we set no changes to null.
           $video_input = Input::all();
           if ($video_input["title"] == $video->title) {
               $video_input["title"] = null;
           }

            $validator = Video::edit_validate($video_input);
           if  ($validator->fails()) {
               Session::flash("errors", $validator->messages()->all());
               return Redirect::back();
           }

           // Now let's get original input so we don't put null if no change ;)
           if (Input::get("title")) {
             $video->title = Input::get("title");
           }

           $video->description = Input::get("description");


           $video->save();

           Session::flash("messages", "Video updated successfully");
           return Redirect::to("videos/show/$id");
       } else {
            Session::flash("message", "You are not logged in");
            return Redirect::to("/videos");
       }
    }

}