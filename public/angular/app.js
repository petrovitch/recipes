(function () {
    'use strict';

    var app = angular
        .module('APP', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                .when('/', {
                    templateUrl: 'angular/_modules/main/main.html',
                    controller: 'MainController'
                })

                .when('/about', {
                    templateUrl: 'angular/_modules/about/about.html',
                    controller: 'AboutController'
                })

                .when('/contacts', {
                    templateUrl: 'angular/_modules/contacts/contacts.html',
                    controller: 'ContactsController'
                })

                .when('/comments', {
                    templateUrl: 'angular/_modules/comments/comments.html',
                    controller: 'CommentsController'
                })

                .when('/counties', {
                    templateUrl: 'angular/_modules/counties/counties.html',
                    controller: 'CountiesController'
                })

                .when('/ecos', {
                    templateUrl: 'angular/_modules/chess/ecos.html',
                    controller: 'EcosController'
                })

                .when('/games', {
                    templateUrl: 'angular/_modules/chess/games.html',
                    controller: 'GamesController'
                })

                .when('/home', {
                    templateUrl: 'angular/_modules/home/home.html',
                    controller: 'HomeController'
                })

                .when('/mccs', {
                    templateUrl: 'angular/_modules/chess/mccs.html',
                    controller: 'MccsController'
                })

                .when('/login', {
                    templateUrl: 'angular/_modules/auth/login.html',
                    controller: 'LoginController'
                })

                .when('/quotes', {
                    templateUrl: 'angular/_modules/chess/quotes.html',
                    controller: 'QuotesController'
                })

                .when('/recipes', {
                    templateUrl: 'angular/_modules/recipes/recipes.html',
                    controller: 'RecipesController'
                })

                .when('/register', {
                    templateUrl: 'angular/_modules/auth/register.html',
                    controller: 'RegisterController'
                })

                .when('/states', {
                    templateUrl: 'angular/_modules/states/states.html',
                    controller: 'StatesController'
                })

                .when('/tags', {
                    templateUrl: 'angular/_modules/tags/tags.html',
                    controller: 'TagsController'
                })

                .when('/users', {
                    templateUrl: 'angular/_modules/users/users.html',
                    controller: 'UsersController'
                })

                .when('/zips', {
                    templateUrl: 'angular/_modules/zips/zips.html',
                    controller: 'ZipsController'
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
