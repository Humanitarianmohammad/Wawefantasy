<x-admin-layout>
    <style>
        .scrollspy {
            overflow-x: auto;
        }
    </style>
    <div class="row" ng-app="leaderboardApp" ng-controller="leaderboardCtrl" ng-clock>
        <input type="hidden" value="{{ url('/') }}" id="base_url">
        <script>
            var users = JSON.parse('<?php echo json_encode($users, JSON_HEX_APOS); ?>');
        </script>
        <div class="content-wrapper-before gradient-45deg-green-teal">
        </div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            <span>Leaderboard</span>
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
                    <div class="row flexClass">
                        <div class="col s5 m5 l5 alignSelfCenter">
                            <label for="formGroupExampleInput">From Date</label>
                            <input  class="datepicker" id="start_date" ng-model="startDate" placeholder="Select date">
                        </div>
                        <div class="col s5 m5 l5 alignSelfCenter">
                            <label for="formGroupExampleInput">To Date</label>
                            <input  class="datepicker" id="end_date" ng-model="endDate" placeholder="Select date">
                        </div>
                        <div class="col s2 m2 l2 alignSelfCenter">
                            <button type="button" class="btn gradient-45deg-green-teal float-right alignSelfCenter" ng-click="applyFilter()">Filter</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table class="table table-responsive" ng-show="users.length != 0">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>User name</th>
                                        <th>Email</th>
                                        <th>Sold amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="val in users track by $index">
                                        <th>@{{$index + 1}}</th>
                                        <th>@{{ val.data.name }}</th>
                                        <th>@{{ val.data.email }}</th>
                                        <th>@{{ val.total_val }} Rs</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" ng-show="users.length == 0">
                                <div class="col-12 text-center">
                                    <h5>Leaderboard is empty</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/public/js/custom/leaderboard.js') }}" type="text/javascript" charset="utf-8"></script>
</x-admin-layout>
