@extends('layout.parent')
@section('title','Quản lý nhân viên')

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


<h3 class="text-center text-primary mt-3">Quản lý <b class="text-primary">nhân viên</b></h3>
<div class="col-12 my-1 d-flex justify-content-end ">
	<a href="{{route('employees.create')}}" class="btn btn-success" data-toggle="modal"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i> <span>Thêm mới nhân viên</span></a>
	<a href="" id="deleteSelected" class="btn btn-danger" data-toggle="modal"><i class="fa-solid fa-trash" data-toggle="tooltip" title="Xóa"></i> <span>Xóa</span></a>
</div>
<div class="container-fluid">
	<div class="table-responsive table-bordered">
		<?php $i = 1 ?>
		<table class="table table-success table-striped table-hover">
			<caption class="table caption-top "><b>DANH SÁCH NHÂN VIÊN</b></caption>
			<thead>
				<tr>
					<th scope="col" class="text-center" style="white-space: nowrap">
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>

					<th scope="col" class="text-center" style="white-space: nowrap">Số thứ tự</th>
					<th scope="col" class="text-center" style="white-space: nowrap">Tên nhân viên</th>
					<th scope="col" class="text-center">Địa chỉ</th>
					<th scope="col" class="text-center">Email</th>
					<th scope="col" class="text-center">Số điện thoại</th>
					<th scope="col" class="text-center">Chức vụ</th>
					<th scope="col" class="text-center">Logo</th>
					<th scope="col" class="text-center" style="white-space: nowrap">Phòng ban</th>
					<th scope="col" colspan="4" class="text-center">Thao tác</th>
				</tr>
			</thead>
			<tbody>

				@foreach($employees as $employee )
				<tr id="employee_ids{{$employee->id}}">
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" name="ids" id="ids" class="checkbox_ids" value="{{ $employee->id }}">
							<label for="checkbox5"></label>
						</span>
					</td>
					<th scope="row"><b>{{ $i ++ }}</b></th>
					<td>{{$employee->full_name}}</td>
					<td>{{$employee->address}}</td>
					<td>{{$employee->email}}</td>
					<td>{{$employee->mobile_phone}}</td>
					<td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
						{{ $employee->position }}
					</td>
					<td>
						@if($employee->avatar)
						<img src="{{ asset('storage/' . $employee->avatar)}}" class="img-fluid" alt="Logo" style="width: 100px; height: auto;" onerror="this.src='https:upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1156px-Picture_icon_BLACK.svg.png'">
						@else
						<img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Logo">
						@endif
					</td>



					<td>{{$departments->find($employee->department_id)->name}}</td>


					<td>
						<a href="{{route('employees.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus" data-toggle="tooltip" title="Thêm"></i></a>
					</td>
					<td>
						<a href="{{route('employees.show',$employee->id)}}" class="btn btn-info"><i class="fa-solid fa-eye" data-toggle="tooltip" title="Xem chi tiết"></i></a>
					</td>
					<td>
						<a href="{{route('employees.edit',$employee->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square" data-toggle="tooltip" title="Cập nhật"></i></a>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#_{{$employee->id}}">
							<i data-toggle="tooltip" title="Xóa" class="fa-solid fa-trash"></i>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="_{{$employee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Cảnh báo!</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										Bạn có chắc chắn muốn xóa {{$employee->name}} không?
									</div>
									<div class="modal-footer">

										<form action="{{route('employees.destroy',$employee->id)}}" method="POST">
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
		{{ $employees->appends(request()->all())->links() }}



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
	$(function(e) {
		$("#selectAll").click(function() {
			$(".checkbox_ids").prop('checked', $(this).prop('checked'));
		});
		$('#deleteSelected').click(function(e) {
			e.preventDefault();
			var all_ids = [];
			$('input:checkbox[name=ids]:checked').each(function() {
				all_ids.push($(this).val());
			});

			$.ajax({
				url: "{{route('employees.delete')}}",
				type: "DELETE",
				data: {
					ids: all_ids,
					_token: '{{csrf_token()}}'
				},
				success: function(response) {
					$.each(all_ids, function(key, val) {
						$('#employee_ids' + val).remove();
					});
					if (response.success) {
						// Hiển thị thông báo thành công
						alert('Xóa các nhân viên đã chọn thành công');
						// Reload trang
						window.location.reload();
					}
				}
			});
		});
	});
</script>
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