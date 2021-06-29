<?php
$name=$_POST['description'];


$supported_extension=array('jpg','jpeg','png','gif','ico');
$target_dir = "uploads/";
$uploadOk = 0;

//Playing with Image Name start
$tmpName=$_FILES["image"]["tmp_name"];
$baseName=basename($_FILES["image"]["name"]);
$fileBreak=explode('.',$baseName);
$extension=$fileBreak[1];
$newName=uniqid().'.'.$extension;
$target_file = $target_dir.$newName;
//Playing with Image Name ends

//Checking File type is valid or not
if(in_array($extension,$supported_extension)){
   //getimagesize returns array and carrying image height, width, mime type, channels, 
   //This check is not optional and unnecessary here
   $check = getimagesize($tmpName);
   if($check !== false)  {
      //Uploading processed file in server
      $uploadResult=move_uploaded_file($tmpName, $target_file);
      $uploadOk = 1;
      
   } else {
      $uploadOk = 0;
   }
}else{
  $uploadOk = 400;
}

$today = date("Y-m-d H:i:s");  
$person = array( 
    "status"=>$uploadOk,
    "name" => $name,
    "dateTime" => $today
); 
$personJSON=json_encode($person);
echo $personJSON;


?>