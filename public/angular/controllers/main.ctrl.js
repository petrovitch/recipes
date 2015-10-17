app.controller('mainController', function($scope, $http) {
    $scope.posts = [];
    $scope.$on('$viewContentLoaded', function() {
        $http.get("/posts/last/3")
            .then(function (response) {
                console.log(response);
            }, function (response) {
                console.warn(response);
            });
    });
    $scope.message = 'Everyone come and see how good I look!';
    $scope.userName = "Kenn E. Thompson";
});