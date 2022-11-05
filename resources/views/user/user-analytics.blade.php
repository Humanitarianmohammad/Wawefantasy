<x-user-layout>
    <div class="row">
        <div class="col s12 m6 l4">
            <!-- Recent Buyers -->
            <div class="card recent-buyers-card animate fadeUp">
                <div class="card-content">
                    <h4 class="card-title mb-0">Recent Orders <i class="material-icons float-right">more_vert</i></h4>
                    <p class="medium-small pt-2">Today</p>
                    <ul class="collection mb-0">
                        @foreach ($orders as $item)
                            <li class="collection-item avatar">
                                <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
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
        <div class="col s12 m6 l4">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">add_shopping_cart</i>
                            <p>Orders</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$booked_order_count}}</h5>
                            <p class="no-margin">Booked</p>
                            <p>{{$order_count}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">add_shopping_cart</i>
                            <p>Orders</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$process_order_count}}</h5>
                            <p class="no-margin">In-process</p>
                            <p>{{$order_count}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">add_shopping_cart</i>
                            <p>Orders</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$completed_order_count}}</h5>
                            <p class="no-margin">Completed</p>
                            <p>{{$order_count}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">perm_identity</i>
                            <p>Products</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$product_count}}</h5>
                            <p class="no-margin">New</p>
                            <p>{{$product_count}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
