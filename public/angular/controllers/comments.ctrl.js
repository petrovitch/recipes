(function () {
    'use strict';

    angular
        .module('APP')
        .controller('CommentsController', CommentsController);

    CommentsController.$inject = ['$rootScope', '$scope', '$http'];

    function CommentsController($rootScope, $scope, $http) {
        var vm = this;
        $scope.message = 'CommentsController';
    };

}());
