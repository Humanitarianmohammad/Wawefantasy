<x-admin-layout>
    <style>
        .scrollspy{
            overflow-x: auto;
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
                            <span>Users List</span>
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
                            <?php if(count($users) != 0){ ?>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>User name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $key => $val) { ?>
                                    <tr>
                                        <th>{{$val->name}}</th>
                                        <th>{{$val->email}}</th>
                                        <th>
                                            <?php
                                            if ($val->status == 1) {
                                                print '<span class="chip green lighten-5"><span class="green-text">Active</span></span>';
                                            } elseif ($val->status == 2) {
                                                print '<span class="chip red lighten-5"><span class="red-text">Not-active</span></span>';
                                            }
                                            ?>
                                        </th>
                                        <th>
                                            <a class="edit" href="{{ route('delete_user', $val->id) }}">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </th>
                                    </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>Please add employees</h5>
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