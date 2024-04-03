<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::orderBy('id', 'desc')->paginate(8); // Paginate with 15 items per page
        $employeeCount = Employee::where('department_id')->count();
        return view('departments.index', compact('departments'));
    }
    public function checkEmployeeCount($department_id)
    {
        $employeeCount = Employee::where('department_id', $department_id)->count();
        return $employeeCount;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::all();
        return view('departments.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255', // Ensure name is a string
            'address' => 'required|string|max:255', // Address is also a string
            'email' => 'required|email|unique:departments,email', // Validate email format and uniqueness
            'phone' => [
                'required',
                'string',
                'max:255',
                // Regex to validate Vietnamese phone number format
                'regex:/^(0|\+84)(\d{1})(\d{8,9})$/',
            ],
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'required|string', // 
            'parent_id' => 'nullable|exists:departments,id', // Ensure parent_id exists in departments table

        ]);
        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('public/logos');
            $validateData['logo'] = str_replace('public/', '', $imagePath);
        }

        Department::create($validateData);
        session()->flash('success', 'Thêm phòng ban thành công');
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $department = Department::find($id);
        return view('departments.detail', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $department = Department::find($id);
        if (!$department) {
            return redirect()->route('departments.index')
                ->with('error', 'Department not found.');
        }

        // Validate dữ liệu từ form
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'website' => 'required|string',
            'parent_id' => 'nullable|exists:departments,id',
        ]);

        // Kiểm tra xem người dùng đã chọn ảnh mới hay không
        if ($request->hasFile('new_logo')) {
            // Xóa ảnh cũ
            Storage::delete('public/logos' . $department->logo);

            // Lưu ảnh mới vào thư mục storage
            $imagePath = $request->file('new_logo')->store('public/logos');

            // Cập nhật đường dẫn ảnh mới vào trường 'logo'
            $validateData['logo'] = str_replace('public/', '', $imagePath);
        }

        // Nếu không có ảnh mới được chọn và trường logo không tồn tại trong dữ liệu đã được validate,
        // sử dụng đường dẫn ảnh hiện tại
        if (!$request->hasFile('new_logo') && !array_key_exists('logo', $validateData)) {
            $validateData['logo'] = $request->current_logo; // Sử dụng trường input ẩn current_logo
        }

        // Cập nhật dữ liệu của phòng ban
        $department->update($validateData);

        session()->flash('success', 'Cập nhật phòng ban thành công');

        return redirect()->route('departments.index');
    }




    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
        session()->flash('success', 'Xóa phòng ban thành công');
        return redirect()->route('departments.index');
    }
}
