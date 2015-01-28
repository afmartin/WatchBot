<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * Validation sent me for a loop.
     *
     * http://laravelbook.com/laravel-input-validation/
     * is a VERY good resource 
     */
    public static function register_validate($input) {   
        $rules = array( 'username' => 'Required|Min:5|Unique:users',
                        'email' => 'Required|Email|Unique:users',
                        'password' => 'Required|Min:8|Confirmed',
                        'password_confirmation' => 'Required|Min:8');

        $validator = Validator::make($input, $rules);
        return $validator;
    }

    public static function update_validate($input) {
        $rules = array ( 'username' => 'Min:5|Unique:users',
                         'email' => 'Email|Unique:users',
                         'password' => 'Min:8|Confirmed',
                         'password_confirmtaion' => 'Min' );

        $validator = Validator::make($input, $rules);
        return $validator;
    }
}
