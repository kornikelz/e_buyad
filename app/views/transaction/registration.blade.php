@extends('....layout')

@section('page-title')
    Register Member
@stop

@section('other-scripts')
  {{HTML::script('bootflat-admin/js/datatables.min.js')}}
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
  {{HTML::script('capturejs/webcam.js')}}
  {{HTML::script('capturejs/webcam.min.js')}}
  <style type="text/css">
  </style>
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
      <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-pencil"></i>&nbsp Member Registration
      <hr>
      </h5></center>

      <div class="btn-group btn-group-justified">
        <a href="#details" data-toggle="tab"><button style="width:33%; height:150%; color:#434A54" id="detailsl" class="active">Member Details</button></a>
        <a href="#contact" data-toggle="tab"><button style="width:33%; height:150%; color:#434A54" id="contactl" class="hidden">Contact Details</button></a>
        <a href="#capture" data-toggle="tab"><button style="width:33%; height:150%; color:#434A54" id="capturel" class="hidden">Capture Image</button></a>
        <a href="#confirm" data-toggle="tab"><button style="width:33%; height:150%; color:#434A54" id="confirml" class="hidden">Confirmation</button></a>
      </div>

      <hr>

      <!--<ul class="nav nav-tabs">
        <li id="detailsl" class = "active"><a id="detailsla" data-toggle="tab" href="#details">Member Details</a></li>
        <li id="contactl" class = "hidden"><a id="detailsla" data-toggle="tab" href="#contact">Contact Details</a></li>
        <li id="capturel" class = "hidden"><a data-toggle="tab" href="#capture">Capture Image</a></li>
        <li id="confirml" class = "hidden"><a data-toggle="tab" href="#confirm">Confirmation</a></li>
      </ul>-->

      <!-- forms -->
      <div class="tab-content">
        <div id="details" class="tab-pane fade in active"><!-- DETAILS -->
          <form role="form" class="form-horizontal">
            <br>

            <div class = "form-group">
              <label class="col-md-3 control-label"><h5> Member Details </h5></label>
            </div>

            <div class="form-group">  
              <label class = "col-md-3 control-label"><span style="color:red" >*</span>First name</label>
              <div id="fnamef" class="col-md-7">
                <input type="text" placeholder="First Name" id="fname" class="form-control" name="fname" maxlength="50">
                <span id="fnamesp" class="1"></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">Middle Name</label>
              <div id="mnamef" class="col-md-7">
                <input type="text" placeholder="Middle Name" id="mname" class="form-control" name="mname" maxlength="50">
                <span id="mnamesp" class="1"></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label"><span style="color:red" >*</span>Last Name</label>
              <div id="lnamef"  class="col-md-7">
                <input type="text" placeholder="Last Name" id="lname" class="form-control" name="lname" maxlength="50">
                <span id="lnamesp" class="1"></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label"><span style="color:red" >*</span>Birthday</label>
              <div id="bdayf" class="col-md-7">
                <?php
                  echo '<input type="date" id="bday" class="form-control" name="bday" min="1900-01-01" max="'.date('Y-m-d').'">';
                ?>
                <span id="bdaysp" class="1"></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">Age</label>
              <div class="col-md-7">
                <input type="text" placeholder="Age" id="age" class="form-control" name="Age" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">OSCA ID Control Number</label>
              <div id="oscaidf" class="col-md-7">
                <input readonly="" type="text" placeholder="OSCA ID Number" id="oscaid" class="form-control" name="oscaid" maxlength="10">
                <span id="oscaidsp" class="1"></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label"><span style="color:red" >*</span>Address</label>
              <div id="haddf" class="col-md-7">
                <input type="text" placeholder="House/Lot No, Street Name, Building Name, Brgy No, Subdivision Name, City" id="hadd" class="form-control" name="hadd" maxlength="200">
                <span id="haddsp" class="1"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class = "col-md-5 control-label">NOTE: (<span style="color:red" >*</span>) ARE REQUIRED FIELD</label>
            </div>
            <br><br>
            
            <div class="form-group">
              <div class="col-md-offset-7 col-md-5">
                  <button type="button" class="btn btn-info"
                    onclick="openContact();">
                    NEXT</button>
                  
                  <button class="btn btn-info" type="button">CLEAR</button>
              </div>
            </div>
          </form>
        </div>
      
        <div id="contact" class="tab-pane fade"><!-- CONTACT -->
          <form role="form" class="form-horizontal">
            <br>

            <div class = "form-group">
              <label class = "col-md-3 control-label"><h5> Contact Details </h5></label>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">Landline Number:</label>
              <div id="lnumf" class="col-md-7">
                <input type="text" placeholder="Home Number" id="lnum" placeholder="#######" class="form-control" name="lnum" maxlength="7">
               
                <span id="lnumsp" class=""></span>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">Mobile Number:</label>
              <div class="col-md-7">
                <div class ="input-group">
                  <span class="input-group-addon">+63</span>
                  <div id = "pnumf">
                    <input type="text" placeholder="9#########" id="pnum" class="form-control" name="pnum" maxlength="10">

                    <span id="pnumsp" class=""></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-3 control-label">Email Address:</label>
              <div id="emailf" class="col-md-7">
                <input type="text" placeholder="email@site.com" id="email" class="form-control" name="email">
                <span id="emailsp" class=""></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class = "col-md-5 control-label">NOTE: ATLEAST 1 CONTACT INFORMATION. (OPTIONAL)</label>
            </div>

            <br><br>
            
            <div class="form-group">
              <div class="col-md-offset-7 col-md-5">
                  <button type="button" class="btn btn-info"
                    onclick="openCapture()">
                    NEXT</button>
                  
                  <button class="btn btn-info" type="button">CLEAR</button>
              </div>
            </div>
          </form>
        </div>

        <div id="capture" class="tab-pane fade">
          <form role="form" class="form-horizontal">
            <br>

            <div class = "form-group">
              <label class="col-md-3 control-label"><h5> Capture Image </h5></label>
            </div>

            <div class="form-group">
              <br>


              <div class="col-md-1"></div>
              <div class="col-md-4" style="align-content:center;">
                <div id="my_camera">
                </div>
              </div>

              <div class="col-md-2">
                <input type="button" onclick="take_snapshot()" value="TAKE PHOTO!">
              </div>

              <div class="col-md-4" style="align-content:center;">
                <div id="result"></div>
              </div>
            </div>

            <br><br>
            
            <div class="form-group">
              <div class="col-md-offset-7 col-md-5">
                  <button type="button" class="btn btn-info"
                    onclick="openConfirmation();">
                    SUBMIT</button>
              </div>
            </div>
          </form>
        </div>

        <div id="confirm" class="tab-pane fade">
          <form role="form" class="form-horizontal" action={{URL::to('/transaction/registration/register-member')}} method="post">
            <br>

            <div class = "form-group">
              <label class = "col-md-3 control-label"><h5> Confirm Details </h5></label>
            </div>

            <div class="form-group">
              <div id="conf_img"class = " col-md-offset-4 cold-md-4"></div>
            </div>

            <div class="form-group">
              <div class="form-group">
                <label class = "col-md-4 control-label">Member Id:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_memid" class="form-control" name="conf_memid" maxlength="" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">First name:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_fname" class="form-control" name="conf_fname" maxlength="" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Middle Name:</label>
                <div class="col-md-6">
                  <input type="text" placeholder="<<NO MIDDLE SET>>" id="conf_mname" class="form-control" name="conf_mname" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Last Name:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_lname" class="form-control" name="conf_lname" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Birthday:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_showbday" class="form-control" readonly>
                </div>
                <input type="hidden" id="conf_bday" name="conf_bday">
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Age:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_age" class="form-control" name="conf_age" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">OSCA ID Control Number:</label>
                <div class="col-md-6">
                  <input readonly="" type="text" placeholder="<<NO OSCA ID>>" id="conf_oscaid" class="form-control" name="conf_oscaid">
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Address:</label>
                <div class="col-md-6">
                  <input type="text" id="conf_hadd" class="form-control" name="conf_hadd" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Landline Number:</label>
                <div class="col-md-6">
                  <input type="text" placeholder="<<NO LANDLINE NUMBER>>" id="conf_lnum" class="form-control" name="conf_lnum" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Phone Number:</label>
                <div class="col-md-6">
                  <input type="text" placeholder="<<NO PHONE NUMBER>>" id="conf_pnum" class="form-control" name="conf_pnum" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class = "col-md-4 control-label">Email Address:</label>
                <div class="col-md-6">
                  <input type="text" placeholder="<<NO EMAIL ADDRESS>>" id="conf_email" class="form-control" name="conf_email" readonly>
                </div>
              </div>

              <br><br>
              
              <div class="form-group">
                <div class="col-md-offset-7 col-md-5">
                    <button type="submit" class="btn btn-info">REGISTER</button>
                    
                    <button class="btn btn-info" type="button" onclick="cancelConfirmation();">CANCEL</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- EVENTS -->
  <script>
    Webcam.set({
          width: 320,
          height: 240,
          // dest_width: 640,
          // dest_height: 480,
          // image_format: 'jpeg',
          // jpeg_quality: 90,
          // force_flash: false,
          // flip_horiz: true,
          // fps: 45
    });

    Webcam.attach('#my_camera');

    $("#lname").blur(function(){
      var inv = nameValidation(document.getElementById('lname').value);
      var divid = document.getElementById('lnamef');
      var spanid = document.getElementById('lnamesp');
      setValidMessage(inv, divid, spanid);
    });

    $("#mname").blur(function(){
      var inv = nameValidation(document.getElementById('mname').value);
      var divid = document.getElementById('mnamef');
      var spanid = document.getElementById('mnamesp');

      if(document.getElementById('mname').value.length <= 0) inv = 0;

      setValidMessage(inv, divid, spanid);
    });

    $("#fname").blur(function(){
      var inv = nameValidation(document.getElementById('fname').value);
      var divid = document.getElementById('fnamef');
      var spanid = document.getElementById('fnamesp');
      setValidMessage(inv, divid, spanid);
    });

    $("#bday").blur(function(){
      var inv = 0;
      var divid = document.getElementById('bdayf');
      var spanid = document.getElementById('bdaysp');

      if((document.getElementById('bday').value.length == 0)){
        inv = 1;
      }else{
        var setdate = new Date(document.getElementById('bday').value);
        var curdate = new Date();
        if(setdate > curdate){
          inv = 1;
        }
      }

      if(inv == 0){
        var age = curdate.getFullYear() - setdate.getFullYear();
        var m = curdate.getMonth() - setdate.getMonth();
        if (m < 0 || (m === 0 && curdate.getDate() < setdate.getDate())) {
          age--;
        }

        document.getElementById('age').value = age;
        if(age <= 60){
          document.getElementById('oscaid').setAttribute("readonly","");
          document.getElementById('oscaid').value = "";
        }else{
          document.getElementById('oscaid').removeAttribute("readonly");
        }
      }else{
        document.getElementById('age').value = "";
      }

      setValidMessage(inv, divid, spanid);
    });

    $("#oscaid").blur(function(){
      var inv = 0;

      if(/^\d+$/.test(document.getElementById('oscaid').value) == false) inv = 1;

      if(document.getElementById('oscaid').value.length <= 0) inv = 0;

      setValidMessage(inv, document.getElementById('oscaidf'), document.getElementById('oscaidsp'));
    });

    $("#hadd").blur(function(){
      var inv = haddValidation(document.getElementById('hadd').value);

      setValidMessage(inv, document.getElementById('haddf'), document.getElementById('haddsp'));
    });

    $("#lnum").blur(function(){
      var lnum = document.getElementById('lnum').value;
      var inv = 0;

      if(lnum.length < 7 && lnum.length != 0){
        inv = 1;
      }

      if(/^[0-9]*$/.test(lnum) == false){
        inv = 1;
      }

      setValidMessage(inv, document.getElementById('lnumf'), document.getElementById('lnumsp'));
    });

    $("#pnum").blur(function(){
      var lnum = document.getElementById('pnum').value;
      var inv = 0;

      if(lnum.length < 10 && lnum.length != 0){
        inv = 1;
      }

      if(/^[0-9]*$/.test(lnum) == false){
        inv = 1;
      }

      setValidMessage(inv, document.getElementById('pnumf'), document.getElementById('pnumsp'));
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

      setValidMessage(inv, document.getElementById('emailf'), document.getElementById('emailsp'));
    });

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

    function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function setValidMessage(inv, divid, spanid){
      if(inv == 1){
        divid.className = "col-md-7 has-error has-feedback";
        spanid.className = "glyphicon glyphicon-remove form-control-feedback";
      }else{
        divid.className = "col-md-7";
        spanid.className = "";
      }

      if(divid.id == "pnumf"){
        if(inv == 1){
          divid.className = "has-error has-feedback";
        }else{
          divid.className = "";
        }
      }
    }
    
  </script>

  <!-- FUNCTIONS -->
  <script>
    function openContact(){
      if(checkDetails()){
        document.getElementById("contactl").className = "active";
        document.getElementById("detailsl").className = "";
        document.getElementById("details").className = document.getElementById("contact").className;
        document.getElementById("contact").className = document.getElementById("contact").className + " active in";
      }else{
        alert('PLEASE INPPUT CORRECT DATA BEFORE PROCEEDING');
      }
    }

    function checkDetails(){
      if(
          (document.getElementById("lnamesp").className == "") &&
          (document.getElementById("mnamesp").className == "") &&
          (document.getElementById("fnamesp").className == "") &&
          (document.getElementById("bdaysp").className == "") &&
          (document.getElementById("haddsp").className == "")
        ){
        return true;
      }else{
        return false;
      }
    }

    function openCapture(){
      if(checkContact()){
        document.getElementById("capturel").className = "active";
        document.getElementById("contactl").className = "";
        document.getElementById("contact").className = document.getElementById("capture").className;
        document.getElementById("capture").className = document.getElementById("capture").className + " active in";
      }else{
        alert('PLEASE INPPUT CORRECT DATA BEFORE PROCEEDING');
      }
    }

    function checkContact(){
      if(
          (
            (document.getElementById("lnumsp").className == "") &&
            (document.getElementById("pnumsp").className == "") &&
            (document.getElementById("emailsp").className == "")
            ) && 
          (
            (document.getElementById('lnum').value.length > 0) ||
            (document.getElementById('pnum').value.length > 0) ||
            (document.getElementById('email').value.length > 0) 
            )
        ){
        return true;
      }else{
        return false;
      }
    }

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('result').innerHTML = '<img src="'+data_uri+'" width="320" height="240" align="middle"/>';
            document.getElementById('conf_img').innerHTML = '<img src="'+data_uri+'" width="320" height="240" align="middle"/>';
            
            Webcam.upload( data_uri, "{{URL::to('/')}}/transaction/registration/upload-temp-image", function(code, text) {
                // Upload complete!
                // 'code' will be the HTTP response code from the server, e.g. 200
                // 'text' will be the raw response content
            } );
        } );
    }

    function openConfirmation(){
      if(checkAllData()){
        document.getElementById('detailsl').className = "hidden";
        document.getElementById('contactl').className = "hidden";
        document.getElementById('capturel').className = "hidden";
        document.getElementById('confirml').className = "active";
        document.getElementById("capture").className = document.getElementById("confirm").className;
        document.getElementById("confirm").className = document.getElementById("confirm").className + " active in";
        setConfirmationData();
      }else{
        alert('PLEASE CHECK ALL INFO PROVIDED BEFORE PROCEEDING!');
      }
    }

    function checkAllData(){
      if(
          (document.getElementById('result').innerHTML.length > 0) &&
          (checkDetails()) &&
          (checkContact())
        ){
        return true;
      }else{
        return false;
      }
    }

    function setConfirmationData(){
      var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
      ];

      var date = new Date(document.getElementById("bday").value);

      document.getElementById('conf_fname').value = document.getElementById("fname").value;
      document.getElementById('conf_mname').value = document.getElementById("mname").value;
      document.getElementById('conf_lname').value = document.getElementById("lname").value;
      document.getElementById('conf_showbday').value = monthNames[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
      document.getElementById('conf_bday').value = document.getElementById("bday").value;
      document.getElementById('conf_age').value = document.getElementById("age").value;
      document.getElementById('conf_oscaid').value = document.getElementById("oscaid").value;
      document.getElementById('conf_hadd').value = document.getElementById("hadd").value;
      document.getElementById('conf_pnum').value = document.getElementById("pnum").value;
      document.getElementById('conf_lnum').value = document.getElementById("lnum").value;
      document.getElementById('conf_email').value = document.getElementById("email").value;


      $.ajax({
          url: '/transaction/registration/get-last-mem-id',
          type: 'GET',
          data: {},
          success: function(data){
              document.getElementById('conf_memid').value = data;
          }, 
          error: function(xhr){
            alert("error in fetching last member id");
          }
      });
    }

    function cancelConfirmation(){
      document.getElementById('detailsl').className = "active";
      document.getElementById('contactl').className = "";
      document.getElementById('capturel').className = "";
      document.getElementById('confirml').className = "hidden";
      document.getElementById("confirm").className = document.getElementById("details").className;
      document.getElementById("details").className = document.getElementById("details").className + " active in";
    }
  </script>

  <script language="JavaScript">
  </script>
@stop

@section('internal-scripts')
@stop

