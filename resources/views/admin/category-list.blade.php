<x-admin-layout>
    <style>
        .scrollspy{
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
                            <span>Category List</span>
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
                            <?php if(count($products) != 0){ ?>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Category Image</th>
                                        <th>Category name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $key => $val) { ?>
                                    <tr>
                                        <th>
                                            <img class="table_img" src="{{ $val->cat_image ? getS3UrlByFid($val->cat_image) : asset('/resources/assets/images/default.png')}}" alt="Product Image">
                                        </th>
                                        <th>{{$val->category_name}}</th>
                                        <th>
                                            <?php
                                            if ($val->status == 0) {
                                                print '<span class="chip green lighten-5"><span class="green-text">Active</span></span>';
                                            }else if ($val->status == 1) {
                                                print '<span class="chip red lighten-5"><span class="red-text">Not-Active</span></span>';
                                            }
                                            ?>
                                        </th>
                                        <th>
                                            <a class="edit" href="{{ route('create_category', $val->cid) }}">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </th>
                                    </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>Please add products</h5>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>