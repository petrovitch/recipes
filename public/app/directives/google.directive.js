(function(){
    'use strict';
    angular
        .module('APP')
        .directive('google', GoogleDirective);

    GoogleDirective.$inject = [];

    function GoogleDirective() {
        return {
            restrict: 'E',
            template: '<a class="btn btn-primary" type="button" href="http://google.com" target="_blank">Google</a>'
        };
    }
})();