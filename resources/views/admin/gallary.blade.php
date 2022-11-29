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
                        <h3 class="mb-2">Gallery Image</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Gallary</button>

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
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($gallaries as $gallary)
                                                    <tr>
                                                        <td>{{ $gallary->category ? $gallary->category->name : '' }}</td>
                                                        <td><img src="{{ asset('storage/' . $gallary->image) }}"
                                                                class="avatar lg rounded-circle me-2 mb-2" alt="">
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$gallary->id }}"
                                                                data-category_id="{{ @$gallary->category_id }}"
                                                                data-image="{{ asset('storage/' . $gallary->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('admin.delete.gallary', @$gallary->id) }}"
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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Gallary
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.gallary') }}" method="post" id="addGallary"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">

                                    <label for="maskPhone" class="form-label">Gallery Category</label>
                                    <select class="form-control mb-2" id="category_id" required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>


                                    {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}

                                    <h6>File Input</h6>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="image" id="image"
                                            accept="image/png, image/gif, image/jpeg" required>
                                    </div>
                                    <span style="color: red">(File should be PNG, GIF, JPEG and 1mb only)</span>

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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Gallary
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.gallary') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="gallary_id" id="gallary_id">
                                    {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}
                                    <label for="maskPhone" class="form-label">Gallery Category</label>
                                    <select class="form-control mb-2" name="category_id" id="category_id" required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <h6>File Input</h6>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="image" id="image"
                                            accept="image/png, image/gif, image/jpeg" id="formFile">
                                        <span style="color: red">(File should be PNG, GIF, JPEG and 1mb only)</span>

                                    </div>
                                    <img src="" id="gallary_image" width="25%">
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
            $('#addGallary').validate({ // initialize the plugin
                rules: {
                    category_id: {
                        required: true
                    },
                    gallary_image: {
                        required: true,
                    },

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#addGallary').validate({ // initialize the plugin
                rules: {
                    category_id: {
                        required: true
                    },
                    gallary_image: {
                        required: true,
                    },

                }
            });
        });
    </script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var image = $(this).attr('data-image');
            var category_id = $(this).attr('data-category_id');

            $("#editModal .modal-dialog #gallary_id").val(id);
            $('#editModal .modal-dialog #category_id option[value="' + category_id + '"]').attr("selected",
                "selected");
            $("#editModal .modal-dialog #gallary_image").attr("src", image);

        });
    </script>
@endsection
