@extends('layouts.master')

@push('mycss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Department Panel</h1>
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
                            <h3 class="card-title">Department List</h3>
                        </div>
                        <div class="col-md-2 float-right">
                            <form action="{{ url('/department/create') }}" method="GET">
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
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sl = 0 @endphp
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ ++$sl }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->created_at }}</td>
                                        <td>
                                            <!-- {!! Html::link("department/$department->id/edit",' Edit', ['class'=> 'fa fa-edit btn btn-success']) !!} -->
                                            <!-- <a href="/department/$department->id/edit" class="btn btn-primary"><i class="fa fa-eye"></i></a> -->
                                            <form action="{{ route('department.edit',$department->id) }}" method="get" style ='float: left; padding: 5px;'>
                                                <!-- @csrf -->
                                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil-alt"></i></button> 
                                            </form>
                                            <form action="{{ url('/department', ['id' => $department->id]) }}" method="post" style ='float: left; padding: 5px;'>
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger delete-confirm" data-name="{{ $department->name }}"><i class="fa fa-trash-alt"></i></button> 
                                            </form>
                                            <!-- <a href="/department/delete/{{$department->id}}" class="button delete-confirm">Delete</a> -->
                                            <!-- <a href="/department/$department->id/edit" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="/department/$department->id/delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a> -->
                                            <!-- {!! Html::link("department/$department->id/delete",' Delete', ['class'=> 'fa fa-trash btn btn-danger']) !!} -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
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