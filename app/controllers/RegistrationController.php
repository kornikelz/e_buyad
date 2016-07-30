<?php

class RegistrationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function uploadTempImage(){
		Image::make($_FILES['webcam']['tmp_name'])->save(app_path('storage/temp_files/temp_mem_image.jpg'));
	}

	public function getLastMemId(){
		return Response::json((new CodeController())->getMemCode());
	}

	public function insertMemInfo(){
		$memid = Input::get('conf_memid');
		$oscaid = Input::get('conf_oscaid');

		Image::make(app_path('storage/temp_files/temp_mem_image.jpg'))
			->save(public_path('storage/member_photos/').$memid.'.jpg');

		if(sizeof($oscaid) <= 0 || $oscaid == ""){
			DB::insert(
				'INSERT INTO tblMember 
					(strMemCode, strMemFName, strMemMName, strMemLName, datMemBirthday, strMemOSCAID, 
					strMemAddress, strMemHomeNum, strMemContNum, strMemEmail, imgMemPhoto, dtmLastUpdate, intStatus)
					VALUES(?, ?, ?, ?, ?, null, ?, ?, ?, ?, ?, now(), 1)',
				[
					$memid, 
					Input::get('conf_fname'), 
					Input::get('conf_mname'), 
					Input::get('conf_lname'), 
					Input::get('conf_bday'), 
					Input::get('conf_hadd'),
					Input::get('conf_lnum'),
					Input::get('conf_pnum'),
					Input::get('conf_email'),
					'storage/member_photos/'.$memid.'.jpg'
				]);
		}else{
			DB::insert(
				'INSERT INTO tblMember 
					(strMemCode, strMemFName, strMemMName, strMemLName, datMemBirthday, strMemOSCAID, 
					strMemAddress, strMemHomeNum, strMemContNum, strMemEmail, imgMemPhoto, dtmLastUpdate, intStatus)
					VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), 1)',
				[
					$memid, 
					Input::get('conf_fname'), 
					Input::get('conf_mname'), 
					Input::get('conf_lname'), 
					Input::get('conf_bday'), 
					$oscaid,
					Input::get('conf_hadd'),
					Input::get('conf_lnum'),
					Input::get('conf_pnum'),
					Input::get('conf_email'),
					'storage/member_photos/'.$memid.'.jpg'
				]);
		}

		return Redirect::to('/transaction/registration');
	}

	public function generateCard(){
		$first = Input::get('name');
		$qrcode = Input::get('memcode');
		$this->generateQR($qrcode);
		$this->generateID($first,$qrcode);
	}

	public function generateQR($qrcode){
		include_once app_path().'\libraries\phpqrcode\qrlib.php';
		QRcode::png($qrcode,app_path('storage/temp_files/qrcode.png'), QR_ECLEVEL_L, 10);
		Image::make(app_path('storage/temp_files/qrcode.png'))->crop(231,231,30,30)->save(app_path('storage/temp_files/qr_cropped.png'));
	}

	public function generateID($first,$qrcode){
		$path = public_path().'/storage/member_card/'.$qrcode;
		File::makeDirectory($path, $mode = 0777, true, true);

		$end = date('Y-m-d', strtotime('+2 years'));
		$exp = 'Expiration: '.$end;

	    $img1 = Image::make(app_path('storage/temp_files/id_back.jpg'));
	    $res = $img1->text($exp, 57, 1075, function($font) {
				    $font->file(app_path('storage/font/ARIAL.TTF'));
				    $font->size(40);
				    $font->color('#000000');
				    // $font->align('center');
				    // $font->valign('top');
				    // $font->angle(45);
				});
	    $qr = Image::make(app_path('storage/temp_files/qr_cropped.png'))->resize(850,850);
	    $res = $img1->insert($qr, 'top-left', 57, 57);
	    $res->save(public_path('storage/member_card/'.$qrcode.'/back.png'));


	    $img2 = Image::make(app_path('storage/temp_files/id_front.jpg'));
	    $res2 = $img2->text($first, 950, 920, function($font) {
				    $font->file(app_path('storage/font/ARIBLK.TTF'));
				    $font->size(80);
				    $font->color('#ffffff');
				    // $font->align('center');
				    // $font->valign('top');
				    // $font->angle(45);
				});
	    $res2 = $img2->text('00002'.$qrcode, 950, 1000, function($font) {
				    $font->file(app_path('storage/font/ARIAL.TTF'));
				    $font->size(65);
				    $font->color('#ffffff');
				    // $font->align('center');
				    // $font->valign('top');
				    // $font->angle(45);
				});
		$res2->save(public_path('storage/member_card/'.$qrcode.'/front.png'));
	}

	public function updateUser(){
		try{
			$defload = DB::table('tblpointloadsetting')
						->select('LoadDefault')
						->where('id','=','1')
						->first();

			DB::insert(
				'INSERT INTO tblMemAccount VALUES(?,?)',
				[Input::get('code'),Input::get('pino')]
				);

			DB::insert(
				'INSERT INTO tblMemCredit VALUES(?,?,now())',
				[Input::get('code'),$defload->LoadDefault]
				);

			return Redirect::to('/transaction/generate-card');

		}catch(PDOException $e){}
	}
}
