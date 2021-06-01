@extends('backend.layout.master')

@section('main-content')
<div class="wrap">
    <a class="btn btn-primary mb-2" href="{{ route('customers.view') }}">List customers</a>
    <div class="card shadow">
        <div class="card-body">
            <h2>Edit Customer</h2>
            <form action="{{ route('customers.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $data->name }}">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input class="form-control" type="text" name="phone" value="{{ $data->phone }}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ $data->email }}">
                </div>
                <div class="form-group">
                    <label for="">Gender</label><br>
                    <input {{ (isset($data->gender) && $data->gender == 'male') ? 'checked' : '' }} type="radio"
                        name="gender" id="male" value="male"><label for="male" class="mr-3 ml-1">Male</label>
                    <input {{ (isset($data->gender) && $data->gender == 'female') ? 'checked' : '' }} type="radio"
                        name="gender" id="female" value="female"><label for="female" class="ml-1">Female</label>
                </div>
                <div class="form-group">
                    <label for="profile_photo" class="text-success"><i class="fas fa-file-image fa-4x"></i></label>
                    <input type="file" name="profile_photo" class="d-none" id="profile_photo">
                    <img id="profile_photo_load" src="{{ URL::to('') }}/uploads/customers/{{ $data->profile_photo }}"
                        alt="" style="width: 150px; display: block;">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Add new">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection