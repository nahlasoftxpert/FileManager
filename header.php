<html>
    <head>
        <title>
            File Manager
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <style type="text/css">
          .content{
            margin: 20px;
          }
      </style>
    </head>

    <body>
       <ul class="nav nav-tabs">
          <li role="presentation" <?=echoActiveClassIfRequestMatches("index")?> ><a href="index.php"><span class="glyphicon glyphicon-list"></span> List Content</a></li>
          <li role="presentation" <?=echoActiveClassIfRequestMatches("create_file")?> ><a href="create_file.php"><span class="glyphicon glyphicon-file"></span> Create File</a></li>
          <li role="presentation" <?=echoActiveClassIfRequestMatches("create_dir")?> ><a href="create_dir.php"><span class="glyphicon glyphicon-folder-open"></span>   Create Folder</a></li>
          <li role="presentation" <?=echoActiveClassIfRequestMatches("upload_file")?>  ><a href="upload_file.php"><span class="glyphicon glyphicon-cloud-upload"></span>  Upload File</a></li>
        </ul>
    </body>
</html>		                
<?php 
require_once('appvars.php');
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    if ($current_file_name == $requestUri)
        echo 'class="active"';
}
?>
<div class='content'>
  <div class="page-header">
    <h2 class="text-info">The root directory is <strong><?php echo $pathOfMyApp;?></strong></h2>      
</div>

