<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
//after subject form you validate the contents
$errors =array();

$required_fields= array('menu_name','position','visible');
	foreach($required_fields as $fieldname){ 
	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
		$errors[]=$fieldname;
	}
}

$fields_with_lengths =array('menu_name'=>30);
foreach($fields_with_lengths as $fieldname=>$maxlength){
	if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
		$errors[]=$fieldname;
	}
}	

if(!empty($errors)){
	redirect_to("new_subject.php");
}

?>

<?php 
	$menu_name=mysql_prep($_POST['menu_name']); //menuname=subjname 
	$position=mysql_prep($_POST['position']);
	$visible=mysql_prep($_POST['visible']); 
?> 
<?php
	$query= "INSERT INTO subjects(menu_name,position,visible)VALUES('{$menu_name}',{$position},{$visible})"; 
	$result=mysqli_query($conn,$query);
	if($result){
		//query successful
		header("Location:content.php"); 
	}else{
		//error msg
		echo"<p>Subject creation failed</p>";
		echo"<p>".mysql_error()."</p>";  
		}
?>

<?php require_once("includes/close_conn.php");?>
