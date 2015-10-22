(function () {
    'use strict';

    angular
        .module('APP')
        .controller('ContactsController', ContactsController);

    ContactsController.$inject = ['$rootScope', '$scope', '$http'];

    function ContactsController($rootScope, $scope, $http) {
        $scope.message = 'ContactsController';
    };

}());