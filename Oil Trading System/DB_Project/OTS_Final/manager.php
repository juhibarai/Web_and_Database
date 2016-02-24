<?php
session_start();
$action= $_GET['action'];
if(isset($_POST['submit_20']))
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
	$sql_1 = "SELECT * from oil";
	$query_1=mysqli_query($conn, $sql_1);
	$row_1 = mysqli_fetch_assoc($query_1);
	
	if($row_1 > 0)
	{
		$new_oil_qty = $row_1["oil_quantity"] +htmlspecialchars($_POST["quantity"]);
		
		$costperbarrel = htmlspecialchars($_POST["costpbarrel"]);
		$sql_2 = "UPDATE oil SET oil_quantity = '".mysqli_real_escape_string($conn,$new_oil_qty)."'";
		mysqli_query($conn, $sql_2);
		$sql_3 = "UPDATE oil SET cost_barrel='".mysqli_real_escape_string($conn,$costperbarrel)."'";
		mysqli_query($conn, $sql_3);
		\header('Location:http://localhost:8080/Workspace/OTS_Final/manager.html');
	}
}
if(isset($_POST['submit_14']))
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
	$toDate = htmlspecialchars($_POST["to"]);
	$fromDate = htmlspecialchars($_POST["from"]);
	//echo $fromDate;
	//echo $toDate;
	//Trans for trans_type=buy
	$sql_14 = "SELECT count(transaction_id) AS tot_trans,sum(oil_quantity) AS tot_oil FROM transaction  where transaction_type = 'BUY' and date_approved between '".mysqli_real_escape_string($conn,$fromDate)."' and '".mysqli_real_escape_string($conn,$toDate)."'";
	//GROUP BY day('".$fromDate."')+'-'+month('".$fromDate."')+'-'+year('".$toDate."')";
	$query_14=mysqli_query($conn, $sql_14);
	$row_14 = mysqli_fetch_assoc($query_14);
	$sum=$row_14["tot_trans"];
	$sum1=$row_14["tot_oil"];
	//Trans for trans_type=buy
	$sql_15 = "SELECT count(transaction_id) AS tot_trans1,sum(oil_quantity) AS tot_oil1 FROM transaction  where transaction_type = 'SELL' and date_approved between '".mysqli_real_escape_string($conn,$fromDate)."' and '".mysqli_real_escape_string($conn,$toDate)."'";
	$query_15=mysqli_query($conn, $sql_15);
	$row_15 = mysqli_fetch_assoc($query_15);
	$sum2=$row_15["tot_trans1"];
	$sum3=$row_15["tot_oil1"];
	//$sql_14 = "SELECT count(transaction_id) AS tot_trans,sum(oil_quantity) AS tot_oil FROM transaction GROUP BY month(date_initiated)+'-'+year(date_initiated)";
	\header('Location:http://localhost:8080/Workspace/OTS_Final/ManagerView.php?trans='.$sum.'&oil='.$sum1.'&to='.$toDate.'&from='.$fromDate.'&trans1='.$sum2.'&oil1='.$sum3);
}
if($action=="submit_11")
{
    \header('Location:http://localhost:8080/Workspace/OTS_Final/manager_set.html');
}

if($action=="submit_13")
{
	\header('Location:http://localhost:8080/Workspace/OTS_Final/client_pay.html');
}

?>

