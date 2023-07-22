@extends('admin.layouts.master')

@section('title', 'Order List Page')

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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>

                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> <strong> {{ session('createSuccess') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> <strong> {{ session('deleteSuccess') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row my-2">
                        <div class="text-center pt-2">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <strong>Total - {{ count($order) }} </strong>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('admin#changeStatus') }}" method="get" class="col-5">
                        @csrf
                        <div class="input-group mb-3">

                            <label for="" class="mt-2 me-4">Order Status</label>

                            <select name="orderStatus" class="custom-select">
                                <option value="">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                </option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-sm bg-dark text-white">Search</button>
                            </div>
                        </div>
                    </form>

                    @if (count($order) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($order as $o)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                                            <td>{{ $o->user_id }}</td>
                                            <td>{{ $o->user_name }}</td>
                                            <td>{{ $o->created_at->format('F j, Y') }}</td>
                                            <td><a href="{{ route('admin#listInfo', $o->order_code) }}" class="text-danger">
                                                    {{ $o->order_code }}</a></td>
                                            <td>{{ $o->total_price }} Kyats</td>
                                            <td>
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0" @if ($o->status == 0) selected @endif
                                                        class="text-center">
                                                        Pending</option>
                                                    <option value="1" @if ($o->status == 1) selected @endif
                                                        class="text-center">
                                                        Accept</option>
                                                    <option value="2" @if ($o->status == 2) selected @endif
                                                        class="text-center">
                                                        Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="mt-3">
                            {{ $order->links() }}
                        </div> --}}
                    @else
                        <h3 class="text-secondary text-center">There is no Order for now.</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#orderStatus').change(function() {
                $status = $('#orderStatus').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/status',
                    data: {
                        'status': $status,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';

                        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
                            'Sep', 'Oct', 'Nov', 'Dec'
                        ];
                        for ($i = 0; $i < response.length; $i++) {
                            $dbDate = new Date(response[$i].created_at);
                            $finalDate = $months[$dbDate.getMonth()] + " " + $dbDate.getDate() +
                                ", " + $dbDate.getFullYear();

                            if (response[$i].status == 0) {
                                $statusMessage =
                                    `
                                <select name="status" class="form-control statusChange">
                                                <option value="0"
                                                    class="text-center" selected>
                                                    Pending</option>
                                                <option value="1"
                                                    class="text-center">
                                                    Accept</option>
                                                <option value="2"
                                                    class="text-center">
                                                    Reject</option>
                                </select>
                                `;
                            } else if (response[$i].status == 1) {
                                $statusMessage = `
                                <select name="status" class="form-control statusChange">
                                                <option value="0"
                                                    class="text-center">
                                                    Pending</option>
                                                <option value="1"
                                                    class="text-center" selected>
                                                    Accept</option>
                                                <option value="2"
                                                    class="text-center">
                                                    Reject</option>
                                </select>
                                `;
                            } else if (response[$i].status == 2) {
                                $statusMessage = `
                                <select name="status" class="form-control statusChange">
                                                <option value="0"
                                                    class="text-center">
                                                    Pending</option>
                                                <option value="1"
                                                    class="text-center">
                                                    Accept</option>
                                                <option value="2"
                                                    class="text-center" selected>
                                                    Reject</option>
                                </select>
                                `;
                            }

                            $list += `
                                <tr class="tr-shadow">
                                    <input type="hidden" class="orderId" value=" ${response[$i].id} ">
                                        <td> ${response[$i].user_id} </td>
                                        <td> ${response[$i].user_name} </td>
                                        <td> ${response[$i].created_at} </td>
                                        <td> ${response[$i].order_code} </td>
                                        <td> ${response[$i].total_price}  Kyats</td>
                                        <td>
                                            ${$statusMessage}
                                        </td>
                                    </tr>
                                `;
                        }
                        $('#dataList').html($list);

                    }
                })
            })

            // change status
            $('.statusChange').change(function() {
                // $parentNote = $(this).parents("tr");
                // $price = Number($parentNote.find('#price').text().replace("Kyats"));
                // $qty
                $currentStatus = $(this).val();
                $parentNote = $(this).parents("tr");
                $orderId = $parentNote.find('.orderId').val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };

                console.log($data);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
                // window.location.href = "http://127.0.0.1:8000/order/list";

            })
        });
    </script>
@endsection
