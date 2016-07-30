@extends('......layout')

@section('page-title')
    Maintenance - Medical Supply
@stop

@section('other-scripts')
  {{HTML::script('bootflat-admin/js/datatables.min.js')}}
	
  <script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	
  <style type="text/css">
        textarea {
            width: 100%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }
        input[type=number]::-webkit-inner-spin-button,
         input[type=number]::-webkit-outer-spin-button {
           -webkit-appearance: none;
           margin: 0;
         }
  </style>
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
      <center><h5 class="content-row-title" style="font-size:25px">Non-Medicine Products Maintenance<hr></h5></center>
      
      <div class="panel panel-default">
        <div class="btn-group btn-group-justified">
          <a href="{{URL::to('/maintenance/products/nonmed/category')}}" class="btn btn-primary">Product Category</a>
          
          <a href="#" class="btn btn-info">Product Details</a>
        </div>

        <br><br><br>

        <div class="panel panel-default">
          <div class = "row">
            <div class = "col-md-3">
              <button type="button" class="btn btn-primary btn-block" onclick="clearForm()" href="#det_form" data-toggle="collapse">ADD PRODUCT DETAIL</button>
            </div>
          </div>

          <!-- forms -->
          <div class ="row">
            <div class="col-md-offset-1 col-md-10">
              <div id="det_form" class="collapse">
                <form role="detform" id="detform" class="form-horizontal" method="post">
                  <input type="hidden" id="code" name="code">

                  <input type="hidden" id="origtype" name ="origtype">

                  <div id="namediv" class="form-group has-feedback"><!-- Product Name -->
                    <label class = "col-md-3 control-label">Product Name</label>

                    <div class="col-md-9">
                      <input type="text" placeholder="Product name" id="name" class="form-control" name="name" maxlength="100" required>
                      <span id="namespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="namep" class="help-block with-errors"></p>
                    </div>
                  </div>

                  <div class="form-group"><!-- Product Category -->
                    <label class = "col-md-3 control-label">Product Category</label>

                    <div class="col-md-9">
                      <select name = "category" id="category" class="form-control" required>
                        <option disabled selected value> -- SELECT CATEGORY -- </option>
                        <?php
                          $result = DB::select('SELECT strNMedCatCode, strNMedCatName FROM tblnmedcategory WHERE intStatus = 1');

                          foreach($result as $data){
                              echo '<option value=\''.$data->strNMedCatCode.'\'>'.$data->strNMedCatName.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"><!-- Measurement Type -->
                    <label class = "col-md-3 control-label">Measurement Type</label>

                    <div class="col-md-9">
                      <select onchange="showMeasurement()" id="meastype" class="form-control" name="meastype" required>
                        <option disabled selected value> -- SELECT MEASUREMENT TYPE -- </option>
                        
                        <option value="0">General</option>
                        
                        <option value="1">Standard</option>
                        
                        <option value="2">None</option>
                      </select>
                    </div>
                  </div>

                  <div id = "measstan" class = "collapse"><!-- Standard Meas -->
                    <div id="stansizediv" class="form-group has-feedback">
                      <label class = "col-md-3 control-label">Size</label>

                      <div class="col-md-9">
                        <input type="text" placeholder="0.00" id="stansize" class="form-control" maxlength="10" name="stansize">
                        <span id="stansizespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <p id="stansizep" class="help-block with-errors"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class = "col-md-3 control-label">Measurement</label>

                      <div class="col-md-9">
                        <select id="uom" name="uom" class="form-control">
                          <option disabled selected value> -- SELECT UNIT OF MEASUREMENT -- </option>
                          
                          <?php
                            $result = DB::select('SELECT strUOMCode, strUOMName FROM tblUOM WHERE intStatus = 1');

                            foreach($result as $data){
                              echo '<option value=\''.$data->strUOMCode.'\'>'.$data->strUOMName.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div id = "measgen" class = "collapse"><!-- General Meas -->
                    <div class="form-group">
                      <label class = "col-md-3 control-label">Size</label>
                      
                      <div class="col-md-9">
                        <select id="gensize" name="gensize" class="form-control">
                          <option disabled selected value> -- SELECT MEASUREMENT SIZE -- </option>

                          <?php
                            $result = DB::select('SELECT strGenSizeCode, strGenSizeName FROM tblgensize WHERE intStatus = 1');

                            foreach($result as $data){
                              echo '<option value="'.$data->strGenSizeCode.'">'.$data->strGenSizeName.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div id="pricediv" class="form-group has-feedback"><!-- Price -->
                    <label class="control-label col-md-3" >Price</label>

                    <div class="col-md-9">
                      <input type="text" placeholder="0.00" id="price" class="form-control" name="price" maxlength="10">
                      <span id="pricespan" class="" aria-hidden="true"></span>
                      <p id="pricep" class="help-block with-errors"></p>
                    </div>
                  </div>

                  <div class="form-group"><!-- Description -->
                    <label class="control-label col-sm-3">Description:</label>
                    
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" placeholder="Description" id = "desc" name = "desc"></textarea>
                    </div>
                  </div>

                  <div class="form-group"><!-- Form Buttons -->
                    <div class="col-md-offset-2 col-md-10">
                      <button type="submit" id="btnsubmit" class="btn btn-info">Submit</button>

                      <button class="btn btn-info" type="cancel" onclick="clearForm()" href="#det_form" data-toggle="collapse">Cancel</button>
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
                  <h3 class="panel-title"> MEDICAL SUPPLIES LIST </h3>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
        							<thead>
        								<tr role="row">
        									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Product Code</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Product Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Category</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Measurement Type</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Size</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Measurement</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Price</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Description</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Option</th>
        								</tr>
        							</thead>

                      <tbody>
                        <!-- php script here-->
                        <?php
    							        $counter = 0;

    							        $results = DB::select("SELECT
                                                    p.strProdCode,
                                                    nm.strProdNMedName,
                                                    nm.intProdNMedMeasType,
                                                    c.strNMedCatName,
                                                    c.strNMedCatCode,
                                                    g.strGenSizeName,
                                                    g.strGenSizeCode,
                                                    s.decNMStanSize,
                                                    u.strUOMName,
                                                    u.strUOMCode,
                                                    pr.decProdPricePerPiece,
                                                    nm.strProdNMedDesc

                                                 FROM
                                                 	  tblProducts p
                                                 LEFT JOIN tblprodnonmed nm
                                                 	  ON p.strProdCode = nm.strProdNMedCode
                                                 LEFT JOIN tblnmedcategory c
                                                 	  ON nm.strProdNMedCatCode = c.strNMedCatCode
                                                 LEFT JOIN tblnmedgeneral gt
                                                 	  ON nm.strProdNMedCode = gt.strNMGenCode
                                                 LEFT JOIN tblgensize g
                                                 	  ON gt.strNMGenSizeCode = g.strGenSizeCode
                                                 LEFT JOIN tblnmedstandard s
                                                 	  ON nm.strProdNMedCode = s.strNMStanCode
                                                 LEFT JOIN tbluom u
                                                 	  ON s.strNMStanUOMCode = u.strUOMCode
                                                 LEFT JOIN tblprodprice pr
                                                 	  ON nm.strProdNMedCode = pr.strProdPriceCode
                                                 WHERE
                                                 	  p.intStatus = 1 AND p.strProdType = 1;");

                          foreach($results as $data){
                            if($counter%2 == 0){
                              $trClass="even";
                            }else{
                              $trClass="odd";
                            }

                            $counter++;

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td class="sorting_1">'.$data->strProdCode.'</td>';
                            echo '<td>'.$data->strProdNMedName.'</td>';
                            echo '<td>'.$data->strNMedCatName.'</td>';

                            // if($data->intProdNMedMeasType == 0){
                            //     $type = 'General';
                            // }else if($data->intProdNMedMeasType == 1){
                            //     $type = 'Standard';
                            // }else{
                            //     $type = 'None';
                            // }

                            if($data->intProdNMedMeasType == 0){
                              echo '<td>GENERAL</td>';
                              echo '<td>'.$data->strGenSizeName.'</td>';
                              echo '<td>-</td>';
                            }else if($data->intProdNMedMeasType == 1){
                              echo '<td>STANDARD</td>';
                              echo '<td>'.$data->decNMStanSize.'</td>';
                              echo '<td>'.$data->strUOMName.'</td>';
                            }else{
                              echo '<td>NONE</td>';
                              echo '<td>-</td>';
                              echo '<td>-</td>';
                            }
                            
                            echo '<td>'.$data->decProdPricePerPiece.'</td>';
                            echo '<td>'.$data->strProdNMedDesc.'</td>';
                            
                            if(empty($data->decNMStanSize)){
                              $data->decNMStanSize = 0;
                            }

                            echo '<td align="center">
                                    <table>
                                      <tr>
                                        <button type="button" class="btn btn-success btn-block" href="#det_form" data-toggle="collapse" onClick="setFormData(\''.$data->strProdCode.'\',\''.
                                                                                                                                                                 str_replace('\'','@',$data->strProdNMedName).'\',\''.
                                                                                                                                                                 $data->strNMedCatCode.'\',\''.
                                                                                                                                                                 $data->intProdNMedMeasType.'\',\''.
                                                                                                                                                                 $data->strGenSizeCode.'\','.$data->decNMStanSize.',\''.
                                                                                                                                                                 $data->strUOMCode.'\',\''.
                                                                                                                                                                 $data->decProdPricePerPiece.'\',\''.
                                                                                                                                                                 $data->strProdNMedDesc.'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                      </tr>

                                      <tr>
                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                $data->strProdCode.'\',\''.
                                                                                                                                                                $data->strProdNMedName
                                                                                                                                                                .'\')"><span class="glyphicon glyphicon-remove"></span></button>
                                      </tr>
                                    </table>
                                  </td>';

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
                                          <form method = "post" action = "{{URL::to('/maintenance/products/nonmed/details/delete-details')}}">
                                              <div class="modal-body">
                                                <p id = "del_msg"> hehe </p>
                                                <input type="hidden" id="del_id" name="del_id">
                                                <input type="hidden" id="del_name" name="del_name">
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
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//validations
    $("#name").blur(function(){
      if(!isProdNameValid(document.getElementById('name').value)){
        document.getElementById('namediv').className = "form-group has-feedback has-error";
        document.getElementById('namespan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('namep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Product Name</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('namediv').className = "form-group has-feedback";
        document.getElementById('namespan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('namep').innerHTML = '';
      }
    });

    function isProdNameValid(name){
      var isValid = true;

      if(name.length <= 0){
        isValid = false;
      }

      if(!/^[a-zA-Z0-9 \-'&()\/.,#+%:]*$/.test(name)){
        isValid = false;
      }

      // if(!/^[a-zA-Z0-9]*$/.test(name.charAt(0))){
      //   isValid = false;
      // }

      // if(!/^[a-zA-Z0-9)]*$/.test(name.charAt(name.length-1))){
      //   isValid = false;
      // }

      // ----- validation here for allowed appearances of special characters -------
      // if(isValid){
      //   for(var i = 0; i < name.length-1; i++){
      //     if(
      //         !/^[a-zA-Z0-9]*$/.test(name.charAt(i)) &&
      //         !/^[a-zA-Z0-9]*$/.test(name.charAt(i+1)) &&
      //         (name.charAt(i) != " " || name.charAt(i+1) != " ") 
      //       ){
      //       isValid = false;
      //       break;
      //     }
      //   }
      // }

      return isValid;
    }

    $("#stansize").blur(function(){
      if(document.getElementById('stansize').hasAttribute('required')){
        if(isStanSizeValid(document.getElementById('stansize').value)){
          document.getElementById('stansize').value = parseFloat(document.getElementById('stansize').value).toFixed(2);  
          document.getElementById('stansizediv').className = "form-group has-feedback";
          document.getElementById('stansizespan').className = "glyphicon form-control-feedback";
          document.getElementById('btnsubmit').className = "btn btn-info";
          document.getElementById('stansizep').innerHTML = '';
        }else{
          document.getElementById('stansizediv').className = "form-group has-feedback has-error";
          document.getElementById('stansizespan').className = "glyphicon form-control-feedback glyphicon-remove";
          document.getElementById('stansizep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Size</li></ul>';
          document.getElementById('btnsubmit').className = "btn btn-info disabled";   
        }
      }
    });

    function isStanSizeValid(size){
      if(size.length > 0 && (parseFloat(size).toFixed(2) > 0)){
        return true;
      }else{
        return false;
      }
    }

    $("#price").blur(function(){
      if(isPriceValid(document.getElementById('price').value)){
          document.getElementById('price').value = parseFloat(document.getElementById('price').value).toFixed(2);  
          document.getElementById('pricediv').className = "form-group has-feedback";
          document.getElementById('pricespan').className = "glyphicon form-control-feedback";
          document.getElementById('pricep').innerHTML = '';
          document.getElementById('btnsubmit').className = "btn btn-info";
      }else{
        document.getElementById('pricediv').className = "form-group has-feedback has-error";
        document.getElementById('pricespan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('pricep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Price</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";   
      }
    });

    function isPriceValid(price){
      if(price.length > 0 && (parseFloat(price).toFixed(2) > 0)){
        return true;
      }else{
        return false;
      }
    }
  </script>
  <script>//functions
    function showMeasurement(){
        var type = document.getElementById('meastype').value;

        if(type == '1'){
            document.getElementById('measstan').className = 'collapse in';
            document.getElementById('measgen').className = 'collapse';
            document.getElementById('stansize').setAttribute('required','');
            document.getElementById('uom').setAttribute('required','');
            document.getElementById('gensize').removeAttribute('required');
            document.getElementById('gensize').value = null;
        }else if(type == '0'){
            document.getElementById('measgen').className = 'collapse in';
            document.getElementById('measstan').className = 'collapse';
            document.getElementById('stansize').removeAttribute('required');
            document.getElementById('uom').removeAttribute('required');
            document.getElementById('gensize').setAttribute('required','');

            document.getElementById('stansize').value = null;  
            document.getElementById('stansizediv').className = "form-group has-feedback";
            document.getElementById('stansizespan').className = "glyphicon form-control-feedback";
            document.getElementById('btnsubmit').className = "btn btn-info";
            document.getElementById('stansizep').innerHTML = '';
        }else{
            document.getElementById('measgen').className = 'collapse';
            document.getElementById('measstan').className = 'collapse';
            document.getElementById('stansize').removeAttribute('required');
            document.getElementById('uom').removeAttribute('required');
            document.getElementById('gensize').removeAttribute('required');

            document.getElementById('stansize').value = null;  
            document.getElementById('stansizediv').className = "form-group has-feedback";
            document.getElementById('stansizespan').className = "glyphicon form-control-feedback";
            document.getElementById('btnsubmit').className = "btn btn-info";
            document.getElementById('stansizep').innerHTML = '';
        }
    }

    function setFormData(code, name, category, meastype, gensize, stansize, uom, price, desc){
        document.getElementById('code').value = code;
        document.getElementById('name').value = name.replace("@","'");
        document.getElementById('category').value = category;
        document.getElementById('meastype').value = meastype;
        document.getElementById('origtype').value = meastype;
        document.getElementById('gensize').value = gensize;
        document.getElementById('stansize').value = stansize;
        document.getElementById('uom').value = uom;
        document.getElementById('price').value = price;
        document.getElementById('desc').value = desc;
        document.getElementById('detform').action = '{{URL::to('/maintenance/products/nonmed/details/update-details')}}';
        setMeasurement(meastype);
    }

    function setMeasurement(type){
        document.getElementById('meastype').value = type;

        if(type == '1'){
            document.getElementById('measstan').className = 'collapse in';
            document.getElementById('measgen').className = 'collapse';
        }else if(type == '0'){
            document.getElementById('measgen').className = 'collapse in';
            document.getElementById('measstan').className = 'collapse';
        }else{
            document.getElementById('measgen').className = 'collapse';
            document.getElementById('measstan').className = 'collapse';
        }
    }

    function delMessage(code,name){
        document.getElementById('del_msg').innerHTML = "Delete " + name + "?";
        document.getElementById('del_id').value = code;
        document.getElementById('del_name').value = name;
    }

    function clearForm(){
        document.getElementById('detform').reset();
          document.getElementById('detform').action = '{{URL::to('/maintenance/products/nonmed/details/add-details')}}';

          document.getElementById('measgen').className = 'collapse';
          document.getElementById('measstan').className = 'collapse';
          document.getElementById('stansize').removeAttribute('required');
          document.getElementById('uom').removeAttribute('required');
          document.getElementById('gensize').removeAttribute('required');
          document.getElementById('stansize').value = null;  
          document.getElementById('stansizediv').className = "form-group has-feedback";
          document.getElementById('stansizespan').className = "glyphicon form-control-feedback";
          document.getElementById('btnsubmit').className = "btn btn-info";
          document.getElementById('stansizep').innerHTML = '';
          document.getElementById('pricediv').className = "form-group has-feedback";
          document.getElementById('pricespan').className = "glyphicon form-control-feedback";
          document.getElementById('pricep').innerHTML = '';
    }
  </script>
@stop