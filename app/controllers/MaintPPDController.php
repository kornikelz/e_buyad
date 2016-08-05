<?php

class MaintPPDController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showPackages()
	{
		return View::make('maintenance/ppd/packages');
	}

    public function showDiscount()
    {
        return View::make('maintenance/ppd/discount');
    }

    public function addDiscount(){
        if(!$this->isDiscountInactive(Input::get('name'))){
            try{
                DB::insert(
                    'INSERT INTO tblDiscounts VALUES (?,?,(?/100),?,now(),1,?)',
                    [
                        (new CodeController())->getDiscountCode(),
                        Input::get('name'),
                        Input::get('percent'),
                        Input::get('amount'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('/maintenance/ppd/discount')
                    ->with('message', 'Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){

                return Redirect::to('/maintenance/ppd/discount')
                    ->with('message', 'Failed adding: '.Input::get('name').'. Name might already be existing');
            }
        }else{
            try{
                DB::update(
                    'UPDATE tblDiscounts SET dblDiscPerc = ?, decDiscAmt = ?, strDiscDesc = ?, intStatus = 1 WHERE strDiscName = ?',
                    [
                        Input::get('percent'),
                        Input::get('amount'),
                        Input::get('desc'),
                        Input::get('name')
                    ]
                );

                return Redirect::to('/maintenance/ppd/discount')
                    ->with('message', '*Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){}
        }
    }

    public function deleteDiscount(){
        DB::update(
            'UPDATE tblDiscounts SET intStatus = 0 WHERE strDiscCode = ?',
            [
                Input::get('del_id')
            ]
        );

        return Redirect::to('/maintenance/ppd/discount')
            ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function updateDiscount(){
        try{
            DB::update(
                'UPDATE tblDiscounts SET strDiscName = ?, dblDiscPerc = ?, decDiscAmt = ?, strDiscDesc = ? WHERE strDiscCode = ?',
                [
                    Input::get('name'),
                    Input::get('percent'),
                    Input::get('amount'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('/maintenance/ppd/discount')
                ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('/maintenance/ppd/discount')
                ->with('message', 'Failed updating: '.Input::get('name').'. Name might already be existing');
        }
    }

    public function isDiscountInactive($name){
        $status = DB::table('tblDiscounts')
                    ->select('intStatus')
                    ->where('strDiscName', $name)
                    ->first();

        if($status == null){
            return false;
        }else{
            if($status->intStatus == 1){
                return false;
            }else{
                return true;
            }
        }
        // return dd($status->intStatus);
    }

    public function getNames(){
        $table = Input::get('table');
        $column = Input::get('column');

        $res = DB::select('SELECT '.$column.' FROM '.$table.' WHERE intStatus = 1');

        return Response::json($res);
    }

    public function getParticipatingProducts(){
        $res = DB::select(
                            'SELECT 
                                pp.strPackProdProdCode, 
                                pp.intPackProdQuantity, 
                                pr.decProdPricePerPiece
                            FROM tblPackProducts pp
                            LEFT JOIN tblProdPrice pr
                                ON pp.strPackProdProdCode = pr.strProdPriceCode
                            WHERE pp.strPackProdCode = ?',
                            [
                                Input::get('packcode')
                            ]
                        );
        return Response::json($res);
    }

    public function addPackage(){
        try{
            //insert package info

            $packcode = (new CodeController())->getPackageCode();
            
            DB::insert(
                'INSERT INTO tblPackages VALUES(?,?,?,?,?,now(),1)',
                [
                    $packcode,
                    Input::get('name'),
                    Input::get('start'),
                    Input::get('end'),
                    Input::get('pkgprice')
                ]);

            $prods = explode(";",Input::get('packprodcode'));
            $qtys = explode(";",Input::get('packprodqty'));
            $i = 0;

            foreach($prods as $prod){
                DB::insert('INSERT INTO tblPackProducts VALUES(?,?,?)',
                    [
                        $packcode,
                        $prod,
                        $qtys[$i]
                    ]);
                $i++;
            }   

            return Redirect::to('/maintenance/ppd/packages');
        }catch(PDOException $ex){
        }
    }
}
