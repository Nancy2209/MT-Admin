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
                        <h3 class="mb-2">Gallery Video</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Gallery Video</button>

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
                                                    <th>Video Url</th>

                                                    {{-- <th>Video</th> --}}
                                                    {{-- <th>Publish</th> --}}

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($careerVideos as $video)
                                                    <tr>
                                                        <td>

                                                            @if ($video->video_url)
                                                                {{ $video->video_url }}
                                                                {{-- <iframe width="420" height="315" controls=0
                                                                src="https://www.youtube.com/embed/tgbNymZ7vqY?start=7&autoplay=0&showinfo=0&controls=0"></iframe> --}}
                                                            @endif
                                                        </td>
                                                        {{-- <td>
                                                            @if ($video->video_name)
                                                                <video width="320" height="240" controls>
                                                                    <source src="{{ asset("storage/$video->video_name") }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endif
                                                        </td> --}}

                                                        {{-- <td>
                                                            @if ($video->active)
                                                                <a
                                                                    href="{{ route('status.career.video', @$video->id) }}">Published</a>
                                                            @else
                                                                <a
                                                                    href="{{ route('status.career.video', @$video->id) }}">Unpublished</a>
                                                            @endif
                                                        </td> --}}
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$video->id }}"
                                                                data-video_url="{{ @$video->video_url }}"
                                                                data-video="{{ $video->video_name ? asset('storage/' . $video->video_name) : '' }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.gallery.video', @$video->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Gallery Videos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.gallery.video') }}" method="post" enctype="multipart/form-data"
                            id="addVideo" onsubmit="return formsubmit(this)" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">

                                    {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}

                                    <h6>Video URL</h6>
                                    <div class="mb-0">
                                        <input class="form-control mb-2" type="url" placeholder="Video Url"
                                            name="video_url" id="video_url" required>
                                        <span style="color: red"> In case of Youtube video link, please use embeded code
                                            of the link. such as :<a href="https://www.youtube.com/embed/s6QL1RrGzSM"
                                                target="_blank">https://www.youtube.com/embed/s6QL1RrGzSM</a> </span>
                                    </div>

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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Gallery Video
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.gallery.video') }}" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">

                                    {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}
                                    <input type="hidden" name="id" id="video_id">
                                    <h6>Video URL</h6>
                                    <div class="mb-0">
                                        <input class="form-control mb-2" type="url" placeholder="Video Url"
                                            name="video_url" id="edit_video_url">
                                        <span style="color: red"> In case of Youtube video link, please use embeded code
                                            of the link. such as :<a href="https://www.youtube.com/embed/s6QL1RrGzSM"
                                                target="_blank">https://www.youtube.com/embed/s6QL1RrGzSM</a> </span>
                                    </div>
                                    {{-- <span>OR</span> --}}

                                    {{-- <h6>Upload Video</h6>
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
            var video_url = $(this).attr('data-video_url');
            var video_name = $(this).attr('data-video');
            $("#editModal .modal-dialog #edit_video").html('');
            $("#editModal .modal-dialog #video_id").val(id);
            $("#editModal .modal-dialog #edit_video_url").val(video_url);
            if (video_name) {
                $("#editModal .modal-dialog #edit_video").html(
                    ' <video width="320" height="240" controls ><source src="' + video_name +
                    '" type="video/mp4"></source></video>');
            }


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
