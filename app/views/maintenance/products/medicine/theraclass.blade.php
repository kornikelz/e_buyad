@extends('......layout')

@section('page-title')
    Maintenance - Therapeutic Class
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
      <center><h5 class="content-row-title" style="font-size:25px">Medicine Maintenance<hr></h5></center>
      <div class="panel panel-default">
        <div class="btn-group btn-group-justified">
          <a href="#" class="btn btn-info">Therapeutic Class</a>
          
          <a href="{{URL::to('maintenance/products/med/gendet')}}" class="btn btn-primary">Generic Details</a>
          
          <a href="{{URL::to('maintenance/products/med/brandet')}}" class="btn btn-primary">Brand Details</a>
          
          <a href="{{URL::to('maintenance/products/med/manudet')}}" class="btn btn-primary">Manufacturer Details</a>
          
          <a href="{{URL::to('maintenance/products/med/proddet')}}" class="btn btn-primary">Product Details</a>
        </div>

        <br><br><br>

        <div class="panel panel-default">
          <div class = "row">
            <div class = "col-md-3">
              <button type="button" class="btn btn-primary btn-block" onclick="clearForm()" href="#theraform" data-toggle="collapse">ADD THERAPEUTIC CLASS</button>
            </div>
          </div>

          <!-- forms -->
          <div class ="row">
            <div class="col-md-offset-2 col-md-8">
              <div id="theraform" class="collapse">
                <form id = "thera_form" role="form" class="form-horizontal" method="post" action="{{URL::to('/maintenance/products/med/theraclass/update-class')}}">
                  
                  <input type="hidden" name="code" id="code">
                  
                  <div id="theradiv" class="form-group has-feedback">
                    <label class = "col-md-2 control-label">Therepeutic Class</label>
                    
                    <div class="col-md-10">
                      <input type="text" placeholder="Therapeutic class" id="theraclass" class="form-control" name="theraclass" maxlength="100" required="">
                      <span id="theraspan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="therap" class="help-block with-errors"></p>
                      
                      <!--errors-->
                      <!--add "has-error" to div class-->
                      <!-- <span class="glyphicon form-control-feedback glyphicon-remove" aria-hidden="true"></span>
                      <p class="help-block with-errors"><ul class="list-unstyled"><li style="color:#DA4453">Invalid Therapeutic Class Name</li></ul></p> -->
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2">Description:</label>
                    
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="Description" name="theradesc" id="theradesc"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                      <button id="btnsubmit" type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                        
                      <button class="btn btn-info" type="cancel" onclick="clearForm()" href="#theraform" data-toggle="collapse">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!--datatable-->
          <div class = "row">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"> THERAPEUTIC CLASS LIST </h3>
                </div>
                
                <div class="panel-body">
                  <div class="table-responsive">
                		<table id="example" class="table table-bordered table-hover">
                			<thead>
                				<tr role="row">
                					<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Class Code</th>
                          
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Therapeutic Class Name</th>
                					
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Description</th>
                					
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
                				</tr>
                			</thead>
                			
                      <tbody>
                        <!-- php script here-->
                        <?php
    							        $counter = 0;

    							        $results = DB::select("SELECT strPMTheraClassCode, strPMTheraClassName, strPMTheraClassDesc FROM tblPMTheraClass WHERE intStatus = 1");

                          foreach($results as $data){
                            if($counter%2 == 0){
                                $trClass="even";
                            }else{
                                $trClass="odd";
                            }
                            $counter++;

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td class="sorting_1">'.$data->strPMTheraClassCode.'</td>';
                            echo '<td>'.$data->strPMTheraClassName.'</td>';
                            echo '<td>'.$data->strPMTheraClassDesc.'</td>';
                            echo '
                                  <td align="center">
                                    <table>
                                      <tr>
                                          <button type="button" class="btn btn-success btn-block" href="#theraform" data-toggle="collapse" onClick="setFormData(\''.
                                                                                                                                                                  $data->strPMTheraClassCode.'\',\''.
                                                                                                                                                                  $data->strPMTheraClassName.'\',\''.
                                                                                                                                                                  $data->strPMTheraClassDesc
                                                                                                                                                                  .'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                      </tr>
                                      <tr>
                                          <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                  $data->strPMTheraClassCode.'\',\''.
                                                                                                                                                                  $data->strPMTheraClassName
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
                          
                          <form method="post" action="{{URL::to('/maintenance/products/med/theraclass/delete-class')}}">
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
  <script>//validations
    $("#theraclass").blur(function(){
      if(!isTheraClassValid(document.getElementById('theraclass').value)){
        document.getElementById('theradiv').className = "form-group has-feedback has-error";
        document.getElementById('theraspan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('therap').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Therapeutic Class Name</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('theradiv').className = "form-group has-feedback";
        document.getElementById('theraspan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('therap').innerHTML = '';
      }
    });

    function isTheraClassValid(theraname){
      var isValid = true;

      if(theraname.length <= 0){
        isValid = false;
      }

      if(!/^[a-zA-Z0\/ -]*$/.test(theraname)){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(theraname.charAt(0))){
        isValid = false;
      }

      if(!/^[a-zA-Z]*$/.test(theraname.charAt(theraname.length-1))){
        isValid = false;
      }

      if(
          (theraname.indexOf("  ") >= 0) ||
          (theraname.indexOf(" /") >= 0) ||
          (theraname.indexOf(" -") >= 0) ||
          (theraname.indexOf("--") >= 0) ||
          (theraname.indexOf("- ") >= 0) ||
          (theraname.indexOf("-/") >= 0) ||
          (theraname.indexOf("//") >= 0) ||
          (theraname.indexOf("/ ") >= 0) ||
          (theraname.indexOf("/-") >= 0)
        ){
        isValid = false;
      }

      return isValid;
    }
  </script>
  <script>//message
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//functions
      function setFormData(code, clasz, desc){
        document.getElementById('code').value = code;
        document.getElementById('theraclass').value = clasz;
        document.getElementById('theradesc').value = desc;
  	    document.getElementById('thera_form').action = '{{URL::to('/maintenance/products/med/theraclass/update-class')}}';
      }
      function delMessage(code,clasz){
        document.getElementById('del_msg').innerHTML = "Delete " + clasz + "?";
        document.getElementById('del_name').value = clasz;
        document.getElementById('del_id').value = code;
      }
      function clearForm(){
        document.getElementById('thera_form').reset();
        document.getElementById('thera_form').action = '{{URL::to('/maintenance/products/med/theraclass/add-class')}}';
        document.getElementById('theradiv').className = "form-group has-feedback";
        document.getElementById('theraspan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('therap').innerHTML = '';
      }
  </script>
@stop