@extends('layout.parent')
@section('title','Quản lý phòng ban')

@section('main')
<h3 class="text-center text-primary mt-3">Quản lý <b class="text-primary">Phòng ban</b></h3>
<div class="col-12 my-1 d-flex justify-content-end ">
	<a href="{{route('departments.create')}}" class="btn btn-success" data-toggle="modal"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i> <span>Thêm mới phòng ban</span></a>
	<a href="{{route('departments.destroy','departments')}}" class="btn btn-danger" data-toggle="modal"><i class="fa-solid fa-trash"></i> <span>Xóa</span></a>
</div>
<div class="container-fluid">
	<div class="table-responsive table-bordered">

		<div class="table-title bg-dark">

			<div class="col-md-12">
				<h2 class="text-white">Danh sách <b class="text-white">Phòng ban</b></h2>
			</div>

		</div>
		<?php $i = 1 ?>
		<table class="table table-success table-striped table-hover">
			<thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th>Số thứ tự</th>
					<th>Tên phòng ban</th>
					<th>Địa chỉ</th>
					<th>Email</th>
					<th>Logo</th>
					<th>Website</th>
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
					<td>{{$department->logo}}</td>
					<td>{{$department->website}}</td>
					<td>
						<a href="{{route('departments.create')}}" class="create" data-toggle="modal"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i></a>
					</td>
					<td>
						<a href="{{route('departments.show',$department->id)}}" class="view" data-toggle="modal"><i class="fa-solid fa-eye" data-toggle="tooltip" title="Xem chi tiết"></i></a>
					</td>
					<td>
						<a href="{{route('departments.edit',$department->id)}}" class="edit" data-toggle="modal"><i class="fa-solid fa-pen-to-square" data-toggle="tooltip" title="Sửa"></i></a>
					</td>
					<td>

						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#_{{$department->id}}">
							<i class="fa-solid fa-trash"></i>
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
</div>


@endsection