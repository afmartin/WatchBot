<?php
/***********************************
 * WatchBot
 *
 * Alexander Martin
 * MacEwan University
 * CMPT 395 - AS40
 * January 30th, 2014
 ***********************************/
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function homePage()
	{
		return View::make('hello')->with('title', 'Home Page');

	}

}
