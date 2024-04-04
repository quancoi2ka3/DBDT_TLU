<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::select('employees.*')

            ->orderBy('id', 'desc')
            ->paginate(8);

        if ($key = request()->key) {
            $employees = Employee::select('employees.*')

                ->orderBy('id', 'desc')
                ->where('full_name', 'like', '%' . $key . '%')
                ->paginate(8);
        }
        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }

    public function checkEmployeeCount($employee_id)
    {
        $employeeCount = Employee::where('employee_id', $employee_id)->count();
        return $employeeCount;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::all();
        $employees = Employee::all();
        return view('employees.create', compact('employees', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'full_name' => 'required|string|max:255', // Ensure name is a string
            'address' => 'required|string|max:255', // Address is also a string
            'email' => 'required|email|unique:employees,email', // Validate email format and uniqueness
            'mobile_phone' => [
                'required',
                'string',
                'max:255',
                // Regex to validate Vietnamese mobile_phone number format
                'regex:/^(0|\+84)(\d{1})(\d{8,9})$/',
            ],
            'position' => 'required|string',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_id' => 'required|exists:departments,id', // 

        ]);
        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('public/logos');
            $validateData['avatar'] = str_replace('public/', '', $imagePath);
        }

        employee::create($validateData);
        session()->flash('success', 'Thêm nhân viên thành công');
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employee = employee::find($id);
        return view('employees.detail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $employee = employee::find($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $employee = employee::find($id);
        if (!$employee) {
            return redirect()->route('employees.index')
                ->with('error', 'employee not found.');
        }

        // Validate dữ liệu từ form
        $validateData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_phone' => 'required|string|max:255',
            'position' => 'required|string',
            'department_id' => 'required|exists:departments,id', 

        ]);

        // Kiểm tra xem người dùng đã chọn ảnh mới hay không
        if ($request->hasFile('new_logo')) {
            // Xóa ảnh cũ
            Storage::delete('public/logos' . $employee->logo);

            // Lưu ảnh mới vào thư mục storage
            $imagePath = $request->file('new_logo')->store('public/logos');

            // Cập nhật đường dẫn ảnh mới vào trường 'logo'
            $validateData['avatar'] = str_replace('public/', '', $imagePath);
        }

        // Nếu không có ảnh mới được chọn và trường logo không tồn tại trong dữ liệu đã được validate,
        // sử dụng đường dẫn ảnh hiện tại
        if (!$request->hasFile('new_logo') && !array_key_exists('logo', $validateData)) {
            $validateData['avatar'] = $request->current_logo; // Sử dụng trường input ẩn current_logo
        }

        // Cập nhật dữ liệu của nhân viên
        $employee->update($validateData);

        session()->flash('success', 'Cập nhật nhân viên thành công');

        return redirect()->route('employees.index');
    }




    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $employee = employee::find($id);
        $employee->delete();
        session()->flash('success', 'Xóa nhân viên thành công');
        return redirect()->route('employees.index');
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        employee::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    }
}
