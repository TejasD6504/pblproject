<?php
  session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
    $password = $_POST['pass'];
    
    include("connection.php");
    $stmt=$pdo->prepare('Select * FROM sign_in WHERE email = :email');
    try 
    {
        $stmt->execute(['email'=> $email]);

        if($stmt->rowCount()>0)
        {   
            $user = $stmt->fetch();
            if($password==$user['password'])
            {
                $stmt=$pdo->prepare('Select * FROM login WHERE email = :email');
                $stmt->execute(['email'=> $email]);
                if($stmt->rowCount()>0)
                {
                    $user = $stmt->fetch();
                    if($email==$user['email'])
                    {
                        echo "<script>alert('Login Successfull!');</script>";;
                        
                    }
                }
                else
                {
                $query = "INSERT INTO login(email,password) VALUES (?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$email,$password]);
                echo "<script>alert('Login Successfull!');</script>";;
                header('Location:/github/mainproject/pblproject/main.html');
                }
            }
            else 
            {
                $_SERVER['email'] = $email;
                $_SERVER['password'] = $password;
                echo"<script >alert('Incorect Password');</script>";;
                header('Location:/github/mainproject/pblproject/pblproject/index.html');

            }
        }
        else
        {
            $_SERVER['email'] = $email;
            $_SERVER['password'] = $password;
            echo "<script>alert('No account associated with his email');</script>";;
            header('Location:/github/mainproject/pblproject/pblproject/index.html');

        } 
    } 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>



