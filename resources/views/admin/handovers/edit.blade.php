@extends('layouts.admin-master')

@section('title')
	 Handover
@endsection

@section('page_title')
	Edit Handover
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Handover</h4>
        </div>
        <div class="panel-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
            <form method="post" action="{{ route('handovers.update', $handover->id) }}" enctype="multipart/form-data" id="form">
                @csrf
                @method('PATCH')
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="clo-lg-10 col-md-10 col-xs-10 pull-left">
                        @include('includes.info-box') {{-- For Alerts  --}}

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="request_ref">Request Ref. No:</label>
                                <input type="text" class="form-control" name="request_ref" value="{{$handover->request_ref}}" required/>
                            </div>
                        </div> 

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="handover_date">Handover Date:</label>
                                <input type="date" class="form-control" name="handover_date" value="{{$handover->handover_date}}" required/>
                            </div>
                        </div>
        
                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <select class="form-control" name="employee_id" >
                                  <option selected disabled>Select the Employee</option>
                                  @foreach($employees as $employee)
                                  @if($handover->employee_id == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                @else
                                <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>  
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div> 
                        
                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="request_emp">Requesting Person:</label>
                                <select class="form-control" name="request_emp" >
                                  <option selected disabled>Select the Requesting Person</option>
                                  @foreach($employees as $employee)
                                  @if($handover->request_emp == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                @else
                                <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>  
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div> 

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="approved_emp">Approved By:</label>
                                <select class="form-control" name="approved_emp" >
                                  <option selected disabled>Select the Approving Person</option>
                                  @foreach($employees as $employee)
                                  @if($handover->approved_emp == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                @else
                                <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>  
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div> 

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="handovered_emp">Handover By:</label>
                                <select class="form-control" name="handovered_emp" readonly>
                                  <option selected disabled>Select the Handovere Person</option>
                                  @foreach($employees as $employee)
                                  @if($handover->handovered_emp == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                  @endif
                                @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-lg-10 col-md-10 col-xs-12">
                              <div class="form-group">
                                  <label for="file_path">Requested Form:</label>
                              <input type="file" class="form-control-file" name="file_path" id="file_path" aria-describedby="fileHelp">
                                  <small id="fileHelp" class="form-text text-muted">Please upload a valid file. Size of file should not be more than 2MB.</small>
                              <input type="hidden" value="{{$handover->file_path}}" name="newfile">
                                </div>
                          </div>

                          

                <div class="col-lg-12 col-md-12 col-xs-12">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('handovers.index') }}>Cancel</a>
              </div>
            </form>
        </div>
      </div>

      <script src="{{ asset('template/js/jquery.min.js') }}"></script>
      <script type="text/javascript">
    
    $(document).ready(function(){
      var size = 0;
          $("#file_path").change(function(evt) {
            $('span.text-danger').hide();
            size = this.files[0].size;
            if(size > 2097152) {
                $("#file_path").after('<span class="text text-danger">Select a valid file! file size is not valid.</span><br>');
                $("#file_path").focus();
            }
          });

          $("#form").on("submit", function(evt){
            $('span.text-danger').hide();
            if(size > 2097152) {
                $("#file_path").after('<span class="text text-danger">Select a valid file! file size is not valid.</span><br>');
                $("#file_path").focus();
                return false;
            }
          });


});
      </script>
@endsection
