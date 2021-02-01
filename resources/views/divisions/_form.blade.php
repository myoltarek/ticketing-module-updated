@if(isset($division))
    {!! Form::model($division, ['url' => "division/$division->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'division', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Division Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Division Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    @if(isset($division))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}