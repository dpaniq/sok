<?php 
    // Post request
    // include_once('../../scripts/register.php');


   
    // Database conn
    include('../../config/db.php');
    
    // Error & success messages
    global $success_msg, $email_exist, $emptyError1, $emptyError2, $emptyError3, $emptyError4, $emptyError5;
    
    if(isset($_POST["submit"])) {
        $email         = $_POST["email"];
        $password      = $_POST["password"];
        $rpassword      = $_POST["rpassword"];
        echo 'done 3';

        // verify if email exists
        $emailCheck = $conn->query("SELECT * FROM users WHERE email = '{$email}' ");
        $rowCount = $emailCheck->num_rows;

        // PHP validation
        if(!empty($email) && !empty($password) && !empty($rpassword)){
            // Todo if rpassword == password
            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {

            // Password hash
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql = $conn->query("INSERT INTO users (email, password, date_time) 
            VALUES ({$email}', '{$password_hash}', now())");
            
                if(!$sql){
                    die("MySQL query failed!" . mysqli_error($conn));
                } else {
                    $success_msg = '<div class="alert alert-success">
                        User registered successfully!
                </div>';
                }
            }
        } else {
            if(empty($email)){
                $emptyError1 = '<div class="alert alert-danger">
                    Email is required.
                </div>';
            }
            if(empty($password)){
                $emptyError2 = '<div class="alert alert-danger">
                    Password is required.
                </div>';
            }
            if(empty($password)){
                $emptyError3 = '<div class="alert alert-danger">
                    Password mismatch.
                </div>';
            }       
        }
    }




?>
<div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">User Registeration Form</h3>

            <?php echo $success_msg; ?>
            <?php echo $email_exist; ?>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" />

                <?php echo $emptyError1; ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" />

                <?php echo $emptyError2; ?>
            </div>

            <div class="form-group">
                <label>Repeat password</label>
                <input type="password" class="form-control" name="rpassword" id="rpassword" />

                <?php echo $emptyError3; ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Register
            </button>
        </form>
    </div>