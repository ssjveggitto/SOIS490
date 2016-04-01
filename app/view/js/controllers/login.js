var Controllers = angular.module('Controllers', []);

Controllers.controller('loginController', ['$scope', '$http',
  function ($scope, $http) {
        $(document).ready(function () {
            $('a').hide();
        });
        $http.get('app/model/data/admin.json').success(function (data) {
            $scope.greeting = " Please login to use Imagine Salon Scheduling Service.";
        });

        $scope.login = function () {
            $scope.message = "Welcome " + $scope.user.name + "!";
            $user = document.getElementById('userInput').value;
            $password = document.getElementById('passwordInput').value;
            $scope.response = "";
            if (!$scope.validate($user, $password)) {
                $scope.response = "Your username/password combination was not recognized.";
                $('#login-response').css('color', 'red');
            } else {
                $scope.response = $scope.message;
                $('.username').text($user);
                $('a').show();
                window.location = "#/home";
            }
        };

        $scope.validate = function (user, password) {
            for (var i = 0; i < $scope.users.length; i++) {
                if (user == $scope.users[i]['name']) {
                    if (password == $scope.users[i]['password']) {
                        return true;

                    }
                }
            }
            return false;
        };

        $scope.users = [
            {
                'name': 'Chaz',
                'password': '1111'
            },
            {
                'name': 'Lee',
                'password': '2222'
            }
        ];
  }]);