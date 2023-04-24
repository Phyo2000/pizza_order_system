@extends('admin.layouts.master')

@section('title', 'Account Detail Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> <strong> {{session('updateSuccess')}} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
        @endif
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.png') }}" class="shadow-sm" alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm mt-4" alt="John Doe" />
                                    @endif
                                </div>

                                <div class="col-5 offset-2">
                                    <h4 class="mb-3 my-5"> <i class="fa-solid fa-user-pen me-2"></i> {{Auth::user()->name}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i> {{Auth::user()->email}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-phone me-2"></i> {{Auth::user()->phone}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-address-card me-2"></i> {{Auth::user()->address}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-mars-and-venus me-2"></i> {{Auth::user()->gender}} </h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-user-clock me-2"></i> {{Auth::user()->created_at->format('j F Y')}}</h4>
                                </div>

                                <div class="row">
                                    <div class="text-center mt-3">
                                        <a href="{{route('admin#edit')}}">
                                            <button class="btn bg-dark text-white">
                                                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
