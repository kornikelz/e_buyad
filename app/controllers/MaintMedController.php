<?php

class MaintMedController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function showTheraClass(){
		return View::make('/maintenance/products/medicine/theraclass');
	}

    public function showProduct(){
        return View::make('/maintenance/products/medicine/proddet');
    }

    public function showGeneric(){
        return View::make('/maintenance/products/medicine/gendet');
    }

    public function showBrand(){
        return View::make('/maintenance/products/medicine/brandet');
    }

    public function showManufacturer(){
        return View::make('/maintenance/products/medicine/manudet');
    }

    //THERAPEUTIC CLASS

    public function updateTheraClass(){
        $theraclass = Input::get('theraclass');
        try{
            DB::update(
                'UPDATE tblPMTheraClass SET strPMTheraClassName = ?, strPMTheraClassDesc = ?, dtmLastUpdate = now() WHERE strPMTheraClassCode = ?',
                [
                    Input::get('theraclass'),
                    Input::get('theradesc'),
                    Input::get('code'),
                ]
            );
            return Redirect::to('/maintenance/products/med/theraclass')
            ->with('message','Successfully updated: '.$theraclass);
        }catch(PDOException $exc){
            return Redirect::to('/maintenance/products/med/theraclass')
            ->with('message','Name might already be existing: '.$theraclass);
        }
    }

    public function deleteTheraClass(){
        DB::update(
            'UPDATE tblPMTheraClass SET intStatus = 0, dtmLastUpdate = now() WHERE strPMTheraClassCode = ?',
            [
                Input::get('del_id'),
            ]
        );

        return Redirect::to('/maintenance/products/med/theraclass')
        ->with('message','Successfully deleted: '.Input::get('del_name'));
    }

    private function isTheraClassArchive($theraclass){
        $status = DB::table('tblPMTheraClass')
                    ->select('intStatus')
                    ->where('strPMTheraClassName', $theraclass)
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

    public function addTheraClass(){
        $theraclass = Input::get('theraclass');
        if($this->isTheraClassArchive($theraclass) == false){
            try{
                DB::insert(
                    'INSERT INTO tblPMTheraClass VALUES (?,?,?,now(),1)',
                    [
                        (new CodeController())->getTheraClassCode(),
                        Input::get('theraclass'),
                        Input::get('theradesc')
                    ]
                );

                return Redirect::to('/maintenance/products/med/theraclass')
                ->with('message','Successfully added therapeutic class: '.$theraclass);
            }catch(PDOException $exc){
                $hehe = $this->isTheraClassArchive($theraclass) ? 'true' : 'false';
                return Redirect::to('/maintenance/products/med/theraclass')
                ->with('message','Name might already be existing: '.$theraclass.' '.$hehe);
            }
        }else{
            try{
                DB::update(
                    'UPDATE tblPMTheraClass SET strPMTheraClassDesc = ?, dtmLastUpdate = now(), intStatus = 1 WHERE strPMTheraClassName = ?',
                    [
                        Input::get('theradesc'),
                        Input::get('theraclass')
                    ]
                );

                return Redirect::to('/maintenance/products/med/theraclass')
                ->with('message','*Successfully added therapeutic class: '.$theraclass);
            }catch(PDOException $exc){
            }
        }
    }

    //GENERIC

    public function updateGeneric(){
        try{
            DB::update(
                'UPDATE tblProdMedGeneric SET strPMGenName = ?, strPMGenDesc = ?, dtmLastUpdate = now()
                  WHERE strPMGenCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('/maintenance/products/med/gendet')
            ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){
            return Redirect::to('/maintenance/products/med/gendet')
            ->with('message', 'Cannot be updated. Name might already be existing: '.Input::get('name'));
        }
    }

    public function deleteGeneric(){
        DB::update(
            'UPDATE tblProdMedGeneric SET intStatus = 0, dtmLastUpdate = now() WHERE strPMGenCode = ?',
            [
                Input::get('del_id'),
            ]
        );

        return Redirect::to('/maintenance/products/med/gendet')
        ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function addGeneric(){
        if(!$this->isGenNameArchive(Input::get('name'))){
            try{
                DB::insert(
                    'INSERT INTO tblProdMedGeneric VALUES(?,?,?,now(),1)',
                    [
                        (new CodeController())->getGenericCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('/maintenance/products/med/gendet')
                ->with('message', 'Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){
                return Redirect::to('/maintenance/products/med/gendet')
                ->with('message', 'Cannot be added. Name might already be existing: '.Input::get('name'));
            }
        }else{
            try{
                DB::update(
                    'UPDATE tblProdMedGeneric set strPMGenDesc = ?, dtmLastUpdate = now(), intStatus = 1 WHERE strPMGenName = ?',
                    [
                        Input::get('desc'),
                        Input::get('name')
                    ]
                    );

                return Redirect::to('/maintenance/products/med/gendet')
                ->with('message', '*Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){}
        }
    }

    private function isGenNameArchive($genname){
        $status = DB::table('tblProdMedGeneric')
                    ->select('intStatus')
                    ->where('strPMGenName', $genname)
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

    //BRANDED

    public function updateBranded(){
        try{
            DB::update(
                'UPDATE tblProdMedBranded SET strPMBranName = ?, strPMBranDesc = ?, dtmLastUpdate = now()
                  WHERE strPMBranCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('/maintenance/products/med/brandet')
                ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('/maintenance/products/med/brandet')
                ->with('message', 'Cannot be updated. Brand Name might already be existing: '.Input::get('name'));
        }
    }

    public function deleteBranded(){
        DB::update(
            'UPDATE tblProdMedBranded SET intStatus = 0, dtmLastUpdate = now()
              WHERE strPMBranCode = ?',
            [
                Input::get('del_id')
            ]
        );

        return Redirect::to('/maintenance/products/med/brandet')
            ->with('message', 'Successfully deleted: '.Input::get('del_name'));
    }

    public function addBranded(){
        if(!$this->isBranNameArchive(Input::get('name'))){
            try{
                DB::insert(
                    'INSERT INTO tblprodmedbranded VALUES (?,?,?,now(),1)',
                    [
                        (new CodeController())->getBrandedCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('/maintenance/products/med/brandet')
                    ->with('message', 'Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){

                return Redirect::to('/maintenance/products/med/brandet')
                    ->with('message', 'Cannot be added. Brand Name might already be existing: '.Input::get('name'));
            }
        }else{
            try{
                DB::update(
                        'UPDATE tblProdMedBranded set strPMBranDesc = ?, dtmLastUpdate = now(), intStatus = 1 WHERE strPMBranName = ?',
                        [
                            Input::get('desc'),
                            Input::get('name')
                        ]
                    );

                return Redirect::to('/maintenance/products/med/brandet')
                    ->with('message', '*Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){}
        }
    }

    private function isBranNameArchive($branname){
        $status = DB::table('tblProdMedBranded')
                    ->select('intStatus')
                    ->where('strPMBranName', $branname)
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
        return dd($status->intStatus);
    }

    //MANUFACTURER

    public function updateManufacturer(){
        try{
            DB::update(
                'UPDATE tblpmmanufacturer SET strPMManuName = ?, strPMManuDesc = ?, dtmLastUpdate = now()
                  WHERE strPMManuCode = ?',
                [
                    Input::get('name'),
                    Input::get('desc'),
                    Input::get('code')
                ]
            );

            return Redirect::to('/maintenance/products/med/manudet')
                ->with('message', 'Successfully updated: '.Input::get('name'));
        }catch(PDOException $ex){

            return Redirect::to('/maintenance/products/med/manudet')
                ->with('message', 'Update failed. Name might already be existing: '.Input::get('name'));
        }
    }

    public function deleteManufacturer(){
        try{
            DB::update(
                'UPDATE tblpmmanufacturer SET intStatus = 0, dtmLastUpdate = now()
                  WHERE strPMManuCode = ?',
                [
                    Input::get('del_id')
                ]
            );

            return Redirect::to('/maintenance/products/med/manudet')
                ->with('message', 'Successfully deleted: '.Input::get('del_name'));
        }catch(PDOException $ex){}
    }

    public function addManufacturer(){
        if(!$this->isManuNameArchive(Input::get('name'))){
            try{
                DB::insert(
                    'INSERT INTO tblpmmanufacturer VALUES (?,?,?,now(),1)',
                    [
                        (new CodeController())->getManufacturerCode(),
                        Input::get('name'),
                        Input::get('desc')
                    ]
                );

                return Redirect::to('/maintenance/products/med/manudet')
                    ->with('message', 'Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){

                return Redirect::to('/maintenance/products/med/manudet')
                    ->with('message', 'Adding failed. Name might already be existing: '.Input::get('name'));
            }
        }else{
            try{
                DB::update(
                        'UPDATE tblPMManufacturer set strPMManuDesc = ?, dtmLastUpdate = now(), intStatus = 1 WHERE strPMManuName = ?',
                        [
                            Input::get('desc'),
                            Input::get('name')
                        ]
                    );

                return Redirect::to('/maintenance/products/med/manudet')
                    ->with('message', '*Successfully added: '.Input::get('name'));
            }catch(PDOException $ex){}
        }
    }

    private function isManuNameArchive($manuname){
        $status = DB::table('tblPMManufacturer')
                    ->select('intStatus')
                    ->where('strPMManuName', $manuname)
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
        //return dd($status->intStatus);
    }

    //PRODUCTS

    public function addProduct(){
        $archprod = $this->isProductArchive(Input::get('medtype'),Input::get('brand'),Input::get('manu'),Input::get('hidden_gen'),Input::get('form'),Input::get('size'),Input::get('uom'));
        if(//if product is not archived
            $archprod == 'false'){
            if(//if product is currently active
                !$this->isProductExisting(null, Input::get('medtype'),Input::get('brand'),Input::get('manu'),Input::get('hidden_gen'),Input::get('form'),Input::get('size'),Input::get('uom'))
                ){
                try{
                    $prodcode = (new CodeController())->getProducCode();

                    //insert into tblProducts
                    DB::insert(
                        'INSERT INTO tblProducts VALUES(?,?,now(),1)',
                        [
                            $prodcode,
                            0,
                        ]
                    );

                    //insert into tblProdMed
                    DB::insert(
                        'INSERT INTO tblProdMed VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                        [
                            $prodcode,
                            Input::get('medtype'),
                            Input::get('thera'),
                            Input::get('brand'),
                            Input::get('manu'),
                            Input::get('form'),
                            Input::get('size'),
                            Input::get('uom'),
                            Input::get('dossize'),
                            Input::get('dosuom'),
                            Input::get('dospersize'),
                            Input::get('dosperuom'),
                            Input::get('pack'),
                            Input::get('desc')
                        ]
                        );

                    //insert Generic Names

                    $gennames = explode(';', Input::get('hidden_gen'));
                    foreach($gennames as $gen){
                        DB::insert('INSERT INTO tblMedGenNames VALUES(?,(SELECT strPMGenCode FROM tblProdMedGeneric WHERE strPMGenName = ?))',
                        [
                            $prodcode, $gen
                        ]);
                    }

                    //insert into tblProdPrice
                    DB::insert(
                        'INSERT INTO tblProdPrice VALUES(?,?,?,?,now())',
                        [
                            $prodcode,
                            Input::get('prpc'),
                            Input::get('prpck'),
                            Input::get('pcpck')
                        ]
                        );

                    return Redirect::to('/maintenance/products/med/proddet')
                    ->with('message','Successfully added!');            
                }catch(PDOException $ex){

                    return Redirect::to('/maintenance/products/med/proddet')
                    ->with('message','Product cannot be added!');    
                }
            }else{
                return Redirect::to('/maintenance/products/med/proddet')
                ->with('message','Product is already existing!');  
            }
        }else{//just activate and update data
            $prodcode = $archprod;
            try{
                //update tblProducts
                DB::update(
                    'UPDATE tblProducts SET dtmLastUpdate = now(), intStatus = 1'
                    );

                //update tblProdMed
                DB::update(
                    'UPDATE tblProdMed SET intProdMedType = ?, strProdMedTheraCode = ?, strProdMedBranCode = ?, strProdMedManuCode = ?, 
                        strProdMedFormCode = ?, decProdMedSize = ?, strProdMedUOMCode = ?, strProdMedPackCode = ?, strProdMedDesc = ?
                     WHERE strProdMedCode = ?',
                    [
                        Input::get('medtype'),
                        Input::get('thera'),
                        Input::get('brand'),
                        Input::get('manu'),
                        Input::get('form'),
                        Input::get('size'),
                        Input::get('uom'),
                        Input::get('pack'),
                        Input::get('desc'),
                        $prodcode
                    ]
                    );

                //update generic names
                DB::table('tblMedGenNames')->where('strMedGenMedCode','=',$prodcode)->delete();

                $gennames = explode(';', Input::get('hidden_gen'));
                foreach($gennames as $gen){
                    DB::insert('INSERT INTO tblMedGenNames VALUES(?,(SELECT strPMGenCode FROM tblProdMedGeneric WHERE strPMGenName = ?))',
                    [
                        $prodcode, $gen
                    ]);
                }

                //update tblProdPrice
                DB::update(
                    'UPDATE tblProdPrice set decProdPricePerPiece = ?, decPricePerPackage = ?, intQtyPerPackage = ?, dtmLastUpdate = now() WHERE strProdPriceCode = ?',
                    [
                        Input::get('prpc'),
                        Input::get('prpck'),
                        Input::get('pcpck'),
                        $prodcode
                    ]
                    );

                return Redirect::to('/maintenance/products/med/proddet')
                    ->with('message','*Product successfully added!');
            }catch(PDOException $ex){}
        }
    }

    public function updateProduct(){
        if(//if product is currently active
                !$this->isProductExisting(Input::get('prodcode'),Input::get('medtype'),Input::get('brand'),Input::get('manu'),Input::get('hidden_gen'),Input::get('form'),Input::get('size'),Input::get('uom'))
                ){
            $prodcode = Input::get('prodcode');

            try{
                //update tblProducts
                DB::update(
                    'UPDATE tblProducts SET dtmLastUpdate = now()'
                    );

                //update tblProdMed
                DB::update(
                    'UPDATE tblProdMed SET intProdMedType = ?, strProdMedTheraCode = ?, strProdMedBranCode = ?, strProdMedManuCode = ?, 
                        strProdMedFormCode = ?, decProdMedSize = ?, strProdMedUOMCode = ?, decProdMedDosSize = ?, strProdMedDosUOMCode = ?, 
                        decProdMedDosPerSize = ?, strProdMedDosPerUOMCode = ?, strProdMedPackCode = ?, strProdMedDesc = ?
                     WHERE strProdMedCode = ?',
                    [
                        Input::get('medtype'),
                        Input::get('thera'),
                        Input::get('brand'),
                        Input::get('manu'),
                        Input::get('form'),
                        Input::get('size'),
                        Input::get('uom'),
                        Input::get('dossize'),
                        Input::get('dosuom'),
                        Input::get('dospersize'),
                        Input::get('dosperuom'),
                        Input::get('pack'),
                        Input::get('desc'),
                        $prodcode
                    ]
                    );

                //update generic names
                DB::table('tblMedGenNames')->where('strMedGenMedCode','=',$prodcode)->delete();

                $gennames = explode(';', Input::get('hidden_gen'));
                foreach($gennames as $gen){
                    DB::insert('INSERT INTO tblMedGenNames VALUES(?,(SELECT strPMGenCode FROM tblProdMedGeneric WHERE strPMGenName = ?))',
                    [
                        $prodcode, $gen
                    ]);
                }

                //update tblProdPrice
                DB::update(
                    'UPDATE tblProdPrice set decProdPricePerPiece = ?, decPricePerPackage = ?, intQtyPerPackage = ?, dtmLastUpdate = now() WHERE strProdPriceCode = ?',
                    [
                        Input::get('prpc'),
                        Input::get('prpck'),
                        Input::get('pcpck'),
                        $prodcode
                    ]
                    );

            return Redirect::to('/maintenance/products/med/proddet')
                ->with('message','Product successfully updated!');
            }catch(PDOException $ex){}
        }else{
            return Redirect::to('/maintenance/products/med/proddet')
            ->with('message','Product is already existing!');  
        }
    }

    public function deleteProduct(){
        DB::update('UPDATE tblProducts SET intStatus = 0 WHERE strProdCode = ?',
            [
                Input::get('del_prodid')
            ]);

        return Redirect::to('/maintenance/products/med/proddet')
            ->with('message','Product successfully deleted!');
    }

    public function isProductExisting($code, $type, $brand, $manu, $generic, $form, $size, $uom){
        $cond = [
                    'tblProdMed.intProdMedType' => intval($type),
                    'tblProdMed.strProdMedBranCode' => $brand,
                    'tblProdMed.strProdMedManuCode' => $manu,
                    'tblProdMed.strProdMedFormCode' => $form,
                    'tblProdMed.decProdMedSize' => floatval($size),
                    'tblProdMed.strProdMedUOMCode' => $uom,
                    'tblProducts.intStatus' => 1
                ];
        $prodcode = DB::table('tblProdMed')
                        ->leftJoin('tblProducts','tblProdMed.strProdMedCode','=','tblProducts.strProdCode')
                        ->select('tblProdMed.strProdMedCode')
                        ->where($cond)
                        ->first();

        if($prodcode != null && $code != $prodcode->strProdMedCode){
            $gens = explode(";",$generic);
            sort($gens);
            $genname = implode(";",$gens);

            $dbgen = DB::select("SELECT group_concat(g.strPMGenName SEPARATOR ';') as 'GenName'
                                    FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                    WHERE mg.strMedGenMedCode = ? GROUP BY mg.strMedGenMedCode",
                                    [
                                        $prodcode->strProdMedCode
                                    ]);

            $dbg = explode(";",$dbgen[0]->GenName);
            sort($dbg);
            $dbgenname = implode(";",$dbg);

            if($genname == $dbgenname){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function isProductArchive($type, $brand, $manu, $generic, $form, $size, $uom){
        $cond = [
                    'tblProdMed.intProdMedType' => intval($type),
                    'tblProdMed.strProdMedBranCode' => $brand,
                    'tblProdMed.strProdMedManuCode' => $manu,
                    'tblProdMed.strProdMedFormCode' => $form,
                    'tblProdMed.decProdMedSize' => floatval($size),
                    'tblProdMed.strProdMedUOMCode' => $uom,
                    'tblProducts.intStatus' => 0
                ];
        $prodcode = DB::table('tblProdMed')
                        ->leftJoin('tblProducts','tblProdMed.strProdMedCode','=','tblProducts.strProdCode')
                        ->select('tblProdMed.strProdMedCode')
                        ->where($cond)
                        ->first();

        if($prodcode != null){
            $gens = explode(";",$generic);
            sort($gens);
            $genname = implode(";",$gens);

            $dbgen = DB::select("SELECT group_concat(g.strPMGenName SEPARATOR ';') as 'GenName'
                                    FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                    WHERE mg.strMedGenMedCode = ? GROUP BY mg.strMedGenMedCode",
                                    [
                                        $prodcode->strProdMedCode
                                    ]);

            $dbg = explode(";",$dbgen[0]->GenName);
            sort($dbg);
            $dbgenname = implode(";",$dbg);

            if($genname == $dbgenname){
                return $prodcode->strProdMedCode;
            }else{
                return 'false';
            }
        }else{
            return 'false';
        }
    }
}