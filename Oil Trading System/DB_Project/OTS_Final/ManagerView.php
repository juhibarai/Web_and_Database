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
  <link href="gridtable.css" type="text/css" rel="stylesheet" />
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
            <a href="./manager.php?action=submit_11">
              <i class="fa fa-database"></i> SET VALUES
            </a>
          </li>
          <li>
          <a href="./manager.php?action=submit_13">
          <i class="fa fa-database"></i>VIEW
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
          <h1>Dashboard</h1>      
            
 <?php
$sum=htmlspecialchars($_GET['trans']);
$sum1=htmlspecialchars($_GET['oil']);
$sum2=htmlspecialchars($_GET['trans1']);
$sum3=htmlspecialchars($_GET['oil1']);
$to=htmlspecialchars($_GET['to']);
$from=htmlspecialchars($_GET['from']);
//echo $sum;
//echo $sum1;

echo "<h3>Transaction Details of OIL BOUGHT from Company From:".$from."<br>To:".$to."</h3>";
echo "<table class='gridtable'>";
echo "<tr>";
echo "<th><h2>Total Transaction</h2></th>";
echo "<th><h2>Total Oil</h2></th>";
echo "</tr>";
echo "<tr>";
echo "<td>".$sum."</td>";
echo "<td>".$sum1."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<br>";
echo "<h3>Transaction Details of OIL SOLD to Company From:".$from."<br>To:".$to."</h3>";
echo "<table class='gridtable'>";
echo "<tr>";
echo "<th><h2>Total Transaction</h2></th>";
echo "<th><h2>Total Oil</h2></th>";
echo "</tr>";
echo "<tr>";
echo "<td>".$sum2."</td>";
echo "<td>".$sum3."</td>";
echo "</tr>";
echo "</table>";
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





