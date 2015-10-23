(function () {
    'use strict';

    angular
        .module('APP')
        .controller('TagsController', TagsController);

    TagsController.$inject = ['$rootScope', '$scope', '$http'];

    function TagsController($rootScope, $scope, $http) {
        $scope.message = 'TagsController';
    };

}());