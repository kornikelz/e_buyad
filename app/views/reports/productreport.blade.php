@extends('....layout')

@section('page-title')
    Sales Reports
@stop

@section('other-scripts')
    {{HTML::script('bootflat-admin/js/datatables.min.js')}}
    {{HTML::style('bootflat-admin/css/custom.css')}}

    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').DataTable( {
        "searching": false
        "lengthChange": false
      }  );
    } );
  </script>

@stop

@section('content')
<div class="panel-body">
  <div class="content-row">  
    <center>
      <h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-list-alt"></i>&nbsp Product Sales Report
      <hr>
      </h5>
    </center>
    
    <div class="col-md-12">
      <form id="medform" role="form" class="form-horizontal" method="post" action= "">
        <div class="col-md-4 pull-right">
          <div class="form-group"><div class="col-md-2"></div>
            <div class="col-md-2">
              <button class="btn btn-info" style="width:300px;height:100px">Generate Report</button><br>
              <button type="submit" id="btnpdf" class="btn btn-danger" style="width:300px;height:100px">Generate PDF</button>
            </div>
          </div>
        </div>


        <div class="col-md-8 pull-left">
          <div class="radio">
            <label class="control-label col-md-2" style="padding-right:3.2%">
              <input onclick="radioClicked('a')" type="radio" required>Fixed Range:
            </label>
            <div class="col-md-6">
              <select class = "form-control" required onchange="range()" id="fixed" name="fixed">
                <option disabled selected value> -- SELECT RANGE -- </option>
                <option value="0">Daily</option>
                <option value="1">Weekly</option>
                <option value="2">Monthly</option>
                <option value="3">Quarterly</option>
                <option value="4">Annual</option>                    
              </select>
            </div>
          </div>
         </div> 
       
        <div class="col-md-8" id="daily" hidden>
          <label class="control-label col-md-8">
            <div id="daily" class="col-md-4 pull-left">
              <input type="checkbox"> Set Date:
            </div>
            <div id="daily" class="col-md-8 pull-right">
              <input type="date" id="start" class="form-control" name="start" min="1900-01-01" max="2016-08-29" required>
            </div>
          </label>
        </div>
        
        <div class="col-md-8" id="weekly" hidden>
          <label class="control-label col-md-8">
            <div id="weekly" class="col-md-4 pull-left">
              <input type="checkbox"> Set Last Date of the Week:
            </div>
            <div id="weekly" class="col-md-8 pull-right">
              <input type="date" id="start" class="form-control" name="start" min="1900-01-01" max="2016-08-29">
            </div>
          </label>
        </div>

        <div class="col-md-8" id="monthly" hidden>
          <label class="control-label col-md-8">
            <div id="monthly" class="col-md-4 pull-left">
              <input type="checkbox"> Set Month:
            </div>
            <div id="monthly" class="col-md-8 pull-right">
              <select class = "form-control" required>
                <option disabled selected value> -- SELECT MONTH -- </option>
                <option>January</option>
                <option>February</option>     
                <option>March</option> 
                <option>April</option> 
                <option>May</option>              
                <option>June</option> 
                <option>July</option> 
                <option>August</option> 
                <option>September</option> 
                <option>October</option> 
                <option>November</option> 
                <option>December</option> 
              </select>
              <select class = "form-control" required>
                <option disabled selected value> -- SELECT YEAR -- </option>
                <option>2016</option>
                <option>2015</option>     
              </select>
            </div>
          </label>
        </div>

        <div class="col-md-8" id="quarterly" hidden>
          <label class="control-label col-md-8">
            <div id="quarterly" class="col-md-4 pull-left">
              <input type="checkbox"> Set Quarter:
            </div>
            <div id="quarterly" class="col-md-8 pull-right">
              <select class = "form-control" required>
                <option disabled selected value> -- SELECT QUARTER MONTH -- </option>
                <option>January-March</option>
                <option>April-June</option>  
                <option>July-September</option> 
                <option>October-December</option> 
              </select>
              <select class = "form-control" required>
                <option disabled selected value> -- SELECT YEAR -- </option>
                <option>2016</option>
                <option>2015</option>     
              </select>
            </div>
          </label>
        </div>
        
        <div class="col-md-8" id="yearly" hidden>
          <label class="control-label col-md-8">
            <div id="yearly" class="col-md-4 pull-left">
              <input type="checkbox"> Set Year:
            </div>
            <div id="yearly" class="col-md-8 pull-right">
              <select class = "form-control" required>
                <option disabled selected value> -- SELECT YEAR -- </option>
                <option>2016</option>
                <option>2015</option>     
              </select>
            </div>
          </label>
        </div>
        
        <br>
        <div class="col-md-8 pull-left">
          <div class="radio">
            <label class="control-label col-md-2">
              <input onclick="radioClicked('a')" type="radio" required>Custom Range:
            </label><br>
            <div class="col-md-6">

              <label class="col-md-3 control-label">Date From:</label>
              <div class="col-md-9">
                <input type="date" id="start" class="form-control" name="start" min="1900-01-01" max="2016-08-29">
              </div>

              <label class="col-md-3 control-label">Date To:</label>
              <div class="col-md-9">
                <input type="date" id="start" class="form-control" name="start" min="1900-01-01" max="2016-08-29">
              </div>

            </div>
          </div>
         </div>

        
      </form>
    </div>


    
    <div class="col-md-12">
      <hr>
      <center>
        <img src="{{('/images/logo.png')}}" style="height: 5%; width:5%">
        <h4>E-BUYad<br>PRODUCT SALES REPORT</h4>
      </center>
      <br>
      <p style="font-size: 18px">&nbsp&nbsp&nbsp Created by:<br>&nbsp&nbsp&nbsp Date:</p>
      <br>
      <p style="font-size: 18px"><b>&nbsp&nbsp&nbsp TOTAL SALES:<b></p>

      <br>
              <!-- datatables -->
        <div class = "row">
          <div class="col-md-12">
                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-hover">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending">Product ID</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">VAT Sales (12%)</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">VAT Exempt</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Discount</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending">Total Sales</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
    </div>
  </div>
</div>


 <script>
    function range(){
      var temp = document.getElementById('fixed');
      var value = temp.options[temp.selectedIndex].value;

      $("#daily").hide();
      $("#weekly").hide();
      $("#monthly").hide();
      $("#quarterly").hide();
      $("#yearly").hide();

        if(document.getElementById('fixed').value == "0")
          {
            $("#daily").show();
          }
        else if(document.getElementById('fixed').value == "1")
          {
            $("#weekly").show();
          }
        else if(document.getElementById('fixed').value == "2")
          {
            $("#monthly").show();
          }
        else if(document.getElementById('fixed').value == "3")
          {
            $("#quarterly").show(); 
          }
        else if(document.getElementById('fixed').value == "4")
          {
            $("#yearly").show();
          }
    }

   </script>


@stop

@section('internal-scripts')
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
@stop

@section('added-scripts')
 
@stop