<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../database/dbconnect.php';
        if (isset($_FILES) && ($_FILES['profile_pictfile']['size'] > 0) && !empty($_POST['edit_name']) && !empty($_POST['edit_phone'])) {
            $username = $_SESSION['user'];
            $new_name = $_POST['edit_name'];
            $new_phone = $_POST['edit_phone'];
            if(isset($_POST['is_driver']))
            {
                $status = 'driver';
            }
            else
            {
                $status = 'customer';
            }

            $checkImg = true;
            $filePath = $_FILES['profile_pictfile']['tmp_name'];
            $fileName = $_FILES['profile_pictfile']['name'];
            $fileSize = $_FILES['profile_pictfile']['size'];
            $fileType = $_FILES['profile_pictfile']['type'];
            if ($_FILES['profile_pictgile']['error'] || !is_uploaded_file($filePath)) {
                $checkImg = false;
                echo "Error: Error in uploading file. Please try again.";
            }
            if ($checkImg && !in_array($fileType, array('image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg', 'image/gif'))) {
                $checkImg = false;
                echo "Error: Unsupported file extension. Supported extensions are JPG / PNG.";
            }
            if ($checkImg && $fileSize > 16000000) {
                $checkImg = false;
                echo "Error: File size must be less than 16 MB.";
            }
            if ($checkImg) {
                $fp      = fopen($filePath, 'r');
                $content = fread($fp, filesize($filePath));
                $content = addslashes($content);
                fclose($fp);
                
                if(!get_magic_quotes_gpc())
                {
                    $fileName = addslashes($fileName);
                }
                $query=mysql_query("UPDATE user set name='".$new_name."',phone='".$new_phone."',status='".$status."',pict='".$content."'WHERE username='".$username."'") or die(mysql_error());
            }
            if($query)
            {
                header("Location: profile.php");
            }
            mysql_close();
        }
    }
?>