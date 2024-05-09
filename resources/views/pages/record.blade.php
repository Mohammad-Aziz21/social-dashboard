@extends('layouts.default')
@section('content')

    <!-- start page title -->
    <div class="row pg-head">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Types</h4>
                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                    data-bs-toggle="modal" data-bs-target="#add_record"> Add Record </button>
            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="record-bar">
        @include('includes.success')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Record Name</th>
                                    <th>Record Type</th>
                                    <th>Customer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td> {{ $record['name'] }} </td>
                                        <td> {{ $record->type->type }} </td>
                                        <td> {{ $record->created_by_name->name }} </td>
                                        <td>
                                            <button type="button" class="badge rounded-pill badge-soft-success font-size-12" data-bs-toggle="modal" data-bs-target="#modal{{ $record['id'] }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <div id="editmodal{{ $record['id'] }}" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                    
                                                    <h5 class="modal-title" id="transaction-detailModalLabel">Edit Record</h5>
                                    
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                @if (
                                                    !$errors->edit->has('name') &&
                                                    !$errors->edit->has('type_id') &&
                                                    !$errors->edit->has('due_date') &&
                                                    !$errors->edit->has('public_details') &&
                                                    !$errors->edit->has('reminder_date') &&
                                                    !$errors->edit->has('step_1_description') &&
                                                    !$errors->edit->has('step_2_description')
                                                )
                                                    @include('includes.errors')
                                                @endif
                                                <form class="repeater" method="post" action="{{ route('record.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $record['id'] }}">
                                                    <div class="modal-body operators-details">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="edit-form">
                                                                    <div data-repeater-list="group-a">
                                                                        <div data-repeater-item class="row">
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="name" class="form-label">Record Name</label>
                                                                                <input type="text" name="name" class="form-control" id="name"
                                                                                    placeholder="Record Name" value="{{ old('name', $record['name']) }}">
                                                                                @if ($errors->edit->has('name'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="type_id" class="form-label">Record Type</label>
                                                                                <select id="type_id" class="form-select" name="type_id">
                                                                                    <option value="">Choose Type</option>
                                                                                    @foreach($types as $type)
                                                                                        <option value="{{ $type['id'] }}" {{ old('type_id', $record['type_id']) == $type['id'] ? 'selected' : '' }} > {{ $type['type'] }} </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->edit->has('type_id'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('type_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="due_date" class="form-label">Record Due Date</label>
                                                                                <input type="date" name="due_date" class="form-control"
                                                                                    id="due_date" placeholder="Record Due Date"
                                                                                    value="{{ old('due_date', $record['due_date']) }}">
                                                                                @if ($errors->edit->has('due_date'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('due_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="public_details" class="form-label">Record Public Detail</label>
                                                                                <input type="text" name="public_details" class="form-control"
                                                                                    id="public_details" placeholder="Record Public Detail"
                                                                                    value="{{ old('public_details', $record['public_details']) }}">
                                                                                @if ($errors->edit->has('public_details'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('public_details') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="reminder_date" class="form-label">Record Reminder Date</label>
                                                                                <input type="date" name="reminder_date" class="form-control"
                                                                                    id="reminder_date" placeholder="Record Reminder Date"
                                                                                    value="{{ old('reminder_date', $record['reminder_date']) }}">
                                                                                @if ($errors->edit->has('reminder_date'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('reminder_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="step_1_description" class="form-label">Step 1 Description</label>
                                                                                <input type="text" name="step_1_description" class="form-control"
                                                                                    id="step_1_description" placeholder="Step 1 Description"
                                                                                    value="{{ old('step_1_description', $record['step_1_description']) }}">
                                                                                @if ($errors->edit->has('step_1_description'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('step_1_description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="step_1_file" class="form-label">Step 1 File</label>
                                                                                <input type="hidden" name="previous_step_1_file" value="{{ $record['step_1_file'] }}">
                                                                                <input type="file" name="step_1_file" class="form-control"
                                                                                    id="step_1_file">
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="step_2_description" class="form-label">Step 2 Description</label>
                                                                                <input type="text" name="step_2_description" class="form-control"
                                                                                    id="step_2_description" placeholder="Step 2 Description"
                                                                                    value="{{ old('step_2_description', $record['step_2_description']) }}">
                                                                                @if ($errors->edit->has('step_2_description'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('step_2_description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="step_2_file" class="form-label">Step 2 File</label>
                                                                                <input type="hidden" name="previous_step_2_file" value="{{ $record['step_2_file'] }}">
                                                                                <input type="file" name="step_2_file" class="form-control"
                                                                                    id="step_2_file">
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
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($records as $record)
                        <div id="modal{{ $record['id'] }}" class="modal fade record-detailModal record-popup" tabindex="-1" role="dialog" aria-labelledby="customer-detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transaction-detailModalLabel">Records</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body operators-details">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Record name</strong> </td>
                                                                <td> {{ $record['name'] }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Record type</strong> </td>
                                                                <td> {{ $record->type->type }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Customer</strong></td>
                                                                <td> {{ $record->created_by_name->name }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status</strong></td>
                                                                <td> {{ $record['status'] }} </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Due to </strong> </td>
                                                                <td> {{ $record['due_date'] }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Public</strong></td>
                                                                <td> {{ $record['public_details'] }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Reminder</strong></td>
                                                                <td> {{ $record['reminder_date'] }} </td>
                                                            </tr>
                                                        </tbody>

                                                        <tbody class="stp-box">
                                                            <tr>
                                                                <td><strong>Step 1</strong> </td>
                                                                <td>done</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Description</strong> </td>
                                                                <td>
                                                                    <p> {{ $record['step_1_description'] }} </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Upload</strong></td>
                                                                <td><img class="record-img" src="uploads/{{ $record['step_1_file'] }}">
                                                                </td>
                                                            </tr>
                                                            <tr></tr>

                                                        </tbody>
                                                        <tbody class="stp-box">
                                                            <tr>
                                                                <td><strong>Step 2</strong> </td>
                                                                <td>open</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Description</strong> </td>
                                                                <td>
                                                                    <p> {{ $record['step_2_description'] }} </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Upload
                                                                    </strong></td>
                                                                <td><img class="record-img" src="uploads/{{ $record['step_2_file'] }}">
                                                                </td>
                                                            </tr>
                                                            <tr></tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- end table-responsive -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="show_edit_modal({{ $record['id'] }})">Edit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>

    <!-- RECORD MODAL DETAILS START -->
    
    <!-- end modal -->

    <div id="add_record" class="modal fade records-oper" tabindex="-1" role="dialog"
        aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="transaction-detailModalLabel">Add Record</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (
                    !$errors->add->has('name') &&
                    !$errors->add->has('type_id') &&
                    !$errors->add->has('due_date') &&
                    !$errors->add->has('public_details') &&
                    !$errors->add->has('reminder_date') &&
                    !$errors->add->has('step_1_description') &&
                    !$errors->add->has('step_2_description')
                )
                    @include('includes.errors')
                @endif
                <form class="repeater" method="post" action="{{ route('record.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body operators-details">
                        <div class="card">
                            <div class="card-body">
                                <div class="edit-form">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item class="row">
                                            <div class="mb-3 col-md-4">
                                                <label for="name" class="form-label">Record Name</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Record Name" value="{{ old('name') }}">
                                                @if ($errors->add->has('name'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="type_id" class="form-label">Record Type</label>
                                                <select id="type_id" class="form-select" name="type_id">
                                                    <option value="">Choose Type</option>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type['id'] }}"> {{ $type['type'] }} </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->add->has('type_id'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('type_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="due_date" class="form-label">Record Due Date</label>
                                                <input type="date" name="due_date" class="form-control"
                                                    id="due_date" placeholder="Record Due Date"
                                                    value="{{ old('due_date') }}">
                                                @if ($errors->add->has('due_date'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('due_date') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="public_details" class="form-label">Record Public Detail</label>
                                                <input type="text" name="public_details" class="form-control"
                                                    id="public_details" placeholder="Record Public Detail"
                                                    value="{{ old('public_details') }}">
                                                @if ($errors->add->has('public_details'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('public_details') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="reminder_date" class="form-label">Record Reminder Date</label>
                                                <input type="date" name="reminder_date" class="form-control"
                                                    id="reminder_date" placeholder="Record Reminder Date"
                                                    value="{{ old('reminder_date') }}">
                                                @if ($errors->add->has('reminder_date'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('reminder_date') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="step_1_description" class="form-label">Step 1 Description</label>
                                                <input type="text" name="step_1_description" class="form-control"
                                                    id="step_1_description" placeholder="Step 1 Description"
                                                    value="{{ old('step_1_description') }}">
                                                @if ($errors->add->has('step_1_description'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('step_1_description') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="step_1_file" class="form-label">Step 1 File</label>
                                                <input type="hidden" name="previous_step_1_file" value="default.jpg">
                                                <input type="file" name="step_1_file" class="form-control"
                                                    id="step_1_file">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="step_2_description" class="form-label">Step 2 Description</label>
                                                <input type="text" name="step_2_description" class="form-control"
                                                    id="step_2_description" placeholder="Step 2 Description"
                                                    value="{{ old('step_2_description') }}">
                                                @if ($errors->add->has('step_2_description'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('step_2_description') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="step_2_file" class="form-label">Step 2 File</label>
                                                <input type="hidden" name="previous_step_2_file" value="default.jpg">
                                                <input type="file" name="step_2_file" class="form-control"
                                                    id="step_2_file">
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
        $(document).ready(function() {
            var addErrors = @json($errors->add->all());
            var editErrors = @json($errors->edit->all());
            if (addErrors.length) {
                $('#add_record').modal('show');
            }
            if (editErrors.length) {
                var edit_id = {!! $errors->edit->first('edit_id') !!}
                show_edit_modal(edit_id);
            }
        });

        function show_edit_modal(id) {
            $(`#editmodal${id}`).modal('show');
        }
    </script>

@stop
