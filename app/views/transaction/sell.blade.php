@extends('....layout')

@section('page-title')
    Make A Sale
@stop

@section('other-scripts')
{{HTML::script('bootflat-admin/js/datatables.min.js')}}
{{HTML::script('qr/qcode-decoder.min.js')}}

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').DataTable();
    $('#example2').DataTable();
	} );
</script>
@stop

@section('content')
<div class="panel-body">
  <div class="content-row">
    <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp Make A Sale
      <hr>
      </h5></center>

    <!-- OR# and Customer --> 
    <div class="panel panel-default col-md-12">
        <form role="form" class="form-horizontal">
        <div class="col-md-4">
          <label class="control-label">Transaction ID:</label>
          <input id="transid" name="transid" type="text" readonly value="{{ $code }}">
        </div>
        <div class="col-md-4">
          <label class="control-label">Date and Time:</label>
          <?php
            echo '<input id="transid" name="transid" type="text" readonly value="'.date("Y-m-d").' '.date("h:ia",strtotime("+8 Hours")).'">';
          ?>
        </div>
        <div class="col-md-4">
          <label class="control-label">Pharmacist:</label>
          <input id="transid" name="transid" type="text" readonly value="Luis Guballo">
        </div>
        </form>
    </div>

    <!-- END -->

    <!-- Product List and Chosen Products List -->
    <div class="panel panel-default col-md-12">
      <div class="panel-body col-md-6">

        <div class="btn-group btn-group-justified">
          <a id="medmenu" class="btn btn-info" onclick="showMed();">Medicine</a>
          <a id="nmedmenu" class="btn btn-primary" onclick="showNonMed();">Non-medicine</a>
        </div>

        <br>
        <div class="panel panel-header">
          <div id="medtbl" class="collapse in">
            <div class="col-md-12">
              <form role="form" class="form-horizontal">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-group">
                      <label class="control-label col-md-4">Filter by:</label>
                      <div class="col-md-8">
                        <select id = "mfilterby" name="mfilterby" class = "form-control">
                          <option disabled selected value>SEARCH</option>
                          <option value="0">Therapeutic Class</option>
                          <option value="1">Manufacturer</option>
                          <option value="2">Form</option>
                          <option value="3">Packaging</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-4">Look for:</label>
                    <div class="col-md-8">
                      <select id = "mlookfor" name="mlookfor" class = "form-control">
                        <option disabled selected value>SEARCH</option>
                        <option value="">ALL</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="table-responsive">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                  <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Size</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Price</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Add</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Thera</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Manu</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Form</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Pack</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $counter = 0;
                    $results = DB::select("SELECT 
                                              m.strProdMedCode,
                                              b.strPMBranName, 
                                              (
                                                SELECT group_concat(g.strPMGenName SEPARATOR ' ') 
                                                    FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                                    WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode
                                              ) as 'GenNames',
                                              t.strPMTheraClassName,
                                              mn.strPMManuName,
                                              f.strPMFormName,
                                              p.strPMPackName, 
                                              m.decProdMedSize, 
                                              u.strUOMName, 
                                              pr.decProdPricePerPiece

                                          FROM tblProdMed m
                                          LEFT JOIN tblProdMedBranded b
                                            ON m.strProdMedBranCode = b.strPMBranCode
                                          LEFT JOIN tblpmtheraclass t
                                            ON m.strProdMedTheraCode = t.strPMTheraClassCode
                                          LEFT JOIN tblpmmanufacturer mn
                                            ON m.strProdMedManuCode = mn.strPMManuCode
                                          LEFT JOIN tblpmform f
                                            ON m.strProdMedFormCode = f.strPMFormCode
                                          LEFT JOIN tblPMPackaging p
                                            ON m.strProdMedPackCode = p.strPMPackCode
                                          LEFT JOIN tblUOM u
                                            ON m.strProdMedDosCode = u.strUOMCode
                                          LEFT JOIN tblProdPrice pr
                                            ON m.strProdMedCode = pr.strProdPriceCode
                                          LEFT JOIN tblProducts pd
                                            ON m.strProdMedCode = pd.strProdCode
                                          WHERE pd.intStatus = 1;");
                      foreach($results as $data){
                            if($counter%2 == 0){
                                $trClass="even";
                            }else{
                                $trClass="odd";
                            }
                            $counter++;

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td><b>'.$data->strPMBranName.'</b> ('.$data->GenNames  .')</td>';
                            echo '<td>'.$data->strPMPackName.' - '.$data->decProdMedSize.' '.$data->strUOMName.'</td>';
                            echo '<td>'.$data->decProdPricePerPiece.'</td>';
                            echo '<td><button class="btn btn-success btn-block" data-toggle="modal" data-target="#quantity" '.
                                  'onClick="setModalForm(\''.
                                    $data->strProdMedCode.'\',\''.
                                    $data->strPMBranName.' '.$data->GenNames.'\','.
                                    $data->decProdPricePerPiece
                                  .')">></button></td>';
                            echo '<td>'.$data->strPMTheraClassName.'</td>';
                            echo '<td>'.$data->strPMManuName.'</td>';
                            echo '<td>'.$data->strPMFormName.'</td>';
                            echo '<td>'.$data->strPMPackName.'</td>';
                            echo '</tr>';
                        }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div id="nmedtbl" class="collapse">
            <div class="col-md-offset-2 col-md-8">
              <form role="form" class="form-horizontal">
                <div class="form-group">
                  <label class="control-label col-md-4">Category:</label>
                  <div class="col-md-8">
                    <select id = "nlookfor" name="nlookfor" class = "form-control">
                      <option disabled selected value>SEARCH</option>
                      <option value="">ALL</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>

            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Code</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Size</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Price</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Add</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 400px;">Cate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $counter = 0;
                    $results = DB::select("SELECT nm.strProdNMedCode, 
                                                  nm.strProdNMedName, 
                                                  pr.decProdPricePerPiece,
                                                  c.strNMedCatName, 
                                                  s.strGenSizeName, 
                                                  st.decNMStanSize, 
                                                  u.strUOMName
                                          FROM tblProdNonMed nm
                                          LEFT JOIN tblProducts p
                                            ON nm.strProdNMedCode = p.strProdCode
                                          LEFT JOIN tblnmedcategory c
                                            ON nm.strProdNMedCatCode = c.strNMedCatCode
                                          LEFT JOIN tblProdPrice pr
                                            ON nm.strProdNMedCode = pr.strProdPriceCode
                                          LEFT JOIN tblNMedGeneral g
                                            ON nm.strProdNMedCode = g.strNMGenCode
                                          LEFT JOIN tblGenSize s
                                            ON g.strNMGenSizeCode = s.strGenSizeCode
                                          LEFT JOIN tblNMedStandard st
                                            ON nm.strProdNMedCode = st.strNMStanCode
                                          LEFT JOIN tblUOM u
                                            ON st.strNMStanUOMCode = u.strUOMCode
                                          WHERE p.intStatus = 1;");
                      foreach($results as $data){
                            if($counter%2 == 0){
                                $trClass="even";
                            }else{
                                $trClass="odd";
                            }
                            $counter++;

                            echo '<tr role="row" class="'.$trClass.'">';
                            echo '<td>'.$data->strProdNMedCode.'</td>';
                            echo '<td>'.$data->strProdNMedName.'</td>';
                            echo '<td>'.$data->strGenSizeName.' '.$data->decNMStanSize.' '.$data->strUOMName.'</td>';
                            echo '<td>'.$data->decProdPricePerPiece.'</td>';
                            echo '<td><button class="btn btn-success btn-block" data-toggle="modal" data-target="#quantity" onclick="setModalForm(\''.
                                    $data->strProdNMedCode.'\',\''.
                                    $data->strProdNMedName.'\','.
                                    $data->decProdPricePerPiece
                                  .')"></button></td>';
                            echo '<td>'.$data->strNMedCatName.'</td>';
                            echo '</tr>';
                        }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="modal fade" id="quantity" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6 class="modal-title" id="myModalLabel">Set Quantity</h6>
                </div>
                <div class="modal-body">
                  <center>
                  <label>Quantity:</label> <input type="number" min="1" max="10000" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" id="pqty">
                  </center>
                  <input type="hidden" id="pcode">
                  <input type="hidden" id="pname">
                  <input type="hidden" id="pprice">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" onclick="addItem()"  data-dismiss="modal" >Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- second half-->
      <div class="panel-body col-md-6">
        <div class="panel panel-header">
          <center>
            <h5>Selected Products</h5>
          </center>
        </div>
        <div class="panel-body" style="height:500px;">
            <table id="purchased" class="table table-condensed table-hover">
              <tr>
                <thead>
                  <tr>
                    <th>Remove</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                  </tr>
                </thead>
              </tr>
              <tr>
                <tbody>
                </tbody>
              </tr>
            </table>
        </div>
      </div>
    </div>
    <!-- END -->

    <div class="col-md-6">
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <div class="checkbox">
          <center>
          <div class="input-group">
          <input type="checkbox" id="discchk" onclick="setDiscount();">
          <select disabled onchange="addDiscount();" id="disc" name="selecter_basic" class="selecter_3" data-selecter-options='{"cover":"true"}'>
            <option selected disabled="" value="0"> --CHOOSE DISCOUNT-- </option>
            <?php
              $results = DB::select('SELECT dblDiscPerc, decDiscAmt, strDiscName FROM tblDiscounts WHERE intStatus = 1');

              foreach($results as $data){
                if($data->decDiscAmt == 0){
                  echo '<option value="'.$data->dblDiscPerc.'">'.$data->strDiscName.'</option>';
                }else{
                  echo '<option value="'.$data->decDiscAmt.'">'.$data->strDiscName.'</option>';
                }
              }
            ?>
          </select>
          </div>
          </center>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group" style="width: 800px;">
          <div class="form-group">
          <label class="control-label col-md-2">
            Subtotal:
          </label>
          <div class="col-md-5">
            <input id="subt" type="text"  class="form-control" value="0" readonly>
          </div>
          </div>
        </div>
        <div class="input-group" style="width: 800px;">
          <label class="control-label col-md-2">
            Discount:
          </label>
          <div class="col-md-5">
            <input id="discamt" type="text"  class="form-control" value="0" readonly>
          </div>
        </div>
        <div class="input-group" style="width: 800px;">
          <label class="control-label col-md-2">
            Tax:
          </label>
          <div class="col-md-5">
            <div class="input-group">
            <input type="text"  class="form-control" value="12" readonly>
            <span class="input-group-addon">%</span>
            </div>
          </div>
        </div>

        <div class="input-group" style="width: 800px;">
          <label class="control-label col-md-2">
            Grand Total:
          </label>
          <div class="col-md-5">
            <input id="grandt" type="text"  class="form-control" value="0" readonly>
          </div>
        </div>

        <div class="col-md-12">
          <center>
          <h5>
            PAYMENT
          </h5>
          </center>
        </div>

        <div class="col-md-12">
          <center>
          <button type="button" id="btncash" data-toggle="modal" data-target="#cash" class="btn btn-success col-md-offset-1 col-md-5" >Cash</button>
          <button type="button" id="btncard" data-toggle="modal" class="btn btn-info col-md-offset-1 col-md-5" onclick="checkGrandTotal()">Card</button><br><br><br>
          <button type="button" id="btnegc" data-toggle="modal" class="btn btn-warning col-md-offset-1 col-md-5" >EGC</button>
          <button type="button" id="btnreturn" data-toggle="modal" data-target="#returnsinfo" class="btn btn-danger col-md-offset-1 col-md-5">Returns</button>
          </center>
        </div>

        <div class="modal fade" id="cash" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">Cash Payment</h6>
              </div>
              <div class="modal-body">
                <center>
                <label>Amount Rendered:</label> 
                <div class="input-group">
                <span class="input-group-addon">Php</span>
                <input  class="form-control" type="number" id="amtpaid" name="amtpaid" min="0.00" step="0.01" pattern="/^[0-9]+(\.[0-9]{1,2})?$/">
                </div>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="checkCashAmount()">Confirm</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="transum" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">Transaction Summary</h6>
              </div>
              <form id="transdet" role="form" method="post" action="{{URL::to('/transaction/sell/get-receipt')}}">
                <div class="modal-body">
                  <input type="hidden" name="prodtransid" id="prodtransid" value="{{ $code }}">
                  <input type="hidden" name="proddisc" id="proddisc">
                  <input type="hidden" name="prodcode" id="prodcode">
                  <input type="hidden" name="prodname" id="prodname">
                  <input type="hidden" name="prodprice" id="prodprice">
                  <input type="hidden" name="prodqty" id="prodqty">
                  <input type="hidden" name="prodamt" id="prodamt">
                  <input type="hidden" name="prodmemcode" id="prodmemcode">
                  <input type="hidden" name="prodmemname" id="prodmemname">
                  <input type="hidden" name="prodbal" id="prodbal">
                  <input type="hidden" name="prodpts" id="prodpts">
                  <div id="heading">
                    <center>
                      <div class="input-group">
                        <center>
                        <label>Subtotal:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumsubt" name="sumsubt" readonly>
                        </div>
                        </center>
                      </div>
                      <div class="input-group">
                        <center>
                        <label>Discount Rate:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumdisc" name="sumdisc" readonly>
                        </div>
                        </center>
                      </div>
                      <div class="input-group">
                        <center>
                        <label>Tax Rate:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumtax" name="sumtax" readonly>
                        </div>
                        </center>
                      </div>
                      <div class="input-group">
                        <center>
                        <label>Grand Total:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumgrant" name="sumgrant" readonly>
                        </div>
                        </center>
                      </div>
                      <div class="input-group">
                        <center>
                        <label>Amount Rendered:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumamt" name="sumamt"  readonly>
                        </div>
                        </center>
                      </div>
                      <div class="input-group">
                        <center>
                        <label>Change:</label> 
                        <div class="input-group">
                        <input  class="form-control" type="text" id="sumchan" name="sumchan" readonly>
                        </div>
                        </center>
                      </div>
                    </center>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Save & Print Receipt</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="cardid" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">SCAN QR CODE</h6>
              </div>
              <div class="modal-body">
                <div id="heading">
                  <center>
                    <div class="input-group">
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
                                url: '/transaction/sell/verify-qr',
                                type: 'GET',
                                data: {
                                    memcode: result
                                },
                                success: function(data){
                                  if(data.length > 0){
                                    document.getElementById('edocnip').value = data[0]['strMemAcctPinCode'];
                                    document.getElementById('edocmem').value = result;
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
                    </div>
                  </center>
                </div>
                <div id="details">
                </div>
                <div id="products">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"  data-toggle="modal" data-target="#cardpin" data-dismiss="modal" onclick="document.getElementById('camstatus').innerHTML = 'PLEASE HOVER YOUR QR CODE TO THE CAMERA'">Confirm</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="cardpin" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">PLEASE ENTER PIN CODE</h6>
              </div>
              <div class="modal-body">
                <div id="heading">
                  <center>
                    <div class="input-group">
                      <center>
                      <label>PIN CODE:</label> 
                      <div class="input-group">
                      <input  class="form-control" type="password" id="nipcode" maxlength="4">
                      <input type="hidden" id="edocnip">
                      <input type="hidden" id="edocmem">
                      </div>
                      </center>
                    </div>
                  </center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="checkPinCode()"  >Confirm</button> 
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="carddet" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">Member Account Details</h6>
              </div>
              <div class="modal-body">
                <div id="heading">
                  <center>
                    <div class="input-group">
                      <center>
                      <label>Member Name:</label> 
                      <div class="input-group">
                      <input  class="form-control" type="text" id="memname" readonly>
                      </div>
                      </center>
                    </div>
                    <div class="input-group">
                      <center>
                      <label>Balance:</label> 
                      <div class="input-group">
                      <input  class="form-control" type="text" id="membal" readonly>
                      </div>
                      </center>
                    </div>
                  </center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" data-toggle="modal" href="#reload">Reload</button>
                <button type="submit" class="btn btn-danger" onclick="checkBalance();" data-dismiss="modal">Load Payment</button>
                <!-- <button type="submit" class="btn btn-danger" data-dismiss="modal">Cash</button> 
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Load + Cash</button>  -->
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="reload" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">RELOAD</h6>
              </div>
              <div class="modal-body">
                <center>
                <label>Amount Rendered:</label> 
                <div class="input-group">
                <span class="input-group-addon">Php</span>
                <input  class="form-control" type="number" id="rload" name="rload" min="0.00" step="0.01" pattern="/^[0-9]+(\.[0-9]{1,2})?$/">
                </div>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="reloadMember()">Confirm</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="returnsinfo" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">RETURNS</h6>
              </div>
              <div class="modal-body">
                <center>
                  <label>Select Return Code:</label> 
                  <div class="input-group">
                    <select id="retuid" name="retuid" class = "form-control" onchange="abx()">
                      <option disabled selected value>--- SELECT RESULTS ID ---</option>
                        <?php
                          $result = DB::select('SELECT decTotalAmount, strReturnCode FROM tblReturns WHERE isUsed = 0');

                          foreach($result as $data){
                            echo '<option value="'.$data->decTotalAmount.'">'.$data->strReturnCode.'</option>';
                          }
                        ?>
                    </select>
                  </div>

                  <div id="retuamt">
                  </div>
                </center>
              </div>
              <div class="modal-footer">
                <button id="btnretuuse" type="button" data-dismiss="modal" class="btn btn-danger" disabled onclick="disableOtherButtons()">USE</button>
                <button id="btnretuuse" type="button" data-dismiss="modal" class="btn btn-danger" disabled onclick="">PAY</button>
                <button id="btnretupay" type="button" data-dismiss="modal" class="btn btn-danger" onclick="enableOtherButtons()">CANCEL</button>
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
function abx(){
    document.getElementById('retuamt').innerHTML = '<label>Amount:</label> '+
                                                   '<div class="input-group">'+
                                                    '<input readonly type="text" name="amtreturn" id="amtreturn" class="form-control" value="'+
                                                    document.getElementById('retuid').value+'">' +
                                                   '</div>';
    document.getElementById('btnretuuse').removeAttribute('disabled');
    document.getElementById('btnretupay').removeAttribute('disabled');
}

function disableOtherButtons(){
  document.getElementById('btncash').setAttribute('disabled','');
  document.getElementById('btncard').setAttribute('disabled','');
  document.getElementById('btnegc').setAttribute('disabled','');
}

function enableOtherButtons(){
  document.getElementById('btncash').removeAttribute('disabled');
  document.getElementById('btncard').removeAttribute('disabled');
  document.getElementById('btnegc').removeAttribute('disabled');
  document.getElementById('btnretuuse').setAttribute('disabled','');
  document.getElementById('btnretupay').setAttribute('disabled','');
  document.getElementById('retuid').value = "";
  document.getElementById('retuamt').innerHTML = "";
}
</script>
<script>
  $(document).ready(function(){
    document.getElementById('example_length').parentElement.outerHTML = "";
    document.getElementById('example2_length').parentElement.outerHTML = "";

  
    //fill category combo box
    $.ajax({
            url: '/maintenance/ppd/packages/get-search-names',
            type: 'GET',
            data: {
                table: 'tblnmedcategory',
                column: 'strNMedCatName'
            },
            success: function(data){
              var opt = "";

              for(var i = 0; i < data.length; i++){
                  opt = opt +
                    '<option>' +
                      data[i]['strNMedCatName'] +
                    '</option>'
                }

              document.getElementById('nlookfor').innerHTML = '<option disabled selected value>SEARCH</option>' + opt + '<option value="">ALL</option>';
            }, 
            error: function(){
            }
        });
  });

  $('#example').dataTable( {
    "pageLength": 10,
    "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false
            },
            {
                "targets": [ 5 ],
                "visible": false
            },
            {
                "targets": [ 6 ],
                "visible": false
            },
            {
                "targets": [ 7 ],
                "visible": false
            }
        ]
  } );

  $('#example2').dataTable( {
    "pageLength": 10,
    "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false
            }
        ]
  } );

  $("#mfilterby").on('change', function(){
    var sttbl;
    var stcol;

    if(document.getElementById('mfilterby').value == 0){
      sttbl = 'tblpmtheraclass';
      stcol = 'strPMTheraClassName';
    }else if(document.getElementById('mfilterby').value == 1){
      sttbl = 'tblpmmanufacturer';
      stcol = 'strPMManuName';
    }else if(document.getElementById('mfilterby').value == 2){
      sttbl = 'tblpmform';
      stcol = 'strPMFormName';
    }else{
      sttbl = 'tblpmpackaging';
      stcol = 'strPMPackName';
    }

    $.ajax({
            url: '/maintenance/ppd/packages/get-search-names',
            type: 'GET',
            data: {
                table: sttbl,
                column: stcol
            },
            success: function(data){
              var opt = "";

              for(var i = 0; i < data.length; i++){
                  opt = opt +
                    '<option>' +
                      data[i][stcol] +
                    '</option>'
                }

              document.getElementById('mlookfor').innerHTML = '<option disabled selected value>SEARCH</option>' + opt + '<option value="">ALL</option>';
            }, 
            error: function(){
            }
        });
  });

  $("#mlookfor").on('change', function(){
    var col;
    var cont = document.getElementById('mfilterby').value;

    if(cont == "0"){
      col = 4;
    }else if(cont == "1"){
      col = 5;
    }else if(cont == "2"){
      col = 6;
    }else if(cont == "3"){
      col = 7;
    }

    filterColumn(col, document.getElementById('mlookfor').value, "#example");
  })

  $("#nlookfor").on('change', function(){
    filterColumn(5, document.getElementById('nlookfor').value, "#example2");
  })

  function filterColumn (i,value, table) {
    $(table).DataTable().column( i ).search(
        value,
        true,
        true
      ).draw();
  }
</script>
<script>
  function reloadMember(){

    if((parseFloat(document.getElementById('rload').value) >= parseFloat('{{$ldmin}}'))){
      var total = parseFloat(document.getElementById('membal').value) + parseFloat(document.getElementById('rload').value);
      total = parseFloat(total).toFixed(2);

      $.ajax({
          url: "{{URL::to('/transaction/sell/reload-mem')}}",
          type: 'POST',
          data: {
              load: total,
              memcode: $('#edocmem').val()
          },
          success: function(data){
            document.getElementById('membal').value = total;
            document.getElementById('rload').value = "";
          }, 
          error: function(xhr){
            alert("error");
          }
      });
    }else{
      alert('INPUT NOT WITHIN ALLOWED INPUT AMOUNT');
      document.getElementById('rload').value = "";
    }
  }
</script>
<script>
  function showMed(){
    document.getElementById('medtbl').className="collapse in";
    document.getElementById('nmedtbl').className="collapse";
    document.getElementById('medmenu').className="btn btn-info";
    document.getElementById('nmedmenu').className="btn btn-primary";
  }
  function showNonMed(){
    document.getElementById('medtbl').className="collapse";
    document.getElementById('nmedtbl').className="collapse in";
    document.getElementById('nmedmenu').className="btn btn-info";
    document.getElementById('medmenu').className="btn btn-primary";
  }
</script>
<script>
  function setModalForm(pcode, pname, pprice){
    document.getElementById('pcode').value= pcode;
    document.getElementById('pname').value= pname;
    document.getElementById('pprice').value= pprice;
  }

  function addItem(){

    var code = document.getElementById('pcode').value;
    var name = document.getElementById('pname').value;
    var quantity = parseInt(document.getElementById('pqty').value);
    var price = document.getElementById('pprice').value;

    if(parseFloat(quantity)%1 === 0 && quantity != 0){
      var isexisting = isItemAdded(code);

      if(isexisting == 0){
        var $table = $("#purchased");

      var newTR = $("<tr>" + 
                    "<td><button class=\"delete\" onclick=\"deductAmt("+(quantity * price)+")\">x</button></td>" + 
                    "<td>"
                      + code + 
                    "</td>" + 
                    "<td>" 
                      + name +
                    "</td>" + 
                    "<td>" 
                      + price +
                    "</td>" + 
                    "<td>" 
                      + quantity +
                    "</td>" + 
                    "<td>" 
                      + (quantity * price) +
                    "</td>"
                    + "</tr>");

      $table.append(newTR);
      }else{
        tempqty = quantity;
        quantity = parseInt(document.getElementById('purchased').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[4].innerHTML) + parseInt(quantity);
        document.getElementById('purchased').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[0].innerHTML = "<button class=\"delete\" onclick=\"deductAmt("+(quantity * price)+")\">x</button>";
        document.getElementById('purchased').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[4].innerHTML = quantity.toString();
        document.getElementById('purchased').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[5].innerHTML = (quantity * parseFloat(price)).toString();
        quantity = tempqty;
      }

      var subt = parseFloat(document.getElementById('subt').value) + (quantity * price);
      var disc = parseFloat(document.getElementById('discamt').value);

      var temp = subt + (subt * 0.12);

      document.getElementById('grandt').value = (temp - (temp * (disc/100))).toFixed(2);

      document.getElementById('subt').value = parseFloat(document.getElementById('subt').value) + (quantity * price);
    }else{
      alert('please input a valid integer');
    }
    document.getElementById('pqty').value = "";
  }

  function collectItems(){
    for(var i = 1; i < document.getElementById('purchased').rows.length; i++){
      document.getElementById('prodcode').value = document.getElementById('prodcode').value + document.getElementById('purchased').getElementsByTagName('TR')[i].getElementsByTagName('TD')[1].innerHTML + ";";
      document.getElementById('prodname').value = document.getElementById('prodname').value + document.getElementById('purchased').getElementsByTagName('TR')[i].getElementsByTagName('TD')[2].innerHTML + ";";
      document.getElementById('prodprice').value = document.getElementById('prodprice').value + document.getElementById('purchased').getElementsByTagName('TR')[i].getElementsByTagName('TD')[3].innerHTML + ";";
      document.getElementById('prodqty').value = document.getElementById('prodqty').value + document.getElementById('purchased').getElementsByTagName('TR')[i].getElementsByTagName('TD')[4].innerHTML + ";";
      document.getElementById('prodamt').value = document.getElementById('prodamt').value + document.getElementById('purchased').getElementsByTagName('TR')[i].getElementsByTagName('TD')[5].innerHTML + ";";
    }
  }
</script>
<script>
  function setDiscount(){
    if(document.getElementById('discchk').checked == true){
      document.getElementById('disc').removeAttribute("disabled");
    }else{
      document.getElementById('disc').value = "0";
      document.getElementById('disc').setAttribute("disabled","");
      document.getElementById('discamt').value="0";
      addDiscount();
    }
  }

  function addDiscount(){
    if(parseFloat(document.getElementById('disc').value) < 1){
      document.getElementById('discamt').value = (parseFloat(document.getElementById('disc').value) * 100).toString() + "%";
      
      if(document.getElementById('disc').selectedIndex > 0){
        document.getElementById('proddisc').value = document.getElementById('disc').options[document.getElementById('disc').selectedIndex].innerHTML;
      }else{
       document.getElementById('proddisc').value = ""; 
      }
        var subt = parseFloat(document.getElementById('subt').value);
        var disc = parseFloat(document.getElementById('discamt').value);

        var temp = subt + (subt * 0.12);

      document.getElementById('grandt').value = (temp - (temp * (disc/100))).toFixed(2) ;
    }else{
        document.getElementById('discamt').value = "Php " + document.getElementById('disc').value ;

        if(document.getElementById('disc').selectedIndex > 0){
          document.getElementById('proddisc').value = document.getElementById('disc').value;
        }else{
          document.getElementById('proddisc').value = ""; 
        }

        var subt = parseFloat(document.getElementById('subt').value);
        var disc = parseFloat(document.getElementById('disc').value);

        if(subt - disc <= 0){
          document.getElementById('grandt').value = "0";
        }else{
          document.getElementById('grandt').value = (subt-disc).toFixed(2);
        }
    }
  }
</script>
<script type="text/javascript">
  $("#purchased").on('click', '.delete', function () {
      
      $(this).closest('tr').remove();

  });
</script>
<script>
  function deductAmt(amt){
    document.getElementById('subt').value = parseFloat(document.getElementById('subt').value) - amt;
      var subt = parseFloat(document.getElementById('subt').value);
      var disc = parseFloat(document.getElementById('discamt').value);

      var temp = subt + (subt * 0.12);

      document.getElementById('grandt').value = temp - (temp * (disc/100));
  }
</script>
<script>
  function checkGrandTotal(){
    if(parseFloat(document.getElementById('grandt').value) > 0){
      $('#cardid').modal('show');
    }else{
      alert('Please choose products first');
    }
  }
   function checkPinCode(){
    if(document.getElementById('nipcode').value == document.getElementById('edocnip').value){
      getMemDetails();
      $('#carddet').modal('show');
    }else{
      alert('WRONG PASSWORD');
    }
   }
  function checkMemAmount(){
    if(parseFloat(document.getElementById('grandt').value) 
        <= parseFloat(document.getElementById('membal').value)){

      document.getElementById('btnreceipt').removeAttribute("disabled");
    }else{
      document.getElementById('btnreceipt').setAttribute("disabled",""  );
    }
  }
  function checkCashAmount(){
    if( (parseFloat(document.getElementById('grandt').value) 
        <= parseFloat(document.getElementById('amtpaid').value))
        && parseFloat(document.getElementById('grandt').value) > 0){
        $('#transum').modal('show');

        //---

        document.getElementById('sumsubt').value  = document.getElementById('subt').value;
        document.getElementById('sumdisc').value  = document.getElementById('disc').value;
        document.getElementById('sumtax').value   = "12%";
        document.getElementById('sumgrant').value = (parseFloat(document.getElementById('grandt').value).toFixed(2)).toString();
        document.getElementById('sumamt').value   = document.getElementById('amtpaid').value;
        document.getElementById('sumchan').value  = ((parseFloat(document.getElementById('amtpaid').value) - parseFloat(document.getElementById('grandt').value)).toFixed(2)).toString();

        collectItems();
    }else{
      alert('Payment cannot be processed');
    }

    document.getElementById('amtpaid').value = "";
  }
  function checkBalance(){
    if( (parseFloat(document.getElementById('grandt').value) 
        <= parseFloat(document.getElementById('membal').value))
        && parseFloat(document.getElementById('grandt').value) > 0){
        $('#transum').modal('show');

        //---

        document.getElementById('sumsubt').value  = document.getElementById('subt').value;
        document.getElementById('sumdisc').value  = document.getElementById('disc').value;
        document.getElementById('sumtax').value   = "12%";
        document.getElementById('sumgrant').value = (parseFloat(document.getElementById('grandt').value).toFixed(2)).toString();
        document.getElementById('sumamt').value   =  document.getElementById('sumgrant').value;
        document.getElementById('sumchan').value  = "0";
        document.getElementById('prodmemname').value = document.getElementById('memname').value;
        document.getElementById('prodbal').value = (parseFloat(parseFloat(document.getElementById('membal').value) - parseFloat(document.getElementById('grandt').value)).toFixed(2)).toString();        
        document.getElementById('prodmemcode').value = document.getElementById('edocmem').value;

        if(
            ( parseFloat(document.getElementById('sumgrant').value) >= parseFloat('{{$ptmin}}') )
          ){
            var perc = parseFloat(parseFloat('{{$ptperc}}') / 100).toFixed(2);
            document.getElementById('prodpts').value = (parseFloat(parseFloat(document.getElementById('sumgrant').value)*perc).toFixed(2)).toString();
        }else{
          document.getElementById('prodpts').value = "0"; 
        }

        collectItems();
    }else{
      alert('Payment cannot be processed');
    }
  }
  function isItemAdded(term){
    //returns 0 if not return row if existing
    var itemrow = 0
    var column = 1;                            // which column to search
    var pattern = new RegExp(term, 'g');       // make search more flexible 
    var table = document.getElementById('purchased');
    var tr = table.getElementsByTagName('TR');
    for(var i = 0; i < tr.length; i++){
      var td = tr[i].getElementsByTagName('TD');
      for(var j = 0; j < td.length; j++){
        if(j == column && td[j].innerHTML == term){

        // for more flexibility use match() function and the pattern built above
        // if(j == column && td[j].innerHTML.match(pattern)){
          //alert(td[j].innerHTML + " ROW: " + i.toString());
          itemrow = i;
          break;
        }
      }    
    }
    return itemrow;
  }
</script>
<script>
  function getMemDetails(){
        $.ajax({
            url: '/transaction/sell/get-mem-details',
            type: 'GET',
            data: {
                memcode: $('#edocmem').val()
            },
            success: function(data){
                $('#memname').val(data[0]['strMemFName'] + " " + data[0]['strMemMName'] + " " + data[0]['strMemLName']);
                $('#membal').val(data[0]['decMCreditValue']);
            }, 
              error: function(xhr){
                $('#memname').val("");
                $('#membal').val("");
              }
        });
  }
</script>
@stop 