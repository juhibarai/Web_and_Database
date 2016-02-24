<?php
session_start();
$action= $_GET['action'];
//echo $action;
if($action=="submit_5")
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
        
        
        /*Getting the quantity of oil set by manager of the company*/
        $sql_1 = "SELECT * FROM oil";
        $query_1=mysqli_query($conn, $sql_1);
        $row_1 = mysqli_fetch_assoc($query_1);
        
        /*Approving a transaction by the trader*/
        $sql = "SELECT * FROM transaction where transaction_status='PTA' and transaction_type='BUY'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0)
        {
            $row = mysqli_fetch_assoc($query);
            if($row["transaction_type"] == 'BUY')
            {
            if($row["oil_quantity"] <= $row_1["oil_quantity"])
            {
                $sql_2 = "UPDATE transaction SET trader_id='".$_SESSION["id"]."', transaction_status='SHIPPED', date_approved=now() WHERE transaction_id='".$row["transaction_id"]."'";
                $query_2=mysqli_query($conn, $sql_2);
                /*Allocating oil to the client and deducting it from the total quantity owned by the company*/
                
                
                $amount = $row_1["cost_barrel"] *  $row["oil_quantity"];
               
                
                $sql_14 = "SELECT sum(oil_quantity) AS sum FROM transaction WHERE client_id = '".$row["client_id"]."' GROUP BY month(date_initiated)+'-'+year(date_initiated)";
                $query_14=mysqli_query($conn, $sql_14);
                $row_14 = mysqli_fetch_assoc($query_14);
               echo $row["client_id"];echo "</br>";
                echo $row_14["sum"];
                if(($row_14["sum"]) >= 30)
                {
                    $sql_5 = "UPDATE client SET level='gold' WHERE cid = '".$row["client_id"]."'";
                    mysqli_query($conn, $sql_5);
                }
                /*Categorize customer as gold or silver*/
               /* if($row["oil_quantity"] > 30)
                {
                    $sql_5 = "UPDATE client SET level='gold' WHERE cid = '".$row["client_id"]."'";
                    mysqli_query($conn, $sql_5);
                }*/
                
                /*Verifying if there is another entry for the same customer in the payment table, the payment table is updated per client*/
                /*$sql_4 = "SELECT * from client where cid = '".$row["client_id"]."'";
                $query_4=mysqli_query($conn, $sql_4);
                $row_2 = mysqli_fetch_assoc($query_4);*/
                 
               
                    /*Calculating the commission and updating the payment table*/
                    $sql_6 = "SELECT * from client where cid= '".$row["client_id"]."'";
                    $query_6=mysqli_query($conn, $sql_6);
                    $row_6 = mysqli_fetch_assoc($query_6);
                    //$oil_quantity = 0;
                    if((strcmp($row_6 ["level"],'gold') == 0) and strcmp($row["commission_type"],'CASH') == 0){
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $row["oil_quantity"];
                         $amount_2 = ($amount * 0.10)+$amount;
                        $oil_quantity = $row["oil_quantity"];
                    }
                    else if(($row_6 ["level"] == 'silver') and ($row["commission_type"]=='CASH'))
                    {
                        
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $row["oil_quantity"];
                         $amount_2 = ($amount * 0.15)+$amount;
                        $oil_quantity = $row["oil_quantity"];
                    }
                    else if(($row_6 ["level"] == 'gold') and ($row["commission_type"]=='OIL'))
                    {
                        
                        $oil_commission=$amount *0.10;
                        $oil_barrels_commission = $oil_commission/($row_1["cost_barrel"]);
                        $oil_quantity = $row["oil_quantity"] - $oil_barrels_commission;
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $oil_quantity;
                        $amount_2 = $amount;
                        //echo $oil_quantity;
                        //$row_2["oil_quantity"] = $row_2["oil_quantity"] - $oil_barrels_qty;
                        //$amount_2 = $amount;
                    }
                    else if(($row_6 ["level"] == 'silver') and ($row["commission_type"]=='OIL'))
                    {
                        $oil_commission=$amount *0.15;
                        $oil_barrels_commission = $oil_commission/($row_1["cost_barrel"]);
                        $oil_quantity = $row["oil_quantity"] - $oil_barrels_commission;
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $oil_quantity;
                        $amount_2 = $amount;
                        //echo $oil_quantity;
                        //$row_2["oil_quantity"] = $row_2["oil_quantity"] - $oil_barrels_qty;
                        //$amount_2 = $amount;
                    }
                    $quantity_2 = $oil_quantity + $row["oil_quantity"];
                    $sql_7 = "UPDATE client SET quantity='".$oil_quantity."' WHERE cid = '".$row["client_id"]."'";
                    mysqli_query($conn, $sql_7);
                    //echo $row_2["amount"];
                    
                  /*$amount_1 = $amount + $amount_2;
                  $amount_3 = $row_2["amount"] + $amount_1;
                    echo $amount_1;
                    $quantity_1 = $row["oil_quantity"] +  $row_2["oil_quantity"];
                    echo $quantity_1;*/
                    $sql_3 = "UPDATE oil SET oil_quantity='".$row_1["oil_quantity"]."'";
                    $query_3=mysqli_query($conn, $sql_3);
                    //echo "hello";
                   // echo "</br>";
                /*if ($row_2 == 0)
                {
                    
                    $sql_5 = "INSERT INTO payment(c_id, oil_quantity, amount, payment_status) VALUES ('".$row["client_id"]."', '".$oil_quantity."','".$amount_2."' , 'PAYMENT PENDING')";
                    
                    
                }*/
               // else
                if($row_6 > 0)
                {
                    $amount_3 = $row_6["amount_due"] + $amount_2;
                    $quantity_1 =$row_6["quantity"] + $oil_quantity;
                    $sql_5="UPDATE client SET  amount_due='".$amount_3."',quantity='".$quantity_1."',status='PAYMENT PENDING' WHERE cid='".$row_6["cid"]."'";
                }
                mysqli_query($conn, $sql_5);
              // \header('Location:http://localhost/OTS/trader.html');
            }
            else
            {
                $sql_6 = "UPDATE transaction SET trader_id='".$_SESSION["id"]."', transaction_status='DECLINE' WHERE transaction_id='".$row["transaction_id"]."'";
                $query_6=mysqli_query($conn, $sql_6);
            }
            }
            else if($row["transaction_type"] == 'SELL')
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
                $sql_10 = "SELECT * FROM client where cid= '".$client_id."'";
                $query_10=mysqli_query($conn, $sql_10);
                $row_10 = mysqli_fetch_assoc($query_10);
           
                if($row_10["quantity"] >= $row["oil_quantity"])
                {
                    $quantity_4 = $row_10["quantity"] - $row["oil_quantity"];
                    $sql_11 = "UPDATE client SET quantity='".$quantity_4."' where cid='".$client_id."'";
                    $query_11=mysqli_query($conn, $sql_11);
                    //$row_11 = mysqli_fetch_assoc($query_11);
                
                     $sql_13 = "SELECT * FROM oil";
                    $query_13=mysqli_query($conn, $sql_13);
                    $row_13 = mysqli_fetch_assoc($query_13);
                
                    $quantity_3 = $row_13["oil_quantity"] + $row["oil_quantity"]; 
                    $sql_12 = "UPDATE oil SET oil_quantity='".$quantity_3."'";
                    $query_12=mysqli_query($conn, $sql_12);
                    //$row_12 = mysqli_fetch_assoc($query_12);
                    
                    $sql_14 = "UPDATE transaction SET trader_id='".$_SESSION["id"]."', transaction_status='SHIPPED', date_approved=now() WHERE transaction_id='".$row["transaction_id"]."'";
                    $query_14=mysqli_query($conn, $sql_14);
  
                }
            }
        }
        \header('Location:http://localhost:8080/Workspace/OTS_Final/trader.html');
}
if($action=="submit_6")
{
    \header('Location:http://localhost:8080/Workspace/OTS_Final/trader_initiate.html');
}

/*if(isset($_POST['submit_11']))
{
    \header('Location:http://localhost/OTS/trader_initiate_sell.html');
}*/

if(isset($_POST['submit_7']))
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
        
        
        /*Getting the quantity of oil set by manager of the company*/
        $sql_1 = "SELECT * FROM oil";
        $query_1=mysqli_query($conn, $sql_1);
        $row_1 = mysqli_fetch_assoc($query_1);
       
        $client_id = htmlspecialchars($_POST["client_id"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        $commission_type = htmlspecialchars($_POST["ctype"]);
        $trader_id = $_SESSION["id"];
        /*Inserting the client details into the transaction table*/
        
        
        if($quantity < $row_1["oil_quantity"])
        {
                
                $sql = "INSERT INTO ots.transaction(client_id, trader_id, date_initiated, date_approved, transaction_status, oil_quantity, commission_type, transaction_type) VALUES ('".mysqli_real_escape_string($conn,$client_id)."', '".mysqli_real_escape_string($conn,$trader_id)."', now(), now(), 'SHIPPED', '".mysqli_real_escape_string($conn,$quantity)."', '".mysqli_real_escape_string($conn,$commission_type)."', 'BUY')";
                $query_2=mysqli_query($conn, $sql);
                
                $sql_3 = "UPDATE oil SET oil_quantity='".mysqli_real_escape_string($conn,$row_1["oil_quantity"])."'";
                $query_3=mysqli_query($conn, $sql_3);
                $amount = $row_1["cost_barrel"] *  $quantity;
               
                /*Categorizing a customer as gold or silver*/
                $sql_14 = "SELECT sum(oil_quantity) AS sum FROM transaction WHERE client_id = '".$client_id."' GROUP BY month(date_initiated)+'-'+year(date_initiated)";
                $query_14=mysqli_query($conn, $sql_14);
                $row_14 = mysqli_fetch_assoc($query_14);
                //echo $row_14["sum"];
                if(($row_14["sum"]) >= 30)
                {
                    $sql_5 = "UPDATE client SET level='gold' WHERE cid = '".$client_id."'";
                    mysqli_query($conn, $sql_5);
                }
                
                /*Verifying if there is another entry for the same customer in the payment table, the payment table is updated per client*/
                /*$sql_4 = "SELECT * from client where cid = '".$client_id."'";
                $query_4=mysqli_query($conn, $sql_4);
                $row_2 = mysqli_fetch_assoc($query_4);*/
                 
               
                    /*Calculating the commission and updating the payment table*/
                    $sql_6 = "SELECT * from client where cid= '".$client_id."'";
                    $query_6=mysqli_query($conn, $sql_6);
                    $row_6 = mysqli_fetch_assoc($query_6);
                    //$oil_quantity = 0;
                    if((strcmp($row_6 ["level"],'gold') == 0) and strcmp($commission_type,'CASH') == 0){
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $quantity;
                        $amount_2 = ($amount * 0.10)+$amount;
                        $oil_quantity = $quantity;
                    }
                    else if(($row_6 ["level"] == 'silver') and ($commission_type == 'CASH'))
                    {
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $quantity;
                        
                         $amount_2 = ($amount * 0.10)+$amount;
                         $oil_quantity = $quantity;
                    }
                    else if(($row_6 ["level"] == 'gold') and ($commission_type =='OIL'))
                    {
                        $oil_commission=$amount *0.10;
                        $oil_barrels_commission = $oil_commission/($row_1["cost_barrel"]);
                        $oil_quantity = $quantity - $oil_barrels_commission;
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $oil_quantity;
                        $amount_2 = $amount;
                        //echo $oil_quantity;
                        //$row_2["oil_quantity"] = $row_2["oil_quantity"] - $oil_barrels_qty;
                        //$amount_2 = $amount;
                    }
                    else if(($row_6 ["level"] == 'silver') and ($commission_type =='OIL'))
                    {
                        $oil_commission=$amount *0.15;
                        $oil_barrels_commission = $oil_commission/($row_1["cost_barrel"]);
                        $oil_quantity = $quantity - $oil_barrels_commission;
                        $row_1["oil_quantity"] = $row_1["oil_quantity"] - $oil_quantity;
                        $amount_2 = $amount;
                        //echo $oil_quantity;
                        //$row_2["oil_quantity"] = $row_2["oil_quantity"] - $oil_barrels_qty;
                        //$amount_2 = $amount;
                    }
                    
                    $quantity_2 = $oil_quantity + $quantity;
                    $sql_7 = "UPDATE client SET quantity='".mysqli_real_escape_string($conn,$oil_quantity)."' WHERE cid = '".mysqli_real_escape_string($conn,$client_id)."'";
                    mysqli_query($conn, $sql_7);
                    $sql_3 = "UPDATE oil SET oil_quantity='".mysqli_real_escape_string($conn,$row_1["oil_quantity"])."'";
                    $query_3=mysqli_query($conn, $sql_3);
                    //echo $row_2["amount"];
                    
                  /*$amount_1 = $amount + $amount_2;
                  $amount_3 = $row_2["amount"] + $amount_1;
                    echo $amount_1;
                    $quantity_1 = $row["oil_quantity"] +  $row_2["oil_quantity"];
                    echo $quantity_1;*/
                /*if ($row_2 == 0)
                {
                    
                    $sql_5 = "INSERT INTO payment(c_id, oil_quantity, amount, payment_status) VALUES ('".$client_id."', '".$oil_quantity."','".$amount_2."' , 'PAYMENT PENDING')";
                    
                    
                }*/
                //else
                if($row_6 > 0)
                {
                    $amount_3 = $row_6["amount_due"] + $amount_2;
                    $quantity_1 =$row_6["quantity"] + $oil_quantity;
                    $sql_5="UPDATE client SET  amount_due='".mysqli_real_escape_string($conn,$amount_3)."',quantity='".mysqli_real_escape_string($conn,$quantity_1)."', status='PAYMENT PENDING' WHERE cid='".mysqli_real_escape_string($conn,$client_id)."'";
                }
                mysqli_query($conn, $sql_5);
              \header('Location:http://localhost:8080/Workspace/OTS_Final/trader.html');
            }
        }
        
 /*if(isset($_POST['submit_12']))
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
        
        
       
        
      
                $client_id = $_POST["client_id"];
                $quantity = $_POST["quantity"];
                $sql_10 = "SELECT * FROM client where cid= '".$client_id."'";
                $query_10=mysqli_query($conn, $sql_10);
                $row_10 = mysqli_fetch_assoc($query_10);
           
                if($row_10["quantity"] >= $quantity)
                {
                    $quantity_4 = $row_10["quantity"] - $quantity;
                    $sql_11 = "UPDATE client SET quantity='".$quantity_4."' where cid='".$client_id."'";
                    $query_11=mysqli_query($conn, $sql_11);
                    //$row_11 = mysqli_fetch_assoc($query_11);
                
                     $sql_13 = "SELECT * FROM oil";
                    $query_13=mysqli_query($conn, $sql_13);
                    $row_13 = mysqli_fetch_assoc($query_13);
                
                    $quantity_3 = $row_13["oil_quantity"] + $quantity; 
                    $sql_12 = "UPDATE oil SET oil_quantity='".$quantity_3."'";
                    $query_12=mysqli_query($conn, $sql_12);
                    //$row_12 = mysqli_fetch_assoc($query_12);
                    
                $sql = "INSERT INTO ots.transaction(client_id, trader_id, date_initiated, date_approved, transaction_status, oil_quantity, transaction_type) VALUES ('".$client_id."', '".$_SESSION["id"]."', now(), now(), 'SHIPPED', '".$quantity."', 'SELL')";
                $query_2=mysqli_query($conn, $sql);
  
                }
                
        
} */   
else if($action=="submit_10")
{
      \header('Location:http://localhost:8080/Workspace/OTS_Final/trader_payment.html');
}
else if(isset($_POST['submit_14']))
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
        $trader_id = $_SESSION["id"];
        $sql_11 = "UPDATE payment SET t_id='".mysqli_real_escape_string($conn,$trader_id)."', payment_status='APPROVE' where id='".mysqli_real_escape_string($conn,$_POST["p_id"])."'";
        $query_11=mysqli_query($conn, $sql_11);
        
        $sql_12 = "SELECT * from payment where id='".mysqli_real_escape_string($conn,htmlspecialchars($_POST["p_id"]))."'";
        $query_12=mysqli_query($conn, $sql_12);
        $row_12 = mysqli_fetch_assoc($query_12);
        $clientid= $row_12["c_id"];
        
        $sql_14 = "SELECT * FROM client where cid='".mysqli_real_escape_string($conn,$clientid)."'";
        $query_14=mysqli_query($conn, $sql_14);
        $row_14 = mysqli_fetch_assoc($query_14);
        $amountdue = $row_14["amount_due"]-$row_12["amount"];
        if($amountdue == 0)
        {
             $sql_13 = "UPDATE client SET amount_due='".mysqli_real_escape_string($conn,$amountdue)."',status='COMPLETED'  where cid='".mysqli_real_escape_string($conn,$clientid)."'";
             $query_13=mysqli_query($conn, $sql_13);
              $row_13 = mysqli_fetch_assoc($query_13);
        }
        else
        {
            $sql_15 = "UPDATE client SET amount_due='".mysqli_real_escape_string($conn,$amountdue)."' where cid='".mysqli_real_escape_string($conn,$clientid)."'";
            $query_15=mysqli_query($conn, $sql_15);
              //$row_13 = mysqli_fetch_assoc($query_13);
        }
      \header('Location:http://localhost:8080/Workspace/OTS_Final/traderApprove.html');
}
else if(isset($_POST['submit_15']))
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
	$trader_id = $_SESSION["id"];
	
	/*Getting the quantity of oil set by manager of the company*/
	$sql_11 = "UPDATE payment SET t_id='".mysqli_real_escape_string($conn,$trader_id)."', payment_status='CANCEL' where id='".mysqli_real_escape_string($conn,htmlspecialchars($_POST["p_id"]))."'";
	$query_11=mysqli_query($conn, $sql_11);
	     
	\header('Location:http://localhost:8080/Workspace/OTS_Final/traderCancel.html');
}
?>


