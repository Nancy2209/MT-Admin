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
    @if ($errors->any())
        <h4 class="error-msg">{{ $errors->first() }}</h4>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">Toppers</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Topper</button>

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
                                                    <th>Percentage </th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($toppers as $topper)
                                                    <?php $keyValues = json_decode($topper->key_highlights, true);
                                                    ?>
                                                    <tr>

                                                        <td>{{ $topper->name }}</td>
                                                        <td> {{ $topper->percentage }} </td>
                                                        <td>{{ substr($topper->description, 0, 100) }}...</td>
                                                        <td><img src="{{ asset('storage/' . $topper->image) }}"
                                                                width="25%"> </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ $topper->id }}"
                                                                data-name="{{ $topper->name }}"
                                                                data-percentage="{{ $topper->percentage }}"
                                                                data-description="{{ $topper->description }}"
                                                                data-image="{{ asset('storage/' . $topper->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.topper', @$topper->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Topper
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.topper') }}" id="addTopper" method="post"
                            enctype="multipart/form-data" id="addVideo" onsubmit="return formsubmit(this)"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group mb-1">
                                        <label for="email-1">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Percentage</label>
                                        <input type="text" class="form-control" name="percentage" id="percentage"
                                            placeholder="Percentage" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="description" required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Image</label>
                                        <input type="file" class="form-control topper-image" name="image"
                                            id="image" accept="image/png, image/gif, image/jpeg" required>
                                        <span style="color: red">(Image should be JPG, GIF, PNG and max 1mb) </span>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Topper
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.topper') }}" method="post" id="updateTopper"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="topper_id">

                                    <div class="form-group mb-1">
                                        <label for="email-1">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="name" required>
                                    </div>


                                    <div class="form-group mb-1">
                                        <label for="email-1">Percentage</label>
                                        <input type="text" class="form-control" name="percentage" id="percentage"
                                            placeholder="percentage" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="email-1">Description</label>
                                        <textarea type="text" class="form-control" name="description" id="description" placeholder="description"
                                            required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Image</label>
                                        <input type="file" class="form-control topper-image" name="image"
                                            accept="image/png, image/gif, image/jpeg">
                                        <span style="color: red">(Image should be JPG, GIF, PNG and max 1mb) </span><br />
                                        <img id="about_img" width="25%">
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
            $('#addTopper').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    percentage: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    about_img: {
                        required: true,
                    },

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateTopper').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    percentage: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    about_img: {
                        required: true,
                    },
                }
            });
        });
    </script>
    {{-- <script>
        $('.topper-image').on('change', function() {
            const image = document.getElementById('topper-image');
            // Check if any file is selected.
            alert(`${image.clientWidth} x ${image.clientHeight}`);

        })
    </script> --}}
    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var percentage = $(this).attr('data-percentage');
            var description = $(this).attr('data-description');
            var image = $(this).attr('data-image');

            $("#editModal .modal-dialog #topper_id").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $("#editModal .modal-dialog #percentage").val(percentage);
            $("#editModal .modal-dialog #description").val(description);
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
