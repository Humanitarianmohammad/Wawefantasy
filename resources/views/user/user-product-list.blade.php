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
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Products</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('user_category_list') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: white">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">

            <div class="container">

                <div class="section">
                    <div class="row" id="ecommerce-products">
                        <div class="col s12 m3 l3 pr-0 hide-on-med-and-down animate fadeLeft">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title">Categories</span>
                                    <hr class="p-0 mb-10">
                                    <ul class="collapsible categories-collapsible">
                                        @foreach ($categories as $key => $item)
                                            <li>
                                                <div class="collapsible-header">
                                                    {{ $item[0]->category_name }}
                                                    <i class="material-icons">keyboard_arrow_right </i>
                                                </div>
                                                <div class="collapsible-body">
                                                    @foreach ($item as $sub_item)
                                                        <p>{{ $sub_item->product_name }}</p>
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l9 pr-0">
                            @foreach ($products as $key => $item)
                                @if ($key != 3)
                                    <div class="col s12 m4 l4">
                                        <div class="card animate fadeLeft">
                                            {{-- <div class="card-badge"><a class="white-text"> <b>On Offer</b> </a>
                                    </div> --}}
                                            <div class="card-content">
                                                <p>{{ $item->category_name }}</p>
                                                <span class="card-title text-ellipsis">{{ $item->product_name }}</span>
                                                <div class="prod_img_div">

                                                    <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
                                                        class="responsive-img product_img alignSelfCenter"
                                                        alt="">
                                                </div>

                                                <div class="display-flex flex-wrap justify-content-center">
                                                    <h5 class="mt-3">{{ $item->product_rate }}Rs</h5>
                                                    <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4 modal-trigger"
                                                        href="#modal_{{ $key }}">View</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Structure -->
                                        <div id="modal_{{ $key }}" class="modal">
                                            <div class="modal-content pt-2">
                                                <div class="row" id="product-one">
                                                    <div class="col s12">
                                                        <a class="modal-close right"><i
                                                                class="material-icons">close</i></a>
                                                    </div>
                                                    <div class="col m6 s12">
                                                        <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
                                                            class="responsive-img" alt="">
                                                    </div>
                                                    <div class="col m6 s12">
                                                        <p>{{ $item->category_name }}</p>
                                                        <h5>{{ $item->product_name }}</h5>
                                                        <p>Availability: <span class="green-text">Available</span></p>
                                                        <hr class="mb-5">
                                                        {{ $item->description }}
                                                        <h5>{{ $item->product_rate }}Rs</h5>
                                                        <a href="{{ route('user_order_page', $item->pid) }}"
                                                            class="waves-effect waves-light btn gradient-45deg-purple-deep-orange mt-2">SELL
                                                            NOW</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col s12">
                                        <div class="card animate fadeUp">
                                            {{-- <div class="card-badge"><a class="white-text"> <b>On Offer</b> </a>
                                            </div> --}}
                                            <div class="card-content">
                                                <div class="row" id="product-four">
                                                    <div class="col m6 s12">
                                                        <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
                                                            class="responsive-img" alt="">
                                                    </div>
                                                    <div class="col m6 s12">
                                                        <p>{{ $item->category_name }}</p>
                                                        <h5>{{ $item->product_name }}</h5>
                                                        {{-- <span class="new badge left ml-0 mr-2" data-badge-caption="">4.2
                                                            Star</span> --}}
                                                        <p>Availability: <span class="green-text">Available</span>
                                                        </p>
                                                        <hr class="mb-5">
                                                        {{ $item->description }}
                                                        {{-- <ul class="list-bullet">
                                                            <li class="list-item-bullet">Dual output USB interfaces
                                                            </li>
                                                            <li class="list-item-bullet">Compatible with all
                                                                smartphones</li>
                                                            <li class="list-item-bullet">Portable design and light
                                                                weight</li>
                                                            <li class="list-item-bullet">Battery type: Lithium-ion
                                                            </li>
                                                        </ul> --}}
                                                        <h5 class="red-text">{{ $item->product_rate }}Rs
                                                            {{-- <span class="grey-text lighten-2 ml-3">199.00</span> --}}
                                                        </h5>
                                                        <a href="{{ route('user_order_page', $item->pid) }}"
                                                            class="waves-effect waves-light btn gradient-45deg-purple-deep-orange z-depth-4 mt-2">
                                                            SELL NOW</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <!-- Pagination -->
                            {{-- <div class="col s12 center">
                                <ul class="pagination">
                                    <li class="disabled">
                                        <a href="#!">
                                            <i class="material-icons">chevron_left</i>
                                        </a>
                                    </li>
                                    <li class="active"><a href="#!">1</a>
                                    </li>
                                    <li class="waves-effect"><a href="#!">2</a>
                                    </li>
                                    <li class="waves-effect"><a href="#!">3</a>
                                    </li>
                                    <li class="waves-effect"><a href="#!">4</a>
                                    </li>
                                    <li class="waves-effect"><a href="#!">5</a>
                                    </li>
                                    <li class="waves-effect">
                                        <a href="#!">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/admin_assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/scripts/eCommerce-products-page.js') }}"></script>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
</x-user-layout>
