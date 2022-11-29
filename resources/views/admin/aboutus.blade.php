@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @elseif($errormessage = Session::get('error'))
        <div class="alert alert-danger alert-block">

            <strong>{{ $errormessage }}</strong>
        </div>
    @endif

    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">About Us</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add About Us</button>

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
                                                    <th>Year</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Image</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($abouts as $about)
                                                    <?php $keyValues = json_decode($about->key_highlights, true);
                                                    ?>
                                                    <tr>
                                                        <td>{{ $about->year }}</td>
                                                        <td>{{ $about->title }}</td>
                                                        <td>{{ substr($about->description, 0, 100) }}...</td>
                                                        <td><img src="{{ asset('storage/' . $about->image) }}"
                                                                width="25%"> </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ $about->id }}"
                                                                data-year="{{ $about->year }}"
                                                                data-title="{{ $about->title }}"
                                                                data-description="{{ $about->description }}"
                                                                data-center="{{ $keyValues['center'] }}"
                                                                data-revenue="{{ $keyValues['revenue'] }}"
                                                                data-students="{{ $keyValues['students'] }}"
                                                                data-image="{{ asset('storage/' . $about->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.about', @$about->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add About Us
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.about') }}" method="post" class="ajaxForm"
                            enctype="multipart/form-data" id="addAbout" onsubmit="return formsubmit(this)">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group mb-1">
                                        <label for="email-1">Year</label>
                                        <input type="text" class="form-control" id="year" name="year"
                                            placeholder="1988-1996" required>

                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="title" required>

                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="description" required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Image</label>
                                        <input type="file" class="form-control " name="image" id="image"
                                            accept="image/png, image/gif, image/jpeg" required>
                                        <span style="color: red">(Image should be less than 1MB.) </span>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Numbers of centers</label>
                                        <input type="text" class="form-control" name="centers" id="centers">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Revenue </label>
                                        <input type="text" class="form-control" name="revenue" id="revenue">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Students </label>
                                        <input type="text" class="form-control" name="students" id="students">
                                    </div>

                                </div>
                            </div>

                            <div class="position-fixed start-50 top-0 translate-middle-x p-3" style="z-index: 1080">
                                <div id="liveToast" class="toast bg-danger text-white border-0 shadow-lg" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body" id="toasterID">

                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                            data-bs-dismiss="toast" aria-label="Close"></button>
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



            <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit About Us
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.about') }}" class="ajaxForm" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="about_id">
                                    <div class="form-group mb-1">
                                        <label for="email-1">Year</label>
                                        <input type="text" class="form-control" name="year" id="year"
                                            placeholder="1988-1996" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Title</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="title" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Description</label>
                                        <textarea type="text" class="form-control" name="description" id="description" placeholder="description"
                                            required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Image</label>
                                        <input type="file" class="form-control " name="image"
                                            accept="image/png, image/gif, image/jpeg">
                                        <span style="color: red">(Image should be less than 1MB.) </span>

                                        <img id="about_img" width="25%">
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Numbers of centers</label>
                                        <input type="text" class="form-control" name="centers" id="centers">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Revenue </label>
                                        <input type="text" class="form-control" name="revenue" id="revenue">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Students </label>
                                        <input type="text" class="form-control" name="students" id="students">
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
            $('#addAbout').validate({
                rules: {
                    year: {
                        required: true,
                        // number: true
                    },
                    title: {
                        required: true,
                        maxlength: 50

                    },
                    description: {
                        required: true,

                    },
                    centers: {
                        required: true,
                        digits: true
                    },
                    revenue: {
                        required: true,
                        digits: true
                    },
                    students: {
                        required: true,
                        digits: true
                    },
                },

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
            var title = $(this).attr('data-title');
            var year = $(this).attr('data-year');
            var description = $(this).attr('data-description');
            var image = $(this).attr('data-image');
            var center = $(this).attr('data-center');
            var revenue = $(this).attr('data-revenue');
            var students = $(this).attr('data-students');

            $("#editModal .modal-dialog #about_id").val(id);
            $("#editModal .modal-dialog #year").val(year);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #description").val(description);
            $("#editModal .modal-dialog #centers").val(center);
            $("#editModal .modal-dialog #revenue").val(revenue);
            $("#editModal .modal-dialog #students").val(students);
            $("#editModal .modal-dialog #about_img").attr("src", image);


        });
    </script>
    <script>
        function formsubmit() {
            var file = $('#file').get(0).files.length;
            var url = $('#video_url').val();
            if (file == 0 && !url) {
                $("#liveToast").toggleClass("show").toggleClass("fade");
                $('#toasterID').html('');
                $('#toasterID').html('Please Enter Atleast one Value');
                $('#liveToast').delay(1000).hide(1000);
                return false;
            }
            return true;

        }
    </script>
@endsection
