<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CLIENT</title>
    </head>
    <body>
        
        <?php
        session_start();
        $action= $_GET['action'];
        if($action=="submit_1")
        {
            
            \header('Location:http://localhost:8080/Workspace/OTS_Final/client_trade.html');
        }
        else if($action=="submit_2")
        {
            
            \header('Location:http://localhost:8080/Workspace/OTS_Final/client_payment.html');
        }
        else if($action=="submit_9")
        {
            
            \header('Location:http://localhost:8080/Workspace/OTS_Final/client_sell.html');
        }
        else if(isset($_POST['submit_6']))
        {
        	$servername = "localhost:3306";
        	$username = "root";
        	$password = "";
        	$dbname = "ots";
        	$conn = mysqli_connect($servername, $username, $password, $dbname);
        	$client_id = $_SESSION["id"];
        	
        	// Check connection
        	if (!$conn) {
        		die("Connection failed: ");
        	}
        	echo 'CONNECTION SUCCESS';
        	mysqli_select_db($conn, "ots");
        	$sql_14 = "INSERT INTO ots.payment(c_id, amount,payment_type, payment_status, date_of_payment) VALUES ('".mysqli_real_escape_string($conn,$client_id)."', '".mysqli_real_escape_string($conn,htmlspecialchars($_POST["amount_pay"]))."', '".mysqli_real_escape_string($conn,htmlspecialchars($_POST["ptype"]))."', 'PENDING APPROVAL', now())";
        	$query_14=mysqli_query($conn, $sql_14);
        	//$row_14 = mysqli_fetch_assoc($query_14);
        	//\header('Location:http://localhost/OTS/client_payment_proceed.html');
            \header('Location:http://localhost:8080/Workspace/OTS_Final/transEntry.html');
        }
        else if(isset($_POST['submit_4']))
        {
            $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $dbname = "ots";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) {
                 die("Connection failed: ");
            }
            echo 'CONNECTION SUCCESS';
            mysqli_select_db($conn, "ots");
            $client_id = $_SESSION["id"];
            $quantity = htmlspecialchars($_POST['quantity']);
            $commission_type = htmlspecialchars($_POST["ctype"]);

            $sql = "INSERT INTO ots.transaction(client_id, date_initiated, transaction_status, oil_quantity, commission_type, transaction_type) VALUES ('".mysqli_real_escape_string($conn,$client_id)."', now(), 'PTA', '".mysqli_real_escape_string($conn,$quantity)."', '".mysqli_real_escape_string($conn,$commission_type)."', 'BUY')";
  
         
           
            if (mysqli_query($conn, $sql)) {
                
                //echo "New record created successfully";
            	\header('Location:http://localhost:8080/Workspace/OTS_Final/transEntry.html');
            }
            mysqli_close($conn);
        } 
        else if(isset($_POST['submit_10']))
        {
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
            $client_id = $_SESSION["id"];
            $sql_10 = "SELECT * FROM client where cid= '".mysqli_real_escape_string($conn,$client_id)."'";
            $query_10=mysqli_query($conn, $sql_10);
            $row_10 = mysqli_fetch_assoc($query_10);
           
            if($row_10["quantity"] >= htmlspecialchars($_POST["quantity_sell"]))
            {
                $quantity_4 = $row_10["quantity"] - htmlspecialchars($_POST["quantity_sell"]);
                $sql_11 = "UPDATE client SET quantity='".$quantity_4."' where cid='".$client_id."'";
                $query_11=mysqli_query($conn, $sql_11);
                //$row_11 = mysqli_fetch_assoc($query_11);
                
                 $sql_13 = "SELECT * FROM oil";
                 $query_13=mysqli_query($conn, $sql_13);
                 $row_13 = mysqli_fetch_assoc($query_13);
                 
                 $quantity_3 = $row_13["oil_quantity"] + htmlspecialchars($_POST["quantity_sell"]); 
                // $oil_cost = $quantity_3 * $row_13["cost_barrel"];
                $sql_12 = "UPDATE oil SET oil_quantity='".$quantity_3."'";
                $query_12=mysqli_query($conn, $sql_12);
                //$row_12 = mysqli_fetch_assoc($query_12);*/
                
                
                 $sql_14 = "INSERT INTO ots.transaction(client_id, date_initiated, date_approved, transaction_status, oil_quantity, transaction_type) VALUES ('".mysqli_real_escape_string($conn,$client_id)."', now(), now(), 'SHIPPED', '".mysqli_real_escape_string($conn,htmlspecialchars($_POST["quantity_sell"]))."', 'SELL')";
                 $query_14=mysqli_query($conn, $sql_14);
                //$row_14 = mysqli_fetch_assoc($query_14);
                 
                /* $sql_15 = "SELECT * FROM payment where c_id = '$client_id'";
                 $query_15=mysqli_query($conn, $sql_15);
                 $row_15 = mysqli_fetch_assoc($query_15);*/
                  $oil_cost = htmlspecialchars($_POST["quantity_sell"]) * $row_13["cost_barrel"]; 
                  
                 if($row_10 > 0)
                 {
                     
                     $quantity_5 = $row_10["quantity"] - htmlspecialchars($_POST["quantity_sell"]);
                     $new_cost = $row_10["amount_due"] - $oil_cost;
                     $sql_16 = "UPDATE client SET amount_due='".mysqli_real_escape_string($conn,$new_cost)."', quantity='".mysqli_real_escape_string($conn,$quantity_5)."', status='PAYMENT PENDING'  where cid = '".mysqli_real_escape_string($conn,$client_id)."'";
                     $query_16=mysqli_query($conn, $sql_16);
                     
                 }
                 /*else
                 {
                     
                     $sql_17 = "INSERT into payment(c_id, oil_quantity,amount, payment_status) VALUES ('".$client_id."', '".$_POST["quantity_sell"]."', '".-($oil_cost)."', 'PAYMENT PENDING')";
                     $query_17=mysqli_query($conn, $sql_17);
                 }*/
            //}
            \header('Location:http://localhost:8080/Workspace/OTS_Final/client.html');
            }
            else {
            	\header('Location:http://localhost:8080/Workspace/OTS_Final/client_sell.html');
            }
        }
            
        ?>
    </body>
</html>