@if(isset($assign_ticket))
    {!! Form::model($assign_ticket, ['url' => "assign-tickets/$assign_ticket->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'assign-tickets', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group">
        {{ Form::label('Department') }}
        {{ Form::select('department_id', $departments, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Assign/Mail To') }}
        {{ Form::select('user_id', $users, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>
    <div class="form-group {{ $errors->has('mail_cc') ? 'has-error' : ''}}">
        {!! Form::label('mail_cc', 'Mail CC')!!}
        {!! Form::text('mail_cc', null, ['class' => 'form-control','placeholder' => 'Enter Email Address', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('mail_cc') }}
        </span>
    </div>

    @if(isset($assign_ticket))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}
