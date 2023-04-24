@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>create admin
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('createSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> <strong> {{session('createSuccess')}} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i>  <strong> {{session('deleteSuccess')}} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search key : <span class="text-dark">{{ request('key') }}</span></h4>
                        </div>

                        <div class="col-3 offset-6">
                            <form action="{{route('admin#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search">
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="text-center pt-2">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <strong>Total - {{$admin->total()}}</strong>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($a->image == null)
                                            <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="Image" />
                                        @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm" alt="Image" />
                                        @endif
                                    </td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>
                                    <td>{{ $a->address }}</td>
                                    <td>{{ $a->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">

                                            @if (Auth::user()->id == $a->id)

                                            @else
                                            <a href="{{route('admin#changeRole', $a->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                    <i class="fa-solid fa-person-circle-minus me-1"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('admin#delete', $a->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{$admin->links()}}
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
