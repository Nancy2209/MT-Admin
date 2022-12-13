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
                        <h3 class="mb-2">City List</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add City</button>

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
                                                    <th> State</th>
                                                    <th>City</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cities as $city)
                                                    <tr>
                                                        <td>{{ $city->state->name }} </td>

                                                        <td>{{ $city->name }}

                                                        </td>


                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$city->id }}"
                                                                data-state="{{ @$city->state->id }}"
                                                                data-name="{{ @$city->name }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.city', @$city->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add City
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.city') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email-1">State</label>
                                        <select name="state_id" class="form-control" required>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Name</label>
                                        <input type="text" class="form-control AlphabetsOnly checkuniqueCity"
                                            name="name" placeholder="City" value="{{ old('name') }}" required>
                                        <span class="errorname"></span>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Team
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.city') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="city_id">
                                        <label for="email-1">State</label>
                                        <select name="state_id" class="form-control" id="state_id" required>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Name</label>
                                        <input type="text" id="name"
                                            class="form-control AlphabetsOnly checkuniqueCity" name="name"
                                            value="{{ old('name') }}" required>
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

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var state = $(this).attr('data-state');

            $("#editModal .modal-dialog #city_id").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $('#editModal .modal-dialog #state_id option[value="' + state + '"]').attr("selected",
                "selected");
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
        $('.checkuniqueCity').on('change', function() {
            var cityValue = $('.checkuniqueCity').val();
            var _token = $('input[name="_token"]').val();
            $(':input[type="submit"]').prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '{!! route('admin.check.city') !!}',
                data: {
                    city: cityValue,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'error') {
                        $('.errorname').text('this city already exist');
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
