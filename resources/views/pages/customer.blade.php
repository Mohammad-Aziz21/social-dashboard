@extends('layouts.default')
@section('content')

    <!-- start page title -->
    <div class="row pg-head">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Customers</h4>
                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add_user">
                    Add Customer
                </button>
            </div>
        </div>
    </div>

    <!-- end page title -->

   
    <!-- end row -->

    <div class="operators-section customers-admin">

        @include('includes.success')

        <div class="row">
            @if (count($customers))
                @foreach($customers as $customer)
                    <div class="col-lg-4">
                        <div class="card card-body">
                            <img src="uploads/{{ $customer['image'] }}">
                            <h4 class="card-title">{{ $customer['name'] }}</h4>
                            <p class="card-text">{{ $customer['email'] }}</p>
                            <span>{{ $customer['phone'] }}</span>
                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal{{ $customer['id'] }}">
                                View Details
                            </button>
                        </div>

                        <div id="modal{{ $customer['id'] }}" class="modal fade customer-detailModal home-opr-mod" tabindex="-1" role="dialog" aria-labelledby="customer-detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <img src="uploads/{{ $customer['image'] }}">
                                      <div>
                                        <h5 class="modal-title" id="transaction-detailModalLabel">{{ $customer['name'] }}</h5>
                                        <p>{{ $customer['email'] }}</p>
                                        <p>{{ $customer['phone'] }}</p>
                                      </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body operators-details admin-customer">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Address</strong></td>
                                                                <td>{{ $customer['address'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Insurance Barmer </strong> </td>
                                                                <td> {{ $customer['insurance_barmer'] }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Car Degree</strong></td>
                                                                <td>{{ $customer['car_degree'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Registred at</strong> </td>
                                                                <td> {{ $customer['created_at']->format('d M Y') }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Last login </strong> </td>
                                                                <td> {{ is_null($customer['last_login']) ? '-' : $customer['last_login']->format('d M Y, H:i') }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status</strong></td>
                                                                <td>{{ $customer['status'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Records open</strong> </td>
                                                                <td>231</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Records in progress </strong> </td>
                                                                <td>83</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Records done </strong></td>
                                                                <td>852</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Public logins</strong> </td>
                                                                <td>23</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Uploads</strong> </td>
                                                                <td>5</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Reminders</strong></td>
                                                                <td>5</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                   {{-- <div class="customer-detail-note">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad </p>
                                                   </div> --}}
                                                </div>
                                                <!-- end table-responsive -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="show_edit_modal({{ $customer['id'] }})">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="editmodal{{ $customer['id'] }}" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                    
                                        <h5 class="modal-title" id="transaction-detailModalLabel">Edit Customer</h5>
                    
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    @if (!$errors->edit->has('name') && !$errors->edit->has('email') && !$errors->edit->has('password'))
                                        @include('includes.errors')
                                    @endif
                                <form class="repeater" method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $customer['id'] }}">
                                    <div class="modal-body admin-customer operators-details">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="edit-form">
                                                    <div data-repeater-list="group-a">
                                                        <div data-repeater-item class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label for="name" class="form-label">Customer Name</label>
                                                                <input type="text" name="name" class="form-control" id="name" placeholder="Customer Name" value="{{ old('name', $customer['name']) }}">
                                                                @if ($errors->edit->has('name'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="email" class="form-label">Customer Email</label>
                                                                <input type="text" name="email" class="form-control" id="email" placeholder="Customer Email" value="{{ old('email', $customer['email']) }}">
                                                                @if ($errors->edit->has('email'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="password" class="form-label">Customer Password</label>
                                                                <div class="input-group auth-pass-inputgroup">
                                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Customer Password" aria-label="Password" aria-describedby="password-addon" value="{{ old('password') }}">
                                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                                </div>
                                                                @if ($errors->edit->has('password'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('password') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="phone" class="form-label">Customer Phone</label>
                                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Customer Phone" value="{{ old('phone', $customer['phone']) }}">
                                                                @if ($errors->edit->has('phone'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('phone') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="address" class="form-label">Customer Address</label>
                                                                <input type="text" name="address" class="form-control" id="address" placeholder="Customer Address" value="{{ old('address', $customer['address']) }}">
                                                                @if ($errors->edit->has('address'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('address') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="insurance_barmer" class="form-label">Customer Insurance Barmer</label>
                                                                <input type="text" name="insurance_barmer" class="form-control" id="insurance_barmer" placeholder="Customer Insurance Barmer" value="{{ old('insurance_barmer', $customer['insurance_barmer']) }}">
                                                                @if ($errors->edit->has('insurance_barmer'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('insurance_barmer') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="car_degree" class="form-label">Customer Car Degree</label>
                                                                <input type="text" name="car_degree" class="form-control" id="car_degree" placeholder="Customer Car Degree" value="{{ old('car_degree', $customer['car_degree']) }}">
                                                                @if ($errors->edit->has('car_degree'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('car_degree') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-8">
                                                                <label for="image" class="form-label">Customer Image</label>
                                                                <input type="hidden" name="previous_image" value="{{ $customer['image'] }}">
                                                                <input type="file" name="image" class="form-control" id="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>{{ 'No Customers Added Yet.' }}</div>
            @endif
            
        </div>

    </div>

    <!-- end row -->
    <div id="add_user" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="transaction-detailModalLabel">Add Customer</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (!$errors->add->has('name') && !$errors->add->has('email') && !$errors->add->has('password'))
                    @include('includes.errors')
                @endif
            <form class="repeater" method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body operators-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="edit-form">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="row">
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Customer Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Customer Name" value="{{ old('name') }}">
                                            @if ($errors->add->has('name'))
                                                <span class="text-danger text-left">{{ $errors->add->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="email" class="form-label">Customer Email</label>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="Customer Email" value="{{ old('email') }}">
                                            @if ($errors->add->has('email'))
                                                <span class="text-danger text-left">{{ $errors->add->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="password" class="form-label">Customer Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Customer Password" aria-label="Password" aria-describedby="password-addon" value="{{ old('password') }}">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                            @if ($errors->add->has('password'))
                                                <span class="text-danger text-left">{{ $errors->add->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="phone" class="form-label">Customer Phone</label>
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Customer Phone" value="{{ old('phone') }}">
                                            @if ($errors->add->has('phone'))
                                                <span class="text-danger text-left">{{ $errors->add->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="address" class="form-label">Customer Address</label>
                                            <input type="text" name="address" class="form-control" id="address" placeholder="Customer Address" value="{{ old('address') }}">
                                            @if ($errors->add->has('address'))
                                                <span class="text-danger text-left">{{ $errors->add->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="insurance_barmer" class="form-label">Customer Insurance Barmer</label>
                                            <input type="text" name="insurance_barmer" class="form-control" id="insurance_barmer" placeholder="Customer Insurance Barmer" value="{{ old('insurance_barmer') }}">
                                            @if ($errors->add->has('insurance_barmer'))
                                                <span class="text-danger text-left">{{ $errors->add->first('insurance_barmer') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="car_degree" class="form-label">Customer Car Degree</label>
                                            <input type="text" name="car_degree" class="form-control" id="car_degree" placeholder="Customer Car Degree" value="{{ old('car_degree') }}">
                                            @if ($errors->add->has('car_degree'))
                                                <span class="text-danger text-left">{{ $errors->add->first('car_degree') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-8">
                                            <label for="image" class="form-label">Customer Image</label>
                                            <input type="hidden" name="previous_image" value="default.jpg">
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var addErrors = @json($errors->add->all());
            var editErrors = @json($errors->edit->all());
            if (addErrors.length) {
                $('#add_user').modal('show');
            }
            if (editErrors.length) {
                var edit_id = {!! $errors->edit->first('edit_id') !!}
                show_edit_modal(edit_id);
            }
        });
        function show_edit_modal(id){
            $(`#editmodal${id}`).modal('show');
        }
    </script>

@stop