(function () {
    'use strict';

    angular
        .module('APP')
        .controller('CountiesController', CountiesController);

    CountiesController.$inject = ['$rootScope', '$scope', '$http'];

    function CountiesController($rootScope, $scope, $http) {
        $http.get("api/counties/get")
            .success(function (response) {
                $scope.counties = response.data;
                console.log('counties', $scope.counties);
            });
    };

}());