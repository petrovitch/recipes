(function () {
    'use strict';
    angular
        .module('APP')
        .constant('_', window._)
        .constant('APP_URL', 'http://www.blog.local/')
        .constant('API_URL', 'http://www.blog.local/api/')
        .constant('FILE_URL', 'https://s3-us-west-2.amazonaws.com/blog/')
        .constant('LEGAL_NAME', 'AngularJS');
})();
