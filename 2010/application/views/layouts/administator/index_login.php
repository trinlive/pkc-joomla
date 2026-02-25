<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    <div class="logo">เทศบาลนครปากเกร็ด</div>

    <div class="box-login">
        <h3>เข้าสู่ระบบ</h3>
        <form class="form-login" method="post" action="<?php echo site_url(ADMIN_MODULE.'/auth/login'); ?>">
            <fieldset>
                <div class="form-group">
				<span class="input-icon">
					<input type="text" class="form-control" name="username" placeholder="Username">
                    <i class="fa fa-user"></i></span>
                    <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
                    <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
                </div>
                <div class="form-group form-actions ">
				<span class="input-icon">
					<input type="password" class="form-control password" name="password" placeholder="Password">
					<i class="fa fa-lock"></i>
                    <!-- <a class="forgot" href="#">
                        I forgot my password
                    </a> --> </span>
                </div>
                <div class="form-actions">
                    <!-- <label for="remember" class="checkbox-inline">
                        <input type="checkbox" class="grey remember" id="remember" name="remember">
                        Keep me signed in
                    </label> -->
                    <input type="submit" id="submit" name="submit" value="Sign In" class="btn btn-bricky pull-right"/>
                </div>

            </fieldset>
        </form>
    </div>
    <!-- end: LOGIN BOX -->
    <!-- start: COPYRIGHT -->
    <div class="copyright">
        201ถ &copy; เทศบาลนครปากเกร็ด
    </div>
    <!-- end: COPYRIGHT -->
</div>
<!-- start: LOGIN BOX -->