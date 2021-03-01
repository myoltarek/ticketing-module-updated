@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-am-6 ml-3">
                    <a href="{{ url()->previous() }}" type="button">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ticket Panel</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ticket Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h4 class="text-center">Customer Info</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    CRM Id:
                                                                </b>
                                                                {{ $ticket->crm_id }}
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Name:
                                                                </b>
                                                                {{ $ticket->crm->customer_name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Phone No:
                                                                </b>
                                                                {{ $ticket->crm->customer_contact }}
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Division:
                                                                </b>
                                                                {{ $ticket->crm->district->division->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    District:
                                                                </b>
                                                                {{ $ticket->crm->district->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Address:
                                                                </b>
                                                                {{ $ticket->crm->address }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card card-warning">
                                                <div class="card-header">
                                                    <h4 class="text-center">Ticket Details</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Ticket Id:
                                                                </b>
                                                                {{ $ticket->id }}
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Ticket Status:
                                                                </b>
                                                                {{ $ticket->status }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Query Type:
                                                                </b>
                                                                {{ $ticket->crm->query_type->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Department:
                                                                </b>
                                                                {{ $ticket->crm->department->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <b>
                                                                    Customer Query:
                                                                </b>
                                                                {{ $ticket->crm->verbatim }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($ticket->ticket_response)){?>
                                        <label>Comments <i class="fas fa-comment-alt ml-1"></i></label>
                                        @foreach ($ticket->ticket_response as $response)
                                        <div class="container-fluid mt-1">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <div class="user_avatar">
                                                        <img src="{{ asset('/img/profile.png') }}" class="" alt="User Image">
                                                    </div>
                                                </div>
                                                <div class="col-sm-11">
                                                    <div class="comment_body">
                                                        <p>{{ $response->response }}</p>
                                                    </div>

                                                    <!-- comments toolbar -->
                                                    <div class="comment_toolbar">
                                                        <!-- inc. date and time -->
                                                        <div class="comment_details">
                                                            <ul>
                                                                <li><i class="fa fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($response->created_at)->toTimeString() }}</li>
                                                                <li><i class="fa fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y') }}</li>
                                                                <li><i class="fa fa-pencil"></i> <span class="user">{{ $response->user->name }}</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    <?php } ?>
                                    <?php if( $ticket->status != 'CLOSED'){ ?>
                                        {!! Form::open(['url' => "ticket/$ticket->id", 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                                {!! Form::label('comment', 'Add Comment')!!}
                                                {!! Form::text('comment', null, ['class' => 'form-control','placeholder' => 'Enter Comment', 'autocomplete' => 'off']) !!}
                                                <span class="text-danger">
                                                    {{ $errors->first('comment') }}
                                                </span>
                                            </div>
                                            {!! Form::Submit('Send to next step', ['class' => 'btn btn-primary float-left', 'name'=>'action']) !!}
                                            {!! Form::Submit('Send to close', ['class' => 'btn btn-danger float-right', 'name'=>'action']) !!}
                                        {!! Form::close() !!}
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
            });
        } );
    </script>
@endsection
