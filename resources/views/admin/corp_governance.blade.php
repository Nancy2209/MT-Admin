@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-block">

            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">Corporate Governance</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Corporate Governance</button>

                    </div>
                </div>
            </div>
        </div>
        <!--//Page Toolbar End//-->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="content p-4 d-flex flex-column-fluid">

                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table mt-0 table-striped table-card table-nowrap">
                                            <thead class="text-uppercase small text-muted">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($corps as $corp)
                                                    <tr>
                                                        <td>{{ $corp->file_title }}</td>

                                                        <td>
                                                            <a href="{{ asset('storage/' . $corp->filename) }}"
                                                                target="_blank"> View File</a>
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit corp"
                                                                data-id="{{ @$corp->id }}"
                                                                data-file_title="{{ @$corp->file_title }}"
                                                                data-filename="{{ asset('storage/' . $corp->filename) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.corp.governance', @$corp->id) }}"
                                                                title="delete corp"
                                                                onClick="return  confirm('Are you sure you want to delete ?')"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>

            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Details
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.corp.governance') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">File Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Title"
                                        name="file_title" required>


                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="filename" accept=".pdf" required>
                                    </div>
                                    <span style="color: red">(File should be PDF and max 5mb) </span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Details
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.corp.governance') }}" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="count_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">File Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Title"
                                        name="file_title" id="file_title" required>


                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="filename" id="filename"
                                            required accept=".pdf">
                                        <span style="color: red">(File should be PDF and max 5mb) </span>

                                        <a href="" id="corpFile" target="_blank">View File</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




        </section>
    </div>
    <script src="{{ asset('/login/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var file_title = $(this).attr('data-file_title');
            var filename = $(this).attr('data-filename');


            $("#editModal .modal-dialog #count_id").val(id);
            $("#editModal .modal-dialog #file_title").val(file_title);
            $("#editModal .modal-dialog #corpFile").attr("href", filename);
        });
    </script>
    <script>
        $(".allow_numeric").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));
            if ((evt.which < 48 || evt.which > 57)) {
                evt.preventDefault();
            }
        });
    </script>
@endsection
