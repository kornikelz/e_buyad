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
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
      <center><h5 class="content-row-title" style="font-size:25px">
      <i class="glyphicon glyphicon-user"></i>&nbsp Members Maintenance
        <hr>
        </h5>
      </center>

      <div class="panel panel-default">
        <!-- forms -->
        <div class ="row">
          <div class="col-md-offset-2 col-md-8">
            <div id="mem_form" class="collapse">
              <form id ="members_form" role="form" class="form-horizontal" method="post" action="{{URL::to('/maintenance/members/update-member')}}">
                <input type="hidden" id = "memid" name = "memid">

                <div class="form-group"><!-- Image -->
                  <div id="photo" class="col-md-offset-4 col-md-4">
                  </div>
                </div>

                <div id="fnamediv" class="form-group has-feedback"><!-- First Name -->
                  <label class = "col-md-2 control-label">First name</label>

                  <div class="col-md-10">
                    <input type="text" placeholder="First Name" id="fname" class="form-control" name="fname" required maxlength="100">

                    <span id="fnamespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>

                <div id="mnamediv" class="form-group"><!-- Middle Name -->
                  <label class = "col-md-2 control-label">Middle Name</label>

                  <div class="col-md-10">
                    <input type="text" placeholder="Middle Name" id="mname" class="form-control" name="mname" maxlength="100">
                    
                    <span id="mnamespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>

                <div id="lnamediv" class="form-group has-feedback"><!-- Last Name -->
                  <label class = "col-md-2 control-label">Last Name</label>

                  <div class="col-md-10">
                    <input type="text" placeholder="Last Name" id="lname" class="form-control" name="lname" required maxlength="100">
                    
                    <span id="lnamespan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group"><!-- Birthday -->
                  <label class = "col-md-2 control-label">Birthday</label>

                  <div class="col-md-10">
                    <?php
                      echo '<input type="date" id="bday" class="form-control" name="bday" min="1900-01-01" max="'.date("Y-m-d").'" onchange="setAge()">';
                    ?>
                  </div>
                </div>

                <div class="form-group"><!-- Age -->
                  <label class = "col-md-2 control-label">Age</label>
                  
                  <div class="col-md-10">
                    <input type="text" placeholder="Age" id="age" class="form-control" name="age" readonly="">
                  </div>
                </div>

                <div id="oscaiddiv" class="form-group has-feedback"><!-- OSCA ID -->
                  <label class = "col-md-2 control-label">OSCA ID Number</label>

                  <div class="col-md-10">
                    <input type="text" placeholder="##########" id="oscaid" class="form-control" name="oscaid" maxlength="10">
                    
                    <span id="oscaidspan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>

                <div id="addressdiv" class="form-group"><!-- Address -->
                  <label class = "col-md-2 control-label">Address</label>
                  
                  <div class="col-md-10">
                    <input type="text" placeholder="House/Lot No, Street Name, Building Name, Brgy No, Subdivision Name, City" id="address" class="form-control" name="address" maxlength="200" required>
                    <span id="addressspan" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "col-md-4 control-label"><h5> Contact Details </h5></label>

                  <p id="contp" class="col-md-4 help-block with-errors"></p>
                </div>

                <div id="homenumdiv" class="form-group has-feedback"><!-- Home Number -->
                  <label class = "col-md-2 control-label">Home Number</label>

                  <div class="col-md-10">
                    <input type="text" placeholder="#######" id="homenum" class="form-control" name="homenum" maxlength="7">
                    
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <p id="homenumspan" class="help-block with-errors"></p>
                  </div>
                </div>

                <div id="contnumdiv" class="form-group has-feedback"><!-- Phone Number -->
                  <label class = "col-md-2 control-label">Phone Number</label>
                  
                  <div class="col-md-10">
                    <div class = "input-group">
                      <span class="input-group-addon">+63</span>
                      <input type="text" maxlength="10" placeholder="(###) ###-####" id="contnum" class="form-control" name="contnum">
                      
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <p id="contnumspan" class="help-block with-errors"></p>
                    </div>
                  </div>
                </div>

                <div id="emaildiv" class="form-group has-feedback"><!-- Email Add -->
                  <label class = "col-md-2 control-label">Email Address</label>
                  <div class="col-md-10">
                    <input type="email" placeholder="email@site.com" id="email" class="form-control" name="email" maxlength="45">
                    
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <p id="emailspan" class="help-block with-errors"></p>
                  </div>
                </div>

                <div class="form-group"><!-- Form Buttons -->
                  <div class="col-md-offset-2 col-md-10">
                    <button id="btnsubmit" class="btn btn-info" type="submit" >Submit</button>
                    <button class="btn btn-info" type="cancel" href="#mem_form" data-toggle="collapse">Cancel</button>
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
                <h3 class="panel-title"> MEMBERS LIST </h3>
              </div>

              <div class="panel-body">
                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-hover">
      							<thead>
      								<tr role="row">
      									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Full Name</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending" style="width: 147px;">Birthday</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 147px;">Age</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 147px;">OSCA ID</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="OSCA ID: activate to sort column ascending" style="width: 147px;">Address</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Home Number: activate to sort column ascending" style="width: 147px;">Home Number</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Contact Number: activate to sort column ascending" style="width: 147px;">Phone Number</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Email Address: activate to sort column ascending" style="width: 147px;">Email Address</th>
      									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Options</th>
      								</tr>
      							</thead>

      							<tbody>
    							    <?php
  							        $counter = 0;

  							        $resultMembers = DB::select("SELECT strMemCode, strMemFName, strMemMName, strMemLName, datMemBirthday, strMemOSCAID, strMemAddress, strMemHomeNum, strMemContNum, strMemEmail,imgMemPhoto FROM tblMember WHERE intStatus = 1");

                        foreach($resultMembers as $data){
                          if($counter%2 == 0){
                              $trClass="even";
                          }else{
                              $trClass="odd";
                          }

                          $counter++;

                          $from = new DateTime($data->datMemBirthday);
                          $to   = new DateTime('today');
                          $fname = str_replace("'", "&", $data->strMemFName);
                          $mname = str_replace("'", "&", $data->strMemMName);
                          $lname = str_replace("'", "&", $data->strMemLName);


                          echo '<tr role="row" class="'.$trClass.'">';
                          echo '<td class="sorting_1">'.$data->strMemCode.'</td>';
                          echo '<td>'.$data->strMemFName.' '.$data->strMemMName.' '.$data->strMemLName.'</td>';
                          echo '<td>'.$data->datMemBirthday.'</td>';
                          echo '<td>'.$from->diff($to)->y.'</td>';
                          echo '<td>'.$data->strMemOSCAID.'</td>';
                          echo '<td>'.$data->strMemAddress.'</td>';
                          echo '<td>'.$data->strMemHomeNum.'</td>';

                          if(empty($data->strMemContNum)){
                              echo '<td>';
                          }else{
                              echo '<td>0';
                          }

                          echo $data->strMemContNum.'</td>';
                          echo '<td>'.$data->strMemEmail.'</td>';
                          echo '
                                <td align="center">
                                  <table>
                                    <tr>
                                        <button type="button" class="btn btn-success btn-block" href="#mem_form"
                                        data-toggle="collapse" onClick="setFormData(\''.$data->strMemCode.'\',\''.$fname.'\',\''
                                                                                       .$mname.'\',\''.$lname.'\',\''
                                                                                       .$data->datMemBirthday.'\',\''.$from->diff($to)->y.'\',\''
                                                                                       .$data->strMemOSCAID.'\',\''.$data->strMemAddress.'\',\''
                                                                                       .$data->strMemHomeNum.'\',\''.$data->strMemContNum.'\',\''
                                                                                       .$data->strMemEmail.'\',\''.$data->imgMemPhoto.'\')"  ><span class="glyphicon glyphicon-pencil"></span></button>
                                    </tr>
                                    <tr>
                                        <button type="button" class="btn btn-danger btn-block" data-target="#delete" data-toggle="modal" onClick="delMessage(\''.$data->strMemCode.'\',\''.str_replace("'","@",$data->strMemFName).'\',\''
                                                                                                                                                                .str_replace("'","@",$data->strMemMName).'\',\''.str_replace("'","@",$data->strMemLName).'\')"><span class="glyphicon glyphicon-remove"></span></button>
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
                        
                        <form method="post" action="{{URL::to('/maintenance/members/delete-member')}}">
                          <div class="modal-body">
                            <p id = "del_msg"> hehe </p>
                            <input type="hidden" id="del_memid" name="del_memid">
                            <input type="hidden" id="del_memname" name="del_memname">
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
@stop

@section('internal-scripts')
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>//validations
    $("#fname").blur(function(){
      var inv = nameValidation(document.getElementById('fname').value);
      var divid = document.getElementById('fnamediv');
      var spanid = document.getElementById('fnamespan');
      setValidMessage(inv, divid, spanid);
    });

    $("#mname").blur(function(){
      var inv = nameValidation(document.getElementById('mname').value);
      var divid = document.getElementById('mnamediv');
      var spanid = document.getElementById('mnamespan');

      if(document.getElementById('mname').value.length <= 0) inv = 0;

      setValidMessage(inv, divid, spanid);
    });

    $("#lname").blur(function(){
      var inv = nameValidation(document.getElementById('lname').value);
      var divid = document.getElementById('lnamediv');
      var spanid = document.getElementById('lnamespan');
      setValidMessage(inv, divid, spanid);
    });

    $("#oscaid").blur(function(){
      var inv = 0;

      if(/^\d+$/.test(document.getElementById('oscaid').value) == false) inv = 1;

      if(document.getElementById('oscaid').value.length <= 0) inv = 0;

      setValidMessage(inv, document.getElementById('oscaiddiv'), document.getElementById('oscaidspan'));
    });

    $("#address").blur(function(){
      var inv = haddValidation(document.getElementById('address').value);

      setValidMessage(inv, document.getElementById('addressdiv'), document.getElementById('addressspan'));
    });

    $("#homenum").blur(function(){

      var lnum = document.getElementById('homenum').value;
      var inv = 0;

      if(lnum.length < 7 && lnum.length != 0){
        inv = 1;
      }

      if(/^[0-9]*$/.test(lnum) == false){
        inv = 1;
      }

      setValidMessage(inv, document.getElementById('homenumdiv'), document.getElementById('homenumspan'));

      checkContDet();
    });

    $("#contnum").blur(function(){
      var lnum = document.getElementById('contnum').value;
      var inv = 0;

      if(lnum.length < 10 && lnum.length != 0){
        inv = 1;
      }

      if(/^[0-9]*$/.test(lnum) == false){
        inv = 1;
      }

      setValidMessage(inv, document.getElementById('contnumdiv'), document.getElementById('contnumspan'));

      checkContDet();
    });

    $("#email").blur(function(){
      var email = document.getElementById('email').value;
      var inv = 0;

      if(!validateEmail(email)){
        inv = 1;
      }

      if(email.length == 0){
        inv = 0;
      }

      setValidMessage(inv, document.getElementById('emaildiv'), document.getElementById('emailspan'));
      checkContDet();
    });

    function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function haddValidation(hadd){
      var inv = 0;

      //valid spec characters
      // # . , - ' /  & [space]

      //check if it contains only allowed characters
      if(/^[a-zA-Z0-9#.,' -]*$/.test(hadd) == false){
        inv = 1;
      }

      //allow num,char,# in first
      if(/^[a-zA-Z0-9#]*$/.test(hadd.charAt(0)) == false){
        inv = 1;
      }

      //check if special characters appear consecutively
      if(
          (hadd.indexOf("##") >= 0) ||
          (hadd.indexOf("..") >= 0) ||
          (hadd.indexOf(",,") >= 0) ||
          (hadd.indexOf("''") >= 0) ||
          (hadd.indexOf("  ") >= 0) ||
          (hadd.indexOf("--") >= 0)
        ){
        inv = 1;
      }

      if(hadd.length <= 0){
        inv = 1;
      }

      return inv;
    }

    function checkContDet(){
      if(
        (document.getElementById('homenum').value.length <= 0) &&
        (document.getElementById('contnum').value.length <= 0) &&
        (document.getElementById('email').value.length <= 0)
        ){
        document.getElementById('contp').innerHTML = '<ul class="list-unstyled"><li style="color:#DA4453">PLEASE CHOOSE ATLEAST ONE CONTACT INFO</li></ul>';  
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        document.getElementById('contp').innerHTML = '';
        document.getElementById('btnsubmit').className = "btn btn-info";
      }
    }

    function nameValidation(name){
      var inv = 0;

      //check if name contains data
      if(name.length == 0){
        inv = 1;
      }

      //check if invalid characters exists
      if(/^[a-zA-Z- ']*$/.test(name) == false) {
        inv = 1;
      }

      //check if special characters appear at beginning or last
      if(
         (name.charAt(0) == ' ' || name.charAt(0) == '-' || name.charAt(0) == '\'') ||
         (name.charAt(name.length - 1) == ' ' || name.charAt(name.length - 1) == '-' || name.charAt(name.length - 1) == '\'')
        ){
        inv = 1;
      }

      //check if special characters appear consecutively
      if(
          (name.indexOf("  ") >= 0) ||
          (name.indexOf("--") >= 0) ||
          (name.indexOf("''") >= 0)
        ){
        inv = 1;
      }

      return inv;
    }

    function setValidMessage(inv, divid, spanid){
      if(inv == 1){
        divid.className = "form-group has-error has-feedback";
        spanid.className = "glyphicon glyphicon-remove form-control-feedback";
        document.getElementById('btnsubmit').className = "btn btn-info disabled";
      }else{
        divid.className = "form-group";
        spanid.className = "";
        document.getElementById('btnsubmit').className = "btn btn-info";
      }
    }
  </script>
  <script>//functions
    function setFormData($memid, fname, mname, lname, $bday, $age, $oscaid, $address, $homenum, $contnum, $email, $img){
        fname = fname.replace("&","'");
        mname = mname.replace("&","'");
        lname = lname.replace("&","'");
        document.getElementById('memid').value = $memid;
        document.getElementById('fname').value = fname;
        document.getElementById('mname').value = mname;
        document.getElementById('lname').value = lname;
        document.getElementById('bday').value = $bday;
        document.getElementById('age').value = $age;
        document.getElementById('address').value = $address;
        document.getElementById('oscaid').value = $oscaid;
        document.getElementById('homenum').value = $homenum;
        document.getElementById('contnum').value = $contnum;
        document.getElementById('email').value = $email;
        document.getElementById('photo').innerHTML = "<img heigh='320' width='240' src='" + "{{URL::to('/')}}" + "/" + $img + "'>";
        setAge();
    }
    function setAge(){
        var dateString = document.getElementById('bday').value;
        var today = new Date();
          var birthDate = new Date(dateString);
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())){
              age--;
          }
        document.getElementById('age').value = age;
        
        if(age <= 60){
          document.getElementById('oscaid').setAttribute("readonly","");
          document.getElementById('oscaid').value = "";
        }else{
          document.getElementById('oscaid').removeAttribute("readonly");
        }
    }
    function delMessage($memid, $fname, $mname, $lname){
       	        document.getElementById('del_msg').innerHTML = "Delete " + $fname.replace("@","'") + " " + $mname.replace("@","'") + " " + $lname.replace("@","'") + " " + "?";
       	        document.getElementById('del_memid').value = $memid;
                document.getElementById('del_memname').value = $fname.replace("@","'") + " " + $mname.replace("@","'") + " " + $lname.replace("@","'") + " " + "?";
       	    }
  </script>
@stop