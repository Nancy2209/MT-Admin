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
                        <h3 class="mb-2">Media</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Media</button>

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
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medias as $media)
                                                    <tr>
                                                        <td>{{ $media->title }}
                                                        </td>
                                                        <td>{{ $media->date }}
                                                        </td>
                                                        </td>
                                                        <td>{{ substr($media->description, 0, 100) }}
                                                        </td>
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$media->id }}"
                                                                data-title="{{ @$media->title }}"
                                                                data-date="{{ @$media->date }}"
                                                                data-description="{{ @$media->description }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.media', @$media->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Media
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.media') }}" id="addMedia" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2" type="text" placeholder="title" name="Title"
                                    id="title"required>


                                <label for="maskPhone" class="form-label">Date</label>
                                <input class="form-control mb-2" type="date" placeholder="date" name="date"
                                    id="date" required>



                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2" placeholder="description" name="description" id="description" required></textarea>



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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Media
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.media') }}" id="updateMedia" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="media_id">
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2" type="text" placeholder="Title" name="title"
                                    id="title" required>

                                <label for="maskPhone" class="form-label">Date</label>
                                <input class="form-control mb-2" type="date" placeholder="Date" name="date"
                                    id="date" required>


                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2" placeholder="Description" name="description" id="description"></textarea>


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
            $('#addMedia').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateMedia').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true,
                    },
                    description: {
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
            var date = $(this).attr('data-date');
            var description = $(this).attr('data-description');

            $("#editModal .modal-dialog #media_id").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #date").val(date);
            $("#editModal .modal-dialog #description").val(description);

        });
    </script>
@endsection
