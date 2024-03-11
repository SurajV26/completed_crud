<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search', '');
            $selectedStatus = $request->input('status', 'all');
            
            $query = employee::query();
            
            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('mobile_no', 'like', "%$search%");
                });
            }   
            
            if ($selectedStatus !== 'all') {
                $query->where('status', $selectedStatus);
            }
            
            $employees = $query->latest()->paginate(5);
            
            return view('employee.index', compact('employees', 'search', 'selectedStatus'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function changeStatus($id){
        $getStatus = employee::where('id',$id)->first();
      
        if($getStatus->status=='active')
        {
          
            $status='inactive';
        }
        else
        {
            $status='active';
        }
        employee::where('id',$id)->update(['status'=>$status]);
       
        return redirect ('/employee');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'mobile_no' => 'required|numeric|digits:10|unique:employees,mobile_no',
            'password' => 'required|string|min:8',
            'dob' => 'required|date',
            'profile' => 'required',
            'status' => 'required|in:ACTIVE,INACTIVE',
        ]);
    
        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');
            $profileImagePath = $profileImage->store('profile_images', 'public');
        } else {
            $profileImagePath = null; // No image provided
        }
    
        // Determine the value of 'is_active' based on the selected 'status'
        $is_active = $request->status === 'ACTIVE' ? 'ACTIVE' : 'INACTIVE';
    
        employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => $request->password,
            'dob' => $request->dob,
            'profile' => $profileImagePath,
            "status" => $request->status,
        ]);
    
        return redirect()->route('employee.index')
            ->with('success', 'Employee created successfully.');
    }
  
    
        public function create()
    {
        return view('employee.create');
    }
    

    public function show(employee $employee)
    {
        return view('employee.show', compact('employee'));
    }


    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }
    
 
public function update(Request $request, Employee $employee)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees,email,' . $employee->id,
        'mobile_no' => 'required|numeric|min:10',
        'password' => 'nullable|string|min:8',
        'dob' => 'required|date',
        'profile' => 'sometimes',
        'status' => 'nullable',
    ]);

    if ($request->hasFile('profile')) {

        $profileImage = $request->file('profile');

        $profileImagePath = $profileImage->store('profile_images', 'public');

  
        $employee->profile = $profileImagePath;
    }


    $employee->name = $validatedData['name'];
    $employee->email = $validatedData['email'];
    $employee->mobile_no = $validatedData['mobile_no'];
    $employee->dob = $validatedData['dob'];
    $employee->status = $validatedData['status'];

   
    $employee->save();

    return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
}  


    // public function destroy(employee $employee)
    // {
    //     $employee->delete();
    //     return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    // }

    public function destroy($id)
    {
        try {
            // Find the employee by the given $id
            $employee = Employee::find($id);
    
            if (!$employee) {
                // If the employee is not found, return with an error message
                return back()->with('error', 'Employee not found.');
            }
    
            // Delete the employee
            $employee->delete();
    
            $msg = "Employee deleted successfully!";
    
            // Redirect to the desired route with a success message
            return redirect()->route('employee.index')->with('msg', $msg);
        } catch (\Exception $ex) {
            // Handle any exceptions that might occur during the process
            return back()->with('error', $ex->getMessage());
        }
    }
           
}
