@extends('....layout')

@section('page-title')
    Maintenance - Employee
@stop

@section('other-scripts')
    {{HTML::script('bootflat-admin/js/datatables.min.js')}}
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').DataTable();
      $('#prod').DataTable();
      $('#part').DataTable();
		} );
	</script>
@stop

@section('content')
<div class="panel-body">
                <div class="content-row">
                  
                  <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-gift"></i>&nbsp Electronic Gift Check - Member
                  <hr>
                  </h5></center>

                    <div class = "row">
                      <div class = "col-md-6">
                        <button id="btncash" type="button" class="btn btn-primary btn-block" href="#cash" data-toggle="collapse" onclick="document.getElementById('prods').className= 'collapse'">CASH</button>
                      </div>
                      <div class = "col-md-6">
                        <button id="btnprod" type="button" class="btn btn-primary btn-block" href="#prods" data-toggle="collapse" onclick="document.getElementById('cash').className= 'collapse'">PRODUCTS</button>
                      </div>
                    </div>
                    <button id="egrcpt" style="visibility:hidden"></button>

                    <!-- forms -->
                    <div class ="row">
                      <div class="col-md-offset-1 col-md-9">
                            <form role="form" class="form-horizontal" method="post" action="{{URL::to('/transaction/egc/submit-nm-cash')}}">
                              <div id="cash" class="collapse"><!-- CASH -->
                                <div class="col-md-12">
                                  <div class="col-md-5">
                                    <div class = "form-group">
                                      <label class = "col-md-8 control-label"><h5> Customer Details </h5></label>
                                    </div>

                                    <div class="form-group">
                                      <label class = "col-md-3 control-label">Customer Name</label>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control" id="custname" name="custname" required maxlength="200">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class = "col-md-3 control-label">Contact Number</label>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control" maxlength="11" id="custnum" name="custnum">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class = "col-md-3 control-label">Amount</label>
                                      <div class="col-md-9">
                                        <input type="number"  class="form-control" maxlength="11" required id="amt" name="amt">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-offset-2 col-md-5">
                                    <div class = "form-group">
                                      <label class = "col-md-10 control-label"><h5>Beneficiary Details</h5></label>
                                    </div>

                                    <div class="form-group">
                                      <label class = "col-md-3 control-label">Beneficiary Name</label>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control" required maxlength="200" id="benname" name="benname">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class = "col-md-3 control-label">Contact Number</label>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control" required maxlength="11" id="bennum" name="bennum">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                  <div class="col-md-offset-7 col-md-5">
                                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                                    <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
                                  </div>
                                </div>
                              </div>
                          </form>
                          <form role="form" class="form-horizontal" method="post" action="{{URL::to('/transaction/egc/submit-nm-prod')}}">
                              <div id="prods" class="collapse">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                      <div class = "form-group">
                                        <label class = "col-md-8 control-label"><h5> Customer Details </h5></label>
                                      </div>

                                      <div class="form-group">
                                        <label class = "col-md-3 control-label">Customer Name</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" id="custname" name="custname" required maxlength="200">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class = "col-md-3 control-label">Contact Number</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" maxlength="11" id="custnum" name="custnum">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-offset-2 col-md-5">
                                      <div class = "form-group">
                                        <label class = "col-md-10 control-label"><h5>Beneficiary Details</h5></label>
                                      </div>

                                      <div class="form-group">
                                        <label class = "col-md-3 control-label">Beneficiary Name</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" required maxlength="200" id="benname" name="benname">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class = "col-md-3 control-label">Contact Number</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" required maxlength="11" id="bennum" name="bennum">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class = "form-group">
                                      <label class = "col-md-9 control-label"><h5>SELECT PRODUCTS</h5></label>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-3">FILTER</label>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-4">Type:</label>
                                      <div class="col-md-8">
                                        <select id = "type" name="type" class = "form-control">
                                          <option disabled selected value>TYPE</option>
                                          <option value="0">MEDICINE</option>
                                          <option value="1">NON MEDICINE</option>
                                          <option value="">ALL</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-4">Filter by:</label>
                                      <div class="col-md-8">
                                        <select id = "filterby" name="filterby" class = "form-control">
                                          <option disabled selected value>SUBTYPE</option>
                                          <option value="">ALL</option>
                                        </select>
                                      </div>
                                    </div>

                                    <input type="hidden" id="sttbl">
                                    <input type="hidden" id="stcol">

                                    <div class="form-group">
                                      <label class="control-label col-md-4">Look for:</label>
                                      <div class="col-md-8">
                                        <select id = "lookfor" name="lookfor" class = "form-control">
                                          <option disabled selected value>SEARCH</option>
                                          <option value="">ALL</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="table-responsive">
                                      <table id="prod" class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="prod_info" style="width: 100%;">
                                        <thead>
                                          <tr>
                                            <th colspan="3"><font color="red">PRODUCT LIST</font></th>
                                          </tr>
                                          <tr role="row">
                                            <th>Products</th>
                                            <th>Price</th>
                                            <th>ADD</th>
                                            <th>Type</th>
                                            <th>Thera</th>
                                            <th>Manu</th>
                                            <th>Form</th>
                                            <th>Pack</th>
                                            <th>Cate</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $counter = 0;

                                            $results = DB::select("SELECT 
                                                                    p.strProdCode,
                                                                    p.strProdType,
                                                                    b.strPMBranName,
                                                                    (
                                                                      SELECT group_concat(g.strPMGenName SEPARATOR ' ') 
                                                                      FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode
                                                                      WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode
                                                                    ) as 'GenNames',
                                                                    t.strPMTheraClassName,
                                                                    mn.strPMManuName,
                                                                    f.strPMFormName,
                                                                    pk.strPMPackName,
                                                                    concat(m.decProdMedSize, ' ', u.strUOMName) as 'MedSize',
                                                                    
                                                                    nm.strProdNMedName,
                                                                    c.strNMedCatName,
                                                                    concat_ws(' ', g.strGenSizeName, s.decNMStanSize, un.strUOMName) as 'NMedSize',
                                                                    
                                                                    pr.decProdPricePerPiece
                                                                      
                                                                  FROM tblproducts p

                                                                  LEFT JOIN tblprodmed m
                                                                    ON p.strProdCode = m.strProdMedCode
                                                                  LEFT JOIN tblprodnonmed nm
                                                                    ON p.strProdCode = nm.strProdNMedCode
                                                                  LEFT JOIN tblProdPrice pr
                                                                    ON p.strProdCode = pr.strProdPriceCode

                                                                  LEFT JOIN tblprodmedbranded b
                                                                    ON m.strProdMedBranCode = b.strPMBranCode
                                                                  LEFT JOIN tblpmtheraclass t
                                                                    ON m.strProdMedTheraCode = t.strPMTheraClassCode
                                                                  LEFT JOIN tblpmmanufacturer mn
                                                                    ON m.strProdMedManuCode = mn.strPMManuCode
                                                                  LEFT JOIN tblpmform f
                                                                    ON m.strProdMedFormCode = f.strPMFormCode
                                                                  LEFT JOIN tbluom u 
                                                                    ON m.strProdMedDosCode = u.strUOMCode
                                                                  LEFT JOIN tblpmpackaging pk
                                                                    ON m.strProdMedPackCode = pk.strPMPackCode
                                                                    
                                                                  LEFT JOIN tblnmedcategory c
                                                                    ON nm.strProdNMedCatCode = c.strNMedCatCode
                                                                  LEFT JOIN tblnmedgeneral gt
                                                                    ON nm.strProdNMedCode = gt.strNMGenCode
                                                                  LEFT JOIN tblgensize g
                                                                    ON gt.strNMGenSizeCode = g.strGenSizeCode
                                                                  LEFT JOIN tblnmedstandard s
                                                                    ON nm.strProdNMedCode = s.strNMStanCode
                                                                  LEFT JOIN tbluom un
                                                                    ON s.strNMStanUOMCode = un.strUOMCode
                                                                    
                                                                  WHERE p.intStatus = 1;");
                                            
                                            foreach($results as $data){
                                              if($counter%2 == 0){
                                                $trClass="even";
                                              }else{
                                                $trClass="odd";
                                              }

                                              $counter++;

                                              echo '<tr role="row" class="'.$trClass.'">';

                                              if($data->strProdType == 0){
                                                $namesung = $data->strPMBranName.' ('.$data->GenNames.') '.$data->MedSize;
                                                echo '<td>'.$namesung.'</td>';
                                              }else{
                                                $namesung = $data->strProdNMedName.' '.$data->NMedSize;
                                                echo '<td>'.$namesung.'</td>';
                                              }

                                              echo '<td>'.$data->decProdPricePerPiece.'</td>';
                                              echo '<td><button type="button" onclick="setAddingMessage(\''.$data->strProdCode.'\',\''.$namesung.'\',\''.$data->decProdPricePerPiece.'\')" class="btn btn-primary btn-block">+</button></td>';
                                              echo '<td>'.$data->strProdType.'</td>';
                                              echo '<td>'.$data->strPMTheraClassName.'</td>';
                                              echo '<td>'.$data->strPMManuName.'</td>';
                                              echo '<td>'.$data->strPMFormName.'</td>';
                                              echo '<td>'.$data->strPMPackName.'</td>';
                                              echo '<td>'.$data->strNMedCatName.'</td>';
                                              echo '</tr>';
                                            }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>

                                      <div class="col-md-6">
                                        <input type="hidden" id="packprods" name="packprods">
                                        <input type="hidden" id="packqty" name="packqty">
                                        <div class="table-responsive">
                                          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                          <table id="part" class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th colspan="4"><font color="red">SELECTED PRODUCTS</font></th>
                                                </tr>
                                                <tr role="row">
                                                  <th>Remove</th>
                                                  <th>Products</th>
                                                  <th>Price</th>
                                                  <th>Quantity</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                          </table>
                                        </div>
                                      </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-offset-1 col-md-3">Total Price</label>
                                  <div class="col-md-8">
                                      <input type="text" readonly class="form-control" id="totalpr" name="totalpr" value="0">
                                  </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                  <div class="col-md-offset-7 col-md-5">
                                    <button type="submit" onclick="collectQty()" class="btn btn-info" data-toggle="modal" data-target="#Submit">Submit</button>
                                    <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
                                  </div>
                                </div>
                              </div>
                          </form>
                        </div>
                            <div id="add_prod" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-dialog modal-md">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                      <br>

                                                        <div class="modal-body">
                                                          <div class="col-md-offset-2 col-md-8">
                                                            <input type="hidden" id="us_code">
                                                            <div class="form-group">
                                                              <label class="col-md-3 control-label"> Product: </label>
                                                              <div class="col-md-9">
                                                                <input type="text" class="form-control" id="us_name" readonly>
                                                              </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label class="col-md-3 control-label"> Price: </label>
                                                              <div class="col-md-9">
                                                                <input type="text" class="form-control" id="us_price" readonly>
                                                              </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label class="col-md-3 control-label"> Quantity: </label>
                                                              <div class="col-md-9">
                                                                <input type="number" class="form-control" id="us_qty" maxlength="100">
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                          <br>
                                                        <div class="modal-footer">
                                                          <button type="button" onclick="addToPackage()" class="col-md-offset-10 col-md-2 btn btn-primary" data-dismiss="modal">OK</button>
                                                       </div>
                                                      </div>
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
@stop

@section('internal-scripts')
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
  <script>
    @if(Session::get('ecode') != null)
      $("#egrcpt").on('click', function(){
      @if(Session::get('type') == '0')
        window.open("/transaction/egc/generate-nm-cash-receipt/" + "{{Session::get('ecode')}}");
      @else
        window.open("/transaction/egc/generate-nm-prod-receipt/" + "{{Session::get('ecode')}}");
      @endif
      });
      $("#egrcpt").click();
    @endif
  </script>
  <script type="text/javascript">
    function collectQty(){
      var arr = [];

      $("#part tr").each(function(){
          arr.push($(this).find("td:last").text());
      });

      for (i=0;i<arr.length;i++)
      {
        document.getElementById('packqty').value = (arr[i] + ";" + document.getElementById('packqty').value);
      }
    }
  </script>
<script type="text/javascript">
  $(document).ready(function(){
  });

  function qtyedit(x){
    x.innerHTML = "<input onkeypress='heyhehehe(event)' id='edittxt' type='number' value='" + x.innerHTML + "'>";
    document.getElementById('edittxt').focus();
  }

  function heyhehehe(e){
    if(e.keyCode == 13){
      document.getElementById('edittxt').outerHTML = document.getElementById('edittxt').value;
    }
  }

  function setAddingMessage(code, name, price){

    if(document.getElementById('packprods').value.indexOf(code) != -1){
      $("#add_prod").modal("hide");
      alert('ITEM ALREADY IN THE SELECTED PRODUCTS!');
    }else{
      document.getElementById('us_code').value = code;
      document.getElementById('us_name').value = name;
      document.getElementById('us_price').value = price;
      $("#add_prod").modal("show");
      document.getElementById('us_qty').focus();
    }
  }

  function addToPackage(){

   $('#part').DataTable().row.add( [
          '<button onclick="removeRow(this);"; class="btn btn-danger btn-block" type="button"  data-toggle="modal" data-target="#myConfirm"><i class="glyphicon glyphicon-remove"></i></button>',
          
          document.getElementById('us_name').value,
          document.getElementById('us_price').value,
          document.getElementById('us_qty').value
      ] ).draw();

    document.getElementById('packprods').value = document.getElementById('packprods').value + document.getElementById('us_code').value + ";";
    var table = document.getElementById("part");
    var row = table.rows[table.rows.length - 1];
    var cell = row.cells[3];

    cell.outerHTML = '<td ondblclick="qtyedit(this)">' + cell.innerHTML + '</td>';

    var cell = row.cells[0];

    cell.outerHTML = '<td>' + 
                     '<button onclick="removeRow(this,\''+document.getElementById('us_code').value +'\');"; class="btn btn-danger btn-block" type="button"  data-toggle="modal" data-target="#myConfirm"><i class="glyphicon glyphicon-remove"></i></button>' +
                     '</td>';

    document.getElementById('totalpr').value = parseFloat(document.getElementById('totalpr').value) + parseFloat(parseFloat(document.getElementById('us_price').value) * parseFloat(document.getElementById('us_qty').value));
  }

  function removeRow(x, code){

    $('#part').DataTable().row($(x).parents('tr')).remove().draw();

    document.getElementById('packprods').value = document.getElementById('packprods').value.replace(code,"");

    document.getElementById('totalpr').value = parseFloat(document.getElementById('totalpr').value) - parseFloat(parseFloat(x.parentElement.parentElement.cells[2].innerHTML) * parseFloat(x.parentElement.parentElement.cells[3].innerHTML));
  }
</script>
<script>
  $(document).ready(function(){
    document.getElementById('prod_length').parentElement.outerHTML = "";
    document.getElementById('part_length').parentElement.outerHTML = "";
  });

  $('#prod').dataTable( {
    "pageLength": 5,
    "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false
            },
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
            },
            {
                "targets": [ 8 ],
                "visible": false
            }
        ]
  } );

  $('#part').dataTable( {
    "pageLength": 5
  } );

  $("#type").on('change', function(){
    setFilterBy(document.getElementById('type').value);
    filterColumn(3, document.getElementById('type').value);
  });

  $("#filterby").on('change', function(){
    var sttbl;
    var stcol;

    if(document.getElementById('type').value == 1){
      sttbl = 'tblNMedCategory';
      stcol = 'strNMedCatName';
    }else{
      if(document.getElementById('filterby').value == 0){
        sttbl = 'tblpmtheraclass';
        stcol = 'strPMTheraClassName';
      }else if(document.getElementById('filterby').value == 1){
        sttbl = 'tblpmmanufacturer';
        stcol = 'strPMManuName';
      }else if(document.getElementById('filterby').value == 2){
        sttbl = 'tblpmform';
        stcol = 'strPMFormName';
      }else{
        sttbl = 'tblpmpackaging';
        stcol = 'strPMPackName';
      }
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

              document.getElementById('lookfor').innerHTML = '<option disabled selected value>SEARCH</option>' + opt + '<option value="">ALL</option>';
            }, 
            error: function(){
            }
        });
  });

  $("#lookfor").on('change', function(){
    var col;
    var cont = document.getElementById('filterby').value;

    if(cont == "0"){
      col = 4;
    }else if(cont == "1"){
      col = 5;
    }else if(cont == "2"){
      col = 6;
    }else if(cont == "3"){
      col = 7;
    }else{
      col = 8;
    }

    filterColumn(col, document.getElementById('lookfor').value);
  })
  
  function setFilterBy(type){
    if(type == 0){
      document.getElementById('filterby').innerHTML = 
      '<option disabled selected value>SUBTYPE</option>' +
      '<option value="0">Therapeutic Class</option>' +
      '<option value="1">Manufacturer</option>' +
      '<option value="2">Medicine Form</option>' +
      '<option value="3">Medicine Packaging</option>' +
      '<option value="">ALL</option>';
    }else if(type == 1){
      document.getElementById('filterby').innerHTML = 
      '<option disabled selected value>SUBTYPE</option>' +
      '<option>Categories</option>' +
      '<option value="">ALL</option>';
    }else{
      document.getElementById('filterby').innerHTML = 
      '<option disabled selected value>SUBTYPE</option>' +
      '<option value="">ALL</option>';
    }
  }

  function filterColumn (i,value) {
    $('#prod').DataTable().column( i ).search(
        value,
        true,
        true
      ).draw();
  }
</script>
@stop
