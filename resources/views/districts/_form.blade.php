@if(isset($district))
    {!! Form::model($district, ['url' => "district/$district->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'district', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'District Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter District Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    <div class="form-group">
        {{ Form::label('Division Name') }}
        {{ Form::select('division_id', $divisions, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
    </div>

    @if(isset($district))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}