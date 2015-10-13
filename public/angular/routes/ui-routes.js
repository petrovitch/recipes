var sampleApp = angular.module('APP', []);

sampleApp .config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/app/about', {
                templateUrl: 'modules/about/about.html',
                controller: 'AboutController'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);