@extends('layouts.default')
@section('content')

    <!-- start page title -->
    <div class="row pg-head">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Operators</h4>
                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add_user">
                    Add Operator
                </button>
            </div>
        </div>
    </div>

    <!-- end page title -->

   
    <!-- end row -->

    <div class="operators-section">

        @include('includes.success')

        <div class="row">
            @if (count($operators))
                @foreach($operators as $operator)
                    <div class="col-lg-4">
                        <div class="card card-body">
                            <img src="uploads/{{ $operator['image'] }}">
                            <h4 class="card-title">{{ $operator['name'] }}</h4>
                            <p class="card-text">{{ $operator['email'] }}</p>
                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal{{ $operator['id'] }}">
                                View Details
                            </button>
                        </div>
                        <div id="modal{{ $operator['id'] }}" class="modal fade home-opr-mod" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <img src="uploads/{{ $operator['image'] }}">
                                    <div>
                                        <h5 class="modal-title" id="transaction-detailModalLabel">{{ $operator['name'] }}</h5>
                                        <p>{{ $operator['email'] }}</p>
                                    </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body operators-details">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Registred at
                                                                </strong> </td>
                                                                <td>
                                                                    {{ $operator['created_at']->format('d M Y') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Last login </strong> </td>
                                                                <td>
                                                                    {{ is_null($operator['last_login']) ? '-' : $operator['last_login']->format('d M Y, H:i') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status
                                                                </strong></td>
                                                                <td>{{ $operator['status'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Customers created
                                                                </strong> </td>
                                                                <td>420
                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Assigned to customers </strong> </td>
                                                                <td>639
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Records open
                                                                </strong> </td>
                                                                <td>231 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Records in progress </strong> </td>
                                                                <td>83
                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Records done
                                                                </strong></td>
                                                                <td>852
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end table-responsive -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="show_edit_modal({{ $operator['id'] }})">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="editmodal{{ $operator['id'] }}" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                    
                                        <h5 class="modal-title" id="transaction-detailModalLabel">Edit Operator</h5>
                    
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    @if (!$errors->edit->has('name') && !$errors->edit->has('email') && !$errors->edit->has('password'))
                                        @include('includes.errors')
                                    @endif
                                <form class="repeater" method="post" action="{{ route('operator.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $operator['id'] }}">
                                    <div class="modal-body operators-details">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="edit-form">
                                                    <div data-repeater-list="group-a">
                                                        <div data-repeater-item class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label for="name" class="form-label">Operator Name</label>
                                                                <input type="text" name="name" class="form-control" id="name" placeholder="Operator Name" value="{{ old('name', $operator['name']) }}">
                                                                @if ($errors->edit->has('name'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="email" class="form-label">Operator Email</label>
                                                                <input type="text" name="email" class="form-control" id="email" placeholder="Operator Email" value="{{ old('email', $operator['email']) }}">
                                                                @if ($errors->edit->has('email'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="password" class="form-label">Operator Password</label>
                                                                <div class="input-group auth-pass-inputgroup">
                                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Operator Password" aria-label="Password" aria-describedby="password-addon" value="{{ old('password') }}">
                                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                                </div>
                                                                @if ($errors->edit->has('password'))
                                                                    <span class="text-danger text-left">{{ $errors->edit->first('password') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 col-md-8">
                                                                <label for="image" class="form-label">Operator Image</label>
                                                                <input type="hidden" name="previous_image" value="{{ $operator['image'] }}">
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
                <div>{{ 'No Operators Added Yet.' }}</div>
            @endif
            
        </div>

    </div>

    <!-- end row -->
    <div id="add_user" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="transaction-detailModalLabel">Add Operator</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (!$errors->add->has('name') && !$errors->add->has('email') && !$errors->add->has('password'))
                    @include('includes.errors')
                @endif
            <form class="repeater" method="post" action="{{ route('operator.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body operators-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="edit-form">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="row">
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Operator Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Operator Name" value="{{ old('name') }}">
                                            @if ($errors->add->has('name'))
                                                <span class="text-danger text-left">{{ $errors->add->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="email" class="form-label">Operator Email</label>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="Operator Email" value="{{ old('email') }}">
                                            @if ($errors->add->has('email'))
                                                <span class="text-danger text-left">{{ $errors->add->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="password" class="form-label">Operator Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Operator Password" aria-label="Password" aria-describedby="password-addon" value="{{ old('password') }}">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                            @if ($errors->add->has('password'))
                                                <span class="text-danger text-left">{{ $errors->add->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-8">
                                            <label for="image" class="form-label">Operator Image</label>
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