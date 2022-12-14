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
                        <h3 class="mb-2">Offers</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Offer</button>

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
                                                    <th>Link/URL</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($offers as $offer)
                                                    <tr>

                                                        <td>{{ $offer->title }}</td>
                                                        <td>{{ substr($offer->description, 0, 100) }}...</td>
                                                        <td><img src="{{ asset('storage/' . $offer->image) }}"
                                                                width="25%"> </td>
                                                        <td>{{ $offer->link_url }}</td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ $offer->id }}"
                                                                data-title="{{ $offer->title }}"
                                                                data-link_url="{{ $offer->link_url }}"
                                                                data-description="{{ $offer->description }}"
                                                                data-image="{{ asset('storage/' . $offer->image) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.offer', @$offer->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Offer
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.offer') }}" id="addTopper" method="post"
                            enctype="multipart/form-data" id="addVideo" onsubmit="return formsubmit(this)"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group mb-1">
                                        <label for="email-1">Name</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title"
                                            required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Link/URL</label>
                                        <input type="url" class="form-control" name="link_url" placeholder="link_url"
                                            required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="description" required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Image</label>
                                        <input type="file" class="form-control topper-image" name="image"
                                            id="image" accept="image/png, image/gif, image/jpeg" required>
                                            <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Offer
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.offer') }}" method="post" id="updateTopper"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="offer_id">

                                    <div class="form-group mb-1">
                                        <label for="email-1">Name</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Title" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="email-1">Link/URL</label>
                                        <input type="url" class="form-control" name="link_url" id="link_url"
                                            placeholder="link_url" required>
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
                                            <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span><br />
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
                    title: {
                        required: true
                    },

                    description: {
                        required: true,

                    },
                    image: {
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
                    title: {
                        required: true
                    },
                    description: {
                        required: true,

                    }

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
            var link_url = $(this).attr('data-link_url');

            $("#editModal .modal-dialog #offer_id").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #link_url").val(link_url);
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
