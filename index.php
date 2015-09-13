<?php
    require_once('header.php');
    if(!empty($_GET['dirName'])){
        $currentWorkingDirectory = $_GET['dirName'];
        if(is_dir($currentWorkingDirectory) == true){ 
            if (0 === strpos($currentWorkingDirectory, $pathOfMyApp)) {
                if(is_executable($currentWorkingDirectory)){
                    require_once('list.php');
                }
                else{ ?> 
                    <h3 class="alert alert-danger">
                        <span class='glyphicon glyphicon-warning-sign text-danger'></span> Permission denied to access 
                        <strong> 
                            <?php echo $currentWorkingDirectory; ?>
                        </strong>
                    </h3>
               <?php }   
            }
            else{?>
                <h3 class="alert alert-danger">
                    <span class='glyphicon glyphicon-warning-sign text-danger'></span>
                    The root directory is <strong><?php echo $pathOfMyApp ?> </strong>
                </h3>

            <?php }
        }//end of if is_dir
        else{ ?>
            <h3 class="alert alert-danger">
                 <strong><?php echo $currentWorkingDirectory; ?> </strong> isn't a Directory
            </h3>
        <?php }//end of else is_dir
    }//end of if $_GET['Dire_Name'] is empty or not
    else{ 
        if($_SERVER['REQUEST_URI'] == "/FileManager/index.php" || $_SERVER['REQUEST_URI'] == "/FileManager/" ){
            $currentWorkingDirectory = $pathOfMyApp;
            require_once('list.php');
        }//end of if url = /localhost/FileManager/index.php or not 
        else{ ?>
            <h3 class="alert alert-danger">
                No Directory!
            </h3>
        <?php } //end of else in case of $_GET['Dire_Name'] is empty and url isn't /localhost/FileManager/index.php
    }//end of else $_GET['Dire_Name'] is empty or not
    echo "</div>";
?>


