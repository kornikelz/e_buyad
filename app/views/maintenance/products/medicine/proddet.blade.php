@extends('......layout')

@section('page-title')
    Maintenance - Medical Product Details
@stop

@section('other-scripts')
  {{HTML::script('bootflat-admin/js/datatables.min.js')}}
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
  <script>
    function hsBranded(x){
        if(document.getElementById('medtype').value == "1"){
            document.getElementById('branded').className = "collapse";
            document.getElementById('brand').removeAttribute("required");
            document.getElementById('brand').value = "";
        }else{
            document.getElementById('branded').className = "collapse in";
            document.getElementById('brand').setAttribute("required","");
        }
    }
  </script>
  <style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    input[type=number] {
      -moz-appearance:textfield;
    }
  </style>
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
      <center><h5 class="content-row-title" style="font-size:25px">Medicine Maintenance<hr></h5></center>

      <div class="panel panel-default">
        <div class="btn-group btn-group-justified">
          <a href="{{URL::to('maintenance/products/med/theraclass')}}" class="btn btn-primary">Therapeutic Class</a>
          <a href="{{URL::to('maintenance/products/med/gendet')}}" class="btn btn-primary">Generic Details</a>
          <a href="{{URL::to('maintenance/products/med/brandet')}}" class="btn btn-primary">Brand Details</a>
          <a href="{{URL::to('maintenance/products/med/manudet')}}" class="btn btn-primary">Manufacturer Details</a>
          <a href="#" class="btn btn-info">Product Details</a>
        </div>
                              
        <br><br><br>
                        
        <div class="panel panel-default">
          <div class = "row">
            <div class = "col-md-3">
              <button type="button" class="btn btn-primary btn-block" href="#mem_form" data-toggle="collapse" onclick="clearForm();">ADD PRODUCT</button>
            </div>
          </div>

          <!-- forms -->
          <div class ="row">
            <div class="col-md-1">
            </div>

            <div class="col-md-10">
              <div id="mem_form" class="collapse"><!-- Form Division -->
                <form id="medform" role="form" class="form-horizontal" method="post" action= ""><!-- Medicine Details Form -->
                  <input type="hidden" id="prodcode" name="prodcode">

                  <div class="form-group"><!-- Medicine type choices -->
                    <label class="control-label col-sm-3">Medicine Type:</label>

                    <div class="col-sm-9">
                      <select id = "medtype" name="medtype" class = "form-control" onchange="hsBranded()" required>
                        <option disabled selected value> -- SELECT MEDICINE TYPE -- </option>
                        <option value = "0">Branded</option>
                        <option value = "1">Generic</option>
                       </select>
                    </div>
                  </div>
                  
                  <div id = "branded"><!-- Brand Name -->
                    <div class="form-group">
                      <label class="control-label col-sm-3">Brand Name:</label>

                      <div class="col-sm-9">
                        <select id = "brand" name="brand" class = "form-control" required>
                          <option disabled selected value> -- SELECT BRAND NAME -- </option>
                          <?php
                            $result = DB::select('SELECT strPMBranName,strPMBranCode FROM tblprodmedbranded WHERE intStatus = 1');

                            foreach($result as $data){
                              echo '<option value="'.$data->strPMBranCode.'">'.$data->strPMBranName.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                                       
                  <div class="form-group"><!-- Generic Name -->
                    <label class="control-label col-sm-3">Generic Name:</label>
                    
                    <div class= "col-sm-7">
                      <input type="text" class="form-control" value="" id="gennames" name="gennames" required="">
                      <input type="hidden" id="hidden_gen" name="hidden_gen">
                    </div>

                    <div class= "col-sm-1">
                      <button class="btn btn-default" type="button" data-toggle="modal" data-target="#add_generic">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                                         
                    <div class= "col-sm-1">
                      <button class="btn btn-default" type="button" onclick="setSelGenericNames()">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>

                    <!-- Pop Up Modal for Adding Generic Name -->
                    <div class="modal fade" id="add_generic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                            <h4 class="modal-title" id="myModalLabel">Add Generic Name</h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group">
                              <div class="col-sm-1"></div>

                              <label class="control-label col-sm-3">Generic Name:</label>

                              <div class="col-sm-7">
                                <select id="genname" name="genname" class="form-control col-sm-8">
                                  <?php
                                    $result = DB::select('SELECT strPMGenCode, strPMGenName FROM tblprodmedgeneric WHERE intStatus = 1');

                                    foreach($result as $data){
                                      echo '<option value="'.$data->strPMGenCode.'">'.$data->strPMGenName.'</option>';
                                    }
                                  ?>
                                </select>
                              </div>

                              <div class="col-sm-1"></div>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="isGenericNameExisting()" data-dismiss="modal">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Pop Up Modal for Removing Generic Name -->
                    <div class="modal fade" id="remove_generic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                            <h4 class="modal-title" id="myModalLabel">Remove Generic Name</h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group">
                              <div class="col-sm-1"></div>

                              <label class="control-label col-sm-3">Generic Name:</label>

                              <div class="col-sm-7">
                                <select id="sel_genname" name="sel_genname" class="form-control col-sm-8">
                                </select>
                              </div>

                              <div class="col-sm-1"></div>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="removeGenericName()" data-dismiss="modal">Remove</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group"><!-- Thera Class -->
                    <label class="control-label col-sm-3">Therapeutic Class:</label>
                    <div class="col-sm-9">
                      <select class = "form-control" id="thera" name="thera" required>
                        <option disabled selected value> -- SELECT THERAPEUTIC CLASS -- </option>
                        <?php
                          $result = DB::select('SELECT strPMTheraClassName,strPMTheraClassCode FROM tblPMTheraClass WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strPMTheraClassCode.'">'.$data->strPMTheraClassName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"><!-- Manufacturer -->
                    <label class="control-label col-sm-3">Manufacturer:</label>
                                         
                    <div class="col-sm-9">
                      <select class = "form-control" id="manu" name="manu" required>
                        <option disabled selected value> -- SELECT MANUFACTURER -- </option>
                        <?php
                          $result = DB::select('SELECT strPMManuName,strPMManuCode FROM tblpmmanufacturer WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strPMManuCode.'">'.$data->strPMManuName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"><!-- Form -->
                    <label class="control-label col-sm-3">Form:</label>
                    
                    <div class= "col-sm-9">
                      <select class = "form-control" id="form" name="form"  required>
                        <option disabled selected value> -- SELECT FORM -- </option>
                        <?php
                          $result = DB::select('SELECT strPMFormName,strPMFormCode FROM tblpmform WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strPMFormCode.'">'.$data->strPMFormName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div id="sizediv" class="form-group has-feedback"><!-- Size -->
                    <label class="control-label col-sm-3">Size:</label>
                     
                    <div class="col-sm-5">
                      <input type="text" id="size" class="form-control" name="size" placeholder="0.00" maxlength="10" required>
                      <span id="sizespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="sizep" class="help-block with-errors"></p>
                    </div>
                    
                    <div class="col-sm-4">
                      <select class = "form-control" id="uom" name="uom" required>
                        <option disabled selected value> -- SELECT UOM -- </option>
                        <?php
                          $result = DB::select('SELECT strUOMName,strUOMCode FROM tblUOM WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strUOMCode.'">'.$data->strUOMName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div id="dosdiv" class="form-group has-feedback"><!-- Dosage -->
                    <label class="control-label col-sm-3">Dosage:</label>
                     
                    <div class="col-sm-2">
                      <input type="text" id="dossize" class="form-control" name="dossize" placeholder="0.00" maxlength="10" required>
                      <span id="dossizespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="dossizep" class="help-block with-errors"></p>
                    </div>
                    
                    <div class="col-sm-2">
                      <select class = "form-control" id="dosuom" name="dosuom" required>
                        <option disabled selected value> -- SELECT UOM -- </option>
                        <?php
                          $result = DB::select('SELECT strUOMName,strUOMCode FROM tblUOM WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strUOMCode.'">'.$data->strUOMName.'</option>';
                          }
                        ?>
                      </select>
                    </div>

                    <div class="col-sm-1">
                      <label class="control-label"> <h5> / </h5> </label>
                    </div>

                    <div class="col-sm-2">
                      <input type="text" id="dospersize" class="form-control" name="dospersize" placeholder="0.00" maxlength="10" required>
                      <span id="dospersizespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="dospersizep" class="help-block with-errors"></p>
                    </div>
                    
                    <div class="col-sm-2">
                      <select class = "form-control" id="dosperuom" name="dosperuom" required>
                        <option disabled selected value> -- SELECT UOM -- </option>
                        <?php
                          $result = DB::select('SELECT strUOMName,strUOMCode FROM tblUOM WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strUOMCode.'">'.$data->strUOMName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"><!-- Packaging -->
                    <label class="control-label col-sm-3">Packaging:</label>
                    
                    <div class="col-sm-9">
                      <select class = "form-control"id="pack" name="pack" required>
                        <option disabled selected value> -- SELECT PACKAGING -- </option>
                        <?php
                          $result = DB::select('SELECT strPMPackName,strPMPackCode FROM tblpmpackaging WHERE intStatus = 1');

                          foreach($result as $data){
                            echo '<option value="'.$data->strPMPackCode.'">'.$data->strPMPackName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"><!-- Description -->
                    <label class="control-label col-sm-3">Description:</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" placeholder="Description" id="desc" name="desc"></textarea>
                    </div>
                  </div>

                  <!-- INSERT PRODUCT DESCRIPTION HERE!!!!!!!!!!!!!! -->

                  <br><br>
                  
                  <div id="prpcdiv" class="form-group has-feedback"><!-- Price per piece -->
                    <label class="control-label col-sm-3" >Price per piece:</label>
                      
                    <div class="col-sm-9">
                        <input type="text" id="prpc" class="form-control" placeholder="0.00" name="prpc">
                        <span id="prpcspan" class="" aria-hidden="true"></span>
                        <p id="prpcp" class="help-block with-errors"></p>
                    </div>
                  </div>

                  <div id="prpckdiv" class="form-group has-feedback"><!-- Price per package -->
                    <label class="control-label col-sm-3">Price per Package:</label>
                    
                    <div class="col-sm-4">
                      <div class = "input-group">
                        <input type="text" id="prpck" placeholder="0.00" class="form-control" name="prpck"  required>
                        <span id="prpckspan" class="" aria-hidden="true"></span>                      
                      </div>
                    </div>

                    <label class="control-label col-sm-1">Per:</label>

                    <div class="col-sm-3">
                      <input type="number" placeholder="0" id="pcpck" class="form-control" name="pcpck">
                      <span id="pcpckspan" class="" aria-hidden="true"></span>
                      <p id="prpckp" class="help-block with-errors">
                      </p>
                    </div>

                    <label class="control-label col-sm-1">Pieces</label>
                  </div>

                  <div class="form-group"><!-- Form Buttons -->
                    <div class="col-md-offset-3 col-md-9">
                      <button id="btnsubmit" type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                      <!-- <button class="btn btn-info" type="button" onclick="window.open('localhost:8000','_blank');window.location.href='/';">Cancel</button> -->
                      <button class="btn btn-info" type="cancel" href="#mem_form" data-toggle="collapse" onclick="clearForm();">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- datatables -->
          <div class = "row">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"> MEDICINE LIST </h3>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
        							<thead>
        								<tr role="row">
        									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Code</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Type</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Class</th>

                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Brand</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Generic</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Manufacturer</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Form</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Size</th>

                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Dosage</th>

                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Packaging</th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;"><p>&#x20B1;/Pc</p></th>
        									
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;"><p>&#x20B1;/Pack</p></th>
        				
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Desc</th>

                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
        								</tr>
        							</thead>

        							<tbody>
      							    <!-- php script here-->
                        <?php
                          $counter = 0;

                          $results = DB::select("SELECT 
                                                  m.strProdMedCode,
                                                  m.intProdMedType,
                                                  t.strPMTheraClassName,
                                                  b.strPMBranName,
                                                  (
                                                    SELECT group_concat(g.strPMGenName SEPARATOR ' ') 
                                                      FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                                      WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode
                                                  ) as 'GenNames',
                                                  (
                                                    SELECT group_concat(g.strPMGenName SEPARATOR ';') 
                                                      FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                                      WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode
                                                  ) as 'GeneNames',
                                                  mn.strPMManuName,
                                                  f.strPMFormName,
                                                  m.decProdMedSize,
                                                  u.strUOMName,
                                                  m.decProdMedDosSize,
                                                  (
                                                    SELECT strUOMName FROM tblUOM WHERE strUOMCode = m.strProdMedDosUOMCode
                                                    ) as 'udUOM',
                                                  m.decProdMedDosPerSize,
                                                  (
                                                    SELECT strUOMName FROM tblUOM WHERE strUOMCode = m.strProdMedDosPerUOMCode
                                                    ) as 'udpUOM',
                                                  pk.strPMPackName,
                                                  pr.decProdPricePerPiece,  
                                                  pr.intQtyPerPackage,
                                                  pr.decPricePerPackage,
                                                  m.strProdMedDesc,

                                                  m.strProdMedTheraCode,
                                                  m.strProdMedBranCode,
                                                  m.strProdMedManuCode,
                                                  m.strProdMedFormCode,
                                                  m.strProdMedUOMCode,
                                                  m.strProdMedPackCode,
                                                  m.strProdMedDosUOMCode,
                                                  m.strProdMedDosPerUOMCode

                                                FROM tblProdMed m
                                                LEFT JOIN tblPMTheraClass t
                                                  ON m.strProdMedTheraCode = t.strPMTheraClassCode
                                                LEFT JOIN tblprodmedbranded b
                                                  ON m.strProdMedBranCode = b.strPMBranCode
                                                LEFT JOIN tblpmmanufacturer mn
                                                  ON m.strProdMedManuCode = mn.strPMManuCode
                                                LEFT JOIN tblpmform f
                                                  ON m.strProdMedFormCode = f.strPMFormCode
                                                LEFT JOIN tbluom u 
                                                  ON m.strProdMedUOMCode = u.strUOMCode
                                                LEFT JOIN tblpmpackaging pk
                                                  ON m.strProdMedPackCode = pk.strPMPackCode
                                                LEFT JOIN tblProdPrice pr
                                                  ON m.strProdMedCode = pr.strProdPriceCode
                                                LEFT JOIN tblproducts p
                                                  ON m.strProdMedCode = p.strProdCode
                                                WHERE p.intStatus = 1;");

                          foreach($results as $data){
                            if($counter%2 == 0){
                                $trClass="even";
                            }else{
                                $trClass="odd";
                            }

                            $counter++;

                            $conv_desc = str_replace("'", "&", $data->strProdMedDesc);

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td class="sorting_1">'.$data->strProdMedCode.'</td>';
                            if($data->intProdMedType == 0){
                              echo '<td>BRN</td>';
                            }else{
                              echo '<td>GEN</td>';
                            }
                            echo '<td>'.$data->strPMTheraClassName.'</td>';
                            echo '<td>'.$data->strPMBranName.'</td>';
                            echo '<td>'.$data->GenNames.'</td>';
                            echo '<td>'.$data->strPMManuName.'</td>';
                            echo '<td>'.$data->strPMFormName.'</td>';
                            echo '<td>'.$data->decProdMedSize.' '.$data->strUOMName.'</td>';
                            echo '<td>'.$data->decProdMedDosSize.' '.$data->udUOM.'/'.$data->decProdMedDosPerSize.' '.$data->udpUOM.'</td>';
                            echo '<td>'.$data->strPMPackName.'</td>';
                            echo '<td>'.$data->decProdPricePerPiece.'</td>';
                            echo '<td>'.$data->decPricePerPackage.'</td>';
                            echo '<td>'.$data->strProdMedDesc.'</td>';
                            echo '
                                  <td align="center">
                                    <table>
                                      <tr>
                                          <button type="button" class="btn btn-success btn-block" href="#mem_form" data-toggle="collapse" onClick="setFormData(\''.$data->strProdMedCode.'\',
                                                                                                                                                               \''.$data->intProdMedType.'\',
                                                                                                                                                               \''.$data->strProdMedBranCode.'\',
                                                                                                                                                               \''.$data->GeneNames.'\',
                                                                                                                                                               \''.$data->strProdMedTheraCode.'\',
                                                                                                                                                               \''.$data->strProdMedManuCode.'\',
                                                                                                                                                               \''.$data->strProdMedFormCode.'\',
                                                                                                                                                               \''.$data->decProdMedSize.'\',
                                                                                                                                                               \''.$data->strProdMedUOMCode.'\',
                                                                                                                                                               \''.$data->decProdMedDosSize.'\',
                                                                                                                                                               \''.$data->strProdMedDosUOMCode.'\',
                                                                                                                                                               \''.$data->decProdMedDosPerSize.'\',
                                                                                                                                                               \''.$data->strProdMedDosPerUOMCode.'\',
                                                                                                                                                               \''.$data->strProdMedPackCode.'\',
                                                                                                                                                               \''.$conv_desc.'\',
                                                                                                                                                               \''.$data->decProdPricePerPiece.'\',
                                                                                                                                                               \''.$data->decPricePerPackage.'\',
                                                                                                                                                               \''.$data->intQtyPerPackage.'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                      </tr>
                                      
                                      <tr>
                                          <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.$data->strProdMedCode.'\',
                                                                                                                                                               \''.$data->strPMBranName.'\',
                                                                                                                                                               \''.$data->GenNames.'\')"><span class="glyphicon glyphicon-remove"></span></button>
                                      </tr>
                                    </table>
                                  </td>
                            ';
                            echo '</tr>';
                          }
                        ?>
        							</tbody>
      		          </table>

    		            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          
                          <form method="post" action="{{URL::to('/maintenance/products/med/proddet/delete-product')}}">
                              <div class="modal-body">
                                <p id = "del_msg"> hehe </p>
                                <input type="hidden" id="del_prodid" name="del_prodid">
                              </div>
                              
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="prompt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="myModalLabel" style="text-align:center;color:#DA4453">!</h2>
                          </div>
                          <div class="modal-body">
                              <p> <h4 style="text-align:center">{{Session::get('message')}} </h4> </p><br><br>
                          </div>
                        </div>
                      </div>
                    </div>
      		        </div>
                </div>
              </div>
  					</div>
  				</div>
			 </div>
      </div>
    </div>
  </div>
@stop

@section('internal-scripts')
  <script>//message
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//functions
    function addGenericName(){
      var sel = document.getElementById('genname');
      var txt = document.getElementById('gennames');
      var hid = document.getElementById('hidden_gen');

      txt.value = txt.value + " " + sel.options[sel.selectedIndex].text;

      if(hid.value == ""){
        hid.value = sel.options[sel.selectedIndex].text;
      }else{
        hid.value = hid.value + ";" + sel.options[sel.selectedIndex].text;
      }
    }

    function isGenericNameExisting(){
      var sel = document.getElementById('genname');
      var txt = document.getElementById('gennames');

      if(txt.value.indexOf(sel.options[sel.selectedIndex].text) == -1){
        addGenericName();
      }else{
        alert('GENERIC NAME ALREADY EXISTING');
      }
    }

    function setSelGenericNames(){
      var opt = "";
      var selgen = document.getElementById('hidden_gen').value.split(";");

      if(selgen[0] != "" || selgen.length > 1){
        for(var i = 0; i < selgen.length; i++){
          opt = opt + "<option>" + selgen[i] + "</option>";
        }

        document.getElementById('sel_genname').innerHTML = opt;
        $('#remove_generic').modal('show');
      }else{
        alert('NO GENERIC NAME ADDED');
      }
    }

    function removeGenericName(){
      var remgen = document.getElementById('sel_genname');
      var txt = document.getElementById('gennames');
      var hid = document.getElementById('hidden_gen');

      if(remgen.options[remgen.selectedIndex].text.length == txt.value.length){
        txt.value = "";
      }else{
        if(txt.value.indexOf(remgen.options[remgen.selectedIndex].text) == 0){
          txt.value = txt.value.replace(remgen.options[remgen.selectedIndex].text + " ","");
        }else{
          txt.value = txt.value.replace(" " + remgen.options[remgen.selectedIndex].text,"");
        }
      }

      if(remgen.options[remgen.selectedIndex].text.length == hid.value.length){
        hid.value = "";
      }else{
        if(hid.value.indexOf(remgen.options[remgen.selectedIndex].text) == 0){
          hid.value = hid.value.replace(remgen.options[remgen.selectedIndex].text + ";","");
        }else{
          hid.value = hid.value.replace(";" + remgen.options[remgen.selectedIndex].text,"");
        }
      }
    }

    function setFormData(code,type,bname,gname,tclass,manuf,form,size,uom,dossize,dosuom,dospsize,dospuom,pack,desc,prpc,prpck,pcpck){
      var gennames = gname.split(";");
      document.getElementById('hidden_gen').value = gname;
      for(var i=0; i < gennames.length; i++){
        document.getElementById('gennames').value = document.getElementById('gennames').value + " " + gennames[i];
      }
      document.getElementById('prodcode').value = code;
      document.getElementById('medtype').value = type;
      document.getElementById('brand').value = bname;
      document.getElementById('thera').value = tclass;
      document.getElementById('manu').value = manuf;
      document.getElementById('form').value = form;
      document.getElementById('size').value = size;
      document.getElementById('uom').value = uom;
      document.getElementById('dossize').value = dossize;
      document.getElementById('dosuom').value = dosuom;
      document.getElementById('dospersize').value = dospsize;
      document.getElementById('dosperuom').value = dospuom;
      document.getElementById('pack').value = pack;
      document.getElementById('desc').value = desc.replace("&","'");
      document.getElementById('prpc').value = prpc;
      document.getElementById('prpck').value = prpck;
      document.getElementById('pcpck').value = pcpck;
      hsBranded();
      document.getElementById('medform').action = "{{URL::to('/maintenance/products/med/proddet/update-product')}}";
    }

    function clearForm(){
      document.getElementById('medform').reset();
      document.getElementById('medform').action = "{{URL::to('/maintenance/products/med/proddet/add-product')}}";
    }

    function delMessage(id, brand, gen){
      document.getElementById('del_prodid').value = id;
      document.getElementById('del_msg').innerHTML = "Delete " + "(" + brand + ") " + " " + gen;
    }
  </script>

  <script>//validations
    $(document).ready(function() {
      $("#size").blur(function(){
        if(document.getElementById('size').value.length > 0 && (parseFloat(document.getElementById('size').value).toFixed(2) > 0)){
          document.getElementById('size').value = parseFloat(document.getElementById('size').value).toFixed(2);
          
          setInvMessage(1,document.getElementById('sizediv'),document.getElementById('sizespan'),document.getElementById('sizep'),"Invalid size");
        }else{
          setInvMessage(0,document.getElementById('sizediv'),document.getElementById('sizespan'),document.getElementById('sizep'),"Invalid size");
        }
      });

      $("#prpc").blur(function(){
        if(document.getElementById('prpc').value.length > 0 && (parseFloat(document.getElementById('prpc').value).toFixed(2) > 0)){
          document.getElementById('prpc').value = parseFloat(document.getElementById('prpc').value).toFixed(2);
          
          setInvMessage(1,document.getElementById('prpcdiv'),document.getElementById('prpcspan'),document.getElementById('prpcp'),"Invalid price");
        }else{
          setInvMessage(0,document.getElementById('prpcdiv'),document.getElementById('prpcspan'),document.getElementById('prpcp'),"Invalid price");
        }
      });

      $("#prpck").blur(function(){
        if(
            (document.getElementById('prpck').value.length > 0) && (parseFloat(document.getElementById('prpck').value).toFixed(2) >= 0)
          ){
          document.getElementById('prpck').value = parseFloat(document.getElementById('prpck').value).toFixed(2);
          setInvMessage(1,document.getElementById('prpckdiv'),document.getElementById('prpckspan'),document.getElementById('prpckp'),"Invalid price or pieces per package");
        }else{
          setInvMessage(0,document.getElementById('prpckdiv'),document.getElementById('prpckspan'),document.getElementById('prpckp'),"Invalid price or pieces per package");
        }
      });

      $("#pcpck").blur(function(){
        if(
            (document.getElementById('pcpck').value.length > 0) && (parseFloat(document.getElementById('pcpck').value).toFixed(0) >= 0)
          ){
          document.getElementById('pcpck').value = parseFloat(document.getElementById('pcpck').value).toFixed(0);
          setInvMessage(1,document.getElementById('prpckdiv'),document.getElementById('pcpckspan'),document.getElementById('prpckp'),"Invalid price or pieces per package");
        }else{
          setInvMessage(0,document.getElementById('prpckdiv'),document.getElementById('pcpckspan'),document.getElementById('prpckp'),"Invalid price or pieces per package");
        }
      });

      $("#gennames").keydown(function(e){
        e.preventDefault();
      });
      //check if other is still invalid, if invalid do not enable button
    });


    function setInvMessage(mode,divid,spanid,pid,message){
      if(mode == 0){
        divid.className = "form-group has-feedback has-error";
        spanid.className = "glyphicon form-control-feedback glyphicon-remove";
        pid.innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453"> ' + message + ' </li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        divid.className = "form-group has-feedback";
        spanid.className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        pid.innerHTML = '';
      }
    }
  </script>

@stop