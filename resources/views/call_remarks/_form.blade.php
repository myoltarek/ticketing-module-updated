@if(isset($call_remark))
    {!! Form::model($call_remark, ['url' => "call-remarks/$call_remark->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'call-remarks', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<!-- {!! Form::open(['url' => 'department']) !!} -->
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Call Remark Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Call Remark Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    @if(isset($call_remark))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}