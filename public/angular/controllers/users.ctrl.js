(function () {
    'use strict';

    angular
        .module('APP')
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$rootScope', '$scope', '$http'];

    function UsersController($rootScope, $scope, $http) {
        $scope.message = 'UsersController';

        $http.get("http://www.blog-api.local/admin/users")
            .success(function (response) {
                $scope.users = response.records;
                console.log('users', $scope.users);
            });
    };

}());