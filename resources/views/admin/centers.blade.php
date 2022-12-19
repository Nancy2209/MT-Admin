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
                        <h3 class="mb-2">Centers</h3>
                    </div>

                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Center</button>

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
                                                    <th> Center Name</th>

                                                    <th>Mobile </th>
                                                    <th> Email </th>
                                                    <th>Address </th>
                                                    <th>Address 1 </th>
                                                    <th>Zip Code </th>

                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (@$centers as $center)
                                                    <tr>
                                                        <td>{{ @$center->name }}</td>

                                                        <td>{{ @$center->mobile }}</td>
                                                        <td>{{ @$center->email }}</td>
                                                        <td>{{ @$center->address }}</td>
                                                        <td>{{ @$center->address1 }}</td>
                                                        <td>{{ @$center->zip_code }}</td>
                                                        <td>{{ @$center->state->name }}</td>
                                                        <td>{{ @$center->city->name }}</td>
                                                        <td>{{ @$center->area }}</td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ $center->id }}"
                                                                data-name="{{ $center->name }}"
                                                                data-mobile="{{ $center->mobile }}"
                                                                data-email="{{ $center->email }}"
                                                                data-address="{{ $center->address }}"
                                                                data-address1="{{ $center->address1 }}"
                                                                data-zipcode="{{ $center->zip_code }}"
                                                                data-state="{{ @$center->state->id }}"
                                                                data-city="{{ @$center->city->id }}"
                                                                data-area="{{ @$center->area }}">
                                                                <i class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.center', @$center->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Center
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.center') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <input type="hidden" value="" name="id" id="canter_id">
                                <div class="form-group">
                                    <label for="name">Center Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="email-1">Mobile</label>
                                    <input type="text" class="form-control allow_numeric" name="mobile"
                                        value="{{ old('mobile') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Address 1</label>
                                    <input type="text" class="form-control" name="address1"
                                        value="{{ old('address1') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email-1">State</label>
                                    <select name="state_id" class="form-control js-get-city" required>
                                        <option>Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">City</label>
                                    <select name="city_id" class="form-control city-data" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Area</label>
                                    <textarea class="form-control" name="area" requireds></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Zip</label>
                                    <input type="text" class="form-control allow_numeric" name="zip_code"
                                        value="{{ old('zip') }}" required>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Center
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.center') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="center_id">
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Center Name</label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email-1">Mobile</label>
                                        <input type="text" id="mobile" class="form-control allow_numeric"
                                            name="mobile" value="{{ old('mobile') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Email</label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Address</label>
                                        <input type="text" id="address" class="form-control" name="address"
                                            value="{{ old('address') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Address 1</label>
                                        <input type="text" id="address1" class="form-control" name="address1"
                                            value="{{ old('address1') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email-1">State</label>
                                        <select name="state_id" id="state_id" class="form-control js-get-city" required>
                                            <option>Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">City</label>
                                        <select name="city_id" id="city_id" class="form-control city-data" required>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Area</label>
                                        <textarea class="form-control" id="area" name="area" requireds></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Zip</label>
                                        <input type="text" id="zip" class="form-control allow_numeric"
                                            maxlength="6" name="zip_code" value="{{ old('zip') }}" required>
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
            var mobile = $(this).attr('data-mobile');
            var email = $(this).attr('data-email');
            var address = $(this).attr('data-address');
            var address1 = $(this).attr('data-address1');
            var zip = $(this).attr('data-zipcode');
            var state = $(this).attr('data-state');
            var city = $(this).attr('data-city');
            var area = $(this).attr('data-area');
            getCity(state);

            $("#editModal .modal-dialog #center_id").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $("#editModal .modal-dialog #mobile").val(mobile);
            $("#editModal .modal-dialog #email").val(email);
            $("#editModal .modal-dialog #address").val(address);
            $("#editModal .modal-dialog #address1").val(address1);
            $("#editModal .modal-dialog #zip").val(zip);
            $("#editModal .modal-dialog #area").val(area);
            $('#editModal .modal-dialog #state_id option[value="' + state + '"]').attr("selected",
                "selected");
            $('#editModal .modal-dialog #city_id option[value="' + city + '"]').attr("selected",
                "selected");

        });
    </script>
    <script>
        $('.js-get-city').on('change', function() {
            var that = $(this).val();
            getCity(that);

        });

        function getCity(state) {
            var id = state;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{!! route('state.city') !!}', //the page containing php script
                type: "post", //request type,
                data: {
                    id: id,
                    _token: _token
                },
                success: function(result) {
                    $('.city-data').html('');
                    $('.city-data').html(result.data);
                }
            });
        }
    </script>

    <script>
        $(".allow_numeric").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));
            if ((evt.which < 48 || evt.which > 57)) {
                evt.preventDefault();
            }
        });
    </script>
@endsection
