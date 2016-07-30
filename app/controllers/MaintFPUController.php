<?php

class MaintFPUController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    // FORMS
	public function showForms()
	{
		return View::make('maintenance/products/fpu/forms');
	}

    public function addForm(){
        try{
            if(!$this->isFormArchive(Input::get('name'))){
                DB::insert(
                    'INSERT INTO tblpmform VALUES(?,?,?,1)',
                    [
                        (new CodeController())->getFormCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                    );

                return Redirect::to('maintenance/fpu/forms')
                        ->with('message', 'Successfully added: '.Input::get('name'));
            }else{
                DB::update(
                        'UPDATE tblPMForm SET strPMFormDesc = ?, intStatus = 1 WHERE strPMFormName = ?',
                        [ Input::get('desc'), Input::get('name') ]
                    );

                return Redirect::to('maintenance/fpu/forms')
                        ->with('message', '*Successfully added: '.Input::get('name'));
            }
        }catch(PDOException $ex){

            return Redirect::to('maintenance/fpu/forms')
                    ->with('message', 'Error adding: '.Input::get('name').'. This might already be existing');
        }
    }

    public function updateForm(){
        try{
            DB::update(
                'UPDATE tblpmform SET strPMFormName = ?, strPMFormDesc = ? WHERE strPMFormCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('maintenance/fpu/forms')
                    ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){
            return Redirect::to('maintenance/fpu/forms')
                    ->with('message', 'Error updating: '.Input::get('name').'. This might already be existing');
        }
    }

    public function deleteForm(){
        DB::update(
            'UPDATE tblpmform set intStatus = 0 WHERE strPMFormCode = ?',
            [
                Input::get('del_id')
            ]
        );

            return Redirect::to('maintenance/fpu/forms')
                    ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function isFormArchive($name){
        $status = DB::table('tblPMForm')
                    ->select('intStatus')
                    ->where('strPMFormName', $name)
                    ->first();

        if($status == null){//no same name found
            return false;
        }else{
            if($status->intStatus == 1){//name found but active
                return false;
            }else{
                return true;//name found but inactive
            }
        }
        // return dd($status->intStatus);
    }

    // PACKAGING

    public function showPackaging()
    {
        return View::make('maintenance/products/fpu/packaging');
    }

    public function addPackaging(){
        try{
            if(!$this->isPackagingArchive(Input::get('name'))){
                DB::insert(
                    'INSERT INTO tblpmpackaging VALUES(?,?,?,1)',
                    [
                        (new CodeController())->getPackagingCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('maintenance/fpu/packaging')
                    ->with('message', 'Successfully added: '.Input::get('name'));
            }else{
                DB::update(
                        'UPDATE tblPMPackaging SET strPMPackDesc = ?, intStatus = 1 WHERE strPMPackName = ?',
                        [ Input::get('desc'), Input::get('name') ]
                    );

                return Redirect::to('maintenance/fpu/packaging')
                        ->with('message', '*Successfully added: '.Input::get('name'));
            }
        }catch(PDOException $ex){

            return Redirect::to('maintenance/fpu/packaging')
                    ->with('message', 'Error adding: '.Input::get('name').'. Name might already be existing');
        }
    }

    public function updatePackaging(){
        try{
            DB::update(
                'UPDATE tblpmpackaging SET strPMPackName = ?, strPMPackDesc = ? WHERE strPMPackCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('maintenance/fpu/packaging')
                    ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('maintenance/fpu/packaging')
                    ->with('message', 'Error updating: '.Input::get('name').'. Name might already be existing');
        }
    }

    public function deletePackaging(){
        DB::update(
            'UPDATE tblpmpackaging set intStatus = 0 WHERE strPMpackCode = ?',
            [
                Input::get('del_id')
            ]
        );

        return Redirect::to('maintenance/fpu/packaging')
                ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function isPackagingArchive($name){
        $status = DB::table('tblPMPackaging')
                    ->select('intStatus')
                    ->where('strPMPackName', $name)
                    ->first();

        if($status == null){//no same name found
            return false;
        }else{
            if($status->intStatus == 1){//name found but active
                return false;
            }else{
                return true;//name found but inactive
            }
        }
        // return dd($status->intStatus);       
    }

    // UOM

    public function showUOM(){
        return View::make('maintenance/products/fpu/uom');
    }

    public function addUOM(){
        try{
            if(!$this->isUOMArchive(Input::get('name'))){
                DB::insert(
                    'INSERT INTO tbluom VALUES(?,?,?,1)',
                    [
                        (new CodeController())->getUOMCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('maintenance/fpu/uom')
                    ->with('message', 'Successfully added: '.Input::get('name'));
            }else{
                DB::update(
                    'UPDATE tbluom SET  strUOMDesc = ?, intStatus = 1 WHERE strUOMName = ?',
                    [
                        Input::get('desc'),
                        Input::get('name')
                    ]
                );

                return Redirect::to('maintenance/fpu/uom')
                    ->with('message', '*Successfully added: '.Input::get('name'));
            }
        }catch(PDOException $ex){

            return Redirect::to('maintenance/fpu/uom')
                ->with('message', 'Error adding: '.Input::get('name').'. Name might already be existing');
        }
    }

    public function updateUOM(){
        try{
            DB::update(
                'UPDATE tbluom SET strUOMName = ?, strUOMDesc = ? WHERE strUOMCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('maintenance/fpu/uom')
                ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('maintenance/fpu/uom')
                ->with('message', 'Error updating: '.Input::get('name').'. Name might already be existing');
        }
    }

    public function deleteUOM(){
        DB::update(
            'UPDATE tbluom set intStatus = 0 WHERE strUOMCode = ?',
            [
                Input::get('del_id')
            ]
        );

        return Redirect::to('maintenance/fpu/uom')
            ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function isUOMArchive($name){
        $status = DB::table('tblUOM')
                    ->select('intStatus')
                    ->where('strUOMName', $name)
                    ->first();

        if($status == null){//no same name found
            return false;
        }else{
            if($status->intStatus == 1){//name found but active
                return false;
            }else{
                return true;//name found but inactive
            }
        }
        // return dd($status->intStatus);
    }
}
