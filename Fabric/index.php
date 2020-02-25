<?php

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "test";
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


//insertion

session_start();

if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{
	if(isset($_FILES["flPage"]) && $_FILES["flPage"]['name'] != "")
	{
	    $_IMAGE_ALLOWED_TYPES = array('jpg','jpeg');
		ini_set('memory_limit', '-1');
		// $temp = explode(".", $_FILES["flPage"]["tmp_name"]);
		// $temp2 = explode(".", $_FILES["flPage"]["name"]);
		// $ext=strtolower($temp2[sizeof($temp2)-1]);

		// $temp2=$temp2[0].'.'.$temp2[1];


	$fileName = $_FILES['flPage']['name'];
    $fileSize = $_FILES['flPage']['size'];
    $fileTmpName  = $_FILES['flPage']['tmp_name'];
    $fileType = $_FILES['flPage']['type'];

	$temp2 = explode(".", $fileName);
    $fileExtension = strtolower($temp2[sizeof($temp2)-1]);

		$temp2=$temp2[0].'.'.$temp2[1];

    $uploadPath = "img/designs/". $temp2; 


        if (! in_array($fileExtension,$_IMAGE_ALLOWED_TYPES)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG file";
           
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . ".";
            }
             exit();
        }

        $page = $_SERVER['PHP_SELF'];
		$sec = "0.01";
		
		
        	$temp3 = $temp2;
			$expire = time()+(60*60*24*30);          
			setcookie('pattern', $temp3, $expire);

	}	
}

?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Printex</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
	<script type="text/javascript" src="js/fabric.js"></script>
	<script type="text/javascript" src="js/caseEditor.js"></script>
	<script type="text/javascript" src="js/jquery.miniColors.min.js"></script>
	
    <!--styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

	 <style type="text/css">
	    body {
	      padding-top: 60px;
/*	      background-color: #000000;	        */
	    }
	    .color-preview {
	      border: 1px solid #CCC;
	      margin: 2px;
	      zoom: 1;
	      vertical-align: top;
	      display: inline-block;
	      cursor: pointer;
	      overflow: hidden;
	      width: 20px;
	      height: 20px;
	    }
		button#add-text {
		  display: none;
		}
		form.frm-stl {
		    text-align: center;
		}
	 </style>
  </head>
  <body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
    <div class="container">
		<section id="typography">
		  <!-- Headings & Paragraph Copy -->
		  <div class="row">			
			<div class="span3">		    	
		    	<div class="tabbable"> 
				  <div class="tab-content">			   
				    <div class="tab-pane active" id="tab2">
				    	<div class="well" style="height:400px;">
				    		<div class="input-append">
							  <!-- <input class="span2" id="text-string" type="text" placeholder="add text here..."> -->
							  <button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
							  <!-- <button class="btn btn-primary">Upload</button> -->
							</div>
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/1.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/2.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/3.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/4.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/5.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/6.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/7.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/8.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/9.png">
							<img style="cursor:pointer;width:90px;height:120px;" class="img-shrt" src="img/10.png">
				    	</div>				      
				    </div>
				  </div>
				</div>				
		    </div>
		    <div class="span6">		   			  		
				<!--	EDITOR      -->	
				<div style="background-color: #ffffff; top:20px;">				
					<div id="phoneDiv" class="page" style="width: 282px; position: relative;left:25%; background-color: rgb(255, 255, 255);">
						<img id="shrt" src="img/2.png"/>
					</div>		
				</div>					
				<form class="frm-stl" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
					<input type="file" name="flPage" />
					<input type="hidden" name="action" value="submit_form" required=""/>
					<button type="submit" id="sbmt-btn">Upload</button>
				</form> 	

				<?php 
							if(isset($_COOKIE['pattern'])){
								// print_r($_COOKIE['pattern']);
							$temp3 = $_COOKIE['pattern'];
				// 			echo $temp3;
							}
							else{
								// echo "Cokiee not set ";
							}
						
				?>
		    </div>		
		  </div>		
		</section>
    </div>   
    <script src="js/bootstrap.min.js"></script>  


<script>
$( document ).ready(function() {
    console.log( "ready!" );
	  		// var el = e.target;	  
	  		// var design = $(this).attr("src");
	  		$('#phoneDiv').css({	
				'backgroundImage': 'url(img/designs/<?= $temp3 ?>)',
				'backgroundRepeat': 'repeat',
				'backgroundPosition': 'left center',
			});
});
 </script>

// <?php
// $conn->close();
// ?> 
  </body>
</html>