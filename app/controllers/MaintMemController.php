<?php

class MaintMemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return View::make('/maintenance/member/memdet');
	}

    public function updateMember(){
        try{
            $oscaid= Input::get('oscaid');

            if(sizeof($oscaid) <= 0 || $oscaid == ""){
                DB::update('UPDATE tblMember SET strMemFName = ?, strMemMName = ?, strMemLName = ?, datMemBirthday = ?, strMemOSCAID = null, strMemAddress = ?, strMemHomeNum = ?, strMemContNum = ?, strMemEMail = ?, dtmLastUpdate = now() WHERE strMemCode = ?', array(
                    Input::get('fname'),
                    Input::get('mname'),
                    Input::get('lname'),
                    Input::get('bday'),
                    Input::get('address'),
                    Input::get('homenum'),
                    Input::get('contnum'),
                    Input::get('email'),
                    Input::get('memid')
                ));
            }else{
                DB::update('UPDATE tblMember SET strMemFName = ?, strMemMName = ?, strMemLName = ?, datMemBirthday = ?, strMemOSCAID = ?, strMemAddress = ?, strMemHomeNum = ?, strMemContNum = ?, strMemEMail = ?, dtmLastUpdate = now() WHERE strMemCode = ?', array(
                    Input::get('fname'),
                    Input::get('mname'),
                    Input::get('lname'),
                    Input::get('bday'),
                    $oscaid,
                    Input::get('address'),
                    Input::get('homenum'),
                    Input::get('contnum'),
                    Input::get('email'),
                    Input::get('memid')
                ));
            }
            
            return Redirect::to('/maintenance/members')
                ->with('message', Input::get('fname').' '.Input::get('mname').' '.Input::get('lname').' has been successfully updated!');
        }catch(PDOException $ex){
            
            return Redirect::to('/maintenance/members')
                ->with('message', Input::get('fname').' '.Input::get('mname').' '.Input::get('lname').' has been cannot be update. Same details might already be existing');
        }
    }

    public function deleteMember(){
        DB::update('UPDATE tblMember SET intStatus = 0, dtmLastUpdate = now() WHERE strMemCode = ?', array(
            Input::get('del_memid')
        ));

        return Redirect::to('/maintenance/members')
                ->with('message', Input::get('del_memname').' has been successfully deleted!');
    }
}
