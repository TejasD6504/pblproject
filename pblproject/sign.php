<?php
  session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $email=$_POST['email2'];
    $password = $_POST['pass2'];
    $confirmpassword = $_POST['passcon'];

       if($password!=$confirmpassword){
        $_SERVER['user']=$username;
        $_SERVER['email2']=$email;
        $_SERVER['pass2']=$password;
        $_SERVER['passcon']=$confirmpassword;

        echo "<script>alert('Password does not match');</script>";
     } 
     else 
     { 
          include ("connection.php");
          $stmt=$pdo->prepare('Select * FROM sign_in WHERE email = :email2');
          $stmt->execute(['email2'=> $email]);
          if($stmt->rowCount()>0){
            $_SERVER['user']=$username;
            $_SERVER['email2']=$email;
            $_SERVER['pass2']=$password;
            $_SERVER['passcon']=$confirmpassword;

            echo "<script>alert('Email already taken. Try another Email!');</script>";;
          }
           else
            {
                try {
                $query = "INSERT INTO sign_in(username, email,password,confirm_password) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$username,$email,$password,$confirmpassword]);
                echo "<script>alert('Sign Up Successfull!');</script>";;
                echo "<script>alert('Login Now');</script>";;
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                }
            }
        }   
    }
?>