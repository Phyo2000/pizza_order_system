@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Account Profile</h3>
                        </div>
                        <hr>

                        @if (session('updateSuccess'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> <strong> {{session('updateSuccess')}} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <form action="{{route('user#accountChange', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/'. Auth::user()->image) }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit">
                                            <i class="fa-solid fa-circle-chevron-right ms-1"></i> Update
                                        </button>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name', Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input id="cc-pament" name="email" type="email" value="{{old('email', Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" value="{{old('phone', Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Gender</label>
                                        <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                            <option value="female" @if(Auth::user()->gender == 'others') selected @endif>Others</option>
                                        </select>

                                        @error('gender')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <textarea id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Address">{{old('address', Auth::user()->address)}}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Role</label>
                                        <input id="cc-pament" name="role" type="text" value="{{old('role', Auth::user()->role)}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Role" disabled>
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
@endsection
