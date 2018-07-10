<?php //require("connection.php");?>

<?php
	
	function display_error(){
		if(!empty($errors)){
					echo "<p class=\"errors\">";
					echo "Please review the following fields: <br/>";
					foreach($errors as $error){
						echo "-".$error."<br/>";
					}
				echo "</p>";
				}
	}
	
	//to handle special char
	function mysql_prep($value){
		$magic_quotes_active=get_magic_quotes_gpc();
		$new_enough_php=function_exists("mysql_real_escape_string");
		
		if($new_enough_php){//php v4.3.0 or higher
			if($magic_quotes_active){
			$value=stripslashes($value);
			}
			$value=mysql_real_escape_string($value);
		}else{	
			if(!$magic_quotes_active){
			$value= addslashes($value);
			}
		}
	return $value;
}  	
	
	function redirect_to($loc=NULL){ //robust
		if(loc != NULL){
		header("location: {$loc}");
		exit;
	   }
	}
	
	function confirm_query($result_set){
		global $conn;
		if(!$result_set){
			die("Database query failed:".mysqli_error($conn));
		}	
	}		

	function get_all_subjects(){
		global $conn;
		$query="SELECT *
				FROM subjects
				ORDER BY position ASC";
		$subject_set= mysqli_query($conn,$query);
		confirm_query($subject_set);
		return $subject_set;
	}

	function get_pages_for_subjects($subject_id){
		global $conn;
		$query="SELECT *
			FROM pages 
			WHERE subject_id={$subject_id} 
			ORDER BY position ASC";						
		$page_set= mysqli_query($conn,$query);
		confirm_query($page_set);
		return $page_set;
	}
	
	function get_subject_by_id($subject_id){
		global $conn;
		$query="SELECT * ";
		$query.="FROM subjects ";
		$query.="WHERE id=" . $subject_id;
		$query.=" LIMIT 1"; //gives only one value if there are many values
		$result_set= mysqli_query($conn,$query);
		confirm_query($result_set);
		//REMEMBER if no rows are returned,fetch array will return false 
		if($subject= mysqli_fetch_array($result_set)){
			return $subject;	//true then return
		}else{
			return NULL;
		}
	}		
	
	function get_page_by_id($page_id){
		global $conn;
		$query="SELECT * ";
		$query.="FROM pages ";
		$query.="WHERE id=" . $page_id;
		$query.=" LIMIT 1"; //gives only one value if there are many values
		$result_set= mysqli_query($conn,$query);
		confirm_query($result_set);
		//REMEMBER if no rows are returned,fetch array will return false 
		if($page= mysqli_fetch_array($result_set)){
			return $page;	//true then return
		}else{
			return NULL;
		}
	}		
	
	function find_selected_page(){
		global $sel_subject;
		global $sel_page;
		
		if(isset($_GET['subj'])){
			//$sel_subj=$_GET['subj'];	//get subject id & store
			$sel_subject= get_subject_by_id($_GET['subj']);
			//$sel_pg= 0;
			$sel_page=NULL;
		}else if(isset($_GET['page'])){
			//$sel_subj= 0;
			$sel_subject= NULL;
			//$sel_page=$_GET['page'];	//get page id & store
			$sel_page= get_page_by_id($_GET['page']);
		}else{
			//$sel_page=0;
			//$sel_subj=0;
			$sel_subject=NULL;
			$sel_page=NULL;
		}
	
	}
	
	function navigation($sel_subject,$sel_page){
		$output= "<ul class='subjects'>";
		//3.perform database query
		$subject_set=get_all_subjects();
		
		//4.use returned data
		while($subject= mysqli_fetch_array($subject_set)){
			$output.= "<li";
			if($subject["id"]== $sel_subject['id']){
				$output.= " class=\"selected\"";
			}
			$output.= "><a href=\"edit_subject.php?subj=" .urlencode($subject["id"]) ."\">{$subject["menu_name"]}</a></li>";
			//$subject_id = $subject["id"];
			
			$page_set=get_pages_for_subjects($subject["id"]);
			$output.= "<ul class=\"pages\">";
			while($page= mysqli_fetch_array($page_set)){
			$output.= "<li";
			if($page["id"]== $sel_page['id']){
				$output.= " class=\"selected\"";
			}
			$output.="><a href=\"content.php?page=" .urlencode($page["id"]) ."\">{$page["menu_name"]}</a></li>";
			} 
			$output.= "</ul>";
		}	
			$output.= "</ul>";
		return $output;
	}
	
?>