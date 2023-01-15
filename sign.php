<?php  require_once 'backend/initialize.php' ?>
<?php $pageTitle = 'Sign UP | Twitter';?>
<?php require_once 'backend/shared/header.php';?>
<section class="sign-container">
    <?php require_once 'backend/shared/signNav.php'; ?>
    <div class="form-container">
        <div class="form-content">
            <div class="header-form-content">
                <h2>Create your account</h2>
            </div>
                <form action="sign.php" class="formField" method="POST">
                        <div class="form-group">
                            <label for="firstName">FirstName</label>
                            <input type="text" name="firstName" id="firstName" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">LastName</label>
                            <input type="text" name="lastName" id="lastName" autocomplete="off" required>
                        </div> 
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"  autocomplete="off" required>
                        </div> 
                        <div class="form-group">
    
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="cpass">Confirm Password</label>
                            <input type="password" name="pass2" id="cpass" autocomplete="off" required>
                        </div>
                        <div class="s-password">
                            <input type="checkbox" class="form-checkbox" id="s-password" onclick="showPassword()">
                            <label for="s-password">Show Password</label>
                        </div>
                        <div class="form-btn-wrapper">
                            <button type="submit" class="btn-form">SignUp</button>
                            <input type="checkbox" class="form-checkbox" id="check" name="remember">
                            <label for="check">Remember me</label>
                        </div>

                </form>
            </div>
                    <footer class="form-footer">
                        <p>Already have an account. <a href="login.php">Login Now</a></p>
                    </footer>
        </div>
    </section>
    <script src="../Tweet/frontend/assets/js/showPassword.js"></script>