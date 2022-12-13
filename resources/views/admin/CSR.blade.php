@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <h4 class="error-msg">{{ $errors->first() }}</h4>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">CSR</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add CSR</button>

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
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($csrs as $csr)
                                                    <tr>

                                                        <td>{{ @$csr->title }}</td>
                                                        <td>{{ substr($csr->description, 0, 100) }}</td>
                                                        <td>
                                                            <div><img class="course-img"
                                                                    src="{{ asset('storage/' . $csr->image) }}"
                                                                    width="150px" height="150px" /></div>
                                                        </td>


                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit CSR"
                                                                data-id="{{ @$csr->id }}"
                                                                data-title="{{ $csr->title }}"
                                                                data-description="{{ $csr->description }}"
                                                                data-image="{{ asset('storage/' . $csr->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.csr', @$csr->id) }}"
                                                                title="delete CSR"
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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add CSR
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.csr') }}" id="addCSR" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">


                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                        required>
                                    <label for="maskPhone" class="form-label">Description</label>
                                    <textarea class="form-control mb-2" type="text" placeholder="description" name="description" id="description"
                                        required></textarea>

                                    <label for="maskPhone" class="form-label">Image</label>
                                    <div class="mb-2">
                                        <input class="form-control" type="file" name="image"
                                            accept="image/png, image/gif, image/jpeg" required>
                                    </div>
                                    <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span>
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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit CSR
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.csr') }}" id="updateCSR" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="coueseId">


                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                        id="title" required>
                                    <label for="maskPhone" class="form-label">Description</label>
                                    <textarea class="form-control mb-2" type="text" placeholder="description" name="description" id="description"
                                        required> </textarea>

                                    <label for="maskPhone" class="form-label">Image</label>
                                    <div class="mb-2">
                                        <input class="form-control" type="file" name="image"
                                            accept="image/png, image/gif, image/jpeg">
                                              <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span>
                                        <img class="avatar lg rounded-circle me-2 mb-2" alt="" id="team_image">

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
        <!-- /.content -->
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
            $('#addCSR').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true,

                    },
                    team_image: {
                        required: true,

                    },

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updatePresentation').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true,
                    },
                    team_image: {
                        required: true,

                    },

                }
            });
        });
    </script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            var description = $(this).attr('data-description');
            var image = $(this).attr('data-image');

            $("#editModal .modal-dialog #coueseId").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #description").val(description);
            ("#editModal .modal-dialog #team_image").attr("src", image);

        });
    </script>
@endsection
