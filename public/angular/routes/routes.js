app = new angular.module('app', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider){
    $routeProvider.
        when('/app/about', {
            controller: 'AboutController',
            templateUrl: 'index.html'
        }).
        otherwise({redirectTo: '/'});
}]);

