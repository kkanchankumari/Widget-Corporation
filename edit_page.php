<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
//when clicked on edit page
	
	if(intval($_GET['page']==0)){
		redirect_to("content.php");
	}
?>

 <?php find_selected_page(); //to get fresh updated page after submiting to db ?>  
  <?php include("includes/header.php");?>
	<table id="structure" > 
		<tr>
			<td id="navigation">
			 	<?php echo navigation ($sel_subject,$sel_page); ?>
			</td>
			
			<td id="page">
			<h2>EDIT PAGE:<?php echo $sel_page['menu_name']; ?></h2>
			
			
			<form action="edit_page.php?page=<?php echo urlencode($sel_page['id']);?> " method="post">
				<p>Page name:
				<input type="text" name="menu_name" value="<?php echo $sel_page['menu_name'];?>" id="menu_name"/>
				</p>
				<p>Position:
					<select name="position">
					<?php 
						$page_set = get_pages_for_subjects($_GET['page']);  
						
						$page_count = mysqli_num_rows($page_set);
						//$page+1 we are adding pages
						for($count=1;$count<=$page_count+1;$count++){
							echo "<option value=\"{$count}\" ";
							if($sel_page['position']==$count){
								echo" selected";
							}
							echo">{$count}</option>";
						}
					?>
					</select>

				</p>
				<p>Visible:
					<input type="radio" name="visible" value="0" <?php if($sel_page['visible']==0) 
					{echo " checked";}
					?>/>No
					&nbsp;
					<input type="radio" name="visible" value="1" <?php if($sel_page['visible']==1) 
					{echo " checked";}
					?> />Yes
				</p>
				<p>Content:
				<textarea><?php global $page_id; $query="SELECT content
										FROM pages 
										WHERE id={$page_id} ";						
									$page_set= mysqli_query($conn,$query);
									confirm_query($page_set);
									echo $page_set; ?>
				</textarea >
				</p>
				
				<a href="edit_page.php?page=<?php echo urlencode($sel_page['id']);?>" >Edit Page</a>
				&nbsp; &nbsp;
				<a href="delete_sub.php?subj=<?php echo urlencode($sel_subject['id']);?>" onclick="return confirm('Are you sure?')">Delete Page</a>
				
			</form></br>
			<a href="content.php">Cancel</a>

<?php require_once("includes/close_conn.php");?>