describe('my.module', function () {
    var $scope;

    beforeEach(module('myApp'));
    beforeEach(inject(function ($controller, $rootScope, $log) {
        //        $scope = $rootScope.new();
        $log.debugEnabled = false;
        $log.reset();
    }));

    describe('Filter: MyFilter', function () {
        // Verify that the controller can be instantiated
        it('should be instantiable', inject(function ($filter) {
            var myFilter = $filter('MyFilter');
            expect(myFilter).toBeDefined();
        }));

        it('should show "yes" when true is passed', inject(function ($filter, $log) {
            var myFilter = $filter('MyFilter');
            var result = myFilter(true);
            expect(result).toBe('yes');
        }));

        it('should include the postfix if provided', inject(function($filter, $log) {
            var myFilter = $filter('MyFilter');
            var result = myFilter(true, 'sir');
            expect(result).toBe('yes sir');
        }));

        // Verify that an unrecogized parameter throws an exception
        it('should require a known argument value', inject(function ($filter, $log) {
            var myFilter = $filter('MyFilter');
            expect(myFilter.bind(this, null)).toThrow();
        }));
    });
});
