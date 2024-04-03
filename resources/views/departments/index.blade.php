@extends('layout.parent')
@section('title','Quản lý phòng ban')

@section('main')
@if (session()->has('success'))
<div id="successAlert" class="alert alert-success" role="alert">
	{{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif


<h3 class="text-center text-primary mt-3">Quản lý <b class="text-primary">Phòng ban</b></h3>
<div class="col-12 my-1 d-flex justify-content-end ">
	<a href="{{route('departments.create')}}" class="btn btn-success" data-toggle="modal"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i> <span>Thêm mới phòng ban</span></a>
	<a href="{{route('departments.destroy','departments')}}" class="btn btn-danger" data-toggle="modal"><i class="fa-solid fa-trash"></i> <span>Xóa</span></a>
</div>
<div class="container-fluid">
	<div class="table-responsive table-bordered">
		<?php $i = 1 ?>
		<table class="table table-success table-striped table-hover">
			<caption class="table caption-top "><b>DANH SÁCH PHÒNG BAN</b></caption>
			<thead>
				<tr>
					<th class="text-center" style="white-space: nowrap">
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th class="text-center" style="white-space: nowrap">Số thứ tự</th>
					<th class="text-center" style="white-space: nowrap">Tên phòng ban</th>
					<th class="text-center">Địa chỉ</th>
					<th class="text-center">Email</th>
					<th class="text-center">Logo</th>
					<th class="text-center">Website</th>
					<th class="text-center">Số nhân viên</th>
					<th colspan="4" class="text-center">Thao tác</th>
				</tr>
			</thead>
			<tbody>

				@foreach($departments as $department )
				<tr>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" name="ids[]" id="ids" value="{{ $department->id }}">
							<label for="checkbox5"></label>
						</span>
					</td>
					<th scope="row"><b>{{ $i ++ }}</b></th>
					<td>{{$department->name}}</td>
					<td>{{$department->address}}</td>
					<td>{{$department->email}}</td>
					<td>
						@if($department->logo)
						<img src="{{ asset('storage/' . $department->logo)}}" class="img-fluid" alt="Logo" onerror="this.src='https:www.iconpacks.net/icons/1/free-building-icon-1062-thumb.png'">
						@else
						<img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Logo">
						@endif
					</td>

					<td style="text-overflow: ellipsis;  white-space: nowrap">
						<a href="{{ $department->website }}">{{ $department->website }}</a>
					</td>
					


					<td>
						<a href="{{route('departments.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i></a>
					</td>
					<td>
						<a href="{{route('departments.show',$department->id)}}" class="btn btn-info"><i class="fa-solid fa-eye" data-toggle="tooltip" title="Xem chi tiết"></i></a>
					</td>
					<td>
						<a href="{{route('departments.edit',$department->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square" data-toggle="tooltip" title="Cập nhật"></i></a>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#_{{$department->id}}">
							<i data-toggle="tooltip" title="Xóa" class="fa-solid fa-trash"></i>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="_{{$department->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Cảnh báo!</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										Bạn có chắc chắn muốn xóa {{$department->name}} không?
									</div>
									<div class="modal-footer">

										<form action="{{route('departments.destroy',$department->id)}}" method="POST">
											@csrf
											@method('DELETE')
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
											<button type="submit" class="btn btn-primary">Xác nhận xóa</button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $departments->appends(request()->all())->links() }}
		<p>Đang ở trang thứ <b>{{ $departments->currentPage() }}</b> trên tổng số <b>{{ $departments->lastPage() }} </b>trang</p>


	</div>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
</div>
<script>
	// Sử dụng JavaScript để ẩn thông báo sau 5 giây
	setTimeout(function() {
		var alert = document.getElementById('successAlert');
		if (alert) {
			alert.style.display = 'none';
		}
	}, 5000); // Thời gian tính bằng mili giây, 5000 mili giây tương đương với 5 giây
</script>

@endsection