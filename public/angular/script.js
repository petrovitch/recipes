var app = angular.module('APP', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'angular/pages/index.html',
            controller  : 'mainController'
        })
        .when('/home', {
            templateUrl : 'angular/pages/index.html',
            controller  : 'mainController'
        })
        .when('/about', {
            templateUrl : 'angular/pages/about.html',
            controller  : 'aboutController'
        })
        .when('/contact', {
            templateUrl : 'angular/pages/contact.html',
            controller  : 'contactController'
        });
});
