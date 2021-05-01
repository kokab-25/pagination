<?php
$connect = mysqli_connect("localhost", "root", "", "data");
$record_per_page = 2;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "SELECT * FROM info order by id LIMIT $start_from, $record_per_page";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Pagination Assignment</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <style>
  a {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container">
   <h3 style="text-align:center; color:red;">Pagination Assignment</h3><br />
   <div class="table-responsive">
    <table class="table table-bordered">
     <tr>
      <td style="text-align:center; color:red; font-weight:bold;">USERNAME</td>
      <td  style="text-align:center; color:red; font-weight:bold;">AGE</td>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
     {
     ?>
     <tr>
      <td style="text-align:center;"><?php echo $row["username"]; ?></td>
      <td style="text-align:center;"><?php echo $row["age"]; ?></td>
     </tr>
     <?php
     }
     ?>
    </table>
    <div align="center">
    <br />
    <?php
    $page_query = "SELECT * FROM info ORDER BY id";
    $page_result = mysqli_query($connect, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($page > 1)
    {
     echo "<a href='pagination.php?page=1'>First</a>";
     echo "<a href='pagination.php?page=".($page - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='pagination.php?page=".$i."'>".$i."</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='pagination.php?page=".($page + 1)."'>>></a>";
     echo "<a href='pagination.php?page=".$total_pages."'>Last</a>";
    }
    
    
    ?>
    </div>
    <br /><br />
   </div>
  </div>
 </body>
</html>



