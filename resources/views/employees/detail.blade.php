@extends('layout.parent')

@section('title','Chi tiết nhân viên')

@section('main')
<h3 class="mt-3">Chi tiết nhân viên </h3>
<div class="container">
    <form></form>
    <div>
        <label class="form-label" for="name">Tên nhân viên</label>
        <div class="input-group">
            <input type="text" class="form-control" name="name" id="name" value="{{$employee->full_name}}" readonly>
        </div>
    </div>
    <div>
        <label class="form-label" for="address">Địa chỉ</label>
        <div class="input-group">

            <input type="text" class="form-control" name="address" id="address" value="{{$employee->address}}" readonly>
        </div>
    </div>
    <div>
        <label class="form-label" for="email">Email</label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend3">@</span>
            <input type="text" class="form-control" name="email" id="email" value="{{$employee->email}}" readonly>
        </div>
    </div>
    <div>
        <label class="form-label" for="phone">Số điện thoại</label>
        <div class="input-group">

            <input type="text" class="form-control" name="phone" id="phone" value="{{$employee->mobile_phone}}" readonly>
        </div>
    </div>
    <div>
        <label class="form-label" for="website">Chức vụ</label>
        <div class="input-group">
            <input type="text" class="form-control" name="position" id="website" value="{{$employee->position}}" readonly>
        </div>
    </div>
    <div>
        <label class="form-label" for="logo">Avatar</label>
        <div class="input-group">
            <!-- Hiển thị ảnh hiện tại -->
            <img src="{{ asset('storage/' . $employee->avatar)}}" class="img-fluid" id="currentLogo" alt="Ảnh hiện tại" style="max-width: 200px;">
            <!-- Trường input ẩn để lưu đường dẫn của ảnh -->
            <input type="hidden" name="logo" value="{{ $employee->avatar }}" readonly>
        </div>
    </div>
    
    <div>
        <label class="form-label" for="website">nhân viên phụ thuộc</label>
        @php
        $parent = DB::table('departments')->where('id', $employee->department_id)->first();

        @endphp
        @if($parent!=null)
        <div class="input-group">
            <input type="text" class="form-control" name="parent_id" id="parent_id" value="{{$parent->name}}" readonly>
        </div>
        @else
        <div class="input-group">
            <input type="text" class="form-control" name="parent_id" id="parent_id" value="Không phụ thuộc phòng ban nào" readonly>
        </div>
        @endif
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
    <a href="{{route('employees.index')}}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
    </form>
</div>

@endsection