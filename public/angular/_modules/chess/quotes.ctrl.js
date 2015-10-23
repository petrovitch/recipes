(function () {
    'use strict';

    angular
        .module('APP')
        .controller('QuotesController', QuotesController);

    QuotesController.$inject = ['$rootScope', '$scope', '$http'];

    function QuotesController($rootScope, $scope, $http) {
        $http.get("api/quotes/get")
            .success(function (response) {
                $scope.quotes = response.data;
                console.log('quotes', $scope.quotes);
            });
    };

}());