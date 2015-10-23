(function () {
    'use strict';

    angular
        .module('APP')
        .controller('AboutController', AboutController)
        .directive('gravatar', GravatarDirective);

    AboutController.$inject = ['$rootScope', '$scope', '$http', '$timeout'];

    function AboutController($rootScope, $scope, $http, $timeout) {
        clock($scope, $timeout);

        $scope.page = 'About';
        $scope.name = "Kenn E. Thompson";
        $scope.email = "kennthompson@gmail.com";
        $scope.emailHash = CryptoJS.MD5($scope.email).toString();
    };

    function GravatarDirective() {
        return {
            restrict: 'AE',
            replace: true,
            scope: {
                name: '@',
                height: '@',
                width: '@',
                emailHash: '@'
            },
            link: function(scope, el, attr) {
                scope.defaultImage = 'https://somedomain.com/images/avatar.png';
            },
            template: '<img alt="{{ name }}" height="{{ height }}"  width="{{ width }}" src="https://secure.gravatar.com/avatar/{{ emailHash }}.jpg?s={{ width }}&d={{ defaultImage }}">'
        };
    };

    function clock($scope, $timeout){
        $scope.clock = {};
        var updateClock = function () {
            $scope.clock.now = new Date();
            $timeout(function () {
                updateClock();
            }, 1000);
        };
        updateClock();
    }

}());
