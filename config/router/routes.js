var app = angular.module('imagineSalonApp', [
    'ngRoute',
    'Controllers'
]);

app.config(['$routeProvider',
            function ($routeProvider) {
        $routeProvider.
        when('/', {
            //Home Page
            templateUrl: 'app/view/pages/templates/login.php',
            controller: 'loginController'
        }).
        when('/home', {
            templateUrl: 'app/view/pages/templates/home.php'
        }).
        when('/calendar', {
            templateUrl: 'app/view/pages/templates/calendar.php'
        }).
        when('/customers', {
            templateUrl: 'app/view/pages/templates/customers.php'
        }).
        when('/inventory', {
            templateUrl: 'app/view/pages/templates/inventory.php'
        }).
        when('/settings', {
            templateUrl: 'app/view/pages/templates/settings.php'
        }).
        when('/reports', {
            templateUrl: 'app/view/pages/templates/reports.php'
        }).
        when('/:user/account', {
            templateUrl: 'app/view/pages/templates/user.php'
        }).
        when('/test', {
            templateUrl: 'app/view/pages/templates/test.php'
        }).
        otherwise({
            redirectTo: '/'
        });
    }]);