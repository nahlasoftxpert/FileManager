<?php
  require_once('header.php');
  // Define application constants
  define('MM_MAXFILESIZE', 1048576);      // 1 MB
  if (isset($_POST['submit'])) {
  	    $fileName = trim($_FILES['fileName']['name']);
	    $fileName_size = $_FILES['fileName']['size']; 	
		$destination =  trim($_POST['destination']);
		if(!empty($fileName) && !empty($destination)){
			if (0 === strpos($destination,$pathOfMyApp)) {
				if(is_dir($destination)){
					if(($fileName_size > 0) && ($fileName_size <= MM_MAXFILESIZE)){
						$target = $destination."/". $_FILES['fileName']['name'];
						if (@move_uploaded_file($_FILES['fileName']['tmp_name'], $target)) {?>
							<h3 class='alert alert-success'>
								<span class="glyphicon glyphicon-ok"></span>
								<strong>
									<?php echo $fileName; ?>
								</strong>  
								is uploaded .
							</h3>

						<?php exit(); }

						else{ ?>
							<h3 class="alert alert-danger">
								<span class='glyphicon glyphicon-warning-sign text-danger'></span>
								Sorry can't move  
								<strong> 
									<?php echo $fileName; ?> 
								</strong>
								to
								<strong>
									<?php echo $destination; ?>
								</strong>
								check the permissions and of 
								<strong> 
									<?php echo $destination." ."; ?>
								</strong>
							</h3>
						<?php }
					}
					else{
						echo '<h3 class="alert alert-danger">Your file must be less than 1MB .</h3>';
					}
				}
				else{
					echo '<h3 class="alert alert-danger"><strong>'.$destination.'</strong> is not a directory</h3>';
				}
			}
			else{ ?>
			 	<h3 class="alert alert-danger">
                    <span class='glyphicon glyphicon-warning-sign text-danger'></span>
                    The root directory is <strong><?php echo $pathOfMyApp; ?> </strong>
                </h3>
			<?php } 		
		}
		else{
			echo '<h3 class="alert alert-danger">You must choose a file name and enter the destination.</h3>';
		}
  }
?>
    <div class="panel panel-info">
	    <div class="panel-heading">
	        <h3 class="panel-title">Upload a file</h3>
	    </div>
	    <div class="panel-body">
			<form enctype="multipart/form-data" method="post" action="upload_file.php" role="form">
				<div class="form-group">
			      <label>File Name:</label>
			      <input type="file" class="form-control" accept="/home/sx-dev112/myapp/" name="fileName" value="<?php if (!empty($fileName)) echo $fileName; ?>">
			    </div>
				<div class="form-group">
			      <label>Destination:</label>
			      <input type="text" class="form-control" name="destination" value="<?php if (!empty($destination)) echo $destination; ?>">
			    </div>
				<input type="submit" class="btn btn-info s submit" name="submit" value="Upload">
			</form>
	    </div>
	</div>

<?php
	echo "</div>";
?>	