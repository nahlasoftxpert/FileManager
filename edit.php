<?php 
    require_once('header.php');
    //check if $_GET['filePath'] is empty or not
    if(!empty($_GET['filePath'])){
        $filePath = $_GET['filePath'];
        if (0 === strpos($filePath, $pathOfMyApp)) {
	        if(is_file($filePath) == true){ 
	        	//check if the file can be readable and writeable or not to know if the file can be edited or not
				if(is_readable($filePath) && is_writable($filePath)){ ?>
				    <div class="panel panel-info">
				        <div class="panel-heading">
				            <h3 class="panel-title">The Content of <strong> <?php echo $filePath; ?> </strong> is :</h3>
				        </div>
				        <div class="panel-body">
							<form method="post" action="edit.php">
				                <textarea class="form-control"  rows="30" name="content">
				                <?php
				                    //read the file 
				                    $lines = file($filePath);
				                    // Loop through our array, show HTML source as HTML source
				                    foreach ($lines as $line_num => $line) { 
				                        echo htmlspecialchars($line); 
				                    }//end or for for reading file ?>
				                </textarea>
				                <br>
				                <input type="hidden" name="fileName" value="<?php echo $filePath; ?>">
								<input type="submit" class="btn btn-info s submit" name="submit" value="Edit">
				            </form>
				        </div>
				    </div>
				<?php }
				else{ ?>
					<h3 class="alert alert-danger">
						<span class='glyphicon glyphicon-warning-sign text-danger'></span>
						Sorry can't read  
						<strong> 
							<?php echo $filePath; ?>
						</strong>
						check the permissions and the type of 
						<strong> 
							<?php echo $filePath." ."; ?>
						</strong>
					</h3>
				<?php }
	        	?> 

	        <?php }//end of if is_file or not
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
    }//end of if $_GET['filePath'] is empty or not
    else{ 
    	if(!empty($_POST['submit']) && !empty($_POST['fileName'])){
    		$content = $_POST['content'];
    		$fileName = $_POST['fileName'];
    		$file = fopen($fileName, "w");
    		fwrite($file, $content);
			fclose($file); ?>
			<h3 class='alert alert-success'>
				<span class="glyphicon glyphicon-ok"></span>
				<strong>
					<?php echo $fileName; ?>
				</strong>  
				is edited .
			</h3>
    	<?php }else{ ?>
    	    <h3 class="alert alert-danger">
            	No File!
       		</h3>
    	<?php }
    }//end of else $_GET['filePath'] is empty or not
    echo "</div>";
?>
