@if(isset($complain_type))
    {!! Form::model($complain_type, ['url' => "complain-type/$complain_type->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'complain-type', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<!-- {!! Form::open(['url' => 'department']) !!} -->
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Complain Type Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Complain Type Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    @if(isset($complain_type))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}