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
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
    <center><h5 class="content-row-title" style="font-size:25px">Non-Medicine Products Maintenance<hr></h5></center>
      
      
      <div class="panel panel-default">
        <div class="btn-group btn-group-justified">
          <a href="#" class="btn btn-info">Product Category</a>
          
          <a href="{{URL::to('/maintenance/products/nonmed/details')}}" class="btn btn-primary">Product Details</a>
        </div>

        <br><br><br>

        <div class="panel panel-default">
          <div class = "row">
            <div class = "col-md-3">
              <button type="button" onclick="clearForm()" class="btn btn-primary btn-block" href="#cat_form" data-toggle="collapse">ADD PRODUCT CATEGORY</button>
            </div>
          </div>
          
          <!-- forms -->
          <div class ="row">
            <div class="col-md-offset-2 col-md-8">
              <div id="cat_form" class="collapse">
                <form role="form" class="form-horizontal" id = "catform" method="post" action="{{URL::to('maintenance/products/nonmed/category/update-category')}}">
                  <input type="hidden" name="code" id="code">
                  
                  <div id="namediv" class="form-group has-feedback"><!-- Category Name -->
                    <label class = "col-md-2 control-label">Category Name</label>
                     
                    <div class="col-md-10">
                      <input type="name" placeholder="Category Name" id="name" class="form-control" name="name" required="" maxlength="100">
                      <span id="namespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="namep" class="help-block with-errors"></p>
                    </div>
                  </div>

                  <div class="form-group"><!-- Description -->
                    <label class="control-label col-sm-2">Description:</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="Description" id = "desc" name = "desc"></textarea>
                    </div>
                  </div>

                  <div class="form-group"><!-- Form Buttons -->
                    <div class="col-md-offset-2 col-md-10">
                      <button id="btnsubmit" type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>

                      <button class="btn btn-info" type="cancel" onclick="clearForm()" href="#cat_form" data-toggle="collapse">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Datatable -->

          <div class = "row">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"> CATEGORY LIST </h3>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
                			<thead>
        								<tr role="row">
        									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Category Code</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Category Name</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Description</th>
        									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
        								</tr>
                      </thead>

                      <tbody>
                        <!-- php script here-->
                        <?php
    							        $counter = 0;

    							        $results = DB::select("SELECT strNMedCatCode, strNMedCatName, strNMedDesc FROM tblnmedcategory WHERE intStatus = 1;");

                          foreach($results as $data){
                            if($counter%2 == 0){
                                $trClass="even";
                            }else{
                                $trClass="odd";
                            }

                            $counter++;

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td class="sorting_1">'.$data->strNMedCatCode.'</td>';
                            echo '<td>'.$data->strNMedCatName.'</td>';
                            echo '<td>'.$data->strNMedDesc.'</td>';
                            echo '
                                  <td align="center">
                                    <table>
                                      <tr>
                                          <button type="button" class="btn btn-success btn-block" href="#cat_form" data-toggle="collapse" onClick="setFormData(\''.
                                                                                                                                                                  $data->strNMedCatCode.'\',\''.
                                                                                                                                                                  $data->strNMedCatName.'\',\''.
                                                                                                                                                                  $data->strNMedDesc
                                                                                                                                                                  .'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                      </tr>
                                      <tr>
                                          <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                  $data->strNMedCatCode.'\',\''.
                                                                                                                                                                  $data->strNMedCatName
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

                          <form method="post" action="{{URL::to('maintenance/products/nonmed/category/delete-category')}}">
                            <div class="modal-body">
                              <p id = "del_msg"> hehe </p>
                              
                              <input type="hidden" id="del_id" name="del_id">
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                          </form>
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
  <script>//validations
    $("#name").blur(function(){
      if(!isCatNameValid(document.getElementById('name').value)){
        document.getElementById('namediv').className = "form-group has-feedback has-error";
        document.getElementById('namespan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('namep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Category Name</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('namediv').className = "form-group has-feedback";
        document.getElementById('namespan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('namep').innerHTML = '';
      }
    });

    function isCatNameValid(name){
      var isValid = true;

      if(name.length <= 0){
        isValid = false;
      }

      if(!/^[a-zA-Z0\/ -&]*$/.test(name)){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(name.charAt(0))){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(name.charAt(name.length-1))){
        isValid = false;
      }

      if(
          (name.indexOf("  ") >= 0) ||
          (name.indexOf(" /") >= 0) ||
          (name.indexOf(" -") >= 0) ||
          (name.indexOf("--") >= 0) ||
          (name.indexOf("- ") >= 0) ||
          (name.indexOf("-/") >= 0) ||
          (name.indexOf("//") >= 0) ||
          (name.indexOf("/ ") >= 0) ||
          (name.indexOf("/-") >= 0) ||
          (name.indexOf("/-") >= 0) ||
          (name.indexOf("&&") >= 0) ||
          (name.indexOf("/&") >= 0) ||
          (name.indexOf("&/") >= 0) ||
          (name.indexOf("&-") >= 0) ||
          (name.indexOf("-&") >= 0)
        ){
        isValid = false;
      }

      return isValid;
    }
  </script>
  <script>//submit form message
    @if(Session::has('message'))
      alert('{{ Session::get('message') }}');
    @endif
  </script>
  <script>//functions
    function setFormData($code, $name, $desc){
      document.getElementById('code').value = $code;
      document.getElementById('desc').value = $desc;
      document.getElementById('name').value = $name;
	    document.getElementById('catform').action = '{{URL::to('/maintenance/products/nonmed/category/update-category')}}';
      document.getElementById('namediv').className = "form-group has-feedback";
      document.getElementById('namespan').className = "glyphicon form-control-feedback";
      document.getElementById('btnsubmit').className = "btn btn-info";
      document.getElementById('namep').innerHTML = '';
    }
    function delMessage($code,$name){
        document.getElementById('del_msg').innerHTML = "Delete " + $name + "?";
        document.getElementById('del_id').value = $code;
    }
    function clearForm(){
      document.getElementById('catform').reset();
      document.getElementById('catform').action = '{{URL::to('/maintenance/products/nonmed/category/add-category')}}';
      document.getElementById('namediv').className = "form-group has-feedback";
      document.getElementById('namespan').className = "glyphicon form-control-feedback";
      document.getElementById('btnsubmit').className = "btn btn-info";
      document.getElementById('namep').innerHTML = '';
    }
  </script>
@stop