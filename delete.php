<?php
	require_once('header.php');
	if(isset($_GET['name'])){
		if(!empty($_GET['name'])){
			$name = $_GET['name'];
			if (0 === strpos($name, $pathOfMyApp)) {
				//check if the $name is directory or file
				if(is_file($name)){
					//check if the file can be deleted or not
					if(@unlink($name)){ ?> 
						<h3 class='alert alert-success'>
							<span class="glyphicon glyphicon-ok"></span>
							<strong>
								<?php echo $name;?>
							</strong>
							is deleted .
						</h3>
					<?php }else{ ?>
						<h3 class="alert alert-danger">
							<span class='glyphicon glyphicon-warning-sign text-danger'></span>
			        		Sorry can't delete 
			        		<strong>
			        			<?php echo $name;?>
			        		</strong>
			        		check the permissions . 
			       		</h3	
					<?php }
				//the $name is directory
				}
				else{
					//check if the directory can be deleted or not
					if(is_executable($name)){
						//check if the directory is empty or not
						if(count(scandir($name)) == 2){
							rmdir($name); ?>
								<h3 class='alert alert-success'>
									<span class="glyphicon glyphicon-ok"></span>
									<strong>
										<?php echo $name;?>
									</strong>
									is deleted .
								</h3>
						<?php }
						else{ ?>
						    <div class="panel panel-info">
						        <div class="panel-heading">
						            <h3 class="panel-title">Confirmation to delete</h3>
						        </div>
						        <div class="panel-body">
									<form method="post" action="delete.php" role="form">
										<div>
											<h3 class="text-danger">
												<strong><?php echo $name; ?></strong></strong> is non empty directory .<br> 
												Are you sure you want to delete it ? 
											</h3>
										</div>
										<div class="form-group">
									      <input type="radio" name="confirm" value="Yes" /> Yes
									    </div>
										<div class="form-group">
									    	<input type="radio" name="confirm" value="No" checked="checked" /> No
									    	<input type="hidden" name="name" value=<?php echo $name; ?>/>
									    </div>
										<input type="submit" class="btn btn-info s submit" name="submit" value="Delete">
									</form>
						        </div>
						  	</div>
						<?php }
					}
					else{?>
						<h3 class="alert alert-danger">
		                    <span class='glyphicon glyphicon-warning-sign text-danger'></span> Sorry can't dalete
		                    <strong> 
		                        <?php echo $name; ?>
		                    </strong>
		                    check the permissions . 
		                </h3>
					<?php }
				}
			}
			else{ ?>
			 	<h3 class="alert alert-danger">
                    <span class='glyphicon glyphicon-warning-sign text-danger'></span>
                    The root directory is <strong><?php echo $pathOfMyApp; ?> </strong>
                </h3>
			<?php }		
		}
		else{ ?>
	 		<h3 class="alert alert-danger">
	        	No file or folder to delete . 
	       	</h3
		<?php }
	}
	else{
		if (isset($_POST['submit'])) {
			$dir = $_POST['name'];
			if ($_POST['confirm'] == 'Yes') {
				del($dir);
			}
			else{ ?>
				<h3 class="alert alert-danger">
					<span class='glyphicon glyphicon-warning-sign text-danger'></span>
		            <strong> 
		                <?php echo $dir; ?>
		            </strong>
		            was not deleted . 
	        	</h3>
			<?php }

		}
	}
	//function to delete the non empty directory
	function del($dir)
	{
		if(is_executable($dir) && is_dir($dir)){
			$result=array_diff(scandir($dir),array('.','..'));
			foreach($result as $item)
			{
				if(is_file($dir.'/'.$item)){
					if(@unlink($dir.'/'.$item)){ ?> 
						<h3 class='alert alert-success'>
							<span class="glyphicon glyphicon-ok"></span>
							<strong>
								<?php echo $dir.'/'.$item;?>
							</strong>
							is deleted .
						</h3>
					<?php }else{ ?>
						<h3 class="alert alert-danger">
							<span class='glyphicon glyphicon-warning-sign text-danger'></span>
			        		Sorry can't delete 
			        		<strong>
			        			<?php echo $dir.'/'.$item;?>
			        		</strong>
			        		check the permissions . 
			       		</h3>	
					<?php }
				}
				else{
					if(is_executable($dir.'/'.$item)){
						if(count(@scandir($dir.'/'.$item)) == 2){
							if(@rmdir($dir.'/'.$item)){ ?>
								<h3 class='alert alert-success'>
									<span class="glyphicon glyphicon-ok"></span>
									<strong>
										<?php echo $dir.'/'.$item;?>
									</strong>
									is deleted .
								</h3>
							<?php }
							else{ ?>
								<h3 class="alert alert-danger">
									<span class='glyphicon glyphicon-warning-sign text-danger'></span>
					        		Sorry can't delete 
					        		<strong>
					        			<?php echo $dir.'/'.$item;?>
					        		</strong>
					        		check the permissions . 
					       		</h3>
							<?php }
						}
						else{
							del($dir.'/'.$item);
						}	
					} 
					else{?>
						<h3 class="alert alert-danger">
							<span class='glyphicon glyphicon-warning-sign text-danger'></span>
			        		Sorry can't delete 
			        		<strong>
			        			<?php echo $dir.'/'.$item;?>
			        		</strong>
			        		check the permissions . 
			       		</h3>	

					<?php }

				}
			}
			@rmdir($dir);
		}
		else{ ?>
			<h3 class="alert alert-danger">
                <span class='glyphicon glyphicon-warning-sign text-danger'></span> Sorry can't dalete
                <strong> 
                    <?php echo $dir; ?>
                </strong>
                check the permissions . 
            </h3>
		<?php }
	}
	echo "</div>"
?>	
