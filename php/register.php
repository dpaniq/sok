<?php

    use App\Registration;

    include 'classes/Registration.php';

    $reg = new Registration();

    if ($_POST)
    {
        $reg->register();
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

    <?php $reg->$success_msg; ?>

    <div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">Registration</h3>


            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email@email.com" required />
                
                <?php $reg->showError('email') ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" required />
                <?php $reg->showError('password') ?>
            </div>

            <div class="form-group">
                <label>Repeat password</label>
                <input type="password" class="form-control" name="rpassword" id="rpassword" required />
                <?php $reg->showError('rpassword') ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Register
            </button>
        </form>
    </div>


</body>

</html>