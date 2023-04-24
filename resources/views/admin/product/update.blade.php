@extends('admin.layouts.master')

@section('title', 'Update Pizza Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza Details</h3>
                            </div>
                            <hr>

                            <form action="{{route('product#update', $pizza->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" alt="John Doe" />


                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
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

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label class="control-label">Pizza Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName', $pizza->name)}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea id="cc-pament" name="pizzaDescription" type="text" class="form-control @error('pizzaDescription') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Description">{{old('pizzaDescription', $pizza->description)}}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Pizza Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice', $pizza->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime', $pizza->waiting_time)}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="text" value="{{$pizza->view_count}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Created Date</label>
                                            <input id="cc-pament" name="created_at" type="text" value="{{$pizza->created_at->format('j-F-Y')}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Role" disabled>
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
