@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
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
                    <div class="card text-center">
                        <div class="card-header">
                        <h3 class="card-title">Ticket List <span class="right badge badge-<?php if($status_for_display=='new') echo 'primary'; elseif($status_for_display=='wip') echo 'warning'; elseif($status_for_display=='answered') echo 'success'; else echo 'danger'; ?>">{{ ucfirst($status_for_display) }}</span></h3>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>TicketID</th>
                                        <th>Agent Name</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Address</th>
                                        <th>Query Type</th>
                                        <th>Complain Type</th>
                                        <th>Verbatim</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->crm->agent_name }}</td>
                                        <td>{{ $ticket->crm->customer_name }}</td>
                                        <td>{{ $ticket->crm->customer_contact }}</td>
                                        <td>{{ $ticket->crm->address }}</td>
                                        <td>{{ $ticket->crm->query_type->name }}</td>
                                        <td>{{ $ticket->crm->complain_type->name }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($ticket->crm->verbatim, 30) }}</td>
                                        <td>
                                            <form action="{{ route('ticket.show', $ticket->id) }}" method="get" style ='float: left; padding: 5px;'>
                                                <button type="submit" class="btn btn-info"><i class="fas fa-eye"></i></button> 
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>TicketID</th>
                                        <th>Agent Name</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Address</th>
                                        <th>Query Type</th>
                                        <th>Complain Type</th>
                                        <th>Verbatim</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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