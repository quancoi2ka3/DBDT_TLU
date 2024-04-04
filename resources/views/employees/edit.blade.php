@extends('layout.parent')

@section('title','Cập nhật nhân viên')

@section('main')

<h3 class="mt-3  text-center">Cập nhật nhân viên </h3>
<div class="container">
    <form action="{{ route('employees.update',$employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label class="form-label" for="name">Tên nhân viên</label>
            <div class="input-group">
                <input type="text" class="form-control" name="full_name" id="full_name" value="{{$employee->full_name}}" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="address">Địa chỉ</label>
            <div class="input-group">

                <input type="text" class="form-control" name="address" id="address" value="{{$employee->address}}" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="email">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                <input type="text" class="form-control" name="email" id="email" value="{{$employee->email}}" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền email
                </div> -->
            </div>
        </div>
        <div>
            <label class="form-label" for="phone">Số điện thoại</label>
            <div class="input-group">

                <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="{{$employee->mobile_phone}}" required>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền số điện thoại
                </div> -->
            </div>
        </div>
        <label class="form-label" for="website">Chức vụ</label>
        <div class="input-group">
            <input type="text" class="form-control" name="position" id="website" value="{{$employee->position}}" required>
            <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền địa chỉ website
                </div> -->
        </div>
        <div>
            <label class="form-label" for="logo">Avatar</label>
            <div class="input-group">
                <!-- Hiển thị ảnh hiện tại -->
                <img src="{{ asset('storage/' . $employee->avatar)}}" class="img-fluid" id="currentLogo" alt="Ảnh hiện tại" style="max-width: 200px;">
                <!-- Trường input ẩn để lưu đường dẫn của ảnh -->
                <input type="hidden" name="current_logo" value="{{ $employee->avatar }}">
            </div>
        </div>
        <div>
            <label class="form-label" for="new_logo">Chọn ảnh mới</label>
            <input type="file" class="form-control" name="new_logo" id="new_logo">
        </div>
        <script>
            document.getElementById('new_logo').addEventListener('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('currentLogo').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);

                // Lấy tên của tệp tin được chọn
                var fileName = this.files[0].name;

                // Cập nhật giá trị của trường input logo
                document.querySelector('input[name="new_logo"]').value = fileName;
            });
        </script>

        <div>

            <label class="form-label" for="website">Phòng ban</label>
            <div class="input-group">
                @php
                use App\Models\Department;
                $parent = DB::table('departments')->where('id', $employee->department_id)->first();

                $departments = Department::all();
                @endphp
                <select class="form-select" id="inputGroupSelect01" name="department_id">

                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Làm ơn điền địa chỉ website
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
        <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">Lưu</button>
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