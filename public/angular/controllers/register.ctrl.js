(function () {
    'use strict';

    angular
        .module('APP')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['$rootScope', '$scope', '$http'];

    function RegisterController($rootScope, $scope, $http) {
        $scope.message = 'RegisterController';
    };

}());
