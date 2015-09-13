<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">
			Location : <?php echo $currentWorkingDirectory ?>
		</h3>
	</div>
	<div class="panel-body">
		<?php
		    if ($handle = opendir($currentWorkingDirectory)) { 
		    	//check if directory is empty or not (count of scandir = 2 (. and ..))
		    	if(count(scandir($currentWorkingDirectory)) == 2){
		    		echo '<h3 class="alert alert-danger"><strong>'.$currentWorkingDirectory.'</strong> is empty</h3>';
		    	}
		    	else { ?>
			        <table class="table table-hover">
			            <thead>
			              <tr>
			                <th class="text-center">Name</th>
			                <th class="text-center">Type</th>
			                <th class="text-center">Size</th>
			                <th class="text-center">Modification Time</th>
			                <th class="text-center">Actions</th>
			              </tr>
			            </thead>
			            <tbody>
						<?php
					    /* This is the correct way to loop over the directory. */
					    while (false !== ($entry = readdir($handle))) {
					        //skip . and ..
					        if ($entry != "." && $entry != "..") { ?>
					        <tr>
					            <td class="text-center"><?php echo "$entry"."<br>";?></td>
					            <td class="text-center">
					            	<?php
					            		 //chech if file or not	
					            		 if(is_file($currentWorkingDirectory."/".$entry)){
					            		 	//check if the file readable or not to check its type
					            		 	if(is_readable($currentWorkingDirectory."/".$entry)){ 
						            		 	echo mime_content_type($currentWorkingDirectory."/".$entry);
					            		 	}else{
					            		 		echo "<span class='glyphicon glyphicon-warning-sign text-danger'></span>";
					            		 	}
					            		 }
					            		 else{
					            		 	echo "directory";
					            		 } ?>
			            		 
					            </td>
					            <td class="text-center"><?php echo filesize($currentWorkingDirectory."/".$entry)." Bytes";?></td>
					            <td class="text-center"><?php echo  @date ("F d Y H:i:s.", filemtime($currentWorkingDirectory."/".$entry));?></td>
					            <td class="text-center">
					            	<?php 
					            		//check if dir or not to show the list icon or not
					            		if(is_dir($currentWorkingDirectory."/".$entry) == true ){ ?>
					            			<a href="<?php echo "index.php?dirName=".$currentWorkingDirectory."/".$entry;?>">
					                    		<span class="glyphicon glyphicon-list"></span>
					                    	</a>
					           		<?php	}
					                	else{ ?> 
				            				<a href="<?php echo "edit.php?filePath=".$currentWorkingDirectory."/".$entry;?>">
				                    			<span class="glyphicon glyphicon-pencil"></span>
				                			</a>
				                			<a href="<?php echo "move_file.php?filePath=".$currentWorkingDirectory."/".$entry;?>">  
				                				<span class="glyphicon glyphicon-transfer"></span>
				                			</a> 			
					                	 <?php } ?>
					                	<a href="<?php echo "delete.php?name=".$currentWorkingDirectory."/".$entry;?>">
					                		<span class="glyphicon glyphicon-trash"></span>
					                	</a>	
					                	<a href="<?php echo "rename.php?name=".$currentWorkingDirectory."/".$entry;?>">
					                		<span class="glyphicon glyphicon-registration-mark"></span>
					                	</a>
					            </td>
			        		</tr>
			        		<?php } //end of if to skip . and ..
			    		}//end of while loop for listing the content
			    	closedir($handle);
				}?>
            			</tbody>
       				</table>
       		<?php } ?>
	</div>
</div>
