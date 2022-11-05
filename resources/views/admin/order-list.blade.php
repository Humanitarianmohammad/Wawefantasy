<x-admin-layout>
    <style>
        .scrollspy {
            overflow-x: auto;
        }
        .table_img{
            max-width: 70px;
            max-height: 35px;
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
                                        <th>Product Name</th>
                                        <th>User Name</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Payment Type</th>
                                        <th>Status</th>
                                        <th>Assign to agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $val) { ?>
                                    <tr>
                                        <th>
                                            <img class="table_img" src="{{ $val->image ? getS3UrlByFid($val->image) : asset('/resources/assets/images/default.png')}}" alt="Product Image">
                                        </th>
                                        <th>{{ $val->product_name }}</th>
                                        <th>{{ $val->name }}</th>
                                        <th>{{ $val->weight }}Kg</th>
                                        <th>{{ $val->amount }}Rs</th>
                                        <th>{{ $val->payment_type }}</th>
                                        <th>
                                            <?php
                                            if ($val->user_status == 0) {
                                                print '<span class="chip yellow lighten-5"><span class="yellow-text">Booked</span></span>';
                                            } elseif ($val->user_status == 1) {
                                                print '<span class="chip orange lighten-5"><span class="orange-text">In-process</span></span>';
                                            } elseif ($val->user_status == 2) {
                                                print '<span class="chip green lighten-5"><span class="green-text">Completed</span></span>';
                                            }
                                            ?>
                                        </th>
                                        <th>
                                            <a class="modal-trigger" href="#myModal" onclick="showModal('{{ $val->oid }}')">
                                                <i class="material-icons">arrow_forward</i>
                                            </a>
                                        </th>
                                        <!-- Modal Structure -->

                                    </tr>

                                    <?php }  ?>
                                </tbody>
                            </table>
                            <form method="POST" id="assign_order" enctype="multipart/form-data"
                                action="{{ URL('assign_order') }}">
                                @csrf
                                <div id="myModal" class="modal">

                                    <div class="modal-content">
                                        <input type="hidden" name="oid" id="oid" value="0">
                                        <h5>Select Pickup agent</h5>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select name="uid">
                                                    <option value="0" selected>Select</option>
                                                    @foreach ($drivers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="uid">Select Pickup agent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            class="waves-effect waves-light btn gradient-45deg-green-teal box-shadow right"
                                            type="submit" name="action">Submit
                                        </button>
                                    </div>

                                </div>
                            </form>
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
    <script>
        $(document).ready(function() {
            $('.modal').modal();
        });

        function showModal(oid) {
            console.log(oid)
            $("#oid").val(oid)
        }
    </script>
</x-admin-layout>
