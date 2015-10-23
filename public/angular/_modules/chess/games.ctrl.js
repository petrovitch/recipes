(function () {
    'use strict';

    angular
        .module('APP')
        .controller('GamesController', GamesController);

    GamesController.$inject = ['$rootScope', '$scope', '$http'];

    function GamesController($rootScope, $scope, $http) {
        $http.get("api/games/getgames")
            .success(function (response) {
                $scope.games = response.data;
                console.log('games', $scope.games);
            });
    };

}());