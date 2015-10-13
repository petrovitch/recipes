(function () {
    var app = angular.module('app', []);

    app.controller('ClockController', function ($scope, $timeout) {
        $scope.clock = {};
        var updateClock = function () {
            $scope.clock.now = new Date();
            $timeout(function () {
                updateClock();
            }, 1000);
        };
        updateClock();
    });

    app.controller('UserController', function ($scope, $http) {
        toastr.options.preventDuplicates = true;
        toastr.options.closeButton = true;

        $scope.user = {};
        $scope.error = {};

        $scope.getData = function () {
            console.log("get data");
            toastr.info('Requesting data', 'Info');

            $http.get("data.php").then(function (response) {
                $scope.title = response.status;
                $scope.user = response.data;
                console.log(response);
                toastr.clear()
                //toastr.success(response.data.name, "Success");
            }, function (response) {
                $scope.error.title = "Error " + response.status;
                $scope.error.message = response.statusText;
                console.warn(response);
                toastr.clear()
                //toastr.warn($scope.error.message, $scope.error.title);
            });
        }
    });

}());