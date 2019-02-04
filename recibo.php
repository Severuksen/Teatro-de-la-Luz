<?php
function upload_screen()
{
               require("config.php");
               $by=stripslashes($_POST['by_character']);
               $title=stripslashes($_POST['image_title']);

               $target_path = "modules/user_gallery/";
               $MAX_SIZE = 2000000;
               $FILE_MIMES = array('image/jpeg','image/jpg');
               $FILE_EXTS = array('.jpg');

               $target_path = $target_path . basename( $_FILES['userfile']['name']); 
               $_FILES['userfile']['tmp_name'];  


               $target_path = "modules/user_gallery/";
               $file_name = $_FILES['userfile']['name'];
               $filenamecheck = "modules/user_gallery/$file_name"; 

               $file_type = $_FILES['userfile']['type'];
               $file_name = $_FILES['userfile']['name'];

               $file_name= str_replace("'","",$file_name);
               $file_name= str_replace(";","",$file_name);

               $target_path = $target_path . basename( $_FILES['userfile']['name']);  

                   if(empty($by) || empty($title) || empty($file_name)){
                       show_error("$warning_start Some Fields Where Left Blank! $warning_end");}

                         elseif (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS)){ 
                                 show_error("$warning_start Only .jpg files are allowed! $warning_end");}

                             elseif(file_exists($filenamecheck)){ 
                                    show_error("$warning_start Image $file_name is already uploaded, please change file name! $warning_end");}

                                 elseif ( $_FILES['userfile']['size'] > $MAX_SIZE){ 
                                         show_error("$warning_start Image $file_name has more then 2MB! $warning_end");}

                else{
                       $logfile="modules/user_gallery/$file_name.php";
                       $ip = $_SERVER['REMOTE_ADDR'];
                       $date = date('Y-m-d H:i');
                       $data = "<?\n\$by=\"$_POST[by_character]\";\n\$title=\"$_POST[image_title]\";\n ?>";

                       $fp = fopen($logfile, 'w');
                       fputs($fp, $data);
                       fclose($fp);
                     
                          if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
                              show_error("$ok_start Image $file_name SuccessFully Uploaded! $ok_end");}
                    } 



}
?>