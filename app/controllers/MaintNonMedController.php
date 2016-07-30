<?php

class MaintNonMedController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    // NON MED CATEGORY

	public function index()
    {
        return View::make('/maintenance/products/non-medicine/nonmedcat');
    }

    public function updateCategory(){
        try{
            DB::update(
                'UPDATE tblNMedCategory SET strNMedCatName = ?, strNMedDesc = ? WHERE strNMedCatCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('/maintenance/products/nonmed/category')
                ->with('message','Successfully updated category name: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('/maintenance/products/nonmed/category')
                ->with('message','Updating failed. Category name might be existing: '.Input::get('name'));
        }
    }

    public function deleteCategory(){
        DB::update(
            'UPDATE tblNMedCategory SET intStatus = 0, dtmLastUpdate = now() WHERE strNMedCatCode = ?',
            [
                Input::get('del_id')
            ]
        );

        return Redirect::to('/maintenance/products/nonmed/category')
                ->with('message','Successfully deleted category name: '.Input::get('del_name'));
    }

    public function addCategory(){
        if(!$this->isCategoryArchive(Input::get('name'))){
            try{
                DB::insert(
                    'INSERT INTO tblnmedcategory VALUES (?,?,?,now(),1)',
                    [
                        (new CodeController())->getNMedCategoryCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('/maintenance/products/nonmed/category')
                    ->with('message','Successfully added category name: '.Input::get('name'));
            }catch(PDOException $e){

                return Redirect::to('/maintenance/products/nonmed/category')
                    ->with('message','Inserting failed. Category name might be existing: '.Input::get('name'));
            }
        }else{
            DB::update(
                'UPDATE tblNMedCategory SET strNMedDesc = ?, intStatus = 1 WHERE strNMedCatName = ?',
                [
                    Input::get('desc'),
                    Input::get('name')
                ]
            );

            return Redirect::to('/maintenance/products/nonmed/category')
                ->with('message','*Successfully added category name: '.Input::get('name'));
        }
    }

    public function isCategoryArchive($name){
        $status = DB::table('tblNMedCategory')
                    ->select('intStatus')
                    ->where('strNMedCatName', $name)
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
    //NON MED PRODUCT DETAILS 
    
    public function showDetails(){
        return View::make('/maintenance/products/non-medicine/nonmeddet');
    }

    public function updateDetails(){
        
        try{
            $isExis = $this->isProductExisting(Input::get('name'),Input::get('meastype'),Input::get('gensize'),Input::get('stansize'),Input::get('uom'));
            
            if($isExis == 'false'){

                //set the measurement type to database fixed int type
                $cat = Input::get('meastype');

                //update general info
                DB::update(
                    'UPDATE tblProdNonMed SET strProdNMedName = ?,
                      strProdNMedCatCode = ?,
                      intProdNMedMeasType = ?, strProdNMedDesc = ?
                      WHERE strProdNMedCode = ?',
                    [
                        Input::get('name'),
                        Input::get('category'),
                        $cat,
                        Input::get('desc'),
                        Input::get('code')
                    ]
                );

                //update price
                DB::update(
                    'UPDATE tblProdPrice SET decProdPricePerPiece = ? WHERE strProdPriceCode = ?',
                    [
                        Input::get('price'),
                        Input::get('code')
                    ]
                );

                //update measurement type info
                if(Input::get('origtype') == 0){
                    //if measurement type is retained and is 'GENERAL'
                    if($cat == 0){
                        DB::update(
                            'UPDATE tblNMedGeneral SET strNMGenSizeCode = ? WHERE strNMGenCode = ?',
                            [
                                Input::get('gensize'),
                                Input::get('code')
                            ]
                        );
                    }
                    //else
                    else{
                        DB::delete(
                            'DELETE from tblNMedGeneral WHERE strNMGenCode =   ?',
                            [ Input::get('code') ]
                        );
                        if($cat == 1) {
                            DB::insert(
                                'INSERT INTO tblnmedstandard VALUES (?,?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('stansize'),
                                    Input::get('uom')
                                ]
                            );
                        }
                    }
                }else if(Input::get('origtype') == 1){
                    if($cat == 1){
                        DB::update(
                            'UPDATE tblNMedStandard SET decNMStanSize = ?,
                              strNMStanUOMCode = ?
                              WHERE strNMStanCode = ?',
                            [
                                Input::get('stansize'),
                                Input::get('uom'),
                                Input::get('code')
                            ]
                        );
                    }
                    else{
                        DB::delete(
                            'DELETE FROM tblnmedstandard WHERE strNMStanCode = ?',
                            [ Input::get('code') ]
                        );
                        if($cat == 0) {
                            DB::insert(
                                'INSERT INTO tblnmedgeneral VALUES(?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('gensize')
                                ]
                            );
                        }
                    }
                }else{
                    if($cat != 2) {
                        if ($cat == 0) {
                            DB::insert(
                                'INSERT INTO tblnmedgeneral VALUES(?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('gensize')
                                ]
                            );
                        } else if ($cat == 1) {
                            DB::insert(
                                'INSERT INTO tblnmedstandard VALUES (?,?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('stansize'),
                                    Input::get('uom')
                                ]
                            );
                        }
                    }
                }

                return Redirect::to('/maintenance/products/nonmed/details')->with(
                    'message',
                    Input::get('name').' Successfully updated!'
                );
            }else{

                return Redirect::to('/maintenance/products/nonmed/details')->with(
                    'message',
                    Input::get('name').' cannot be updated. Same details might already be existing'
                );
            }
        }catch(PDOException $ex){
            return Redirect::to('/maintenance/products/nonmed/details')->with(
                'message',
                Input::get('name').' cannot be updated. Same details might already be existing*'
            );
        }
    }

    public function deleteDetails(){
        DB::update(
            'UPDATE tblProducts SET intStatus = 0 WHERE strProdCode = ?',
            [ Input::get('del_id') ]
        );



        return Redirect::to('/maintenance/products/nonmed/details')->with(
            'message',
            Input::get('del_name').' Successfully deleted!'
        );
    }

    public function addDetails(){
        
        $isExis = $this->isProductExisting(Input::get('name'),Input::get('meastype'),Input::get('gensize'),Input::get('stansize'),Input::get('uom'));
        
        if($isExis == "false"){//product does not exist
            //just add the product
            $code = (new CodeController())->getProducCode();

            //set the measurement type to database fixed int type

            $cat = Input::get('meastype');

            //tblProducts
            DB::insert(
                'INSERT INTO tblproducts VALUES (?,1,now(),1)',
                [
                    $code
                ]
            );

            //tblProdNonMed
            DB::insert(
                'INSERT INTO tblprodnonmed VALUES (?,?,?,?,?)',
                [
                    $code,
                    Input::get('name'),
                    Input::get('category'),
                    $cat,
                    Input::get('desc')
                ]
            );

            //tblPrice
            DB::insert(
                'INSERT INTO tblProdPrice VALUES (?,?,0,0,now())',
                [
                    $code,
                    Input::get('price'),
                ]
            );

            if($cat == 0){
                DB::insert(
                    'INSERT INTO tblnmedgeneral VALUES(?,?)',
                    [
                        $code,
                        Input::get('gensize')
                    ]
                );

            }else if($cat == 1){
                DB::insert(
                    'INSERT INTO tblnmedstandard VALUES (?,?,?)',
                    [
                        $code,
                        Input::get('stansize'),
                        Input::get('uom')
                    ]
                );
            }

            return Redirect::to('/maintenance/products/nonmed/details')->with(
                'message',
                Input::get('name').' Successfully added!'
            );
        }else{//product does exist
            if($this->isProductArchive($isExis)){//product is inactive
                //activate the product whilst updating the data
            
                //set the measurement type to database fixed int type
                $cat = Input::get('meastype');

                //update general info
                DB::update(
                    'UPDATE tblProdNonMed SET strProdNMedName = ?,
                      strProdNMedCatCode = ?,
                      intProdNMedMeasType = ?, strProdNMedDesc = ?
                      WHERE strProdNMedCode = ?',
                    [
                        Input::get('name'),
                        Input::get('category'),
                        $cat,
                        Input::get('desc'),
                        $isExis
                    ]
                );

                //update price
                DB::update(
                    'UPDATE tblProdPrice SET decProdPricePerPiece = ? WHERE strProdPriceCode = ?',
                    [
                        Input::get('price'),
                        Input::get('code')
                    ]
                );

                //update measurement type info
                if(Input::get('origtype') == 0){
                    //if measurement type is retained and is 'GENERAL'
                    if($cat == 0){
                        DB::update(
                            'UPDATE tblNMedGeneral SET strNMGenSizeCode = ? WHERE strNMGenCode = ?',
                            [
                                Input::get('gensize'),
                                Input::get('code')
                            ]
                        );
                    }
                    //else
                    else{
                        DB::delete(
                            'DELETE from tblNMedGeneral WHERE strNMGenCode =   ?',
                            [ Input::get('code') ]
                        );
                        if($cat == 1) {
                            DB::insert(
                                'INSERT INTO tblnmedstandard VALUES (?,?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('stansize'),
                                    Input::get('uom')
                                ]
                            );
                        }
                    }
                }else if(Input::get('origtype') == 1){
                    if($cat == 1){
                        DB::update(
                            'UPDATE tblNMedStandard SET decNMStanSize = ?,
                              strNMStanUOMCode = ?
                              WHERE strNMStanCode = ?',
                            [
                                Input::get('stansize'),
                                Input::get('uom'),
                                Input::get('code')
                            ]
                        );
                    }
                    else{
                        DB::delete(
                            'DELETE FROM tblnmedstandard WHERE strNMStanCode = ?',
                            [ Input::get('code') ]
                        );
                        if($cat == 0) {
                            DB::insert(
                                'INSERT INTO tblnmedgeneral VALUES(?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('gensize')
                                ]
                            );
                        }
                    }
                }else{
                    if($cat != 2) {
                        if ($cat == 0) {
                            DB::insert(
                                'INSERT INTO tblnmedgeneral VALUES(?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('gensize')
                                ]
                            );
                        } else if ($cat == 1) {
                            DB::insert(
                                'INSERT INTO tblnmedstandard VALUES (?,?,?)',
                                [
                                    Input::get('code'),
                                    Input::get('stansize'),
                                    Input::get('uom')
                                ]
                            );
                        }
                    }
                }

                //active in tblProducts
                DB::update('UPDATE tblProducts SET intStatus = 1 WHERE strProdCode = ?',
                            [$isExis]);

                return Redirect::to('/maintenance/products/nonmed/details')->with(
                    'message',
                    Input::get('name').' successfully added!*'
                );
            }else{//product is active
                //do not let it pass!
                return Redirect::to('/maintenance/products/nonmed/details')->with(
                    'message',
                    Input::get('name').' cannot be added. Same details might already be existing'
                );
            }
        }
    }

    public function isProductExisting($name, $type, $gensize, $stansize, $uom){
        $cond = [
                    'strProdNMedName' => $name,
                    'intProdNMedMeasType' => intval($type)
                ];

        $prodcode = DB::table('tblProdNonMed')
                        ->select('strProdNMedCode')
                        ->where($cond)
                        ->first();

        if($prodcode != null){
            if($type == 0){
                $gencode = DB::table('tblNMedGeneral')
                                ->select('strNMGenSizeCode')
                                ->where('strNMGenCode', $prodcode->strProdNMedCode)
                                ->first();

                if($gencode->strNMGenSizeCode == $gensize){
                    return $prodcode->strProdNMedCode;
                }else{
                    return 'false';
                }
            }else if($type == 1){
                $stancode = DB::table('tblNMedStandard')
                                ->select('decNMStanSize', 'strNMStanUOMCode')
                                ->where('strNMStanCode', $prodcode->strProdNMedCode)
                                ->first();

                if($stancode->decNMStanSize == $stansize && $stancode->strNMStanUOMCode == $uom){
                    return $prodcode->strProdNMedCode;
                }else{
                    return 'false';
                }
            }else{
                return $prodcode->strProdNMedCode;
            }
        }else{
            return 'false';
        }
    }

    public function isProductArchive($code){
        $status = DB::table('tblProducts')
                    ->select('intStatus')
                    ->where('strProdCode', $code)
                    ->where('intStatus', 0)
                    ->first();

        if($status == null){
            return false;
        }else{
            return true;
        }
    }
}
