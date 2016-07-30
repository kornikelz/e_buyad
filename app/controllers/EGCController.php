<?php

class EGCController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	// 

	// --------- NON MEMBERS ------------

	public function sendSMS($dstno, $msg){
		$username = 'kornikells';
		$password = 'luis021';
		$type = '1';
		$senderid = '1234';

		$sendlink = 
			"http://www.isms.com.my/isms_send.php?un=".
			urlencode($username).
			"&pwd=".
			urlencode($password)."&dstno=".
			$dstno.
			"&msg=".
			urlencode($msg).
			"&type=".
			$type.
			"&sendid=".
			$senderid; 

		$handle = $this->ismscURL($sendlink);

		return $handle;	
	}

	private function ismscURL($link){

  		$http = curl_init($link);

  		curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
  		$http_result = curl_exec($http);
  		$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
  		curl_close($http);

  		return $http_result;
    }

    private function is_connected(){
	    $connected = @fsockopen("www.google.com", 80); 
	                                        //website, port  (try 80 or 443)
	    if ($connected){
	        $is_conn = true; //action when connected
	        fclose($connected);
	    }else{
	        $is_conn = false; //action in connection failure
	    }
	    return $is_conn;
	}

    private function generatePinCode() {
		$str = "";
		$characters = array_merge(range('0','9'));
		$max = count($characters) - 1;

		for ($i = 0; $i < 4; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}

		return $str;
	}

    public function isCombExisting($egc, $pin){
        $status = DB::table('tblEGC')
                    ->select('strEGCCode')
                    ->where('strEGCCode', $egc)
                    ->where('strEGCPinCode', $pin)
                    ->first();

        if($status == null){
            return false;
        }else{
        	return true;
        }
    }

    //cash

    public function saveEGCCash(){
    	$egccode = (new CodeController())->getEGCCode();
    	$pincode = "";

    	do{
    		$pincode = $this->generatePinCode();
    	}while($this->isCombExisting($egccode, $pincode));

    	try{

    		//insert into tblEGC
    		DB::insert(
    			'INSERT INTO tblEGC VALUES(?,0,1,?,?,?,?, now())',
    			[
    				$egccode,
    				intVal(Input::get('amt')),
    				$pincode,
    				Input::get('benname'),
    				substr(Input::get('bennum'), 1),
    			]
    			);

    		//insert into tblEGCCust
    		DB::insert(
    			'INSERT INTO tblEGCCust VALUES(?,null,?,?)',
    			[
    				$egccode,
    				Input::get('custname'),
    				substr(Input::get('custnum'), 1),
    			]
    			);

    		//send message

    		$message = 'Hello '.Input::get('benname'). '! '.Input::get('custname').
    				   ' has sent you e-Buyad\'s Electronic Gift Check amounting to '.
    				   Input::get('amt').' pesos Use the following pin code in using '.
    				   'this gift card: '.$pincode.', together with its EGC ID: '.
    				   $egccode.'. Have a good day!';
    		$number = '63'.substr(Input::get('bennum'), 1);

    		if($this->is_connected()){
	    		$handle = $this->sendSMS($number, $message);

	    		if($handle == '2000 = SUCCESS'){

		    		return Redirect::to('/transaction/egc')
		    			->with('message', 'EGC has been successfully processed!')
		    			->with('ecode',$egccode)
		    			->with('type','0');

	    		}else{
		    		return Redirect::to('/transaction/egc')
		    			->with('message', 'EGC has been successfully saved but error in sending message.')
		    			->with('ecode',$egccode)
		    			->with('type','0');
	    		}
    		}else{
    			return Redirect::to('/transaction/egc')
	    			->with('message', 'EGC has been successfully saved but message was not sent due to no connection in internet!')
	    			->with('ecode',$egccode)
	    			->with('type','0');;
    		}

    	}catch(PDOException $ex){}
    }

    public function showEGCCashReceipt($ecode){
        $pdf = App::make('dompdf');

        $result = DB::table('tblEGC')
        			->leftJoin('tblEGCCust','tblEGC.strEGCCode','=','tblEGCCust.strEGCCCode')
        			->select('tblEGC.decAmount','tblEGCCust.strEGCCustName','tblEGC.strEGCBeneficiary','tblEGC.strEGCPinCode')
        			->where('tblEGC.strEGCCode', '=', $ecode)
        			->first();

        $pdf->loadHTML('
						<html>
						<head>
						</head>
						<style type="text/css">
						    body{
						        font-family: "Monospace";
						    }
						    #notheader{
						        margin-left: 200px;
						    }
						</style>
						<body>
						    <div id="header1">
						        <center><b>
						        <br>-------------------------------  
						        <br>E-BUYAD
						        <br>Point of Sale
						        <br>and
						        <br>Cashless Payment System
						        <br>------------------------------- 
						        <br>
						        <br>ELECTRONIC GIFT CHECK
						        </b></center>
						    </div>
						    <div id="notheader">
						        <div id="header2">
						            <br>EGC ID: '.$ecode.' 
						            <br>DATETIME: '.date("Y-m-d").' '.date("h:ia",strtotime("+8 Hours")).'
						            <br>PHARMACIST: Luis Guballo<br><br>
						        </div>
						        <div id="details">
						        </div>
						        <div id="Footer">
						            <br>AMOUNT: '.$result->decAmount.'
						            <br>
						            <br>CUSTOMER: '.$result->strEGCCustName.'
						            <br>BENEFICIARY: '.$result->strEGCBeneficiary.'
						            <br>PIN CODE: '.$result->strEGCPinCode.'
						        </div>
						    </div>
						</body>
						</html>
        	');

        return $pdf->stream();

        Session::flush();
    }

    //prods
    public function saveEGCProds(){
    	$prod = explode(";", Input::get('packprods'));
    	$prod = array_diff($prod, [""]);
    	$qty = explode(";", Input::get('packqty'));
    	$qty = array_reverse(array_diff($qty, [""]));

    	// echo Input::get('custname').'<br>';
    	// echo Input::get('custnum').'<br>';
    	// echo Input::get('benname').'<br>';
    	// echo Input::get('bennum').'<br>';

    	// foreach($prod as $haha){
    	// 	echo $haha.'<br>';
    	// }

    	// foreach($qty as $hasha){
    	// 	echo $hasha.'<br>';
    	// }

    	$egccode = (new CodeController())->getEGCCode();
    	$pincode = "";

    	do{
    		$pincode = $this->generatePinCode();
    	}while($this->isCombExisting($egccode, $pincode));

    	try{

    		//insert into tblEGC
    		DB::insert(
    			'INSERT INTO tblEGC VALUES(?,1,1,0,?,?,?, now())',
    			[
    				$egccode,
    				$pincode,
    				Input::get('benname'),
    				substr(Input::get('bennum'), 1),
    			]
    			);

    		//insert into tblEGCCust
    		DB::insert(
    			'INSERT INTO tblEGCCust VALUES(?,null,?,?)',
    			[
    				$egccode,
    				Input::get('custname'),
    				substr(Input::get('custnum'), 1),
    			]
    			);

    		//insert products
    		$i = 0;
    		foreach($prod as $pr){
    			DB::insert(
    				'INSERT INTO tblEGCProds VALUES (?,?,?)',
    				[
    					$egccode,
    					$pr,
    					$qty[$i]
    				]);
    			$i++;
    		}

    		//send message

    		$message = 'Hello '.Input::get('benname'). '! '.Input::get('custname').
    				   ' has sent you e-Buyad\'s Electronic Gift Check consisting of various products amounting to '.
    				   Input::get('totalpr').' pesos Use the following pin code in using '.
    				   'this gift card: '.$pincode.', together with its EGC ID: '.
    				   $egccode.'. Have a good day!';

    		$number = '63'.substr(Input::get('bennum'), 1);

    		if($this->is_connected()){
	    		$handle = $this->sendSMS($number, $message);

	    		if($handle == '2000 = SUCCESS'){

		    		return Redirect::to('/transaction/egc')
		    			->with('message', 'EGC has been successfully processed!')
		    			->with('ecode',$egccode)
		    			->with('type','1');

	    		}else{
		    		return Redirect::to('/transaction/egc')
		    			->with('message', 'EGC has been successfully saved but error in sending message.')
		    			->with('ecode',$egccode)
		    			->with('type','1');
	    		}
    		}else{
    			return Redirect::to('/transaction/egc')
	    			->with('message', 'EGC has been successfully saved but message was not sent due to no connection in internet!')
	    			->with('ecode',$egccode)
	    			->with('type','1');
    		}
    	}catch(PDOException $ex){}
    }

    public function showEGCProdsReceipt($ecode){
    	$results = DB::select(
    		'SELECT 
				b.strPMBranName,
				p.strProdType,
				(
				  SELECT group_concat(g.strPMGenName SEPARATOR \' \') 
				  FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
				  WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode
				) as \'GenNames\',
				concat(m.decProdMedSize, \' \', u.strUOMName) as \'MedSize\',

				nm.strProdNMedName,
				concat_ws(\' \', g.strGenSizeName, s.decNMStanSize, un.strUOMName) as \'NMedSize\',

				pr.decProdPricePerPiece,
				e.intQty
				  
				FROM tblEGCProds e
				LEFT JOIN tblProducts p
				ON e.strEPProdCode = p.strProdCode

				LEFT JOIN tblprodmed m
				ON p.strProdCode = m.strProdMedCode
				LEFT JOIN tblprodnonmed nm
				ON p.strProdCode = nm.strProdNMedCode
				LEFT JOIN tblProdPrice pr
				ON p.strProdCode = pr.strProdPriceCode

				LEFT JOIN tblprodmedbranded b
				ON m.strProdMedBranCode = b.strPMBranCode
				LEFT JOIN tbluom u 
				ON m.strProdMedDosCode = u.strUOMCode

				LEFT JOIN tblnmedgeneral gt
				ON nm.strProdNMedCode = gt.strNMGenCode
				LEFT JOIN tblgensize g
				ON gt.strNMGenSizeCode = g.strGenSizeCode
				LEFT JOIN tblnmedstandard s
				ON nm.strProdNMedCode = s.strNMStanCode
				LEFT JOIN tbluom un
				ON s.strNMStanUOMCode = un.strUOMCode

				WHERE p.intStatus = 1 AND e.strEPEGCCode = ?
				',
    			[$ecode]
    	);

		// echo sizeOf($results);

		// echo $results[0]->strProdCode;

		// dd($results);
		
		$strtbl = "";
		$total = 0;

		for($i = 0; $i < sizeOf($results); $i++){

			if($results[$i]->strProdType == "0"){
				$prodname = '<b>'.$results[$i]->strPMBranName.'</b> '.$results[$i]->GenNames.' - '.$results[$i]->MedSize;
			}else{
				$prodname = $results[$i]->strProdNMedName.' - '.$results[$i]->NMedSize;
			}

			$strtbl = $strtbl.
					  '<tr>'.
					  	'<td>'.
					  		$prodname.
					  	'</td>'.
					  	'<td>'.
					  		$results[$i]->intQty.
					  	'</td>'.	
					  '</tr>';

			$total = $total + (floatval($results[$i]->decProdPricePerPiece) * intval($results[$i]->intQty));
		}
		
        $pdf = App::make('dompdf');

        $result = DB::table('tblEGC')
        			->leftJoin('tblEGCCust','tblEGC.strEGCCode','=','tblEGCCust.strEGCCCode')
        			->select('tblEGC.decAmount','tblEGCCust.strEGCCustName','tblEGC.strEGCBeneficiary','tblEGC.strEGCPinCode')
        			->where('tblEGC.strEGCCode', '=', $ecode)
        			->first();

        $pdf->loadHTML('
						<html>
						<head>
						</head>
						<style type="text/css">
						    body{
						        font-family: "Monospace";
						    }
						    #notheader{
						        margin-left: 200px;
						    }
						</style>
						<body>
						    <div id="header1">
						        <center><b>
						        <br>-------------------------------  
						        <br>E-BUYAD
						        <br>Point of Sale
						        <br>and
						        <br>Cashless Payment System
						        <br>------------------------------- 
						        <br>
						        <br>ELECTRONIC GIFT CHECK
						        </b></center>
						    </div>
						    <div id="notheader">
						        <div id="header2">
						            <br>EGC ID: '.$ecode.' 
						            <br>DATETIME: '.date("Y-m-d").' '.date("h:ia",strtotime("+8 Hours")).'
						            <br>PHARMACIST: Luis Guballo<br><br>
						        </div>
						        <div id="details">
							        <table width="60%">
			                            <col width="180px">
			                            <col width="180px">
			                            <tr>
			                                <th align="left"> ITEM        </th>
			                                <th> QTY </th>
			                            </tr>
			                            '.$strtbl.'
			                        </table>
			                    </div>
							    <div id="Footer">
						            <br>AMOUNT: Php '.$total.'
						            <br>
						            <br>CUSTOMER: '.$result->strEGCCustName.'
						            <br>BENEFICIARY: '.$result->strEGCBeneficiary.'
						            <br>PIN CODE: '.$result->strEGCPinCode.'
						        </div>
						    </div>
						</body>
						</html>
        	');

        return $pdf->stream();

        Session::flush();


    }

	// --------- NON MEMBERS ------------
}
