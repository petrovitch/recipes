(function () {
    'use strict';

    angular
        .module('APP')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$rootScope', '$scope', '$http'];

    function LoginController($rootScope, $scope, $http) {
        var vm = this;
        $scope.message = 'LoginController';
    };

}());
