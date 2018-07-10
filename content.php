
<?php
//require function gives an error that a functions is y/n
/*include is a simple html wont give you the errors*/
#comments section 
//refactoring means restructuring the code without changing its behaviour
?>

<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>

<?php	find_selected_page();?>
<?php include("includes/header.php");?>

	<table id="structure" > 
		<tr>
			<td id="navigation">
				<?php echo navigation ($sel_subject,$sel_page); ?>
					<br/>
					<a href="new_subject.php">+Add new subject </a>
					
			</td>	
			<td id="page">
				<?php if(!is_null($sel_subject)){ //subject selected ?>  
						<h2><?php echo $sel_subject['menu_name'];?></h2>
				<?php } elseif(!is_null($sel_page)){ //page selected ?>
						<h2><?php echo $sel_page['menu_name'];?></h2>
						<div class="page-content">
							<?php echo $sel_page['content'];?> </br></br></br>
							<a href="">Edit page</a>
						</div>
						
				<?php } else{ //nothing selected ?>
						<h2>Select a subject or page to edit</h2>	
						<br></br>
						<a href="fragment.php?s1=1">Display Subject from s1</a>&nbsp;&nbsp;
						<a href="fragment.php?s2=2">Display Subject from s2</a>
				
				<?php	}	?>
				<br/>
				
			</td>
				
		</tr>
			
	</table>
<?php require("includes/footer.php");   ?>						
