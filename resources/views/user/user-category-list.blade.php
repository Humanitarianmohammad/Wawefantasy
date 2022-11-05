<x-user-layout>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/public/admin_assets/css/pages/eCommerce-products-page.css') }}">
    <style>
        .prod_img_div {
            display: grid;
        }

        @media only screen and (min-device-width: 991px) {
            .product_img {
                max-height: 13vw;
            }

            .prod_img_div {
                height: 13vw;
            }
        }

        @media only screen and (min-device-width: 600px) and (max-device-width: 991px) {
            .product_img {
                max-height: 24.4vw;
            }

            .prod_img_div {
                height: 24.4vw;
            }
        }

        @media only screen and (max-device-width: 600px) {
            .product_img {
                max-height: 81vw;
                margin-left: auto;
                margin-right: auto;
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
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Categories</span></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">

            <div class="container">

                <div class="section">
                    <div class="row" id="ecommerce-products">
                        <div class="col s12 m12 l12 pr-0">
                            @foreach ($categories as $key => $item)
                                <div class="col s12 m4 l3">
                                    <div class="card animate fadeLeft">
                                        <div class="card-content">
                                            <span class="card-title text-ellipsis">{{ $item->category_name }}</span>
                                            <div class="prod_img_div">
                                                <img src="{{ $item->cat_image ? getS3UrlByFid($item->cat_image) : asset('/resources/assets/images/default.png') }}"
                                                    class="responsive-img product_img alignSelfCenter" alt="">
                                            </div>

                                            <div class="display-flex flex-wrap justify-content-center">
                                                {{-- <h5 class="mt-3">{{ $item->product_rate }}Rs</h5> --}}
                                                <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4 modal-trigger"
                                                    href="{{route('user_product_list', $item->cid)}}">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/admin_assets/js/scripts/eCommerce-products-page.js') }}"></script>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
</x-user-layout>
