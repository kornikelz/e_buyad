<?php

class TransactionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showRegistration()
	{
		return View::make('transaction/registration');
	}

    public function showSell()
    {
        $result = DB::table('tblpointloadsetting')
                        ->select('PointMinimum','PointPercent','LoadMinimum')
                        ->where('id','=','1')
                        ->first();

        return View::make('transaction/sell')
            ->with('code',(new CodeController())->getTransCode())
            ->with('ptmin', $result->PointMinimum)
            ->with('ptperc', $result->PointPercent)
            ->with('ldmin', $result->LoadMinimum);
    }

    public function showReload()
    {
        $result = DB::table('tblpointloadsetting')
                        ->select('LoadMinimum')
                        ->where('id','=','1')
                        ->first();

        return View::make('transaction/reload')
                        ->with('loadmin', $result->LoadMinimum);
    }

    public function showEGC()
    {
        return View::make('transaction/egc');
    }

    public function showEGCMem()
    {
        return View::make('transaction/egcmem');
    }

    public function showReturn()
    {
        return View::make('transaction/return')
            ->with('retid', (new CodeController())->getReturnsCode());
    }

    public function showGenCard()
    {
        return View::make('transaction/gencard');
    }

    public function getEGCDetails(){
        $res = DB::table('tblEGC')
        ->where('strEGCPinCode', '=', Input::get('egcpincode'))
        ->get();

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

    public function getPinCode(){
        $res = DB::select(
            'SELECT strMemAcctPinCode FROM tblMemAccount WHERE strMemAcctCode = ?',
             [
                Input::get('memcode')
             ]
            );

        return Response::json($res);
    }

    public function showReceipt(){
        $pdf = App::make('dompdf'); 

        $prodcode = explode(';',Input::get('prodcode'));
        $prodname = explode(';',Input::get('prodname'));
        $prodprice = explode(';',Input::get('prodprice'));
        $prodqty = explode(';',Input::get('prodqty'));
        $prodamt = explode(';',Input::get('prodamt'));
        $memcode = Input::get('prodmemcode');
        
        if(sizeof($memcode) <= 0){
            $memcode = null;
        }

        if($memcode ==""){
        $res = DB::insert(
            'INSERT INTO tblTransaction VALUES (?,now(),?,?,(SELECT strDiscCode FROM tblDiscounts WHERE strDiscName = ?))',
             [
                Input::get('prodtransid'),
                'EMP00001',
                null,
                Input::get('proddisc')
             ]
            );
        }else{
            $res = DB::insert(
            'INSERT INTO tblTransaction VALUES (?,now(),?,?,(SELECT strDiscCode FROM tblDiscounts WHERE strDiscName = ?))',
             [
                Input::get('prodtransid'),
                'EMP00001',
                $memcode,
                Input::get('proddisc')
             ]
            );
        }

        $strtbl = "";
        for($i = 0; $i < (sizeof($prodcode)-1); $i++){
            $strtbl = $strtbl.'<tr>
                        <td>'.substr($prodname[$i],0,10).'...<br>Php'.$prodprice[$i].'</td>
                        <td align="center">'.$prodqty[$i].'</td>
                        <td align="right">'.$prodamt[$i].'</td>
                    </tr>';
            $res = DB::insert(
            'INSERT INTO tblTransDetails VALUES (?,?,?)',
             [
                Input::get('prodtransid'),
                $prodcode[$i],
                $prodqty[$i]
             ]
            );
        }

        //update credit
        $res = DB::update(
            'UPDATE tblMemCredit SET decMCreditValue = ?, dtmLastUpdate = now() WHERE strMCreditCode = ?',
            [
                round((floatval(Input::get('prodbal')) + floatval(Input::get('prodpts'))),2),
                Input::get('prodmemcode')
            ]
            );

        if(strlen(Input::get('prodmemcode')) > 0){
            //update insert
                DB::insert('INSERT INTO tblMemPoints VALUES(?,?,?)',
                            [Input::get('prodtransid'),Input::get('prodmemcode'),Input::get('prodpts')]);
        }
        $subtotal = Input::get('sumsubt');

        $discount = Input::get('sumdisc');

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
                    </b></center>
                </div>
                <div id="notheader">
                    <div id="header2">
                        <br>TRANSACTION ID: '.Input::get('prodtransid').'
                        <br>DATETIME: '.date("Y-m-d").' '.date("h:ia",strtotime("+8 Hours")).'
                        <br>PHARMACIST: Luis Guballo<br><br>
                    </div>
                    <div id="details">
                        <table width="60%">
                            <col width="120px">
                            <col width="120px">
                            <col width="120px">
                            <tr>
                                <th align="left"> ITEM        </th>
                                <th> QTY </th>
                                <th align="right"> AMT </th>
                            </tr>
                            '.$strtbl.'
                        </table>
                    </div>
                    <div id="Footer">
                        <br>SUBTOTAL: '.$subtotal.'
                        <br>DISCOUNT: '.Input::get('sumdisc').'
                        <br>DISC AMT:
                        <br>TAX: 12%
                        <br>TAXABLE AMT: '.($subtotal * 0.12).'
                        <br>TOTAL: '.Input::get('sumgrant').'
                        <br>
                        <br>CUSTOMER: '.Input::get('prodmemname').'
                        <br>CREDIT BALANCE: '.Input::get('prodbal').'
                        <br>POINTS EARNED: '.Input::get('prodpts').'
                        <br>
                        <br>AMT RENDERED: '.Input::get('sumamt').'
                        <br>CHANGE: '.Input::get('sumchan').'
                    </div>
                </div>
            </body>
            </html>
            ');
        return $pdf->stream();
    }

    public function getTransInfo(){
        $res = DB::select(
            'SELECT t.dtmTransDate, concat(c.strMemFName, \' \', c.strMemMName, \' \', c.strMemLName) as \'customer\'
            FROM tbltransaction t LEFT JOIN tblmember c ON t.strTransCustCode = c.strMemCode WHERE t.strTransId = ?',
            [
                Input::get('transcode')
            ]
            );

        return Response::json($res);
    }

    public function fillBought(){
        $res = DB::select(
            'SELECT d.strTDProdCode, pr.decProdPricePerPiece, d.intQuantity, 
            (pr.decProdPricePerPiece * d.intQuantity) as \'total\'
            FROM tbltransdetails d left join tblProdPrice pr ON d.strTDProdCode = pr.strProdPriceCode 
            WHERE d.strTDTransCode = ?',
            [
                Input::get('transcode')
            ]
            );

        return Response::json($res);
    }

    public function reloadMember(){
        try{
            DB::update('UPDATE tblMemCredit SET decMCreditValue = ? WHERE strMCreditCode = ?',
                [Input::get('load'), Input::get('memcode')]);
        }catch(PDOException $ex){}
    }

    public function saveReturns(){
        $retcode = Input::get('retid');
        $transcode = Input::get('transid');
        $memcode = Input::get('cust');
        $total = Input::get('totalreturns');

        try{
            DB::insert('INSERT INTO tblReturns VALUES(?,?,?,?,now(),1)',
                [$retcode, $transcode, $memcode, floatval($total)]);

            $pdf = App::make('dompdf');

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
                            <br>RETURN SLIP
                            </b></center>
                        </div>
                        <div id="notheader">
                            <div id="header2">
                                <br>RETURNS ID: '.$retcode.' 
                                <br>DATETIME: '.date("Y-m-d").' '.date("h:ia",strtotime("+8 Hours")).'
                                <br>PHARMACIST: Luis Guballo<br><br>
                            </div>
                            <div id="details">
                                <br>AMOUNT: '.$total.'
                            </div>
                            <div id="Footer">
                                <br>
                                <br>CUSTOMER: '.$memcode.'
                            </div>
                        </div>
                    </body>
                    </html>
            ');
        return $pdf->stream();            
        }catch(PDPException $e){}
    }

    public function getReturnsDetails(){
        $result = DB::select('SELECT strCustName, decTotalAmount FROM tblReturns
                                WHERE strReturnCode = ? AND isUsed = 0',
                                [
                                    Input::get('returns')
                                ]);
        
        return Response::json($result);
    }
}
