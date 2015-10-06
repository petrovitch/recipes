(function () {
    var app = angular.module('APP', []);


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

    app.controller('MyController', function ($scope) {
    });

}());