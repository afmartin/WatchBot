<?php
/***********************************
 * WatchBot
 *
 * Alexander Martin
 * MacEwan University
 * CMPT 395 - AS40
 * January 30th, 2014
 ***********************************/
class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
