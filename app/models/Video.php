<?php
/***********************************
 * WatchBot
 *
 * Alexander Martin
 * MacEwan University
 * CMPT 395 - AS40
 * January 30th, 2014
 ***********************************/
class Video extends Eloquent {

    protected $table = "videos";

    // We don't want the YouTube video key  rendered in JSON
    protected $hidden = array('video');

    /**
     * A video belongs to user, returns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('User');
    }

    /**
     * Creates a validator for user.
     *
     * @param $input
     * @return \Illuminate\Validation\Validator
     */
    public static function validate($input) {
        $rules = array(
            "title" => "Min:3|Required|Min:4|Unique:videos",
            "video" => "Required|Unique:videos"
        );

        $validator = Validator::make($input, $rules);

        return $validator;
    }

    public static function edit_validate($input) {
         $rules = array(
            "title" => "Min:4|Unique:videos",
        );

        $validator = Validator::make($input, $rules);

        return $validator;

    }
}