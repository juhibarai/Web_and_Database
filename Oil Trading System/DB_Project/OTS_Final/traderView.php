<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Dashboard, Free HTML5 Admin Template</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="css/templatemo_main.css">
</head>
<body>
  <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo"><h1>OTS - Oil Transaction System</h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
      </div>   
    </div>
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
          <li>
            <form class="navbar-form">
              <input type="text" class="form-control" id="templatemo_search_box" placeholder="Search...">
              <span class="btn btn-default">Go</span>
            </form>
          </li>
          <li class="active"><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
          <li>
            <a href="./traderView.php?action=submit_30">
              <i class="fa fa-database"></i> APPROVE_TRANSACTION
            </a>
          </li>
          <li>
          <a href="./trader.php?action=submit_10">
          <i class="fa fa-database"></i>APPROVE/CANCEL PAYMENT
          </a>
          </li>
          <li><a href="./trader.php?action=submit_6">
          <i class="fa fa-database"></i>INITIATE_BUY
          </a>
          </li>
          
        </ul>
      </div><!--/.navbar-collapse -->

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
            
            <li><a href="#">Dashboard</a></li>
            <li class="active">Overview</li>
            <li><a href="login.html">Sign Out</a></li>
          </ol>
          <h1>Transactions Pending Approval</h1> 
          
         <a href="./trader.php?action=submit_5"><span class="btn btn-default">Approve/Cancel</span> </a>
			<br><br>

<?php
session_start();
$action= $_GET['action'];

if($action=="submit_30")
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
	$sql_14 = "SELECT * FROM transaction where transaction_status = 'PTA'";
	$query_14=mysqli_query($conn, $sql_14);
	//$row_14 = mysqli_fetch_assoc($query_14);
	//$w=$row_14['transaction_status'];
	//echo $w;
	
	echo "<table border='1'>
<tr>
			<th>transaction_id</th>
			<th>client_id</th>
			<th>trader_id</th>
			<th>transaction_status</th>
			<th>oil_quantity</th>
			<th>commission_type</th>
			<th>date_initiated</th>
			<th>date_approved</th>
			<th>transaction_type</th>					
</tr>";
	
	while($row15 = mysqli_fetch_array($query_14))
	{
		echo "<tr>";
		echo "<td>" . $row15['transaction_id'] . "</td>";
		echo "<td>" . $row15['client_id'] . "</td>";
		echo "<td>" . $row15['trader_id'] . "</td>";
		echo "<td>" . $row15['transaction_status'] . "</td>";
		echo "<td>" . $row15['oil_quantity'] . "</td>";
		echo "<td>" . $row15['commission_type'] . "</td>";
		echo "<td>" . $row15['date_initiated'] . "</td>";
		echo "<td>" . $row15['date_approved'] . "</td>";
		echo "<td>" . $row15['transaction_type'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	mysqli_close($conn);
}
?>

</div>
      </div>
      <footer class="templatemo-footer">
        <div class="templatemo-copyright">
          <p>Copyright &copy; 2084 Your Company Name <!-- Credit: www.templatemo.com --></p>
        </div>
      </footer>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/templatemo_script.js"></script>
</body>
</html>