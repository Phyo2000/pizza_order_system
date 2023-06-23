@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                <td><img src="{{ asset('storage/' . $c->product_image) }}" alt=""
                                        class="img-thumbnail shadow-sm" style="width: 70px;"></td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }} <input type="hidden" class="productId"
                                        value="{{ $c->product_id }}"> <input type="hidden" class="userId"
                                        value="{{ $c->user_id }}"> </td>
                                <td class="align-middle" id="price">{{ $c->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center"
                                            value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="totalP">{{ $c->pizza_price * $c->qty }} Kyats</td>
                                <input type="hidden" value="{{ $c->pizza_price * $c->qty }}" id="total">
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;

                $parentNode.find('#totalP').html($total + " Kyats");

                summaryCalculation();
            })
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;

                $parentNode.find('#totalP').html($total + " Kyats");

                summaryCalculation();
            })

            $('.btnRemove').click(function() {
                $parentNode = $(this).parents("tr");
                $parentNode.remove();

                summaryCalculation();

            })

            function summaryCalculation() {
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#totalP').text().replace("Kyats", ""));
                });

                $("#subTotalPrice").html(`${$totalPrice} Kyats`);
                $("#finalPrice").html(`${$totalPrice + 3000} Kyats`);

            }

        })
    </script>
    <script>
        $('#orderBtn').click(function() {
            $orderList = [];

            $random = Math.floor(Math.random() * 1000000001);

            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#totalP').text().replace("Kyats", "") * 1,
                    'order_code': 'PAZ' + $random
                });
            });

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                data: $orderList,
                dataType: 'json',
                success: function(response) {

                }
            })
        })
    </script>
@endsection
