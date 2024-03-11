@extends('employee.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <th>Gmail</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th>Mobile No</th>
                        <td>{{ $employee->mobile_no }}</td>
                    </tr>
                    <tr>
                        <th>DOB</th>
                        <td>{{ !empty($employee->dob) ? date('d-m-Y', strtotime($employee->dob)) : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $employee->status }}</td>
                    </tr>
                    <tr>
                        <th>Profile</th>
                        <td>
                            <img src="{{ '/storage/' . $employee->profile }}" width="100" height="120">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
