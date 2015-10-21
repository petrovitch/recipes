(function () {
    'use strict';

    angular
        .module('APP')
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$rootScope', '$scope', '$http'];

    function UsersController($rootScope, $scope, $http) {
        var vm = this;
        $scope.message = 'UsersController';
    };

}());