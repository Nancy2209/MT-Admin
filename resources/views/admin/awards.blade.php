@extends('Common.app')
<!-- Content Wrapper. Contains page content -->
<style>
    .hero-img {
        width: 20%
    }
</style>
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @elseif ($error = Session::get('error'))
        <div class="alert alert-danger alert-block">

            <strong>{{ $error }}</strong>
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
                        <h3 class="mb-2">Awards List</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Award</button>

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
                                                    <th>Images</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (@$awards as $award)
                                                    <?php $images = json_decode($award->image); ?>
                                                    <tr>
                                                        <td>{{ @$award->title }}
                                                        </td>
                                                        <td>{{ substr(@$award->description, 0, 100) }}...
                                                        </td>
                                                        <td>
                                                            @foreach ($images as $image)
                                                                <img src="{{ asset('storage/awards/' . $image) }}"
                                                                    width="10%" height="10%">
                                                            @endforeach
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$award->id }}"
                                                                data-title="{{ @$award->title }}"
                                                                data-description="{{ @$award->description }}"
                                                                data-image="{{ @$award->image }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.award', @$award->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Award
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.award') }}" id="addAward" class="ajaxForm" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2 @error('title') is-invalid @enderror" type="text"
                                    placeholder="title" id="title" name="title" required>
                                @error('title')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2 @error('description') is-invalid @enderror" id="description" name="description"
                                    required></textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                                <label for="maskPhone" class="form-label">Images</label>
                                <input class="form-control mb-2" type="file" name="image[]" id="images"
                                    accept="image/png, image/gif, image/jpeg" multiple required>
                                    <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span>

                                <div class="col-md-12">
                                    <div class="mt-1 text-center">
                                        <div class="images-preview-div"> </div>
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
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit State
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.award') }}" class="ajaxForm" id="updateAward"
                            method="post" enctype="multipart/form-data" onSubmit="return checkForm();">

                            @csrf
                            <input type="hidden" name="id" id="award_id">
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                    id="title">

                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2" name="description" id="description">
                                </textarea>

                                <label for="maskPhone" class="form-label">Images</label>
                                <input class="form-control mb-2" type="file" name="image[]" id="images"
                                    accept="image/png, image/gif, image/jpeg" multiple>
                                    <span style="color: red">(Only the jpeg/png image files are allowed. The maximum allowed file size is 100 KB) </span>


                                <div class="col-md-12">
                                    <div class="mt-1 text-center">
                                        <div class="images-preview-div"> </div>
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
            $('#addAward').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true,
                    },
                    images: {
                        required: true,

                    },
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateAward').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true,
                    },
                    images: {
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

            $("#editModal .modal-dialog #award_id").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #description").val(description);

        });
    </script>

    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img class="hero-img">')).attr('src', event.target.result)
                                .appendTo(
                                    imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });
    </script>
@endsection
