<?php
	require_once('header.php');
	//check if $POST is set or not 
	if (isset($_POST['submit'])) {
		$dirName = trim($_POST['dirName']);
		$path =  trim($_POST['path']);
		//check if $dirName and $Path are empty or not 
		if(!empty($dirName) && !empty($path)){
			if (0 === strpos($path, $pathOfMyApp)) {
				//check if $path is directory or not 
				if(is_dir($path)){
					//check if the $Path is writeable or not to know if we can create new file in it or not 
					if(is_writeable($path)){
						$fullPath = $path."/".$dirName;
						//check if directory aleardy exists or not 
						if(!file_exists($fullPath)){
							$dir = mkdir($fullPath); ?>				
							<h3 class='alert alert-success'>
								<span class="glyphicon glyphicon-ok"></span>
								The directory 							
								<strong>
									<?php echo $fullPath; ?>
								</strong>
								 is created 
							</h3>
							<?php 
							exit();
						}
						else{
							echo '<h3 class="alert alert-danger"><strong>'.$fullPath.'</strong> already exists</h3>';	
						}	
					}
					else{
						echo '<h3 class="alert alert-danger">Permissions denied to access <strong>'.$path.'</strong></h3>';
					}	
				}
				else{
					echo '<h3 class="alert alert-danger"><strong>'.$path.'</strong> is not a directory</h3>';
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
			echo '<h3 class="alert alert-danger">You must enter directory name and path.</h3>';
		}
	}
?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Create a directory</h3>
        </div>
        <div class="panel-body">
			<form method="post" action="create_dir.php" role="form">
				<div class="form-group">
			      <label>Directory Name:</label>
			      <input type="text" class="form-control" name="dirName" value="<?php if (!empty($dirName)) echo $dirName; ?>">
			    </div>
				<div class="form-group">
			      <label>Path:</label>
			      <input type="text" class="form-control" name="path" value="<?php if (!empty($path)) echo $path; ?>">
			    </div>
				<input type="submit" class="btn btn-info s submit" name="submit" value="Create">
			</form>
        </div>
    </div>
</div>