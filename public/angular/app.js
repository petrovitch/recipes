var app = angular.module('APP', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'angular/templates/main.html',
            controller  : 'mainController'
        })
        .when('/home', {
            templateUrl : 'angular/templates/main.html',
            controller  : 'mainController'
        })
        .when('/user', {
            templateUrl : 'angular/templates/user.html',
            controller  : 'userController'
        })
        .when('/comment', {
            templateUrl : 'angular/templates/comment.html',
            controller  : 'commentController'
        })
        .when('/tag', {
            templateUrl : 'angular/templates/tag.html',
            controller  : 'tagController'
        })
        .when('/login', {
            templateUrl : 'angular/templates/login.html',
            controller  : 'loginController'
        })
        .when('/about', {
            templateUrl : 'angular/pages/about.html',
            controller  : 'aboutController'
        })
        .when('/contact', {
            templateUrl : 'angular/pages/contact.html',
            controller  : 'contactController'
        })
        .otherwise({redirectTo:'/'});
});

