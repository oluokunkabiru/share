<?php
ini_set('post_max_size', '900000000000M');
ini_set('upload_max_filesize', '9000000000000M');
if($_SERVER['REQUEST_METHOD']=="POST"){
$target_dir = "uploads/";
if(!is_dir($target_dir)){
  mkdir(($target_dir));
}
for($i =0; $i < count($_FILES['file']['name']); $i++){
$target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

   
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}
// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
        echo '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success !</strong> Your file '.($i+1).' <strong>'.$_FILES["file"]["name"][$i].'</strong>  uploaded successfully.
      </div>';
      echo '<script>
      setInterval(function(){
        window.location.assign("index.php");
      }, 1000);
      </script>';
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
}


if(isset($_GET['q'])){
  $q = $_GET['q'];

$hint = "";
$dir ="uploads/";
$files = scandir($dir);
// lookup all hints from array if $q is different from ""
if ($q !== "") {
    // $q = strtolower($q);
    $len=strlen($q);
    foreach($files as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
$file = explode(", ", $hint);
foreach($file as $filename){
    echo $filename == "" ? "No such files exist" : '<a href="'.$dir.$filename.'" class="btn btn-dark m-2" download>'.$filename.'</a>';

}
  
}
