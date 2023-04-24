@extends('admin.layouts.master')

@section('title', 'Pizza Detail Page')

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
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" class="shadow-sm" alt="John Doe" />
                                </div>

                                <div class="col-7">
                                    <div class="my-3 btn bg-danger text-white d-block w-50 fs-5 text-center"><i class="fa-solid fa-pizza-slice me-2"></i> {{$pizza->name}}</div>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2"></i> {{$pizza->price}} Ks</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-clock me-2"></i> {{$pizza->waiting_time}} mins</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-eye me-2"></i> {{$pizza->view_count}}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-clone me-2"></i> {{$pizza->category_name}}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-user-clock me-2"></i> {{$pizza->created_at->format('j F Y')}}</span>
                                    <div class="my-3"> <i class="fa-solid fa-file-lines me-1"></i> <b>Description</b></div>
                                    <div class="">
                                        {{$pizza->description}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="text-center mt-3">
                                        <a href="{{route('product#updatePage', $pizza->id)}}">
                                            <button class="btn bg-dark text-white">
                                                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Pizza
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
