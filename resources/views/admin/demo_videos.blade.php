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
                        <h3 class="mb-2">Category Standard Video</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Category Standard Video</button>

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

                                                    <th>Standard Type </th>
                                                    <th>Title</th>
                                                    <th>Description </th>
                                                    <th>Video Url </th>
                                                    {{-- <th>Video</th> --}}
                                                    <th>Tag </th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($demoVideos as $demoVideo)
                                                    <tr>
                                                        <td>
                                                            {{ $demoVideo->classCategory->name }}
                                                        </td>
                                                        <td>{{ @$demoVideo->title }}</td>
                                                        <td>{{ substr($demoVideo->description, 0, 100) }}</td>
                                                        <td>

                                                            @if ($demoVideo->video_url)
                                                                {{ $demoVideo->video_url }}
                                                            @endif
                                                        </td>
                                                        {{-- <td>
                                                            @if ($demoVideo->video_name)
                                                                <video width="320" height="240" controls>
                                                                    <source
                                                                        src="{{ asset("storage/$demoVideo->video_name") }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endif
                                                        </td> --}}
                                                        <td>{{ @$demoVideo->tag_name }}</td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$demoVideo->id }}"
                                                                data-class_name="{{ $demoVideo->classCategory->id }}"
                                                                data-title="{{ $demoVideo->title }}"
                                                                data-description="{{ $demoVideo->description }}"
                                                                data-tag_name="{{ $demoVideo->tag_name }}"
                                                                data-video_url="{{ $demoVideo->video_url }}"
                                                                data-video_name="{{ $demoVideo->video_name ? asset('storage/' . $demoVideo->video_name) : '' }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('admin.delete.demoVideo', @$demoVideo->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Category Standard Videos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.demoVideo') }}" method="post" enctype="multipart/form-data"
                            id="addVideo" onsubmit="return formsubmit(this)" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Standard</label>
                                    <select class="form-control mb-2" name="class_id" required>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }} </option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                        required>
                                    <label for="maskPhone" class="form-label">Description</label>
                                    <textarea class="form-control mb-2" type="text" placeholder="description" name="description" required></textarea>

                                    <label for="maskPhone" class="form-label">Tag</label>
                                    <input class="form-control mb-2" type="text" placeholder="tag" name="tag_name"
                                        required>

                                    <h6>Video URL</h6>
                                    <div class="mb-0">
                                        <input class="form-control mb-2" type="url" placeholder="Video Url"
                                            name="video_url" id="video_url">
                                    </div>
                                    {{-- <span>OR</span>

                                    <h6>Upload Video</h6>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="video_name" id="file"
                                            accept="video/mp4,video/x-m4v,video/*" onchange="Filevalidation()">
                                        <span id="error_video"></span>
                                    </div> --}}
                                    <div class="position-fixed start-50 top-0 translate-middle-x p-3" style="z-index: 1080">
                                        <div id="liveToast" class="toast bg-danger text-white border-0 shadow-lg"
                                            role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body" id="toasterID">

                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Category Standard Video
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.demoVideo') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="standardID">
                                    <label for="maskPhone" class="form-label">Standard</label>
                                    <select class="form-control mb-2" name="class_id" id="class_id" required>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }} </option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                        id="title" required>
                                    <label for="maskPhone" class="form-label">Description</label>
                                    <textarea class="form-control mb-2" type="text" placeholder="description" name="description" id="description"
                                        required></textarea>
                                    <label for="maskPhone" class="form-label">Tag</label>
                                    <input class="form-control mb-2" type="text" placeholder="tag" name="tag_name"
                                        id="tag_name" required>

                                    {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}
                                    <h6>Video URL</h6>
                                    <div class="mb-0">
                                        <input class="form-control mb-2" type="url" placeholder="Video Url"
                                            name="video_url" id="edit_video_url">
                                    </div>
                                    {{-- <span>OR</span>

                                    <h6>Upload Video</h6>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="video_name" id="video_name"
                                            accept="video/mp4,video/x-m4v,video/*" onchange="Filevalidation()">
                                    </div> --}}
                                    <div id="edit_video">
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
                        $('#liveToast').delay(5000).hide(5000);
                    }
                }
            }
        }
    </script>
    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var course_name = $(this).attr('data-course_name');
            var title = $(this).attr('data-title');
            var description = $(this).attr('data-description');
            var tag_name = $(this).attr('data-tag_name');
            var video_url = $(this).attr('data-video_url');
            // var video_name = $(this).attr('data-video_name');


            $("#editModal .modal-dialog #standardID").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #description").val(description);
            $("#editModal .modal-dialog #tag_name").val(tag_name);
            $('#editModal .modal-dialog #class_id option[value="' + class_name + '"]').attr("selected",
                "selected");
            $("#editModal .modal-dialog #edit_video_url").val(video_url);
            // if (video_name) {
            //     $("#editModal .modal-dialog #edit_video").html(
            //         ' <video width="320" height="240" controls ><source src="' + video_name +
            //         '" type="video/mp4"></source></video>');
            // }


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
                $('#liveToast').delay(5000).hide(5000);
                return false;
            }
            return true;

        }
    </script>
@endsection
