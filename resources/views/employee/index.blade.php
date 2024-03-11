@extends('employee.layout')
 
@section('content')
    <hr/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}"> Create New Employee</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <hr/>
    <form action="{{ route('employee.index') }}" method="GET">
        <div class="row">
            <div class="col-md-3">
                <strong>Search</strong>
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search here..." />
            </div>
            <div class="col-md-3">
                <label for="status">Status</label>
                <select name="status" class="custom-select">
                    <option value="all" {{ $selectedStatus == 'all' ? 'selected' : '' }}>Select Status</option>
                    <option value="ACTIVE" {{ $selectedStatus == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                    <option value="INACTIVE" {{ $selectedStatus == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                </select>
            </div>
            <div class="col-md-3" style="margin-top: 31px;">
                <button type="submit" class="btn btn-success">Search</button>
                <a href="{{ route('employee.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </div>
    </form>
    <hr/>
    

    <table class="table table-bordered">
        {{-- < action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data"> --}}
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No.</th>
            {{-- <th>Password</th> --}}
            <th>DOB</th>
            <th>Profile Pic</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->mobile_no }}</td>
            {{-- <td>{{ $employee->password }}</td> --}}
            <td>{{ !empty($employee->dob) ? date('d-m-Y', strtotime($employee->dob)) : 'N/A' }}</td>
            <td>
                @if ($employee->profile)
                <img src="{{ asset('storage/' . $employee->profile) }}" alt="Profile Image" width="120" height="120">
                @else
                    <span>N/A</span>
                @endif
            </td>            
            <td>
                @if ($employee->status == 'active')
                    <a href="{{url('/employee-status/'.$employee->id )}}"
                        class="btn btn-success">Active</a>
                    @else
                    <a href="{{url('/employee-status/'.$employee->id )}}"
                        class="btn btn-danger">InActive</a>
                @endif
            </td>
            <td>
                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-success">Edit</a>
                <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-primary">Show</a>
                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Employee Member?')" style="margin: 10px">Delete</button>
                </form>                               
             </td>
        </tr>
        @endforeach
    </table>
    
  
    {!! $employees->links() !!}

@endsection
