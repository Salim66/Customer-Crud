@extends('backend.layout.master')


@section('main-content')
<div class="wrap-table">
    @include('validation')
    <a class="btn btn-primary mb-2" href="{{ route('customers.add') }}">Add new customer</a>
    <div class="card shadow">
        <div class="card-body">
            <h2>All Customers</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Profile Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($all_data as $data)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->gender }}</td>
                        <td>
                            <input type="checkbox" class="status_customer btn btn-success btn-sm" data-size="mini"
                                data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                data-toggle="toggle" data-id="{{ $data->id }}" @if($data->status == 1) checked @endif>
                        </td>
                        <td><img src="{{ URL::to('') }}/uploads/customers/{{ $data->profile_photo }}" alt=""></td>
                        <td>
                            <a class="btn btn-sm btn-info" id="show_customer" data-id="{{ $data->id }}"
                                data-toggle="modal" href="#">View</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('customers.edit', $data->id) }}">Edit</a>
                            <a class="btn btn-sm btn-danger"
                                href="{{ route('customers.delete', $data->id) }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- customer view detials modal -->
<div class="modal fade" id="customer_details_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt=""
                    style="width: 150px; height: 150px; border-radius: 50%; display: block; margin: 0 auto;">
                <h2 class="name" style="text-align: center"></h2>
                <table class="table table-striped">
                    <tr>
                        <td>Name</td>
                        <td class="name"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="email"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="phone"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td class="gender"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection