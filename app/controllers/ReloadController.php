<?php

class ReloadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function getPinCode(){
        $res = DB::select(
            'SELECT strMemAcctPinCode FROM tblMemAccount WHERE strMemAcctCode = ?',
             [
                Input::get('memcode')
             ]
            );

        return Response::json($res);
    }


    public function getMemDetails(){
        $res = DB::select(
            'SELECT m.strMemFName, m.strMemMName, m.strMemLName, b.decMCreditValue
             FROM tblMember m LEFT JOIN tblMemCredit b ON m.strMemCode = b.strMCreditCode
             WHERE m.strMemCode = ?',
             [
                Input::get('memcode')
             ]
            );

        return Response::json($res);
    }

    public function reloadCredit(){
    	try{
    		DB::insert(
    			'UPDATE tblMemCredit SET decMCreditValue = ?, dtmLastUpdate = now() WHERE strMCreditCode = ?',
    			[
    				(intval(Input::get('membal')) + intval(Input::get('amt'))),
    				Input::get('memcode')
    			]);

    		return Redirect::to('/transaction/reload');
    	}catch(PDOException $ex){}
    }

}
