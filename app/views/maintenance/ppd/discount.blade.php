@extends('......layout')

@section('page-title')
    Maintenance - Member Details
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
        input[type=number]::-webkit-outer-spin-button
          {
            -webkit-appearance: none;
            margin: 0;
          }
  </style>
@stop

@section('content')
<div class="panel-body">
                <div class="content-row">
                  <center><h5 class="content-row-title" style="font-size:25px">Discount Maintenance<hr></h5></center>

                  <div class="btn-group btn-group-justified">
                            <a href="{{URL::to('/maintenance/ppd/packages')}}" class="btn btn-primary">Packages</a>
                            <a hidden href="#" class="btn btn-primary">Promos</a>
                            <a href="#" class="btn btn-info">Discounts</a>
                  </div>
                        <br> <br><br>
                  <div class="panel panel-default">
                    <div class = "row">
                      <div class = "col-md-3">
                        <button type="button" class="btn btn-primary btn-block" href="#disc_form" data-toggle="collapse" onclick="clearForm()">ADD DISCOUNT</button>
                      </div>
                    </div>
                    <!-- forms -->
                    <div class ="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                          <div id="disc_form" class="collapse">

                            <form id="discform" class="form-horizontal" role="form" method="post" action="">
                                <input type="hidden" name="code" id="code">
                              <div id="namediv" class="form-group has-feedback">
                                <label class="control-label col-sm-2">Discount Name</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Discount Name" id="name" required="">
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

                              <div class="form-group">
                                <label class="control-label col-sm-2">Type of Discount:</label>
                              </div>

                              <div class="form-group">
                                  <div class="radio">
                                    <label class="control-label col-md-4">
                                      <input onclick="radioClicked('a')" type="radio" name="rdisc" id="rpercent" value="percent" required>Percentage:
                                    </label>
                                    <div id="percentdiv" class="col-sm-8 form-group">
                                        <div class = "input-group">
                                          <input type="text" class="form-control" id="percent" name="percent" maxlength="2" required readonly>
                                          <span class="input-group-addon">%</span>
                                          <span id="percentspan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <label class="control-label col-md-4">
                                      <input onclick="radioClicked('b')"  type="radio" name="rdisc" id="ramount" value="amount"  >Amount:
                                    </label>
                                    <div id="amountdiv" class="col-sm-8 form-group">
                                        <div class = "input-group">
                                          <span class="input-group-addon">₱</span>
                                          <input type="text" class="form-control" id="amount" name="amount" required=""  readonly maxlength="10">
                                          <span id="amountspan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                  <button id="btnsubmit" type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                                  <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
                              </div>
                            </div>
                            </form>
                          </div>
                      </div>
                    </div>
					          <!-- datatables -->
                    <div class = "row">
                      <div class="col-md-12" style="overflow-x: auto;">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title"> Package Details </h3>
                          </div>
                          <div class="panel-body">
                  		    <table id="example" class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                  			    <thead>
                                    <tr role="row">
                                        <th>Discount Code</th>
                                        <th>Discount Name</th>
                                        <th>Percentage</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Optiont</th>
                                    </tr>
                  			    </thead>
                  				<tbody>
                  							    <!-- php script here-->
                                                                    <?php
                                      							        $counter = 0;

                                      							        $results = DB::select("SELECT * FROM tbldiscounts WHERE intStatus = 1;");

                                                                        foreach($results as $data){
                                                                            if($counter%2 == 0){
                                                                                $trClass="even";
                                                                            }else{
                                                                                $trClass="odd";
                                                                            }
                                                                            $counter++;
                                                                            $name = str_replace("'","#",$data->strDiscName);
                                                                            echo '<tr role="row" class="'.$trClass.'">';
                                                                            echo '<td class="sorting_1">'.$data->strDiscCode.'</td>';
                                                                            echo '<td>'.$data->strDiscName.'</td>';
                                                                            echo '<td>'.($data->dblDiscPerc * 100).'%</td>';
                                                                            echo '<td>'.$data->decDiscAmt.'</td>';
                                                                            echo '<td>'.$data->strDiscDesc.'</td>';
                                                                            echo '

                                                                                <td align="center">
                                                                                  <table>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-success btn-block" href="#disc_form" data-toggle="collapse" onClick="setFormData(\''.
                                                                                                                                                                                                                $data->strDiscCode.'\',\''.
                                                                                                                                                                                                                $name.'\',\''.
                                                                                                                                                                                                                $data->dblDiscPerc.'\',\''.
                                                                                                                                                                                                                $data->decDiscAmt.'\',\''.
                                                                                                                                                                                                                $data->strDiscDesc
                                                                                                                                                                                                                .'\')"><span class="glyphicon glyphicon-pencil"></span></button>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.
                                                                                                                                                                                                                $data->strDiscCode.'\',\''.
                                                                                                                                                                                                                $name
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
                                                                      <form method="post" action="{{URL::to('maintenance/ppd/discount/delete-discount')}}">
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
  <script>//message
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//validations
    $("#name").blur(function(){
      if(!isDiscNameValid(document.getElementById('name').value)){
        document.getElementById('namediv').className = "form-group has-feedback has-error";
        document.getElementById('namespan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('namep').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">Invalid Discount Name</li></ul>';
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('namediv').className = "form-group has-feedback";
        document.getElementById('namespan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
        document.getElementById('namep').innerHTML = '';
      }
    });

    $("#percent").blur(function(){
      if(document.getElementById('percent').value.length > 0 && (parseFloat(document.getElementById('percent').value).toFixed(2) > 0)){
        document.getElementById('percent').value = parseInt(document.getElementById('percent').value);
        document.getElementById('percentdiv').className = "col-sm-8 form-group has-feedback";
        document.getElementById('percentspan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
      }else{
        document.getElementById('percentdiv').className = "col-sm-8 form-group has-feedback has-error";
        document.getElementById('percentspan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }
    });

    $("#amount").blur(function(){
      if(document.getElementById('amount').value.length > 0 && (parseFloat(document.getElementById('amount').value).toFixed(2) > 0)){
        document.getElementById('amount').value = parseFloat(document.getElementById('amount').value).toFixed(2);
        document.getElementById('amountdiv').className = "col-sm-8 form-group has-feedback";
        document.getElementById('percentspan').className = "glyphicon form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info";
      }else{
        document.getElementById('amountdiv').className = "col-sm-8 form-group has-feedback has-error";
        document.getElementById('amountspan').className = "glyphicon form-control-feedback glyphicon-remove";
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }
    });

    function isDiscNameValid(name){
      var isValid = true;

      if(name.length <= 0){
        isValid = false;
      }

      if(!/^[a-zA-Z0-9 \-'&()\/#+]*$/.test(name)){
        isValid = false;
      }

      if(!/^[a-zA-Z0-9]*$/.test(name.charAt(0))){
        isValid = false;
      }

      if(!/^[a-zA-Z0-9)]*$/.test(name.charAt(name.length-1))){
        isValid = false;
      }

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
  </script>
  <script>//functions
      function radioClicked(a){
          if(a == "a"){
              document.getElementById('amount').value = "0";
              document.getElementById('amount').setAttribute("readonly","");
              document.getElementById('percent').removeAttribute("readonly");
              document.getElementById('percent').value = "";
              document.getElementById('amountdiv').className = "col-sm-8 form-group has-feedback";
              document.getElementById('amountspan').className = "glyphicon form-control-feedback";
              document.getElementById('btnsubmit').className = "btn btn-info";
          }else{
              document.getElementById('percent').value = "0";
              document.getElementById('percent').setAttribute("readonly","");
              document.getElementById('amount').removeAttribute("readonly");
              document.getElementById('amount').value = "";
              document.getElementById('percentdiv').className = "col-sm-8 form-group has-feedback";
              document.getElementById('percentspan').className = "glyphicon form-control-feedback";
              document.getElementById('btnsubmit').className = "btn btn-info";
          }
      }
  	    function clearForm(){
  	        document.getElementById('discform').reset();
  	        document.getElementById('discform').action = '{{URL::to('/maintenance/ppd/discount/add-discount')}}';
  	    }
      function delMessage($code,$name){
          $name = $name.replace("#","'");
          document.getElementById('del_msg').innerHTML = "Delete " + $name + "?";
          document.getElementById('del_id').value = $code;
          document.getElementById('del_name').value = $name;
      }
      function setFormData($code, $name, $perc, $amt, $desc){
          $name = $name.replace("#","'");

          if($perc == 0){
              document.getElementById('rpercent').checked = false;
              document.getElementById('ramount').checked = true;
              document.getElementById('percent').value= 0;
              document.getElementById('percent').value = "0";
              document.getElementById('percent').setAttribute("readonly","");
              document.getElementById('amount').removeAttribute("readonly");
              document.getElementById('amount').value = "";
          }else{
              document.getElementById('rpercent').checked = true;
              document.getElementById('ramount').checked = false;
              document.getElementById('amount').value = "0";
              document.getElementById('amount').setAttribute("readonly","");
              document.getElementById('percent').removeAttribute("readonly");
              document.getElementById('percent').value = "";
          }

          document.getElementById('code').value = $code;
          document.getElementById('name').value = $name;
          document.getElementById('percent').value = $perc * 100;
          document.getElementById('amount').value = $amt;
          document.getElementById('desc').value = $desc;
  	    document.getElementById('discform').action = '{{URL::to('/maintenance/ppd/discount/update-discount')}}';
      }
  </script>
@stop