<div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">User Sign Up</h3>

            <?php echo $success_msg; ?>
            <?php echo $email_exist; ?>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" />

                <?php echo $emptyError3; ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" />

                <?php echo $emptyError4; ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Sign up
            </button>
        </form>
    </div>