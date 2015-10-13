angular.module('myApp', [])
    .filter('MyFilter', function ($log) {
        return function (val, postfix) {
            var result;
            if (val === true) {
                result = 'yes';
            } else if (val === false) {
                result = 'no';
            } else {
                // Kind of like ArgumentException from .NET or IllegalArgumentException in Java
                var errorMessage = 'Unknown argument: \"' + val + '\"';
                $log.error(errorMessage);
                throw errorMessage;
            }

            if ((postfix !== undefined) && (postfix !== null)) {
                result = result + ' ' + postfix;
            }
            return result;
        };
    })
;