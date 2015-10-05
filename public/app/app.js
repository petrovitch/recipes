var main = angular.module('main', []);

main.controller('ClockController', function ($scope, $timeout) {
    $scope.clock = {};
    var updateClock = function () {
        $scope.clock.now = new Date();
        $timeout(function () {
            updateClock();
        }, 1000);
    };
    updateClock();
});

main.controller('AddingMachineController', function ($scope) {
    $scope.counter = 0;
    $scope.add = function (value) {
        $scope.counter += value;
    };
    $scope.subtract = function (value) {
        $scope.counter -= value;
    };
});

main.controller('MyController', function ($scope, $Interpolate) {
});
