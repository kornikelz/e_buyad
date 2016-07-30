<?php

class PointLoadUtilController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showPointLoad(){
		$result = DB::table('tblpointloadsetting')
						->select('LoadDefault','LoadMinimum','PointMinimum','PointPercent')
						->where('id','=','1')
						->first();

		return View::make('utilities/pointloadsetting')
						->with('loaddef', strval($result->LoadDefault))
						->with('loadmin', $result->LoadMinimum)
						->with('ptperc', $result->PointPercent)
						->with('ptmin', $result->PointMinimum);
	}

	public function updatePointLoad(){
		DB::update(
			'UPDATE tblpointloadsetting 
				SET LoadDefault = ?,
					LoadMinimum = ?,
					PointMinimum = ?,
					PointPercent = ?
			WHERE id = 1',
			[
				Input::get('defload'),
				Input::get('minload'),
				Input::get('mintotal'),
				Input::get('percpoint')
			]);

		return Redirect::to('/utils/pointload')->with('message','Mechanics successfully updated!');
	}
}
