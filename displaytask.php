<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
  		<?php
  		include 'config.php';
  		include 'opendb.php';
  		
  		$sql="SELECT task_name, task_desc, due_date FROM task_list WHERE show_flg='1'";
  		$result = mysqli_query($conn, $sql);
  		
  		if (mysqli_num_rows($result) > 0) {
  			//output data of each row
  			while ($row = mysqli_fetch_assoc($result)) {
  				echo $row["task_name"]. "  ";
  				echo $row["due_date"]. "<br>";
  				echo "     " . $row[task_desc]. "<br>";
  			}
  		} else {
  			echo "No tasks this week!";
  		}
  		
  		mysqli_close($conn);
  		
  		?>
</body>
</html>