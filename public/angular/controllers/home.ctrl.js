(function () {
    'use strict';

    angular
        .module('APP')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['$rootScope', '$scope', '$http'];

    function HomeController($rootScope, $scope, $http) {
        $scope.message = 'HomeController';
    };

}());