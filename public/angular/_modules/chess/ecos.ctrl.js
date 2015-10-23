(function () {
    'use strict';

    angular
        .module('APP')
        .controller('EcosController', EcosController);

    EcosController.$inject = ['$rootScope', '$scope', '$http'];

    function EcosController($rootScope, $scope, $http) {
        $http.get("api/ecos/get")
            .success(function (response) {
                $scope.ecos = response.data;
                console.log('ecos', $scope.ecos);
            });
    };

}());