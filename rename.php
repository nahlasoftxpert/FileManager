<?php
	require_once('header.php');
	if(isset($_GET['name'])){
		if(!empty($_GET['name'])){
			$name = $_GET['name'];
			if (0 === strpos($name, $pathOfMyApp)) { ?>
			    <div class="panel panel-info">
			        <div class="panel-heading">
			            <h3 class="panel-title">Rename <?php echo $name; ?></h3>
			        </div>
			        <div class="panel-body">
						<form method="post" action="rename.php" role="form">
							<div class="form-group">
						      <label>New Name:</label>
						      <input type="text" class="form-control" name="newName" value="<?php if (!empty($newName)) echo $newName; ?>">
						    </div>
							<input type="hidden"  name="oldName" value="<?php echo $name;?>">
							<input type="submit" class="btn btn-info s submit" name="submit" value="Rename">
						</form>
			        </div>
			    </div>
			<?php }
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
			$oldName = trim($_POST['oldName']);
			$newName = trim($_POST['newName']);
			$fileName = end(explode("/", $oldName));
			$path = strstr($oldName,$fileName,true);
			if(!empty($oldName) && !empty($newName)){
				if(!file_exists($path.$newName)){
					if(@rename($oldName, $path.$newName)){ ?>
						<h3 class='alert alert-success'>
							<span class="glyphicon glyphicon-ok"></span>
							<strong>
								The <?php echo $oldName; ?>	
							</strong>
							is renamed to						
							<strong>
								<?php echo $path.$newName; ?>
							</strong>
						</h3>
					<?php }
					else{ ?>
						<h3 class="alert alert-danger">
							<span class='glyphicon glyphicon-warning-sign text-danger'></span>
							Sorry can't rename  
							<strong> 
								<?php echo $oldName; ?>
							</strong>
							check the permissions .
						</h3>
					<?php }
				}
				else{?>
					<h3 class="alert alert-danger">
						<span class='glyphicon glyphicon-warning-sign text-danger'></span>
						This name 
						<strong>
							<?php echo $path.$newName; ?>
						</strong> 
						already exists .
					</h3>			
				<?php }
			}
			else{ ?>
	    		<h3 class="alert alert-danger">
	    			<span class='glyphicon glyphicon-warning-sign text-danger'></span>
	    			You must enter the new name.
	    		</h3>
			<?php }

		}
	}


?>
</div>