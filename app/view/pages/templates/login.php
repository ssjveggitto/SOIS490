<h4 id="login-response">{{ response }}</h4>
<form name="loginForm" class="form-horizontal" novalidate ng-submit="login()">
    <fieldset>
        <legend>Log In Here</legend>
        <div class="form-group">
            <label for="inputUser" class="col-lg-2 control-label">Username</label>
            <div class="col-lg-4">
                <input type="text" id="userInput" class="form-control" id="inputUser" placeholder="Username" ng-model="user.name" ng-required="true">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-4">
                <input type="password" id="passwordInput" class="form-control" id="inputPassword" placeholder="Password" ng-model="user.password" ng-required="true">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </fieldset>