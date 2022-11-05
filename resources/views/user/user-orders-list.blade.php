<x-user-layout>
    <style>
        .scrollspy{
            overflow-x: auto;
        }
        @media only screen and (min-device-width: 991px) {
            .prod_img {
                height: 3vw;
                width: 3vw;
            }
        }

        @media only screen and (min-device-width: 600px) and (max-device-width: 991px) {
            .prod_img {
                height: 5vw;
                width: 5vw;
            }
        }

        @media only screen and (max-device-width: 600px) {
            .prod_img {
                height: 9vw;
                width: 9vw;
            }
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
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            <span>Order List</span>
                        </h5>
                        {{-- <ol class="breadcrumbs">
                            <li class="breadcrumb-item">Employees</li>
                            <li class="breadcrumb-item active" style="color: purple">
                                Employee List
                            </li>
                        </ol> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l12">
            <div id="responsive-table" class="card card card-default scrollspy">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <?php if(count($data) != 0){ ?>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Payment Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $val) { ?>
                                    <tr>
                                        <th>
                                            <img class="circle prod_img" src="{{ $val->image ? getS3UrlByFid($val->image) : asset('/resources/assets/images/default.png') }}" alt="">
                                        </th>
                                        <th>{{$val->product_name}}</th>
                                        <th>{{$val->weight}}Kg</th>
                                        <th>{{$val->amount}}Rs</th>
                                        <th>{{ $val->payment_type }}</th>
                                        <th>
                                            <?php
                                            if ($val->user_status == 0) {
                                                print '<span class="chip yellow lighten-5"><span class="yellow-text">Booked</span></span>';
                                            }else if ($val->user_status == 1) {
                                                print '<span class="chip orange lighten-5"><span class="orange-text">Waiting for pickup</span></span>';
                                            }else if($val->user_status == 2){
                                                print '<span class="chip green lighten-5"><span class="green-text">Completed</span></span>';
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>You have not sold anything!!</h5>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>