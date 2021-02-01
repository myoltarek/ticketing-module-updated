@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">CRM Panel</h1>
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
                            <div class="col-md-5">
                                <h3 class="card-title">CRM List</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>CRM ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Address</th>
                                        <th>Query</th>
                                        <th>Complain</th>
                                        <th>Verbatim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($crms as $crm)
                                
                                    <tr>
                                        <td>{{ $crm->id }}</td>
                                        <td>{{ $crm->customer_name }}</td>
                                        <td>{{ $crm->customer_contact }}</td>
                                        <td>{{ $crm->district->name }}</td>
                                        <td>{{ $crm->district->division->name }}</td>
                                        <td>{{ $crm->address }}</td>
                                        <td>{{ $crm->query_type->name }}</td>
                                        <td>{{ $crm->complain_type->name }}</td>
                                        <td>{{ $crm->verbatim }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>CRM ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Address</th>
                                        <th>Query</th>
                                        <th>Complain</th>
                                        <th>Verbatim</th>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
            });
        } );

        $('.delete-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete ${name}?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    </script>
@endsection