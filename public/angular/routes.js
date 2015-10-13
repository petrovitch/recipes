app = new angular.module('app', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider){
    $routeProvider.
        when('/', {controller: 'MainController',
            templateUrl: 'modules/main/main.html'}).
        when('/', {controller: 'UserController',
            templateUrl: 'modules/users/user.html'}).
        when('/', {controller: 'CommentController',
            templateUrl: 'modules/comments/comment.html'}).
        when('/', {controller: 'TagController',
            templateUrl: 'modules/tags/tag.html'}).
        when('/', {controller: 'LoginController',
            templateUrl: 'modules/login/login.html'}).
        otherwise({redirectTo: '/'});
}]);

app.controller('MainController', function($scope){
    $scope.userName = "Kenn";
})