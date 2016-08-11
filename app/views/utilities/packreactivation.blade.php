@extends('....layout')

@section('page-title')
    Utilities - Data Reactivation
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
      <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-barcode"></i>&nbsp Product Data Reactivation
      <hr>
      </h5></center>
      
      <div class= "row">
        <div class="btn-group btn-group-justified">
          <a href="formreactivation" class="btn btn-primary">Form Data Reactivation</a>
          <a href="packreactivation" class="btn btn-info">Packaging Data Reactivation</a>
          <a href="uomreactivation" class="btn btn-primary">UOM Data Reactivation</a>
        </div>
      
        <br>

        <div class="col-md-12"><br>
          <table id="example" class="table table-bordered table-hover">
           <br>
           <caption></caption>
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Packaging Code</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Packaging Name</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Description</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        
            <div class="col-md-8; pull-right">
              <button class="btn btn-primary"  data-toggle="modal" data-target="#member">Choose Data</button>
              <button class="btn btn-info">Restore Data</button>
            </div>
          </div>
      
        <div class="modal fade " id="member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel"><span><i class= "glyphicon glyphicon-user"></i></a></span>&nbspMember Data Reactivation<hr></h4>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-hover">
                    <caption></caption>
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;"></th>
                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Member ID: activate to sort column descending" style="width: 249px;">Packaging Code</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Last Name: activate to sort column descending" style="width: 249px;">Packaging Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Option: activate to sort column ascending" style="width: 147px;">Description</th>
                    </thead>

                    <tbody>
                      <tr>
                        <td><input type="checkbox"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="modal-footer">
                <a href="">
                  <button type="button" class="btn btn-primary">Restore</button>
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>             
          </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
@stop

@section('added-scripts')
  
@stop