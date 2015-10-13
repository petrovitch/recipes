(function () {
    'use strict';
    angular
        .module('APP')
        .controller('ClocksController', ClocksController);

    ClocksController.$inject = ['$scope', '$timeout'];

    function ClocksController($scope, $timeout) {
        $scope.clock = {};
        $scope.clock.now = new Date();
        var updateClock = function () {
            $scope.clock.now = new Date();
            $timeout(function () {
                updateClock();
            }, 1000);
        };
        updateClock();
    } // end controller
})();