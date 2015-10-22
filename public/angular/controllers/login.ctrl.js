(function () {
    'use strict';

    angular
        .module('APP')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$rootScope', '$scope', '$http'];

    function LoginController($rootScope, $scope, $http) {
        $scope.message = 'LoginController';
    };

}());
