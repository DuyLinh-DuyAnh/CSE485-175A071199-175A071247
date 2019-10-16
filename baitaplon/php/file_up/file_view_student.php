
<?php
session_start();
 if (!isset($_SESSION['user_level']) or (($_SESSION['user_level']) != 2 and ($_SESSION['user_level'])) != 2)
 {
    header("Location: ../../login.php");
    exit();
 }
?>
<?php
require_once ('../../mysql_connect.php');

?>
<html>
<head>
<title>Upload and Download Files</title>
<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../css/mycss.css"> 
<link rel="stylesheet" type="text/css" href="../../css/fontawesome/css/all.css"> 

		<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css"> -->
</head>
	<script src="../../js/bootstrap.js" type="text/javascript"></script> 
	<script src="../../js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/login.js"></script>

<script src="../../js/bootstrap.js"></script> 

<style>
</style>
<body>
	<section class="col-sm-12 content nopadding">
    <div class="container nopadding">
      
    
    <div class="row">
      <?php
        if((!isset($_SESSION['user_level'])) || ($_SESSION['user_level'] !=1 &&  $_SESSION['user_level']!=2 && $_SESSION['user_level']!=0))
        {
           include('../header/header_view.php');
        }
        else{
          include('../header/header_view_student.php');
        }

?>
    </div>

	    <div class="row-fluid content noidung pb-5">
	        <div class="span12">
	            <div class="container alert-success">
		<br />
		<h1 align="center"><p> Thư viện</p></h1>	
		<br />
		<br />
			<form enctype="multipart/form-data" action="" name="form" method="POST">
					<div class="col-12">

					<label for="">Chọn môn : </label>
					<select name="select" id="select" class="bg-faded co">
					<?php
					$query = "SELECT * FROM subject";
                    $result=mysqli_query($dbcon,$query);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                    	echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }          


					 ?>
					</select>
					</div>
					<input type="submit" name="submit_search" id="submit" value="Tìm kiếm" class="bg-primary w-25" />
			</form>
		<br />
		<br />
		 <?php 
		 if(!isset($_POST['submit_search']))
		 {
    $q = "SELECT * FROM subject ";
    $result1=mysqli_query($dbcon,$q);
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC))
    {
    	$id=$row1['id_subject'];
    	$name_subject=$row1['name'];
    	$query= "SELECT * FROM UPLOAD where id_subject='$id'";
        $result2=mysqli_query($dbcon,$query);
         $num_row=mysqli_num_rows($result2);
         if($num_row>0){


		 ?>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered bg-white" id="example">
			<thead>
				<tr>
					<th width="90%" align="center" class="alert-danger"><?php echo $id." - ".$name_subject; ?></th>
						
				</tr>
			</thead>
			 <?php
			     
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {
				$name=$row2['name'];
			?> 
			<tr>
			
				<td>
					<a href="<?php echo '../../pload/'.$name ;?>" title=""><?php echo $name ;?></a>
				</td>
				<td>
					<a href="<?php echo '../../upload/'.$name ;?>"><i class="fas fa-download"></i></a>
				</td>
				<!-- <td>
					<button class="alert-success" id=""><a href=""><i class="fas fa-trash-alt"></i></a></button>
				</td>
 -->
			</tr>
			 <?php }}?> 
		</table>
	<?php }}
	if(isset($_POST['submit_search']))

	{
		$subject=$_POST['select'];
		$q = "SELECT * FROM subject where name='$subject' ";
    $result1=mysqli_query($dbcon,$q);
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC))
    {

    	$id=$row1['id_subject'];
    	$name_subject=$row1['name'];
 ?>
 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered bg-white" id="example">
			<thead>
				<tr>
					<th width="90%" align="center" class="alert-danger" ><?php echo $id." - ".$name_subject; ?></th>
						
				</tr>
			</thead>
			 <?php
			     $query= "SELECT * FROM UPLOAD where id_subject='$id'";
                    $result=mysqli_query($dbcon,$query);

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
				$name=$row['name'];
			?> 
			<tr>
			
				<td>
					<a href="<?php echo '../../upload/'.$name ;?>" title=""><?php echo $name ;?></a>
				</td>
				<td>
					<a href="<?php echo '../../upload/'.$name ;?>"><i class="fas fa-download"></i></a>
				</td>
				<!-- <td>
					<button class="alert-success" id=""><a href=""><i class="fas fa-trash-alt"></i></a></button>
				</td>
 -->
			</tr>
			 <?php }?> 
		</table>
	<?php }}

  ?>




	</div>
	</div>
	</div>
	<div class="row">
          <?php include('../footer/footer.php') ?>         
        </div>
</div>
</section>


</body>
</html>