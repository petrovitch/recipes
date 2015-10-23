(function () {
    'use strict';

    angular
        .module('APP')
        .controller('StatesController', StatesController);

    StatesController.$inject = ['$rootScope', '$scope', '$http'];

    function StatesController($rootScope, $scope, $http) {
        $http.get("api/states/get")
            .success(function (response) {
                $scope.states = response.data;
                console.log('states', $scope.states);
            });
    };

}());