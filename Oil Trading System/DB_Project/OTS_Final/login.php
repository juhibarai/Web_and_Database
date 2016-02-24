<?php

    session_start();
    /*if( isset( $_SESSION['counter'] ) )
    {
        $_SESSION['counter'] += 1;
    }
    else
    {
         $_SESSION['counter'] = 1;
    }
   $msg = "You have visited this page ".  $_SESSION['counter'];
   $msg .= "in this session.";
   echo $msg;*/
    if($_POST['submit_0'] == 'Sign in')
    {
        $_SESSION["username"] = htmlspecialchars($_POST["username"]);
        $_SESSION["password"] = htmlspecialchars($_POST["password"]);
       // $_SESSION["role"]=$_POST["role"];
        //echo $_SESSION["role"];
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "ots";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: ");
        }
        mysqli_select_db($conn, "ots");
        $sql = "SELECT * FROM login where username='".mysqli_real_escape_string($conn,htmlspecialchars($_POST["username"]))."' and password='".mysqli_real_escape_string($conn,htmlspecialchars($_POST["password"]))."'";
    
        $query = mysqli_query($conn, $sql);
       
        //$row = mysqli_fetch_assoc($query);
        if (mysqli_num_rows($query) == 0)
        {
            //echo $mysqli_num_rows($query);
            echo 'please enter the correct details';
            \header('Location:http://localhost:8080/Workspace/OTS_Final/loginError.html');
        }
        else
        {
            $row = mysqli_fetch_assoc($query);
                $_SESSION["id"] = $row["id"];
            }
            if($row['role'] == 'CLIENT')
            {
                \header('Location:http://localhost:8080/Workspace/OTS_Final/client.html');
            }
            else if($row['role'] == 'TRADER')
            {
                \header('Location:http://localhost:8080/Workspace/OTS_Final/trader.html');
            } 
            else if($row['role'] == 'MANAGER')
            {
                \header('Location:http://localhost:8080/Workspace/OTS_Final/manager.html');
            } 
        }
     
   
?>
