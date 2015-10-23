(function () {
    'use strict';

    angular
        .module('APP')
        .controller('MccsController', MccsController);

    MccsController.$inject = ['$rootScope', '$scope', '$http'];

    function MccsController($rootScope, $scope, $http) {
        $http.get("api/mccs/get")
            .success(function (response) {
                $scope.mccs = response.data;
                console.log('mccs', $scope.mccs);
            });
    };

}());