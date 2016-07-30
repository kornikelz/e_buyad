<?php

class CodeController extends BaseController
{
	
	private function getLastCode($table, $pkTable){
	    $lastCode = DB::table($table)
						->select($pkTable)
					    ->orderBy($pkTable, 'desc')
				       	->take(1)
				       	->get();
			return $lastCode;
	}
	public function showCode($forCode) {
			$pattern = "/(\d+)/";
			$array = preg_split($pattern, $forCode, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			$number = (int)$array[1];
			$number++;
			$number = str_pad($number, 5, "0", STR_PAD_LEFT);
			$code = $array[0];
			$code .= $number;
			return $code;
	}
	
	public function getBranchCode(){
		$strCode = $this->getLastCode('tblBranches', 'strBranchCode');
		if($strCode == null || $strCode == "") {
			$forCode = "BRA00000";
		}
		else {
			$forCode = $strCode["0"]->strBranchCode;
		}

		return $this->showCode($forCode);
	}

    public function getJobCode(){
        $strCode = $this->getLastCode('tblEmpJobDesc', 'strEJCode');
        if($strCode == null || $strCode == "") {
            $forCode = "JOB00000";
        }
        else {
            $forCode = $strCode["0"]->strEJCode;
        }

        return $this->showCode($forCode);
    }

    public function getEmployeeCode(){
        $strCode = $this->getLastCode('tblEmployee', 'strEmpCode');
        if($strCode == null || $strCode == "") {
            $forCode = "EMP00000";
        }
        else {
            $forCode = $strCode["0"]->strEmpCode;
        }

        return $this->showCode($forCode);
    }

    public function getTheraClassCode(){
        $strCode = $this->getLastCode('tblPMTheraClass', 'strPMTheraClassCode');
        if($strCode == null || $strCode == "") {
            $forCode = "THR00000";
        }
        else {
            $forCode = $strCode["0"]->strPMTheraClassCode;
        }

        return $this->showCode($forCode);
    }

    public function getGenericCode(){
        $strCode = $this->getLastCode('tblProdMedGeneric', 'strPMGenCode');
        if($strCode == null || $strCode == "") {
            $forCode = "MGN00000";
        }
        else {
            $forCode = $strCode["0"]->strPMGenCode;
        }

        return $this->showCode($forCode);
    }

    public function getBrandedCode(){
        $strCode = $this->getLastCode('tblProdMedBranded', 'strPMBranCode');
        if($strCode == null || $strCode == "") {
            $forCode = "MBR00000";
        }
        else {
            $forCode = $strCode["0"]->strPMBranCode;
        }

        return $this->showCode($forCode);
    }

    public function getManufacturerCode(){
        $strCode = $this->getLastCode('tblPMManufacturer', 'strPMManuCode');
        if($strCode == null || $strCode == "") {
            $forCode = "MNF00000";
        }
        else {
            $forCode = $strCode["0"]->strPMManuCode;
        }

        return $this->showCode($forCode);
    }

    public function getNMedCategoryCode(){
        $strCode = $this->getLastCode('tblNMedCategory', 'strNMedCatCode');
        if($strCode == null || $strCode == "") {
            $forCode = "NMC00000";
        }
        else {
            $forCode = $strCode["0"]->strNMedCatCode;
        }

        return $this->showCode($forCode);
    }

    public function getProducCode(){
        $strCode = $this->getLastCode('tblProducts', 'strProdCode');
        if($strCode == null || $strCode == "") {
            $forCode = "PRD00000";
        }
        else {
            $forCode = $strCode["0"]->strProdCode;
        }

        return $this->showCode($forCode);
    }

    public function getFormCode(){
        $strCode = $this->getLastCode('tblPMForm', 'strPMFormCode');
        if($strCode == null || $strCode == "") {
            $forCode = "FRM00000";
        }
        else {
            $forCode = $strCode["0"]->strPMFormCode;
        }

        return $this->showCode($forCode);
    }

    public function getPackagingCode(){
        $strCode = $this->getLastCode('tblPMPackaging', 'strPMPackCode');
        if($strCode == null || $strCode == "") {
            $forCode = "PCK00000";
        }
        else {
            $forCode = $strCode["0"]->strPMPackCode;
        }

        return $this->showCode($forCode);
    }

    public function getUOMCode(){
        $strCode = $this->getLastCode('tblUOM', 'strUOMCode');
        if($strCode == null || $strCode == "") {
            $forCode = "UOM00000";
        }
        else {
            $forCode = $strCode["0"]->strUOMCode;
        }

        return $this->showCode($forCode);
    }

    public function getDiscountCode(){
        $strCode = $this->getLastCode('tblDiscounts', 'strDiscCode');
        if($strCode == null || $strCode == "") {
            $forCode = "DSC00000";
        }
        else {
            $forCode = $strCode["0"]->strDiscCode;
        }

        return $this->showCode($forCode);
    }

    public function getTransCode(){
        $strCode = $this->getLastCode('tblTransaction', 'strTransId');
        if($strCode == null || $strCode == "") {
            $forCode = "TRN00000";
        }
        else {
            $forCode = $strCode["0"]->strTransId;
        }

        return $this->showCode($forCode);
    }

    public function getMemCode(){
        $strCode = $this->getLastCode('tblMember', 'strMemCode');
        if($strCode == null || $strCode == "") {
            $forCode = "MEM00000";
        }
        else {
            $forCode = $strCode["0"]->strMemCode;
        }

        return $this->showCode($forCode);
    }

    public function getEGCCode(){
        $strCode = $this->getLastCode('tblEGC', 'strEGCCode');
        if($strCode == null || $strCode == "") {
            $forCode = "EGC00000";
        }
        else {
            $forCode = $strCode["0"]->strEGCCode;
        }

        return $this->showCode($forCode);
    }

    public function getReturnsCode(){
        $strCode = $this->getLastCode('tblReturns', 'strReturnCode');
        if($strCode == null || $strCode == "") {
            $forCode = "RET00000";
        }
        else {
            $forCode = $strCode["0"]->strReturnCode;
        }

        return $this->showCode($forCode);
    }
}

?>
