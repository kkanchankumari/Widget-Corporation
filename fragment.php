<?php require_once("includes/connection.php");?>
<?php require_once("includes/header.php");?>
<?php

$ptr=$_GET['s1'];
$ptr1=$_GET['s2'];

if($ptr==1){
$query= "SELECT * from s1 where position<=2";
		$result=mysqli_query($conn,$query);
				//print_r($result);
				
				if(mysqli_affected_rows($conn)>0){
					//rows affected successfully
				
					while( $row = mysqli_fetch_assoc($result)){
						$subjects[]= $row;
						
					}echo "<table border=1 cellpadding=8 >";
					foreach($subjects as $subject){
							
							echo "<tr><td>" . $subject['id'] . "</td>"."<td>".$subject['menu_name'] . "</td></tr>";
							//echo "<br>";
							
					}echo "</table>";
				}else{
					//error
					echo "<p>".mysqli_error($conn)."</p>";
					echo "<a href=\"content.php\">Return to main page<a/>";
				}
}else if($ptr1==2){
$query= "SELECT * from s2 where position>2";
		$result=mysqli_query($conn,$query);
				//print_r($result);
				
				if(mysqli_affected_rows($conn)>0){
					//rows affected successfully
				
					while( $row = mysqli_fetch_assoc($result)){
						$subjects[]= $row;
						
					}
					echo "<table border=1 cellpadding=8 >";
					foreach($subjects as $subject){
							echo "<tr><td>" . $subject['id'] . "</td>"."<td>".$subject['menu_name'] . "</td></tr>";
							
					}
					echo "</table>";
				}else{
					//error
					echo "<p>".mysqli_error($conn)."</p>";
					echo "<a href=\"content.php\">Return to main page<a/>";
				}
}
?>
<?php require_once("includes/footer.php");?>
<?php //require_once("includes/close_conn.php");?>