<?php
    session_start();

    use App\SignUp;

    include 'classes/SignUp.php';

    $reg = new SignUp();

    if ($_POST){
        $reg->login();
    }
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once './src/partials/head.php'; ?>
    <title><?php echo $title ?></title>
</head>

<body>
    <?php include_once './src/partials/navbar.php'; ?>

    <div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">Sign Up</h3>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required />
                <?php $reg->showError('email') ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                <?php $reg->showError('password') ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block"> Sign up </button>
            <?php $reg->showError('incorrect') ?>
            <p style="text-align:center; margin-top:4px;">Not registered yet? <a href='register.php'>Register Here</a></p>
        </form> 
    </div>


</body>

</html>