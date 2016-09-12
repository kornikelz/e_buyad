<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	

	public function dashboard()
	{
		return View::make('/dashboard');
	}

}
