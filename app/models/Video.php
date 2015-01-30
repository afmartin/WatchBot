<?php

class Video extends Eloquent {

    protected $table = "videos";

    protected $hidden = array('video');

    public function user() {
        return $this->belongsTo('User');
    }

    public static function validate($input) {
        $rules = array(
            "title" => "Min:3|Required|Unique:videos",
            "video" => "Required|Unique:videos"
        );

        $validator = Validator::make($input, $rules);

        return $validator;
    }
}