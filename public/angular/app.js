(function () {
    'use strict';

    var app = angular
        .module('APP', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                .when('/', {
                    templateUrl: 'angular/views/main.html',
                    controller: 'MainController'
                })

                .when('/about', {
                    templateUrl: 'angular/views/about.html',
                    controller: 'AboutController'
                })

                .when('/contacts', {
                    templateUrl: 'angular/views/contacts.html',
                    controller: 'ContactsController'
                })

                .when('/comments', {
                    templateUrl: 'angular/views/comments.html',
                    controller: 'CommentsController'
                })

                .when('/home', {
                    templateUrl: 'angular/views/home.html',
                    controller: 'HomeController'
                })

                .when('/login', {
                    templateUrl: 'angular/views/login.html',
                    controller: 'LoginController'
                })

                .when('/register', {
                    templateUrl: 'angular/views/register.html',
                    controller: 'RegisterController'
                })

                .when('/tags', {
                    templateUrl: 'angular/views/tags.html',
                    controller: 'TagsController'
                })

                .when('/users', {
                    templateUrl: 'angular/views/users.html',
                    controller: 'UsersController'
                })

                .otherwise({redirectTo: '/'});
        });

    run.$inject = ['$rootScope', '$location', '$cookieStore', '$http'];
    function run($rootScope, $location, $cookieStore, $http) {
        // keep user logged in after page refresh
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            // redirect to login page if not logged in and trying to access a restricted page
            var restrictedPage = $.inArray($location.path(), ['/login', '/register']) === -1;
            var loggedIn = $rootScope.globals.currentUser;
            if (restrictedPage && !loggedIn) {
                $location.path('/login');
            }
        });
    }
}());
