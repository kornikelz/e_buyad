@extends('....layout')

@section('page-title')
    Generate Card
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
    <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-credit-card"></i>&nbsp Generate E-Buyad Card
      <hr>
      </h5></center>
      
      <div class = "panel pane-default">
        <div id="memlist" class="collapse in">
          <div class = "row">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"> MEMBERS LIST </h3>
                </div>
                
                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Member ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Last Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">First Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Middle Name: activate to sort column ascending" style="width: 187px;">Middle Name</th>
                          <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $counter = 0;

                          $resultMembers = DB::select("SELECT strMemCode, strMemFName, strMemMName, strMemLName FROM tblMember WHERE intStatus = 1");

                          foreach($resultMembers as $data){
                              if($counter%2 == 0){
                                  $trClass="even";
                              }else{
                                  $trClass="odd";
                              }
                              $counter++;


                              $fname = str_replace("'", "&", $data->strMemFName);
                              $lname = str_replace("'", "&", $data->strMemLName);
                              $fullname = $lname.', '.$fname;


                              echo '<tr role="row" class="'.$trClass.'">';
                              echo '<td class="sorting_1">'.$data->strMemCode.'</td>';
                              echo '<td>'.$data->strMemLName.'</td>';
                              echo '<td>'.$data->strMemFName.'</td>';
                              echo '<td>'.$data->strMemMName.'</td>';
                              echo '
                                  <td align="center">
                                          <button type="button" class="btn btn-success btn-block" href="#mem_form"
                                          data-toggle="collapse" onClick="genCard(\''.$data->strMemCode.'\',\''.$fullname.'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                  </td>
                              ';
                              echo '</tr>';
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="memcard" class="collapse">
          <div class = "row">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"> GENERATING MEMBER CARD... </h3>
                </div>
                
                <div class="panel-body">
                  <center>
                  <img id="front" height="400" width="600"><br><br><br>

                  <img id="back" height="400" width="600"><br><br><br>
                  </center>

                  <div class="col-md-offset-8 col-md-4">
                    <div class="col-md-6">
                      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#setpin">SAVE</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="setpin" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form  class="form-horizontal" role="form" method="post" action="{{URL::to('/transaction/generate-card/set-basic-info')}}">
                  <div class="modal-body">
                    <div class="col-md-offset-2 col-md-8">
                      <input type="hidden" id="code" name="code">
                      <br><br>
                      <div class="form-group">
                        <label class="col-md-6 control-label">SET PINCODE:</label>
                        
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="pino" name="pino" onkeypress="return isNumber(event)" maxlength="4" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-6 control-label">INPUT PINCODE AGAIN:</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="pint" onkeypress="return isNumber(event)" required maxlength="4">
                        </div>
                      </div>
                    </div>
                  </div><br>

                  <div class="modal-footer">
                    <button id="btnsubmit" type="submit" class="col-md-offset-10 col-md-2 btn btn-primary" disabled="">OK</button>
                  </div>
                </form>
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
    $("#pino").blur(function(){
      if(document.getElementById('pino').value == document.getElementById('pint').value && document.getElementById('pino').value.length > 0){
        document.getElementById('btnsubmit').removeAttribute('disabled');
      }else{
        document.getElementById('btnsubmit').setAttribute('disabled','');
      }
    });

    $("#pint").blur(function(){
      if(document.getElementById('pint').value == document.getElementById('pino').value && document.getElementById('pint').value.length > 0){
        document.getElementById('btnsubmit').removeAttribute('disabled');
      }else{
        document.getElementById('btnsubmit').setAttribute('disabled','');
      }
    });
  </script>
  <script>
    function genCard(id, fullname){
      document.getElementById('code').value = id;
      fullname = fullname.replace("&","'");
      $.ajax({
          url: '/transaction/generate-card/process-card',
          type: 'GET',
          data: {
              memcode: id,
              name: fullname
          },
          success: function(data){
            document.getElementById('memlist').className="collapse";
            document.getElementById('memcard').className="collapse in";
            document.getElementById('front').src = "{{URL::to('/')}}/storage/member_card/" + id + "/front.png";
            document.getElementById('back').src = "{{URL::to('/')}}/storage/member_card/" + id + "/back.png";
          },
          error: function(xhr){
            alert('error in generating card');
          }
      });
    }

    function hideCard(){
      document.getElementById('memlist').className="collapse in";
      document.getElementById('memcard').className="collapse";
    }

    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
  </script>
@stop

