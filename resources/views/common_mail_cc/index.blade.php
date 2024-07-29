@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Common Mail CC Panel</h1>
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
                        <div class="col-md-10">
                            <h3 class="card-title">Common Mail CC List</h3>
                        </div>
                        <div class="col-md-2 float-right">
                            <form action="{{ url('/common-mail-cc/create') }}" method="GET">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button>
                            </form>
                        </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sl = 0 @endphp
                                @foreach($common_mail_ccs as $common_mail_cc)
                                    <tr>
                                        <td>{{ ++$sl }}</td>
                                        <td>{{ $common_mail_cc->name }}</td>
                                        <td>{{ $common_mail_cc->email }}</td>
                                        <td>{{ $common_mail_cc->created_at }}</td>
                                        <td>
                                            <form action="{{ route('common-mail-cc.edit',$common_mail_cc->id) }}" method="get" style ='float: left; padding: 5px;'>
                                                <!-- @csrf -->
                                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil-alt"></i></button>
                                            </form>
                                            <form action="{{ url('/common-mail-cc', ['id' => $common_mail_cc->id]) }}" method="post" style ='float: left; padding: 5px;'>
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger delete-confirm" data-name="{{ $common_mail_cc->name }}"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created Date</th>
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
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>

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
