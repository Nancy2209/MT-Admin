@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @elseif ($error = Session::get('error'))
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
                        <h3 class="mb-2">State List</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add State</button>

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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (@$states as $state)
                                                    <tr>
                                                        <td>{{ @$state->name }}
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$state->id }}"
                                                                data-name="{{ @$state->name }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('admin.state.delete', @$state->id) }}"
                                                                data-id="{{ @$office->id }}" title="delete logo"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add State
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.state') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="email-1">Name</label>
                                    <input type="text" class="form-control AlphabetsOnly checkunique" name="name"
                                        value="{{ old('name') }}" required>
                                    <span class="errorname"></span>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.state') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="state_id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="email-1">Name</label>
                                    <input type="text" id="name" class="form-control AlphabetsOnly" name="name"
                                        required>
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

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            $("#editModal .modal-dialog #state_id").val(id);
            $("#editModal .modal-dialog #name").val(name);

        });
    </script>
    <script>
        $('.AlphabetsOnly').keypress(function(e) {
            var regex = new RegExp(/^[a-zA-Z\s]+$/);
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
    </script>
    <script>
        $('.checkunique').on('change', function() {
            var stateValue = $('.checkunique').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: '{!! route('admin.check.state') !!}',
                data: {
                    state: stateValue,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'error') {
                        $('.errorname').text('this state already exist');
                        $('.errorname').css('color', 'red');
                        $(':input[type="submit"]').prop('disabled', true);
                        return false;
                    } else {
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                }
            });

        })
    </script>
@endsection
