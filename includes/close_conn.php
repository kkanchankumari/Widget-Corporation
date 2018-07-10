<?php

function close_conn(){
		if(isset($conn)){
		mysqli_close($conn);
		}
	}
	
?>	