@extends('layout.parent')

@section('title','Thêm mới nhân viên')

@section('main')

<h3 class="mt-3 text-center">Thêm nhân viên mới </h3>
<div class="container">
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label class="form-label" for="name">Tên nhân viên</label>
            <div class="input-group">
                <input type="text" class="form-control" name="full_name" id="name" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="address">Địa chỉ</label>
            <div class="input-group">

                <input type="text" class="form-control" name="address" id="address" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="email">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                <input type="text" class="form-control" name="email" id="email" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="phone">Số điện thoại</label>
            <div class="input-group">

                <input type="text" class="form-control" name="mobile_phone" id="phone" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền số điện thoại
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="website">Chức vụ</label>
            <div class="input-group">
                <input type="text" class="form-control" name="position" id="website" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền địa chỉ website
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="avatar">Avatar</label>
            <div class="input-group">
                <input type="file" class="form-control" name="avatar" id="logo" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Logo không được bỏ trống
                </div> -->
            </div>
        </div>

        <!-- <div class="col-md-3" >
        <label for="validationServer05" class="form-label">Ghi chú</label>
        <div id="editor">
        <input type="text" class="form-control" id="validationServer05" aria-describedby="validationServer05Feedback" >
        </div>
        <div id="validationServer05Feedback" class="invalid-feedback">
            Điền ghi chú không
        </div>
    </div> -->
        <!-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" >
                <label class="form-check-label" for="invalidCheck3">
                    Agree to terms and conditions
                </label>
                <div id="invalidCheck3Feedback" class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div> -->
        <div class="input-group my-3">
            <label class="input-group-text" for="inputGroupSelect01">Chọn phòng ban phụ thuộc</label>
            <select class="form-select" id="inputGroupSelect01" name="department_id">
                @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">Thêm</button>
        </div>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <a href="{{route('employees.index')}}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
</div>

@endsection