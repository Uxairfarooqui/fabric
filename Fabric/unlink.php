<?php    
	$folder_path = "img/designs/"; 
	$files = glob($folder_path.'/*');  	   
	foreach($files as $file) { 
	   	if(is_file($file))  
	        unlink($file);  
	} 

?>