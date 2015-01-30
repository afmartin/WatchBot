<?php

class Video extends Eloquent {

    protected $table = "videos";

    protected $hidden = array('video');

    public function user() {
        return $this->belongsTo('User');
    }

    public static function validate($input) {
        $rules = array(
            "title" => "Min:3|Required",
            "video" => "Required"
        );

        $validator = Validator::make($input, $rules);

        return $validator;
    }
}