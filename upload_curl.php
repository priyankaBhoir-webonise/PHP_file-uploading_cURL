<?php 
	//--------------- jpeg,jpg,png are only allow to upload-------------------------------------------
	
	function my_error_handler($errno,$errmsg,$errfile,$errline)				// user defined function for error handling
		{
			switch($errno){
			case E_USER_ERROR :
								echo "<br><hr>ERROR : [$errno] : $errmsg";
								die();
								break;
			case E_USER_NOTICE :
								echo "<br><hr>ERROR : [$errno] : $errmsg";
								break;
			 default :
								echo "<br><hr>ERROR : [unknown error type] : $errmsg";
								break;
			}
				
		}	
	function upload_file(){
			$allowed_types=array('image/jpeg','image/jpg','image/png');
			$tmp=$_FILES['file']['tmp_name'];
			$dst="/var/www/{$_POST['name']}";
			$newdst="/var/www/thumb_{$_POST['name']}";
				if(($_FILES['file']['error']<=0) and (in_array($_POST['type'],$allowed_types)))
					{			
							if (move_uploaded_file($tmp, $dst)) {
       	 							// Success !!
								$image = new Imagick($dst);
								if ($image->thumbnailImage(100,100)===true){
										echo '<br><hr>File is uploaded successfully. you can find the image at '.$dst;
										$image->writeImage($newdst);
										echo '<br>You can find the thumbnail image at '.$dst;
								}
    							 }			
					}
					else
					{
							if($_FILES['file']['error']==4){
									trigger_error('No file was uploaded',E_USER_NOTICE);				// using user defined trigger
									echo '<br />please upload the file :<a href=upload_file.php> back</a>';
							}
							else  if (!in_array($_POST['type'],$allowed_types)){
									throw new Exception(" : not specified type");		//using exception
															
							}
							else if($_FILES['file']['error']==1)
									trigger_error(' The uploaded file exceeds the max_filesize ',E_USER_NOTICE);		// using user defined trigger
							else if($_FILES['file']['error']==2)
									trigger_error(' The uploaded file exceeds the MAX_FILE_SIZE ',E_USER_NOTICE);		// using user defined trigger
							else if($_FILES['file']['error']==3)
									trigger_error(' File was partially uploaded ',E_USER_ERROR);		// using user defined trigger
						
					}
			
					
	
		}	
		$old_error_handler = set_error_handler("my_error_handler");			
		try{
				upload_file();
			}
			catch(Exception $e)
			{
					echo '<br><hr>Exception : '.$e->getMessage();
			}
?>
