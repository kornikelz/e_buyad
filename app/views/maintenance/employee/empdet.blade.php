@extends('......layout')

@section('page-title')
    Maintenance - Job Descriptions
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

    </style>
@stop

@section('content')
        <div class="panel-body">
                <div class="content-row">
                    <center><h5 class="content-row-title" style="font-size:25px">Company Maintenance<hr></h5></center>
                    
                  <div class="btn-group btn-group-justified">
                            <a href="{{URL::to('/maintenance/employee/branchdet')}}" class="btn btn-primary">Branch Details</a>
                            <a href="{{URL::to('/maintenance/employee/jobdet')}}" class="btn btn-primary">Job Description</a>
                            <a href="{{URL::to('/maintenance/employee/empdet')}}" class="btn btn-info">Employee Details</a>
                  </div>
                                            <br> <br><br>

                    <div class="panel panel-default">
                    <div class = "row">
                        <div class = "col-md-3">
                            <button onclick="clearForm()" type="button" class="btn btn-primary btn-block" href="#empform" data-toggle="collapse">ADD EMPLOYEE</button>
                        </div>
                    </div>
                    <!-- forms -->
                    <div class ="row">
                      <div class="col-md-2">
                      </div>
                      <div class="col-md-8">
                          <div id="empform" class="collapse">
                            <form id = "emp_form" role="form" class="form-horizontal" data-toggle="validator" method="post" action="{{URL::to('/maintenance/employee/empdet/add-employee')}}">
                              <input type="hidden" name="code" id="code">
                              <div class="form-group has-feedback">
                                <label class = "col-md-2 control-label">First name</label>
                                <div class="col-md-10">
                                  <input type="text" placeholder="First Name" id="fname" class="form-control" name="fname" required>

                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                  <p class="help-block with-errors"></p>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class = "col-md-2 control-label">Middle Name</label>
                                <div class="col-md-10">
                                  <input type="text" placeholder="Middle Name" id="mname" class="form-control" name="mname">
                                </div>
                              </div>
                              <div class="form-group has-feedback">
                                <label class = "col-md-2 control-label">Last Name</label>
                                <div class="col-md-10">
                                  <input type="text" placeholder="Last Name" id="lname" class="form-control" name="lname">
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                  <p class="help-block with-errors"></p>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class = "col-md-2 control-label">Address</label>
                                <div class="col-md-10">
                                  <input id = "address" type="text" placeholder="House/Lot No, Street Name, Building Name, Brgy No, Subdivision Name, City" class="form-control" name="address">
                                </div>
                              </div>
                              <div class="form-group has-feedback">
                                <label class = "col-md-2 control-label">Contact Number</label>
                                <div class="col-md-10">
                                  <div class = "input-group">
                                    <span class="input-group-addon">+63</span><input type="text" maxlength="10" pattern="\b[^0-8]\d{9}\b" placeholder="(###) ###-####" id="contnum" class="form-control" name="contnum">
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                    <p class="help-block with-errors"></p>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                  <button type="submit" class="btn btn-info">Submit</button>
                                  <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
                                </div>
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
                                                <h3 class="panel-title"> EMPLOYEE LIST </h3>
                                              </div>
                                              <div class="panel-body">
                                                <div class="table-responsive">
                                      					<table id="example" class="table table-bordered table-hover">
                                      							<thead>
                                      								<tr role="row">
                                      									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Employee Code</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">First Name</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Middle Name</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Middle Name: activate to sort column ascending" style="width: 187px;">Last Name</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Address</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Contact Number</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Option</th>

                                      								</tr>
                                      								</tr>
                                      							</thead>
                                      							<tbody>
                                      							    <?php
                                      							        $counter = 0;

                                      							        $results = DB::select("SELECT e.strEmpCode, e.strEmpFName, e.strEmpMName, e.strEmpLName, e.strEmpAddress, e.strEmpContNum
                                                                                                  FROM tblEmployee e
                                                                                                  WHERE e.intStatus;");

                                                                        foreach($results as $data){
                                                                            if($counter%2 == 0){
                                                                                $trClass="even";
                                                                            }else{
                                                                                $trClass="odd";
                                                                            }
                                                                            $counter++;

                                                                            echo '<tr role="row" class="'.$trClass.'">';
                                                                                echo '<td class="sorting_1">'.$data->strEmpCode.'</td>';
                                                                            echo '<td>'.$data->strEmpFName.'</td>';
                                                                            echo '<td>'.$data->strEmpMName.'</td>';
                                                                            echo '<td>'.$data->strEmpLName.'</td>';
                                                                            echo '<td>'.$data->strEmpAddress.'</td>';
                                                                            echo '<td>'.$data->strEmpContNum.'</td>';
                                                                            echo '

                                                                                <td align="center">
                                                                                  <table>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-success btn-block" href="#empform" data-toggle="collapse" onClick="setFormData(\''.
                                                                                                                                                                                                                $data->strEmpCode.'\',\''.
                                                                                                                                                                                                                $data->strEmpFName.'\',\''.
                                                                                                                                                                                                                $data->strEmpMName.'\',\''.
                                                                                                                                                                                                                $data->strEmpLName.'\',\''.
                                                                                                                                                                                                                $data->strEmpAddress.'\',\''.
                                                                                                                                                                                                                $data->strEmpContNum.'\',\''
                                                                                                                                                                                                                .'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                                                                    $data->strEmpCode.'\',\''.
                                                                                                                                                                                                                    $data->strEmpFName.'\',\''.
                                                                                                                                                                                                                    $data->strEmpMName.'\',\''.
                                                                                                                                                                                                                    $data->strEmpLName
                                                                                                                                                                                                                .'\')"><span class="glyphicon glyphicon-remove"></span></button>
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
                                                              <form method="post" action="{{URL::to('/maintenance/employee/empdet/delete-employee')}}">
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
    function setUserLevel(){
        document.getElementById('level').value = document.getElementById("ulevel").value;
    }
</script>
<script>
    function setFormData($code, $fname, $mname, $lname, $address, $contnum){
        document.getElementById('code').value = $code;
        document.getElementById('fname').value = $fname;
        document.getElementById('mname').value = $mname;
        document.getElementById('lname').value = $lname;
        document.getElementById('address').value = $address;
        document.getElementById('contnum').value = $contnum;
        document.getElementById('emp_form').action = "{{URL::to('/maintenance/employee/empdet/update-employee')}}";
    }
</script>
<script>
	    function clearForm(){
	        document.getElementById('emp_form').reset();
	        document.getElementById('emp_form').action = '{{URL::to('/maintenance/employee/empdet/add-employee')}}';
	    }
</script>
<script>
    function delMessage($code,$fname,$mname,$lname){
        document.getElementById('del_msg').innerHTML = "Delete " + $fname + " " + $mname + " " + $lname + "?";
        document.getElementById('del_id').value = $code;
    }
</script>
@stop

