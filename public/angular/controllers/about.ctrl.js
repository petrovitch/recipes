(function () {
    'use strict';

    angular
        .module('APP')
        .controller('AboutController', AboutController);

    AboutController.$inject = ['$rootScope', '$scope', '$http', '$timeout'];

    function AboutController($rootScope, $scope, $http, $timeout) {
        clock($scope, $timeout);

        var vm = this;

        $scope.page = 'About';
    };

    function clock($scope, $timeout){
        $scope.clock = {};
        var updateClock = function () {
            $scope.clock.now = new Date();
            $timeout(function () {
                updateClock();
            }, 1000);
        };
        updateClock();
    }

}());
