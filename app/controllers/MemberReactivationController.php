<?php

class MemberReactivationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	

	public function index()
	{
		return View::make('/utilities/memberreactivation');
	}

	public function thera()
	{
		return View::make('/utilities/therareactivation');
	}

	public function generic()
	{
		return View::make('/utilities/genreactivation');
	}

	public function brand()
	{
		return View::make('/utilities/brandreactivation');
	}

	public function manufacturer()
	{
		return View::make('/utilities/manureactivation');
	}

	public function product()
	{
		return View::make('/utilities/prodreactivation');
	}

	public function prodcat()
	{
		return View::make('/utilities/prodcatreactivation');
	}

	public function proddet()
	{
		return View::make('/utilities/proddetreactivation');
	}

	public function form()
	{
		return View::make('/utilities/formreactivation');
	}

	public function pack()
	{
		return View::make('/utilities/packreactivation');
	}

	public function uom()
	{
		return View::make('/utilities/uomreactivation');
	}

	public function branch()
	{
		return View::make('/utilities/branchreactivation');
	}

	public function job()
	{
		return View::make('/utilities/jobreactivation');
	}

	public function emp()
	{
		return View::make('/utilities/empreactivation');
	}

	public function discount()
	{
		return View::make('/utilities/discountreactivation');
	}

	public function promos()
	{
		return View::make('/utilities/promoreactivation');
	}

	public function package()
	{
		return View::make('/utilities/packagereactivation');
	}


}
