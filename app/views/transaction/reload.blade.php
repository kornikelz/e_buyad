@extends('....layout')

@section('page-title')
    Maintenance - Employee
@stop

@section('other-scripts')
  {{HTML::script('bootflat-admin/js/datatables.min.js')}}
  {{HTML::script('qr/qcode-decoder.min.js')}}
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">
      <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-refresh"></i>&nbsp Reload
      <hr>
      </h5></center>
      
      <!-- forms -->
      <div class ="row">
        <div class="col-md-12">
          <div class="col-md-offset-1 col-md-5">
            <input type="hidden" id="hpincode">
            <input type="hidden" id="hmemcode">

            <video autoplay height = "500" width = "450"></video>
            
            <h5 id="camstatus">PLEASE HOVER YOUR QR CODE TO THE CAMERA</h5>
            
            <script type="text/javascript">
              (function () {
                'use strict';

                var qr = new QCodeDecoder();
                if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
                  alert('Your browser doesn\'t match the required specs.');
                  throw new Error('Canvas and getUserMedia are required');
                }

                var video = document.querySelector('video');
                var reset = document.querySelector('#reset');
                var stop = document.querySelector('#stop');


                function resultHandler (err, result) {
                  if (err){
                    return console.log(err.message);
                    document.getElementById('camstatus').value = "SCANNING FAILURE"
                  }
                  else{
                    document.getElementById('camstatus').innerHTML = "SCANNING SUCCESSFUL";
                    $.ajax({
                        url: '/transaction/reload/get-pin-code',
                        type: 'GET',
                        data: {
                            memcode: result
                        },
                        success: function(data){
                          if(data.length > 0){
                            document.getElementById('hpincode').value = data[0]['strMemAcctPinCode'];
                            document.getElementById('hmemcode').value = result;
                            $("#setpin").modal("show");
                          }else{
                            alert('INVALID QR CODE');
                          }
                        }, 
                          error: function(xhr, status, error) {
                            alert('ERROR IN READING QR CODE');
                          }
                    });
                  }
                }

                // prepare a canvas element that will receive
                // the image to decode, sets the callback for
                // the result and then prepares the
                // videoElement to send its source to the
                // decoder.

                qr.decodeFromCamera(video, resultHandler);


                // attach some event handlers to reset and
                // stop whenever we want.

                reset.onclick = function () {
                  qr.decodeFromCamera(video, resultHandler);
                };

                stop.onclick = function () {
                  qr.stop();
                };

              })();
            </script>

            <div id="setpin" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                      <div class="col-md-offset-2 col-md-8">
                        <form class="form-horizontal" role="form">
                          <br><br>
                          <div class="form-group">
                            <label class="col-md-3 control-label">PINCODE:</label>
                            
                            <div class="col-md-8">
                              <input type="password" class="form-control" id="pino" name="pino" onkeypress="return isNumber(event)" maxlength="4">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div><br>

                    <div class="modal-footer">
                      <button type="button" data-toggle="modal" onclick="checkPinCode()" data-dismiss="modal" class="col-md-offset-10 col-md-2 btn btn-primary">OK</button>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-offset-1 col-md-5">
            <form role="form" class="form-horizontal" method="post" action="{{URL::to('/transaction/reload/credit-reload')}}">
                <br><br><br><br><br>
               <div class="form-group">
                 <label class = "col-md-4 control-label">Customer Code:</label>
                 <div class="col-md-8">
                   <input readonly id="memcode" name="memcode" class="form-control" type="text">
                 </div>
               </div>

               <div class="form-group">
                 <label class = "col-md-4 control-label">Customer Name:</label>
                 <div class="col-md-8">
                   <input readonly id="memname" class="form-control" type="text">
                 </div>
               </div>

               <div class="form-group">
                 <label class = "col-md-4 control-label">Credit Load Balance:</label>
                 <div class="col-md-8">
                   <input readonly id="membal" name="membal" class="form-control" type="text">
                 </div>
               </div>
               <br>

               <div class="form-group">
                 <label class = "col-md-4 control-label">Load Amount</label>
                 <div class="col-md-8">
                   <input type="number" readonly id="amt" name="amt" class="form-control" required  onkeypress="return isNumber(event)">
                 </div>
               </div>

               <br><br>
               <div class="form-group">
                 <div class="col-md-offset-2 col-md-10">
                 {{Session::get('loadmin')}}  
                   <button id="btnsubmit" type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                   <button class="btn btn-info" type="cancel" 
                    onclick="this.parentElement.parentElement.parentElement.reset();document.getElementById('amt').setAttribute('readonly','');">
                   Clear</button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>


@stop

@section('internal-scripts')
  <script>
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
  </script>
  <script>
    function checkPinCode(){
      if(document.getElementById('pino').value == document.getElementById('hpincode').value){
        $.ajax({
            url: '/transaction/reload/get-mem-det',
            type: 'GET',
            data: {
                memcode: $('#hmemcode').val()
            },
            success: function(data){
                $('#memname').val(data[0]['strMemFName'] + " " + data[0]['strMemMName'] + " " + data[0]['strMemLName']);
                $('#membal').val(data[0]['decMCreditValue']);
                $('#memcode').val($('#hmemcode').val());
                document.getElementById('amt').removeAttribute('readonly');
            }, 
              error: function(xhr){
              }
        });
      }else{
        alert('INVALID PIN CODE!');
      }
    }
  </script>
  <script>
    $("#amt").blur(function(){
        var amt = document.getElementById('amt').value;

        if(parseInt(amt) < parseInt("{{$loadmin}}")){
          document.getElementById('btnsubmit').setAttribute('disabled','');
          alert('INPUT IS NOT IN THE RANGE OF ALLOWED AMOUNT');
        }else{
          document.getElementById('btnsubmit').removeAttribute('disabled');
        }
    });
  </script>
@stop
