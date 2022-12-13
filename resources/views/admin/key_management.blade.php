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
                        <h3 class="mb-2">Key </h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Key Management</button>

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
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($directors as $boardOfDirector)
                                                    <tr>
                                                        <td>{{ $boardOfDirector->name }}</td>
                                                        <td>{{ $boardOfDirector->designation }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/' . $boardOfDirector->image) }}">
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$boardOfDirector->id }}"
                                                                data-name="{{ @$boardOfDirector->name }}"
                                                                data-designation="{{ @$boardOfDirector->designation }}"
                                                                data-image="{{ asset('storage/' . $boardOfDirector->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.keyManagement', @$boardOfDirector->id) }}"
                                                                title="delete logo"
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
                        <form action="{{ route('admin.add.keyManagement') }}" id="addBoardDirector" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="Name" name="name"
                                        id="name" required>
                                    <label for="maskPhone" class="form-label">Designation</label>
                                    <input class="form-control mb-2" type="text" placeholder="designation"
                                        id="designation" name="designation" required>

                                    <label for="maskPhone" class="form-label">Image</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="image" id="image"
                                            accept="image/png, image/gif, image/jpeg" required>
                                    </div>
                                    <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed
                                        file size is 100 KB) </span>

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
                        <form action="{{ route('admin.update.keyManagement') }}" class="ajaxForm" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" id="count_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="Name" id="name"
                                        name="name" required>
                                    <label for="maskPhone" class="form-label">Designation</label>
                                    <input class="form-control mb-2" type="text" placeholder="designation"
                                        name="designation" id="designation" required>

                                    <label for="maskPhone" class="form-label">Image</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="image"
                                            accept="image/png, image/gif, image/jpeg" onchange="Filevalidation(this)">
                                        <img id="profile_img">
                                    </div>
                                    <span style="color: red">(Only the jpeg/png image files are allowed. The maximum
                                        allowed file size is 100 KB) </span>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <style>
        .error {
            color: #FF0000;
            display: block;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#addBoardDirector').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    designation: {
                        required: true,
                    },
                    profile_img: {
                        required: true,

                    },
                }
            });
        });
    </script>
    <script>
        Filevalidation = () => {
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 5120) {
                        $('#file').val('');
                        $("#liveToast").toggleClass("show").toggleClass("fade");
                        $('#toasterID').html('');
                        $('#toasterID').html('Max value should be 5MB');
                        $('#liveToast').delay(1000).hide(500);
                    }
                }
            }
        }
    </script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var designation = $(this).attr('data-designation');
            var image = $(this).attr('data-image');


            $("#editModal .modal-dialog #count_id").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $("#editModal .modal-dialog #designation").val(designation);
            $("#editModal .modal-dialog #profile_img").attr("src", image);
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
