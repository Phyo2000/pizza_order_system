@extends('admin.layouts.master')

@section('title', 'Role Change Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>

                            <form action="{{route('admin#change', $account->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            <img src="{{ asset('image/default_user.png') }}" class="shadow-sm" alt="John Doe" />
                                        @else
                                            <img src="{{ asset('storage/'. $account->image) }}" alt="John Doe" />
                                        @endif

                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-circle-chevron-right ms-1"></i> Change
                                            </button>
                                        </div>

                                    </div>

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input id="cc-pament" disabled name="name" type="text" value="{{old('name', $account->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if($account->role == 'role') selected @endif>Admin</option>
                                                <option value="user" @if($account->role == 'role') selected @endif>User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input id="cc-pament" disabled name="email" type="email" value="{{old('email', $account->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input id="cc-pament" disabled name="phone" type="number" value="{{old('phone', $account->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Gender</label>
                                            <select name="gender" disabled id="" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if($account->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if($account->gender == 'female') selected @endif>Female</option>
                                                <option value="female" @if($account->gender == 'others') selected @endif>Others</option>
                                            </select>

                                            @error('gender')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea id="cc-pament" disabled name="address" type="text" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Address">{{old('address', $account->address)}}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
