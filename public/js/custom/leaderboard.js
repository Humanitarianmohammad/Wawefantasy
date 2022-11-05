var app = angular.module("leaderboardApp", []);
app.controller("leaderboardCtrl", ['$scope', '$http', '$rootScope', '$location', '$window',
    function ($scope, $http, $rootScope, $location, $window) {
        $scope.baseUrl = $('#base_url').val();
        $scope.users = users;
        $scope.startDate = '';
        $scope.endDate = '';
        console.log($scope.users);

        $scope.applyFilter = function () {
            // console.log($scope.startDate)
            // console.log($scope.endDate)
            if ($scope.startDate && $scope.endDate) {
                var data = {
                    'from': $scope.startDate,
                    'to': $scope.endDate,
                }
                $http.post($scope.baseUrl + '/leaderboard_filter', JSON.stringify(data)).then(function (response) {
                    // console.log(response.data)
                    if (response.data) {
                        $scope.fileNames = [];
    
                        console.log(response.data);
                        if (response.data) {
                            $scope.users = response.data;
                        }
    
                    }
    
                }, function (response) {
    
                    //errors
                    console.log(response);
                });
            } else {
                // alertify.error('Please select Start and End date')
            }
    
        }
        

    }]);


