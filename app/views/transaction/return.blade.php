@extends('....layout')

@section('page-title')
    Accept A Return
@stop

@section('other-scripts')
{{HTML::script('bootflat-admin/js/datatables.min.js')}}
@stop

@section('content')
<div class="panel-body">
  <div class="content-row">
    <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp Accept Return
      <hr>
      </h5></center>

    <!-- OR# and Customer --> 
    <div class="panel panel-default col-md-12">
        <center>
        <label class="control-label">Transaction ID:</label>
        <select id="translistid" onchange="setInfo()" name="selecter_basic" class="selecter_3" data-selecter-options='{"cover":"true"}'>
            <option selected disabled="" value="0"> --CHOOSE TRANSACTION-- </option>
            <?php
              $results = DB::select('SELECT strTransId FROM tblTransaction');

              foreach($results as $data){
                echo '<option value="'.$data->strTransId.'">'.$data->strTransId.'</option>';
              }
            ?>
        </select>
        </center>
    </div>
    <!-- END -->

    <!-- Product List and Chosen Products List -->
    <div class="panel panel-default col-md-12">
      <div class="panel-body col-md-6">
        <div class="panel panel-header">
          <center>
            <h5>Bought Products</h5>
          </center>
        </div>
        <div class="panel-body" style="height:500px;">
          <input type="hidden" id="code">
          <input type="hidden" id="price">
          <input type="hidden" id="qty">
          <input type="hidden" id="row">
            <table id="bought" class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Return</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>

      <div class="modal fade" id="modalqty" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">Quantity</h6>
              </div>
              <div class="modal-body">
                <center>
                <label>Pieces to be returned:</label> 
                <input  class="form-control" type="number" id="pcqty" name="pcqty" min="0.00" step="0.01" pattern="/^[0-9]+(\.[0-9]{1,2})?$/">
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="checkQuantity()">Confirm</button>
              </div>
            </div>
          </div>
        </div>

      <!-- second half-->
      <div class="panel-body col-md-6">
        <div class="panel panel-header">
          <center>
            <h5>Returned Products</h5>
          </center>
        </div>
        <div class="panel-body" style="height:500px;">
            <table id="returned" class="table table-condensed table-hover">
              <thead>
              <tr>
                <th>Remove</th>
                <th>Product Code</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
      </div>
    </div>
    <!-- END -->
    <form role="form" method="post" action="{{URL::to('/transaction/return/save')}}">
      <div class="col-md-6">
       <div class="form-group">
        <div class="input-group" style="width: 800px;">
            <input type="hidden" name="retid" value="{{$retid}}">
            <div class="form-group">
            <label class="control-label col-md-2" style="padding-right:0px">
              Transaction ID:
            </label>
            <div class="col-md-5">
              <input id="transid" type="text"  name="transid" class="form-control" readonly>
            </div>
            </div>
          </div>
          <div class="input-group" style="width: 800px;">
            <label class="control-label col-md-2">
              Date:
            </label>
            <div class="col-md-5">
              <input id="date" name="date" type="text"  class="form-control" readonly>
            </div>
          </div>
          <div class="input-group" style="width: 800px;">
            <label class="control-label col-md-2">
              Pharmacist:
            </label>
            <div class="col-md-5">
              <input id="pharmacist" type="text" name="pharmacist" class="form-control" readonly>
            </div>
          </div>
          <div class="input-group" style="width: 800px;">
            <label class="control-label col-md-2">
              Customer:
            </label>
            <div class="col-md-5">
              <input id="cust" type="text" name="cust" class="form-control" required readonly>
            </div>
          </div>
       </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <div class="col-md-12">
            <center>
             <label class="control-label col-md-4">
              <h5>TOTAL:</h5>
              </label>
              <div class="col-md-8">
                <input id="totalreturns" type="text"  class="form-control" name="totalreturns" required readonly>
              </div>
            </center>
          </div>
          <div class="col-md-12">
            <center>
            <button type="submit" id="btncash" disabled class="btn btn-danger col-md-12" >GENERATE RETURN SLIP</button>
            </center>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

@stop

@section('internal-scripts')
<script>
  function addItem(){

    var code = document.getElementById('code').value;
    var quantity = parseInt(document.getElementById('pcqty').value);
    var price = document.getElementById('price').value;

    if(parseFloat(quantity)%1 === 0 && quantity != 0){
      var isexisting = isItemAdded(code);

      if(isexisting == 0){
        var $table = $("#returned");

        var newTR = $("<tr>" + 
                    "<td><button class=\"delete\" onclick=\"deductAmt("+(quantity * price)+")\">x</button></td>" + 
                    "<td>"
                      + code + 
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
        quantity = parseInt(document.getElementById('returned').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[3].innerHTML) + parseInt(quantity);
        document.getElementById('returned').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[0].innerHTML = "<button class=\"delete\" onclick=\"deductAmt("+(quantity * price)+")\">x</button>";
        document.getElementById('returned').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[3].innerHTML = quantity.toString();
        document.getElementById('returned').getElementsByTagName('TR')[isexisting].getElementsByTagName('TD')[4].innerHTML = (quantity * parseFloat(price)).toString();
        quantity = tempqty;
      }
      setTotal();
    }else{
      alert('please input a valid integer');
    }
    document.getElementById('qty').value = "";
    document.getElementById('btncash').removeAttribute('disabled');
  }
</script>
<script type="text/javascript">
  $("#returned").on('click', '.delete', function () {
      
      $(this).closest('tr').remove();

  });
</script>
<script>
  function deductAmt(amt){
    document.getElementById('totalreturns').value = parseFloat(parseFloat(document.getElementById('totalreturns').value) - amt).toFixed(2);
    if(parseFloat(document.getElementById('totalreturns').value) == 0){ 
      document.getElementById('btncash').setAttribute('disabled','');
    }
  }

  function isItemAdded(term){
    //returns 0 if not return row if existing
    var itemrow = 0
    var column = 1;                            // which column to search
    var pattern = new RegExp(term, 'g');       // make search more flexible 
    var table = document.getElementById('returned');
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
  function checkQuantity(){
    if(parseInt(document.getElementById('pcqty').value) <= parseInt(document.getElementById('qty').value)){
      addItem();
    }else{
      alert('INVALID QUANTITY');
    }
  }
</script>
<script>
  function setInfo(){
    $('#bought tr:gt(0)').remove();
    $('#returned tr:gt(0)').remove();
    document.getElementById('totalreturns').value = "";
    $.ajax({
            url: '/transaction/return/trans-info',
            type: 'GET',
            data: {
                transcode: document.getElementById('translistid').value
            },
            success: function(data){
              document.getElementById('transid').value = document.getElementById('translistid').value;
              document.getElementById('date').value = data[0]['dtmTransDate'];
              document.getElementById('pharmacist').value = 'Luis Guballo';
              document.getElementById('cust').value = data[0]['customer'];
              if(data[0]['customer'] == null){
                document.getElementById('cust').removeAttribute('readonly');
              }else{
                document.getElementById('cust').setAttribute('readonly','');
              }
            }, 
              error: function(xhr){
              }
        });

    $.ajax({
            url: '/transaction/return/trans-det',
            type: 'GET',
            data: {
                transcode: document.getElementById('translistid').value
            },
            success: function(data2){
              for(var i = 0; i < data2.length; i++){
                var $table = $("#bought");

                var newTR = $("<tr>" + 
                    "<td>"
                      + data2[i]['strTDProdCode'] + 
                    "</td>" + 
                    "<td>" 
                      + data2[i]['decProdPricePerPiece'] +
                    "</td>" + 
                    "<td>" 
                      + data2[i]['intQuantity'] +
                    "</td>" + 
                    "<td>" 
                      + data2[i]['total'] +
                    "</td>" + 
                    "<td>"+
                    "<button onclick=\"setData('" + 
                      data2[i]['strTDProdCode'] + "','" + 
                      data2[i]['decProdPricePerPiece'] + "'," + 
                      data2[i]['intQuantity'] + "," + 
                      i + ")\">></button></td>" + 
                    + "</tr>");

                $table.append(newTR);
              }
            }, 
              error: function(xhr){
              }
        });
  }
  function setData(code, price, quantity, row){
    document.getElementById('code').value = code;
    document.getElementById('price').value = price;
    document.getElementById('qty').value = quantity;
    document.getElementById('row').value = row;
    $('#modalqty').modal('show');
  }
  function setTotal(){
    var counter = 0;
    for(var i = 1; i < document.getElementById('returned').rows.length; i++){
      counter = counter + parseFloat(document.getElementById('returned').getElementsByTagName('TR')[i].getElementsByTagName('TD')[4].innerHTML);
    }
    document.getElementById('totalreturns').value = "" + (counter.toFixed(2)).toString();
  }
</script>
@stop 