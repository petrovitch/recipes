(function () {
    var app = angular.module('app', []);

    app.controller('ClockController', function ($scope, $timeout) {
        $scope.clock = {};
        var updateClock = function () {
            $scope.clock.now = new Date();
            $timeout(function () {
                updateClock();
            }, 1000);
        };
        updateClock();
    });

    app.controller('UserController', function ($scope, $http) {
        toastr.options.preventDuplicates = true;
        toastr.options.closeButton = true;

        $scope.user = {};
        $scope.error = {};

        $scope.getData = function () {
            console.log("get data");
            toastr.info('Requesting data', 'Info');

            $http.get("data.php").then(function (response) {
                $scope.title = response.status;
                $scope.user = response.data;
                console.log(response);
                toastr.clear()
                //toastr.success(response.data.name, "Success");
            }, function (response) {
                $scope.error.title = "Error " + response.status;
                $scope.error.message = response.statusText;
                console.warn(response);
                toastr.clear()
                //toastr.warn($scope.error.message, $scope.error.title);
            });
        }
    });

    var myapp = angular.module('sampleapp', [ ]);

    myapp.controller('samplecontoller', function ($scope ,$interval ) {

        $scope.init = $interval(function(){

            var date = new Date();
            $scope.dates = [{ "date1" : date }]

        },100 )

    });
    myapp.filter('dateFormat', function($filter)
    {
        return function(input)
        {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

            return _date.toUpperCase();

        };
    });
    myapp.filter('dateFormat1', function($filter)
    {
        return function(input)
        {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input), 'MM dd yyyy');

            return _date.toUpperCase();

        };
    });

    myapp.filter('time', function($filter)
    {
        return function(input)
        {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input), 'HH:mm:ss');

            return _date.toUpperCase();

        };
    });
    myapp.filter('datetime', function($filter)
    {
        return function(input)
        {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input),
                'MMM dd yyyy - HH:mm:ss');

            return _date.toUpperCase();

        };
    });
    myapp.filter('datetime1', function($filter)
    {
        return function(input)
        {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input),
                'MM dd yyyy - HH:mm:ss');

            return _date.toUpperCase();

        };
    });


}());