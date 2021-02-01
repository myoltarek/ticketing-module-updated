@if(isset($department))
    {!! Form::model($department, ['url' => "department/$department->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'department', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<!-- {!! Form::open(['url' => 'department']) !!} -->
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Department Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Department Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    @if(isset($department))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}