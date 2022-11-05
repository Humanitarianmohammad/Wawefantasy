<x-driver-layout>
    <div class="row">
        <div class="col s12 m6 l4">
            <!-- Recent Buyers -->
            <div class="card recent-buyers-card animate fadeUp">
                <div class="card-content">
                    <h4 class="card-title mb-0">Latest orders
                        <a href="{{ URL('/agent_order_list') }}">
                            <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See all</span>
                        </a>

                    </h4>
                    <p class="medium-small pt-2">Recent</p>
                    <ul class="collection mb-0">
                        @foreach ($assigned_orders as $item)
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
            <!-- Recent Buyers -->
            <div class="card recent-buyers-card animate fadeUp">
                <div class="card-content">
                    <h4 class="card-title mb-0">Pending orders
                        <a href="{{ URL('/agent_order_list') }}">
                            <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See all</span>
                        </a>

                    </h4>
                    <p class="medium-small pt-2">Recent</p>
                    <ul class="collection mb-0">
                        @foreach ($pending_orders as $item)
                            <li class="collection-item avatar">
                                <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
                                    alt="" class="circle">
                                <p class="font-weight-600">{{ $item->product_name }}</p>
                                <p class="medium-small">{{ date('d, M Y', $item->order_date) }}</p>
                                <a href="#!" class="secondary-content"><i
                                        class="material-icons">star_border</i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <!-- Recent Buyers -->
            <div class="card recent-buyers-card animate fadeUp">
                <div class="card-content">
                    <h4 class="card-title mb-0">Completed orders
                        <a href="{{ URL('/agent_order_list') }}">
                            <span class="badge pill gradient-45deg-green-teal gradient-shadow mt-2 mr-2">See all</span>
                        </a>

                    </h4>
                    <p class="medium-small pt-2">Recent</p>
                    <ul class="collection mb-0">
                        @foreach ($completed_orders as $item)
                        <li class="collection-item avatar">
                            <img src="{{ $item->image ? getS3UrlByFid($item->image) : asset('/resources/assets/images/default.png') }}"
                                alt="" class="circle">
                            <p class="font-weight-600">{{ $item->product_name }}</p>
                            <p class="medium-small">{{ date('d, M Y', $item->order_date) }}</p>
                            <a href="#!" class="secondary-content"><i
                                    class="material-icons">star_border</i></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-driver-layout>
