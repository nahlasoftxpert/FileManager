<?php
	require_once('header.php');
	//check if $POST is set or not 
	if (isset($_POST['submit'])) {
		$fileName = trim($_POST['fileName']);
		$path =  trim($_POST['path']);
		//check if $fileName and $path are empty or not 
		if(!empty($fileName) && !empty($path)){
			if (0 === strpos($path, $pathOfMyApp)) {
				//check if $path is directory or not 
				if(is_dir($path)){
					//check if the $path is writeable or not to know if we can create new file in it or not 
					if(is_writeable($path)){
						$fullPath = $path."/".$fileName;
						//check if file aleardy exists or not 
						if(!file_exists($fullPath)){
							$file = fopen($fullPath, "w");
							header("Location: edit.php?filePath=$fullPath");
							fclose($file);
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
			echo '<h3 class="alert alert-danger">You must enter file name and path.</h3>';
		}
	}
?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Create a file</h3>
        </div>
        <div class="panel-body">
			<form method="post" action="create_file.php" role="form">
				<div class="form-group">
			      <label>File Name:</label>
			      <input type="text" class="form-control" name="fileName" value="<?php if (!empty($fileName)) echo $fileName; ?>">
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