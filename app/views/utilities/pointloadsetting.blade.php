@extends('....layout')

@section('page-title')
    Utilities - Mechanics
@stop

@section('other-scripts')
    {{HTML::script('bootflat-admin/js/datatables.min.js')}}
@stop

@section('content')
  <div class="panel-body">
    <div class="content-row">  
      <center><h5 class="content-row-title" style="font-size:25px"><i class="glyphicon glyphicon-tasks"></i>&nbsp Pointing/Loading Setting
      <hr>
      </h5></center>

      <!-- forms -->
      <div class ="row">
        <div class="col-md-offset-1 col-md-9">
          <form role="form" class="form-horizontal" method="post" action="{{URL::to('/utils/pointload/update-mech')}}">
            <div class = "form-group">
              <label class = "col-md-3  control-label"><h5> Loading </h5></label>
            </div>

            <div class="form-group">
              <label class = "col-md-offset-1 col-md-3 control-label">Default Load</label>
              <div class="col-md-6">
                <input type="number" class="form-control" id="defload" name="defload" required maxlength="10" value="{{$loaddef}}">
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-offset-1 col-md-3 control-label">Minimum Load</label>
              <div class="col-md-6">
                <input type="number" class="form-control" id="minload" name="minload" required maxlength="10" value="{{$loadmin}}">
              </div>
            </div>

            <div class = "form-group">
              <label class = "col-md-3  control-label"><h5> Pointing </h5></label>
            </div>

            <div class="form-group">
              <label class = "col-md-offset-1 col-md-3 control-label">Pointing Percentage</label>
              <div class="col-md-6">
                <input type="number" class="form-control" id="percpoint" name="percpoint" required maxlength="10" value="{{$ptperc}}">
              </div>
            </div>

            <div class="form-group">
              <label class = "col-md-offset-1 col-md-3 control-label">Minimum Payment Total</label>
              <div class="col-md-6">
                <input type="number" class="form-control" id="mintotal" name="mintotal" required maxlength="10" value="{{$ptmin}}">
              </div>
            </div>

            <br><br>
            <div class="form-group">
              <div class="col-md-offset-7 col-md-5">
                <button type="submit" class="btn btn-info">Submit</button>
                <button class="btn btn-info" type="cancel" href="#" data-toggle="collapse">Cancel</button>
              </div>
            </div>
          </form>

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
@stop

@section('internal-scripts')
  <script>
    @if(Session::get('message') != null)
      $('#prompt').modal('show');
    @endif
  </script>
@stop
