@extends('....layout')

@section('page-title')
    Dashboard
@stop

@section('other-scripts')
    {{HTML::script('bootflat-admin/js/datatables.min.js')}}
    {{HTML::style('bootflat-admin/css/custom.css')}}
    {{HTML::style('bootflat-admin/css/theme-default.css')}}
    
    <script type="text/javascript" src="bootflat-admin/js/plugins.js"></script>

    

    <script type="text/javascript" src="bootflat-admin/js/added/moment.min.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/chart.min.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/bootstrap-progressbar.min.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/icheck.min.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/custom.js"></script>
    <script type="text/javascript" src="bootflat-admin/js/added/pace.min.js"></script>
@stop

@section('content')
<br>
<div class="right_col" role="main">
  <div class="row top_tiles">
    <div class="col-md-12">
        <!-- START WIDGET CLOCK -->
        <div class="animated flipInY col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats">
                <div class="icon pull-left">
                    <i class="glyphicon glyphicon-time"></i>
                </div>
                <div class="widget-big-int plugin-clock" style="height:99px; padding-top: 3%; padding-left:15%;font-size:50px">
                    <center>00:00</center>
                </div>                         
                <div class="widget-subtitle plugin-date"style="padding-left: 15%; font-size:15px"><strong>Loading...</strong></div>
            </div>                       
        </div>                        
        <div class="animated flipInY col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-group"></i>
                </div>
                <div class="count">179</div>

                <h3>Customers</h3>
                <p>Total Number of Customers</p>
            </div>
        </div>
        <div class="animated flipInY col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-shopping-cart"></i>
                </div>
                <div class="count">179</div>

                <h3>Total Sales Today</h3>
                <p>Total Number of Sales Today</p>
            </div>
        </div>

        <div class="animated flipInY col-md-3 col-sm-3 col-xs-12">
            <div class="tile-stats">
                <center>
                    <h3>Welcome <br> Admin!
                    </h3>
                </center>
            </div>
        </div>
      </div>
    
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:3%;">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Weekly Transaction |<small style="color:black">Weekly progress</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="mybarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:3%">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Top Branches</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:3%;">
        <div class="x_panel">
            <div class="x_title">
                <h2>Number of Customers |<small style="color:black">Weekly Customers</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:3%">
        <div class="x_panel tile fixed_height_320">
            <div class="x_title">
                <h2>Top 3 Best-Seller Products</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>Biogesic</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="w_right w_20">
                        <span>123</span>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>Tuseran</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="w_right w_20">
                        <span>53</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>Neozep</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="w_right w_20">
                        <span>23</span>
                    </div>
                    <div class="clearfix"></div>
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
    // Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [
              
              {
                label: 'Number of Transaction',
                backgroundColor: "#428bca",
                data: [41, 56, 25, 48, 72, 34, 12]
              }]
            },

          options:{
            scales:{
              yAxes:[{
                ticks:{
                    beginAtZero:true
                }
              }]
            }
          }
      });

      // Pie chart
      var ctx = document.getElementById("pieChart");
      var data = {
        datasets: [{
          data: [120, 50, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          label: 'My dataset' // for legend
        }],
        labels: [
          "Teresa Branch",
          "Pureza Branch",
          "Tutuban Branch",
          "Quiapo Branch",
          "Sta. Mesa Branch"
        ]
      };

      var pieChart = new Chart(ctx, {
        data: data,
        type: 'pie',
        otpions: {
          legend: false
        }
      });

      // Line chart
      var ctx = document.getElementById("lineChart");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [
            
            {
              label: "Number of Customers",
              backgroundColor: "rgba(3, 88, 106, 0.3)",
              borderColor: "rgba(3, 88, 106, 0.70)",
              pointBorderColor: "rgba(3, 88, 106, 0.70)",
              pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(151,187,205,1)",
              pointBorderWidth: 1,
              data: [82, 23, 66, 9, 99, 4, 2]
          }]
        },
      });
    </script>

  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
@stop

@section('added-scripts')
   

@stop