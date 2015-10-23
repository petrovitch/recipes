(function () {
    'use strict';

    angular
        .module('APP')
        .controller('RecipesController', RecipesController);

    RecipesController.$inject = ['$rootScope', '$scope', '$http'];

    function RecipesController($rootScope, $scope, $http) {
        $http.get("api/recipes/get")
            .success(function (response) {
                $scope.recipes = response.data;
                console.log('recipes', $scope.recipes);
            });
    };

}());