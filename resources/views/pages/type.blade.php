@extends('layouts.default')
@section('content')

    <!-- start page title -->
    <div class="row pg-head">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Types</h4>
                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                    data-bs-toggle="modal" data-bs-target="#add_type"> Add Type </button>
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
                                    <th>Type Name</th>
                                    <th>Type Description </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td> {{ $type['type'] }} </td>
                                        <td> {{ $type['description'] }} </td>
                                        <td>
                                            <button type="button" class="badge rounded-pill badge-soft-success font-size-12" data-bs-toggle="modal" data-bs-target="#modal{{ $type['id'] }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <div id="editmodal{{ $type['id'] }}" class="modal fade records-oper" tabindex="-1"
                                        role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="transaction-detailModalLabel">Edit Type</h5>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                @if (
                                                    !$errors->edit->has('type') &&
                                                        !$errors->edit->has('description') &&
                                                        !$errors->edit->has('start_date') &&
                                                        !$errors->edit->has('services'))
                                                    @include('includes.errors')
                                                @endif
                                                <form class="repeater" method="post" action="{{ route('type.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $type['id'] }}">
                                                    <div class="modal-body operators-details">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="edit-form">
                                                                    <div data-repeater-list="group-a">
                                                                        <div data-repeater-item class="row">
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="type"
                                                                                    class="form-label">Type Name</label>
                                                                                <input type="text" name="type"
                                                                                    class="form-control" id="type"
                                                                                    placeholder="Type Name"
                                                                                    value="{{ old('type', $type['type']) }}">
                                                                                @if ($errors->edit->has('type'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('type') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="description"
                                                                                    class="form-label">Type
                                                                                    Description</label>
                                                                                <input type="text" name="description"
                                                                                    class="form-control" id="description"
                                                                                    placeholder="Type Description"
                                                                                    value="{{ old('description', $type['description']) }}">
                                                                                @if ($errors->edit->has('description'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="start_date"
                                                                                    class="form-label">Type Start
                                                                                    Date</label>
                                                                                <input type="date" name="start_date"
                                                                                    class="form-control" id="start_date"
                                                                                    placeholder="Type Start Date"
                                                                                    value="{{ old('start_date', $type['start_date']) }}">
                                                                                @if ($errors->edit->has('start_date'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('start_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="services"
                                                                                    class="form-label">Type Services</label>
                                                                                <input type="text" name="services"
                                                                                    class="form-control" id="services"
                                                                                    placeholder="Type Services"
                                                                                    value="{{ old('services', $type['services']) }}">
                                                                                @if ($errors->edit->has('services'))
                                                                                    <span
                                                                                        class="text-danger text-left">{{ $errors->edit->first('services') }}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3 col-md-8">
                                                                                <label for="file"
                                                                                    class="form-label">Type File</label>
                                                                                <input type="hidden" name="previous_file"
                                                                                    value="{{ $type['file'] }}">
                                                                                <input type="file" name="file"
                                                                                    class="form-control" id="file">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($types as $type)
                            <div id="modal{{ $type['id'] }}" class="modal fade records-oper" tabindex="-1"
                                role="dialog" aria-labelledby="typeview-detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="transaction-detailModalLabel">View Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body operators-details">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Type name</strong> </td>
                                                                    <td>{{ $type['type'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Type Start Date</strong> </td>
                                                                    <td>{{ $type['start_date'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Type Services</strong> </td>
                                                                    <td>{{ $type['services'] }}</td>
                                                                </tr>
                                                            </tbody>
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Type description</strong></td>
                                                                    <td><span>{{ $type['description'] }}</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Upload</strong> </td>
                                                                    <td>{{ $type['file'] }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end table-responsive -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="show_edit_modal({{ $type['id'] }})">Edit</button>
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


    <div id="add_type" class="modal fade records-oper" tabindex="-1" role="dialog" aria-labelledby="typeedit-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="transaction-detailModalLabel">Add Type</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (
                    !$errors->add->has('type') &&
                        !$errors->add->has('description') &&
                        !$errors->add->has('start_date') &&
                        !$errors->add->has('services'))
                    @include('includes.errors')
                @endif
                <form class="repeater" method="post" action="{{ route('type.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body operators-details">
                        <div class="card">
                            <div class="card-body">
                                <div class="edit-form">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item class="row">
                                            <div class="mb-3 col-md-4">
                                                <label for="type" class="form-label">Type Name</label>
                                                <input type="text" name="type" class="form-control" id="type"
                                                    placeholder="Type Name" value="{{ old('type') }}">
                                                @if ($errors->add->has('type'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('type') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="description" class="form-label">Type Description</label>
                                                <input type="text" name="description" class="form-control"
                                                    id="description" placeholder="Type Description"
                                                    value="{{ old('description') }}">
                                                @if ($errors->add->has('description'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('description') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="start_date" class="form-label">Type Start Date</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    id="start_date" placeholder="Type Start Date"
                                                    value="{{ old('start_date') }}">
                                                @if ($errors->add->has('start_date'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('start_date') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="services" class="form-label">Type Services</label>
                                                <input type="text" name="services" class="form-control"
                                                    id="services" placeholder="Type Services"
                                                    value="{{ old('services') }}">
                                                @if ($errors->add->has('services'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->add->first('services') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-8">
                                                <label for="file" class="form-label">Type File</label>
                                                <input type="hidden" name="previous_file" value="default.jpg">
                                                <input type="file" name="file" class="form-control"
                                                    id="file">
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
                $('#add_type').modal('show');
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
