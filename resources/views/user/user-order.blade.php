<x-user-layout>
    <style>
        .general-action-btn {
            position: relative;
        }
    </style>

    <div class="row">
        <div class="content-wrapper-before gradient-45deg-green-teal">
        </div>

        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Order Details</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('user_product_list', 0) }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: white">Order details</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-content">
                                <table class="striped">
                                    <tbody>
                                        <tr>
                                            <td>Product image:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Product name:</td>
                                            <td class="users-view-latest-activity">{{ $data->product_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Price:</td>
                                            <td class="users-view-verified">{{ $data->product_rate }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity:</td>
                                            <td class="users-view-role">
                                                <div class="input-field col s7 alignSelfCenter noPadding noMargin">
                                                    <input id="weight" type="number" class="validate"
                                                        value="0">
                                                    {{-- <label for="weight">Weight in Kg</label> --}}
                                                </div>
                                                <div class="col s5 alignSelfCenter  noPadding noMargin">
                                                    <button
                                                        class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow btn-small"
                                                        onclick="checkPrice()">
                                                        Check price
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total:</td>
                                            <input type="hidden" id="product_rate" value="{{ $data->product_rate }}">
                                            <td>
                                                <span id="total_amount"> 0Rs</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 right-align">
                        <a href="#confirm_checkout" onclick="checkPrice()"
                            class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow mb-2  modal-trigger">
                            Proceed to checkout
                        </a>
                    </div>
                    <div id="confirm_checkout" class="modal">
                        <form method="POST" id="form_create_order" enctype="multipart/form-data"
                            action="{{ URL('create_order') }}">
                            @csrf

                            <input type="hidden" name="rate" id="rate" value="{{ $data->product_rate }}">
                            <input type="hidden" name="pid" id="pid" value="{{ $data->pid }}">
                            <input type="hidden" name="amount" id="amount" value="">
                            <input type="hidden" name="final_weight" id="final_weight" value="">
                            <div class="modal-content pt-2">
                                <div class="row" id="product-one">
                                    <div class="col s12">
                                        <a class="modal-close right"><i class="material-icons">close</i></a>
                                    </div>
                                    <div class="col m12 s12">
                                        <h5>Confirm Order</h5>
                                        <table class="striped">


                                            <tbody>

                                                <tr>
                                                    <td>Name</td>
                                                    <td>Price</td>
                                                    <td>Quantity</td>
                                                    <td>Total</td>

                                                </tr>
                                                <tr>
                                                    <td class="users-view-latest-activity">{{ $data->product_name }}
                                                    </td>
                                                    <td>{{ $data->product_rate }}</td>
                                                    <td id="quantity_td"> </td>
                                                    <td>
                                                        <span id="amount_td"> 0Rs</span>
                                                    </td>
                                                </tr>
                                                </tr>
                                            </tbody>

                                        </table>
                                        <button
                                            class="waves-effect waves-light btn gradient-45deg-purple-deep-orange mt-2">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/admin_assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // $("#weight").change(function() {

            // });
        });

        function checkPrice() {
            var weight = $('#weight').val();
            var rate = $('#product_rate').val();
            var price = weight * rate;

            $('#quantity_td').html(weight + 'Kg');
            $('#total_amount').html(price + 'Rs');
            $('#amount_td').html(price + 'Rs');
            $('#amount').val(price);
            $('#final_weight').val(weight);
            console.log(rate);
        }
    </script>
</x-user-layout>
