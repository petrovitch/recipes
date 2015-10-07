(function(){
    'use strict';
    angular
        .module('APP')
        .directive('google', GoogleDirective);

    GoogleDirective.$inject = [];

    function GoogleDirective() {
        return {
            restrict: 'EA',
            template: '<a href="http://google.com" target="_blank" class="btn btn-info">Google</a>'
        };
    }
})();