@if(isset($escalation_level))
    {!! Form::model($escalation_level, ['url' => "escalation-levels/$escalation_level->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'escalation-levels', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Level Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Level Name', 'autocomplete' => 'off', 'required' => 'required']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>
    <div class="form-group {{ $errors->has('days') ? 'has-error' : ''}}">
        {!! Form::label('days', 'Days of escalation')!!}
        {!! Form::number('days', null, ['class' => 'form-control','placeholder' => 'Enter Days', 'autocomplete' => 'off', 'required' => 'required']) !!}
        <span class="text-danger">
            {{ $errors->first('days') }}
        </span>
    </div>

    @if(isset($escalation_level))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}
