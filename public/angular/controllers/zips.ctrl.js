(function () {
    'use strict';

    angular
        .module('APP')
        .controller('ZipsController', ZipsController);

    ZipsController.$inject = ['$rootScope', '$scope', '$http'];

    function ZipsController($rootScope, $scope, $http) {
        $http.get("api/zipcodes/getzips")
            .success(function (response) {
                $scope.zips = response.data;
                console.log('zips', $scope.zips);
            });
    };

}());