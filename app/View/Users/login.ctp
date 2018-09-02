<div class="login">
    <div class="login-wrapper">
        <div class="login-placeholder">
            <i class="fa fa-user-circle-o login-placeholder-icon"></i>
        </div>
        <?php 
            echo $this->Form->create("User", [
                "type"  => "POST",
                "class" => "login-form"
            ]);
        ?>
        <?php echo $this->Flash->render(); ?>
        <div class="login-field">
            <i class="fa fa-envelope-o login-icon"></i>
            <?php 
                echo $this->Form->input("username", [
                    "type"        => "text",
                    "class"       => "login-input",
                    "div"         => false,
                    "label"       => false,
                    "placeholder" => "username"
                ]);
            ?>
        </div>
        <div class="login-field">
            <i class="fa fa-lock login-icon"></i>
            <?php 
                echo $this->Form->input("password", [
                    "type"        => "password",
                    "class"       => "login-input login-input--password",
                    "div"         => false,
                    "label"       => false,
                    "placeholder" => "********"
                ]);
            ?>
        </div>
        <div class="login-field">
            <a href="" class="login-forgot-password">Forgot Password?</a>
            <!-- <label class="login-label">
                <input type="checkbox" class="checkbox">
                Login as User?
            </label> -->
        </div>
        <div class="login-field login-field--button">
            <input type="submit" class="button-submit" value="Login">
        </div>
        <?php echo $this->Form->end(); ?> 
        <!-- <form class="login-form">
            <div class="flash-error">
                <i class="fa fa-exclamation error-icon"></i>
                <span>Ako error</span>
            </div>
            <div class="login-field">
                <i class="fa fa-envelope-o login-icon"></i>
                <input type="text" class="login-input" placeholder="username">
            </div>
            <div class="login-field">
                <i class="fa fa-lock login-icon"></i>
                <input type="password" class="login-input login-input--password"/ placeholder="********">
            </div>
            <div class="login-field">
                <a href="" class="login-forgot-password">Forgot Password?</a>
                <label class="login-label">
                    <input type="checkbox" class="checkbox">
                    Login as User?
                </label>
            </div>
            <div class="login-field login-field--button">
                <input type="submit" class="button-submit" value="Login">
            </div>
        </form> -->
    </div>
</div>