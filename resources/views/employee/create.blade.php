@extends('employee.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Employee</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
            </div>
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mobile No:</strong>
                <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No." value="{{ old('mobile_no') }}">
            </div>
            @if ($errors->has('mobile_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile_no') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password"value="{{ old('password') }}">
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DOB:</strong>
                <input type="date" name="dob" class="form-control" placeholder="Date Of Birth" value="{{ old('dob') }}">
            </div>
            @if ($errors->has('dob'))
                <span class="help-block">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
            <strong for="profile">Profile</strong><br>
            <input type="file" name="profile" id="profile" value="1">
            @if ($errors->has('profile'))
            <span class="help-block">
                <strong>{{ $errors->first('profile') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3 mt-3">
            <strong for="">Status:<span class="required"> *</span></strong>
            <select class="form-control" name="status">
                <option value="">Select Status</option>
                <option value="ACTIVE" {{ old('status') == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                <option value="INACTIVE" {{ old('status') == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
            </select>
            @if ($errors->has('status'))
            <span class="errors text-danger" role="alert" id="errorstatus">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
    </form>
@endsection