<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	if(intval($_GET['subj']==0)){
			redirect_to("content.php");
	}
	
	$id=mysql_prep($_GET['subj']);//basically get the id
	echo "<p>The subject deletion failed.</p>";
	if($subject= get_subject_by_id($id)){
	
		$query= "DELETE FROM subjects where id={$id} LIMIT 1";
		$result=mysqli_query($conn,$query);
				
				if(mysqli_affected_rows($conn)==1){//success query
					redirect_to("content.php");
				}else{
					//Deletion failed
					echo "<p>The subject deletion failed.</p>";
					echo "<p>".mysqli_error()."</p>";
					echo "<a href=\"content.php\">Return to main page<a/>";
				}

				
	}else{
		//subject didn't exist
		redirect_to("content.php");
	}
?>	
	
<?php require_once("includes/close_conn.php");?>


