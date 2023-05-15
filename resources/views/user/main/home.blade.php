@extends('user/layouts.master')

@section('content')
<!-- SHOP STARTS -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title ms-4 text-uppercase mb-3"><span class="">Our Pizza, Our Love</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white">
                        {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                        <label class="mt-2 ms-2" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal me-2">{{count($category)}}</span>
                    </div>

                    <hr>

                    @foreach ($category as $c)
                        <div class="d-flex align-items-center justify-content-between mb-3 ms-1 shadow-sm">
                            {{-- <input type="checkbox" class="custom-control-input" id="price-1"> --}}
                            <label class="" for="price-1">{{$c->name}}</label>
                            {{-- <span class="badge border font-weight-normal">{{count($category)}}</span> --}}
                        </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->

            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>

        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ms-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ms-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose Option...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                @foreach ($pizza as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height:250px" src="{{asset('storage/'.$p->image)}}" alt="product">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    {{-- <h5>20000 kyats</h5><h6 class="text-muted ms-2"><del>25000</del></h6> --}}
                                    <h5>{{$p->price}} Kyats</h5>
                                </div>
                                {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary me-1"></small>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- SHOP END -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            // $.ajax({
            //     type : 'get',
            //     url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
            //     dataType : 'json',
            //     success : function(response){
            //         console.log(response);
            //     }
            // })

            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();

                if($eventOption == 'desc'){
                    $.ajax({
                        type : 'post',
                        url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data : {'status' : 'desc'},
                        dataType : 'json',
                        success : function(response){
                            $list = '';

                            for($i=0;$i<response.length; $i++){
                                $list += '
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height:250px" src="{{asset('storage/'. ${response[$i].image})}}" alt="product">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                            </div>
                            ';
                            }

                        }
                    })
                }else if($eventOption == 'asc'){
                    $.ajax({
                        type : 'post',
                        url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data : {'status' : 'asc'},
                        dataType : 'json',
                        success : function(response){
                            console.log(response);

                        }
                    })
                }
            })
        });
    </script>
@endsection
