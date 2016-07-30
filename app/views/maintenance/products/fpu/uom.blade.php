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
                  <center><h5 class="content-row-title" style="font-size:25px">Unit of Measurement Maintenance<hr></h5></center>

                  <div class="btn-group btn-group-justified">
                    <a href="form" class="btn btn-primary">Forms</a>
                    <a href="packaging" class="btn btn-primary">Packaging</a>
                    <a href="#" class="btn btn-info">Unit of Measurement</a>
                  </div>
                        <br> <br><br>
                  <div class="panel panel-default">
                    <div class = "row">
                      <div class = "col-md-3">
                        <button type="button" class="btn btn-primary btn-block" href="#uom_form" data-toggle="collapse" onclick="clearForm()">ADD UOM</button>
                      </div>
                    </div>
                    <!-- forms -->
                    <div class ="row">
                      <div class="col-md-2">
                      </div>
                      <div class="col-md-8">
                          <div id="uom_form" class="collapse">

                            <form class="form-horizontal" role="form" id="uomform" method="post">
                            <input type="hidden" name="code" id="code">
                              <div id="namediv" class="form-group">
                                <label class = "col-md-2 control-label">UOM Name:</label>
                                <div class="col-md-10">
                                  <input type="text" placeholder="UOM Name" id="name" class="form-control" name="name">
                                  <span id="namespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                  <p id="namep" class="help-block with-errors"></p>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Description:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Description" id="desc" name="desc"></textarea>
                                </div>
                              </div>


                                <br><br><br>
                              <div class="form-group">
                                <div class="col-md-offset-3 col-md-10">
                                  <button id="btnsubmit" type="submit" class="btn btn-info">Submit</button>

                                  <button class="btn btn-info" type="cancel" href="#uom_form" data-toggle="collapse" onclick="clearForm()">Cancel</button>
                              </div>
                            </div>
                            </form>
                          </div>
                      </div>
                    </div>
					          <!-- datatables -->
                    <div class = "row">
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-12" style="overflow-x: auto;">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title"> Unit of Measurement Details </h3>
                          </div>
                          <div class="panel-body">
                  					<table id="example" class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                  							<thead>

                                  <tr role="row">
                  									<th>UOM Code</th>
                  									<th>UOM Name</th>
                  									<th>Description</th>
                  									<th>Option</th>
                  								</tr>
                  							</thead>
                  							<tbody>
                  							    <!-- php script here-->
                                                                    <?php
                                      							        $counter = 0;

                                      							        $results = DB::select("SELECT * FROM tbluom WHERE intStatus = 1;");

                                                                        foreach($results as $data){
                                                                            if($counter%2 == 0){
                                                                                $trClass="even";
                                                                            }else{
                                                                                $trClass="odd";
                                                                            }
                                                                            $counter++;

                                                                            echo '<tr role="row" class="'.$trClass.'">';
                                                                            echo '<td class="sorting_1">'.$data->strUOMCode.'</td>';
                                                                            echo '<td>'.$data->strUOMName.'</td>';
                                                                            echo '<td>'.$data->strUOMDesc.'</td>';
                                                                            echo '

                                                                                <td align="center">
                                                                                  <table>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-success btn-block" href="#uom_form" data-toggle="collapse" onClick="setFormData(\''.
                                                                                                                                                                                                                $data->strUOMCode.'\',\''.
                                                                                                                                                                                                                $data->strUOMName.'\',\''.
                                                                                                                                                                                                                $data->strUOMDesc
                                                                                                                                                                                                                .'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                                                                $data->strUOMCode.'\',\''.
                                                                                                                                                                                                                $data->strUOMName
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
                                                                      <form method="post" action="{{URL::to('maintenance/fpu/uom/delete-uom')}}">
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


@stop

@section('internal-scripts')
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//validations
    $("#name").blur(function(){
      if(!isFormNameValid(document.getElementById('name').value)){
        document.getElementById('namediv').className = "form-group has-feedback has-error";
        document.getElementById('namespan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('namep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Unit of Measurement</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('namediv').className = "form-group has-feedback";
        document.getElementById('namespan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('namep').innerHTML = '';
      }
    });

    function isFormNameValid(name){
      var isValid = true;

      if(name.length <= 0){
        isValid = false;
      }

      if(!/^[a-zA-Z\-]*$/.test(name)){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(name.charAt(0))){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(name.charAt(name.length-1))){
        isValid = false;
      }

      if(
          (name.indexOf("--") >= 0)
        ){
        isValid = false;
      }

      return isValid;
    }
  </script>
  <script>//functions
    function setFormData($code, $name, $desc){
        document.getElementById('code').value = $code;
        document.getElementById('desc').value = $desc;
        document.getElementById('name').value = $name;
	    document.getElementById('uomform').action = '{{URL::to('maintenance/fpu/uom/update-uom')}}';
    }
    function delMessage($code,$name){
        document.getElementById('del_msg').innerHTML = "Delete " + $name + "?";
        document.getElementById('del_id').value = $code;
        document.getElementById('del_name').value = $name;
    }
	    function clearForm(){
	        document.getElementById('uomform').reset();
	        document.getElementById('uomform').action = '{{URL::to('maintenance/fpu/uom/add-uom')}}';
        document.getElementById('namediv').className = "form-group has-feedback";
        document.getElementById('namespan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('namep').innerHTML = '';
	    }
  </script>
@stop