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
                    <center><h5 class="content-row-title" style="font-size:25px">Employee Maintenance<hr></h5></center>
                    
                    <div class="btn-group btn-group-justified">
                    <a href="{{URL::to('/maintenance/employee/branchdet')}}" class="btn btn-primary">Branch Details</a>
                                                <a href="{{URL::to('/maintenance/employee/jobdet')}}" class="btn btn-info">Job Description</a>
                                                <a href="{{URL::to('/maintenance/employee/empdet')}}" class="btn btn-primary">Employee Details</a>
                                      </div>
                                            <br> <br><br>

                    <div class="panel panel-default">
                    <div class = "row">
                        <div class = "col-md-3">
                            <button onclick="clearForm()" type="button" class="btn btn-primary btn-block" href="#jobform" data-toggle="collapse">ADD JOB DESCRIPTION</button>
                        </div>
                    </div>
                    <!-- forms -->
                    <div class ="row">
                      <div class="col-md-2">
                      </div>
                      <div class="col-md-8">
                          <div id="jobform" class="collapse">
                            <form id = "job_form" role="form" class="form-horizontal" data-toggle="validator" method="post" action="{{URL::to('/maintenance/employee/jobdet/add-job')}}">
                              <input type="hidden" name="code" id="code">
                              <input type="hidden" name="level" id="level" value = "1">

                              <div class="form-group has-feedback">
                                <label class = "col-md-2 control-label">Job Name</label>
                                <div class="col-md-10">
                                  <input type="text" placeholder="Job Name" id="name" class="form-control" name="name" required="">
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                              <p class="help-block with-errors"></p>
                                </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <textarea id="description" name = "description" class="form-control" rows="3" placeholder="Description"></textarea>
                                    </div>
                                </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">User Level</label>
                                <div class="col-sm-3">
                                    <select class = "form-control" id = "ulevel" onchange="setUserLevel()">
                                        <option value = "1">1</option>
                                        <option value = "2">2</option>
                                        <option value = "3">3</option>
                                </select>
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
                                                <h3 class="panel-title"> JOB LIST </h3>
                                              </div>
                                              <div class="panel-body">
                                                <div class="table-responsive">
                                      					<table id="example" class="table table-bordered table-hover">
                                      							<thead>
                                      								<tr role="row">
                                      									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Job Code</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Job Name</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Job Description</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Middle Name: activate to sort column ascending" style="width: 187px;">User Level</th>
                                      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
                                      								</tr>
                                      								</tr>
                                      							</thead>
                                      							<tbody>
                                      							    <?php
                                      							        $counter = 0;

                                      							        $resultJobs = DB::select("SELECT strEJCode, strEJName, strEJDescription, intUserLevel FROM tblEmpJobDesc WHERE intStatus = 1");

                                                                        foreach($resultJobs as $data){
                                                                            if($counter%2 == 0){
                                                                                $trClass="even";
                                                                            }else{
                                                                                $trClass="odd";
                                                                            }
                                                                            $counter++;

                                                                            echo '<tr role="row" class="'.$trClass.'">';
                                                                            echo '<td class="sorting_1">'.$data->strEJCode.'</td>';
                                                                            echo '<td>'.$data->strEJName.'</td>';
                                                                            echo '<td>'.$data->strEJDescription.'</td>';
                                                                            echo '<td>'.$data->intUserLevel.'</td>';
                                                                            echo '
                                                                                <td align="center">
                                                                                  <table>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-success btn-block" href="#jobform" data-toggle="collapse" onClick="setFormData(\''.$data->strEJCode.'\',\''.$data->strEJName.'\',\''.$data->strEJDescription.'\',\''.$data->intUserLevel.'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.$data->strEJCode.'\',\''.$data->strEJName.'\')"><span class="glyphicon glyphicon-remove"></span></button>
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
                                                              <form method="post" action="{{URL::to('/maintenance/employee/jobdet/delete-job')}}">
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
    function setFormData($code, $name, $description, $level){
        document.getElementById('code').value = $code;
        document.getElementById('name').value = $name;
        document.getElementById('description').value = $description;
        document.getElementById('ulevel').value = $level;
        document.getElementById('level').value = $level;
        document.getElementById('job_form').action = "{{URL::to('/maintenance/employee/jobdet/update-job')}}";
    }
</script>
<script>
    function delMessage($code,$name){
        document.getElementById('del_msg').innerHTML = "Delete " + $name + "?";
        document.getElementById('del_id').value = $code;
    }
</script>
<script>
	    function clearForm(){
	        document.getElementById('job_form').reset();
	        document.getElementById('job_form').action = '{{URL::to('/maintenance/employee/jobdet/add-job')}}';
	    }
</script>
@stop

