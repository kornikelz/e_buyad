@extends('......layout')

@section('page-title')
    Maintenance - Employee
@stop

@section('other-scripts')
    {{HTML::script('bootflat-admin/js/datatables.min.js')}}
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<script>
        function validateNumbers(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if ((charCode >= 48 && charCode <= 57) || charCode == 45 || charCode == 43) {
            return true;
          }else{
            return false;
          }
        }
     </script>
@stop

@section('content')
        <div class="panel-body">
                <div class="content-row">
                    <center><h5 class="content-row-title" style="font-size:25px">Employee Maintenance<hr></h5></center>
                    
                    <div class="btn-group btn-group-justified">
                        <a href="{{URL::to('/maintenance/employee/branchdet')}}" class="btn btn-info">Branch Details</a>
                        <a href="{{URL::to('/maintenance/employee/jobdet')}}" class="btn btn-primary">Job Description</a>
                        <a href="{{URL::to('/maintenance/employee/empdet')}}" class="btn btn-primary">Employee Details</a>
                    </div>

                    <br><br><br>

                    <div class="panel panel-default">
                    <div class = "row">
                        <div class = "col-md-3">
                            <button type="button" class="btn btn-primary btn-block" href="#branch_form" data-toggle="collapse" onclick="clearForm()">ADD BRANCH</button>
                        </div>
                    </div>

                    <!-- forms -->

                    <div class ="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div id="branch_form" class="collapse">
                                <form id = "braform" role="form" class="form-horizontal" data-toggle="validator" method="post" action="{{URL::to('/maintenance/employee/branchdet/add-branch')}}">
                                    <input type="hidden" name="code" id="code">
                                    <div class="form-group has-feedback">
                                        <label class = "col-md-2 control-label">Branch Name</label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="Branch Name" id="name" class="form-control" name="name" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <p class="help-block with-errors"></p>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class = "col-md-2 control-label">Branch Address</label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="House/Lot No, Street Name, Building Name, Brgy No, Subdivision Name, City" id="address" class="form-control" name="address" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <p class="help-block with-errors"></p>
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <label class = "col-md-4 control-label"><h5> Contact Details </h5></label>
                                    </div>
                                    <div class="form-group  has-feedback">
                                        <label class = "col-md-2 control-label">Telephone Number</label>
                                        <div class="col-md-10">
                                            <input type="text"  placeholder="###-##-##" id="telnum" class="form-control" name="telnum"   pattern="\d{7}" onkeypress="return validateNumbers(event)" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                                        <p class="help-block with-errors"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class = "col-md-2 control-label">Fax Number</label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="Fax Number" id="faxnum" class="form-control" name="faxnum" onkeypress="return validateNumbers(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                         </div>
                    </div>

                    <div class = "row">
                                          <div class="col-md-12">
                                            <div class="panel panel-info">
                                              <div class="panel-heading">
                                                <h3 class="panel-title"> BRANCHES LIST </h3>
                                              </div>
                                              <div class="panel-body">
                                                <div class="table-responsive">
                                      					<table id="example" class="table table-bordered table-hover">
                                      							<thead>
                                      								<tr role="row">
                                      									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Branch Code</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Branch Name</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Branch Address</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Middle Name: activate to sort column ascending" style="width: 187px;">Telephone Number</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending" style="width: 147px;">Fax Number</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
                                      								</tr>
                                      								</tr>
                                      							</thead>
                                      							<tbody>
                                      							    <?php
                                      							        $counter = 0;

                                      							        $resultBranches = DB::select("SELECT strBranchCode, strBranchName, strBranchAddress, strBranchContNum, strBranchFaxNum FROM tblBranches WHERE intStatus = 1");

                                                                        foreach($resultBranches as $data){
                                                                            if($counter%2 == 0){
                                                                                $trClass="even";
                                                                            }else{
                                                                                $trClass="odd";
                                                                            }
                                                                            $counter++;

                                                                            echo '<tr role="row" class="'.$trClass.'">';
                                                                            echo '<td class="sorting_1">'.$data->strBranchCode.'</td>';
                                                                            echo '<td>'.$data->strBranchName.'</td>';
                                                                            echo '<td>'.$data->strBranchAddress.'</td>';
                                                                            echo '<td>'.$data->strBranchContNum.'</td>';
                                                                            echo '<td>'.$data->strBranchFaxNum.'</td>';
                                                                            echo '
                                                                                <td align="center">
                                                                                  <table>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-success btn-block" href="#branch_form" data-toggle="collapse" onClick="setFormData(\''.$data->strBranchCode.'\',\''
                                                                                                                                                                                                              .$data->strBranchName.'\',\''
                                                                                                                                                                                                              .$data->strBranchAddress.'\',\''
                                                                                                                                                                                                              .$data->strBranchContNum.'\',\''
                                                                                                                                                                                                              .$data->strBranchFaxNum.'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.$data->strBranchCode.'\',\''.$data->strBranchName.'\')"><span class="glyphicon glyphicon-remove"></span></button>
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
                                                              <form method="post" action="{{URL::to('/maintenance/employee/branchdet/delete-branch')}}">
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
@stop

@section('internal-scripts')
	  <script>
	    function setFormData($code, $name, $address, $telnum, $faxnum){
	        document.getElementById('code').value = $code;
	        document.getElementById('name').value = $name;
	        document.getElementById('address').value = $address;
	        document.getElementById('telnum').value = $telnum;
	        document.getElementById('faxnum').value = $faxnum;
	        document.getElementById('braform').action = '{{URL::to('/maintenance/employee/branchdet/update-branch')}}';
	    }
	  </script>
	  <script>
	    function clearForm(){
	        document.getElementById('braform').reset();
	        document.getElementById('braform').action = '{{URL::to('/maintenance/employee/branchdet/add-branch')}}';
	    }
	  </script>
	  <script>
	    function delMessage($code, $name){
	        document.getElementById('del_msg').innerHTML = "Delete " + $name + "?";
	        document.getElementById('del_id').value = $code;
	    }
	  </script>
@stop

