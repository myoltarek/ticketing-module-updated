@if(isset($common_mail_cc))
    {!! Form::model($common_mail_cc, ['url' => "common-mail-cc/$common_mail_cc->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'common-mail-cc', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name')!!}
        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('name') }}
        </span>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email')!!}
        {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Enter Email Address', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
            {{ $errors->first('email') }}
        </span>
    </div>

    @if(isset($common_mail_cc))
        {!! Form::Submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    @else
        {!! Form::Submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    @endif



{!! Form::close() !!}
