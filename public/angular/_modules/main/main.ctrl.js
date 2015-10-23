(function () {
    'use strict';

    angular
        .module('APP')
        .controller('MainController', MainController);

    MainController.$inject = ['$rootScope', '$scope', '$http'];

    function MainController($rootScope, $scope, $http) {
        $scope.message = 'MainController';
    };

}());
