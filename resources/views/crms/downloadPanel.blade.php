@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crm Panel</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Download Crms</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url' => '/crm/download', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @csrf
                                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                                        {!! Form::label('start_date', 'Start Date')!!}
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                        {!! Form::text('start_date', null, ['class' => 'form-control','placeholder' => 'Enter Start Date', 'id' =>"datepicker", 'autocomplete' => 'off', 'required' => 'required']) !!}
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-clock"></i></span></div>
                                        &nbsp;<input type="text" id="alternate" class="form-control">
                                        <span class="text-danger">
                                            {{ $errors->first('start_date') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                                    {!! Form::label('end_date', 'End Date')!!}
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                        {!! Form::text('end_date', null, ['class' => 'form-control','placeholder' => 'Enter End Date', 'id' =>"datepicker1", 'autocomplete' => 'off', 'required' => 'required']) !!}
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-clock"></i></span></div>
                                        &nbsp;<input type="text" id="alternate1" class="form-control">
                                        <span class="text-danger">
                                            {{ $errors->first('end_date') }}
                                        </span>
                                    </div>
                                </div>
                                {!! Form::Submit('Download', ['class' => 'btn btn-primary pull-right']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
     <script type="text/javascript">
       $( function() {
			$( "#datepicker" ).datepicker({ 
                changeMonth: true, 
                changeYear: true, 
                dateFormat: "yy-mm-dd",
                altField: "#alternate",
                altFormat: "DD, d MM, yy" 
            });
        	$( "#datepicker" ).datepicker( "option", "showAnim", "show","setDate", "0" );
        	$( "#datepicker1" ).datepicker({ 
                changeMonth: true, 
                changeYear: true, 
                dateFormat: "yy-mm-dd",
                altField: "#alternate1",
                altFormat: "DD, d MM, yy"
            });
        	$( "#datepicker1" ).datepicker( "option", "showAnim", "show","setDate", "0" );
		} );
    </script>
@endsection