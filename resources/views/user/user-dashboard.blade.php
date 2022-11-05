<x-user-layout>
    <div class="row">
        <div class="col s12 m6 l8">
            <div class="row">
                <div class="col s12 m12 l6">
                    <!-- Recent Buyers -->
                    <div class="card recent-buyers-card animate fadeUp">
                        <div class="card-content">
                            <h4 class="card-title mb-0">Categories
                                <a href="{{URL('/user_category_list')}}">
                                    <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See
                                        all</span>
                                </a>

                            </h4>
                            <p class="medium-small pt-2">Recent</p>
                            <ul class="collection mb-0">
                                @foreach ($categories as $item)
                                    <li class="collection-item avatar">
                                        <img src="{{ $item->cat_image ? getS3UrlByFid($item->cat_image) : asset('/resources/assets/images/default.png')}}"
                                            alt="" class="circle">
                                        <p class="font-weight-600">{{ $item->category_name }}</p>
                                        <p class="medium-small">{{ date('d, M Y', $item->created_on) }}</p>
                                        <a href="#!" class="secondary-content"><i
                                                class="material-icons">star_border</i></a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <!-- Recent Buyers -->
                    <div class="card recent-buyers-card animate fadeUp">
                        <div class="card-content">
                            <h4 class="card-title mb-0">Products
                                <a href="{{URL('/user_product_list/0')}}">
                                    <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See
                                        all</span>
                                </a>

                            </h4>
                            <p class="medium-small pt-2">Recent</p>
                            <ul class="collection mb-0">
                                @foreach ($products as $item)
                                    <li class="collection-item avatar">
                                        <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png')}}"
                                            alt="" class="circle">
                                        <p class="font-weight-600">{{ $item->product_name }}</p>
                                        <p class="medium-small">{{ date('d, M Y', $item->prod_created_on) }}</p>
                                        <a href="#!" class="secondary-content"><i
                                                class="material-icons">star_border</i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 noPadding" style="padding: 0;">
                <div class="card gradient-45deg-light-blue-cyan gradient-shadow">
                    <div class="card-content white-text">
                        <div class="row">
                            <div class="col s6">
                                <span class="card-title">Start Selling</span>
                            </div>
                            <div class="col s6">
                                <a href="{{URL('/user_product_list/0')}}" class=" float-right waves-effect waves-light btn gradient-45deg-green-teal">Go to products</a>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <!-- Recent Buyers -->
            <div class="card recent-buyers-card animate fadeUp">
                <div class="card-content">
                    <h4 class="card-title mb-0">Orders
                        <a href="{{URL('/user_order_list')}}">
                            <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See all</span>
                        </a>

                    </h4>
                    <p class="medium-small pt-2">Recent</p>
                    <ul class="collection mb-0">
                        @foreach ($orders as $item)
                            <li class="collection-item avatar">
                                <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png')}}"
                                    alt="" class="circle">
                                <span class="font-weight-600">{{ $item->product_name }}</span>
                                <span class="medium-small">{{ date('d, M Y', $item->order_date) }}</span>
                                <div class="">
                                    @if ($item->order_status == 0)
                                        <span class="chip orange lighten-5"><span
                                                class="orange-text">Booked</span></span>
                                    @elseif($item->order_status == 1)
                                        <span class="chip yellow lighten-5"><span
                                                class="yellow-text">In-Process</span></span>
                                    @elseif($item->order_status == 2)
                                        <span class="chip green lighten-5"><span
                                                class="green-text">Completed</span></span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
