<?php 
    require_once('header.php');
    if(!empty($_GET['filePath'])){
    	$filePath = $_GET['filePath'];
    	if (0 === strpos($filePath, $pathOfMyApp)) {
	        if(is_file($filePath) == true){ 
	        	if(is_readable($filePath)){ ?>
	        	    <div class="panel panel-info">
				        <div class="panel-heading">
				            <h3 class="panel-title">Move a file</h3>
				        </div>
				        <div class="panel-body">
							<form method="post" action="move_file.php" role="form">
								<div class="form-group">
							      <label>Destination to move <strong><?php echo $filePath;?></strong> to it :</label>
							      <input type="text" class="form-control" name="destination" value="<?php if (!empty($destination)) echo $destination; ?>">
							    </div>
							    <input type="hidden" name="filePath" value="<?php echo $filePath; ?>">
								<input type="submit" class="btn btn-info s submit" name="submit" value="Move">
							</form>
				        </div>
				    </div>
	        	<?php }
				else{ ?>
					<h3 class="alert alert-danger">
						<span class='glyphicon glyphicon-warning-sign text-danger'></span>
						Sorry can't move  
						<strong> 
							<?php echo $filePath; ?>
						</strong>
						check the permissions of 
						<strong> 
							<?php echo $filePath." ."; ?>
						</strong>

					</h3>
				<?php }        
	        }//end of if is_file or not
	        else{ ?>
	            <h3 class="alert alert-danger">
	                 <?php echo $filePath." isn't a file";?>
	            </h3>
	        <?php }//end of else is_file or not
	    }
	    else{ ?>
		 	<h3 class="alert alert-danger">
                <span class='glyphicon glyphicon-warning-sign text-danger'></span>
                The root directory is <strong><?php echo $pathOfMyApp; ?> </strong>
            </h3>
		<?php }    
    }
    else{
    	if (!empty($_POST['submit'])) {
	    	$destination = trim($_POST['destination']);
	    	$filePath = trim($_POST['filePath']);
			if(!empty($destination) && !empty($filePath)) {
	    		if(is_dir($destination)){
	    			//get file name 
	    			$fileName = end(explode("/", $filePath));
	    			if(!file_exists($destination."/".$fileName)){
	    				//get the path of the file to check the permission of it
	    				$path = strstr($filePath,$fileName,true);
	    				if(is_executable($destination) && is_executable($path)){
	    					if(@copy($filePath,$destination."/".$fileName) && @@unlink($filePath)){ ?>
	    						<h3 class='alert alert-success'>
	    							<span class="glyphicon glyphicon-ok"></span>
									<strong>
										<?php echo $fileName; ?>
									</strong>  
									is moved to 
									<strong>
										<?php echo $destination;?>
									</strong>
								</h3>
						    <?php }
						    else{ ?>
								<h3 class="alert alert-danger">
									<span class='glyphicon glyphicon-warning-sign text-danger'></span>
									Sorry can't move  
									<strong> 
										<?php echo $fileName; ?>
									</strong>
									check the permissions of 
									<strong> 
										<?php echo $destination." ."; ?>
									</strong>
								</h3>
						    <?php }	
	    				}
	    				else{ ?>
							<h3 class="alert alert-danger">
								<span class='glyphicon glyphicon-warning-sign text-danger'></span>
								Sorry can't move  
								<strong> 
									<?php echo $fileName; ?>
								</strong>
								check the permissions of 
								<strong> 
									<?php echo $destination." ."; ?>
								</strong>
							</h3>
	    				<?php }
	    			}
	    			else{ ?> 
	    			    <h3 class="alert alert-danger">
	    			    	<span class='glyphicon glyphicon-warning-sign text-danger'></span>
			                There is a file in 
			                <strong>
			                 	<?php echo $destination; ?>
			                </strong>
			                 	with the name 
			                <strong>
			                	<?php echo $fileName;?>
			                </strong> 	
			            </h3>
	    			<?php }
	    		}
	    		else{
					echo '<h3 class="alert alert-danger"><strong>'.$destination.'</strong> is not a directory</h3>';
	    		}
	    	}
	    	else{
	    		echo '<h3 class="alert alert-danger">You must enter the destination.</h3>';
	    	}
	    }
	    else{ ?>
		    <h3 class="alert alert-danger">
	        	No File!
	   		</h3>
	    <?php }	
	}       
    echo "</div>"
?>    