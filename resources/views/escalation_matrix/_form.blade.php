@if(isset($escalation_matrix))
    {!! Form::model($escalation_matrix, ['url' => "escalation-matrix/$escalation_matrix->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'escalation-matrix', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group">
        {{ Form::label('Escalation Level') }}
        {{ Form::select('escalation_level_id', $escalation_levels, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Department') }}
        {{ Form::select('department_id', $departments, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Assign/Mail To') }}
        {{ Form::select('user_id', $users, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>
    <div class="form-group {{ $errors->has('to_or_cc') ? 'has-error' : ''}}">
        {!! Form::label('to_or_cc', 'Mail To/CC')!!}
        {!! Form::select('to_or_cc', ['to' => 'To', 'cc' => 'CC'], null, ['class' => 'form-control','placeholder' => 'Please select']) !!}
        <span class="text-danger">
            {{ $errors->first('to_or_cc') }}
        </span>
    </div>

    @if(isset($escalation_matrix))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}
