<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/switch.css">
</head>
<body>
    <div class="frame" id="edit_profile_page">
        <div class="header">
            <?php
                $user_id = $_GET['id'];
                include '../database/dbconnect.php';
                
                $query=mysqli_query($con,"SELECT * FROM user WHERE user_id='".$user_id."'") or die(mysqli_error());
    
                if(mysqli_num_rows($query)!=0)
                {
                    $row=mysqli_fetch_assoc($query);
                    $username = $row['username'];
                    include("../template/header.php");
                }
                mysqli_close($con);
            ?>
        </div>
        <div class="menu">
            <?php include '../template/menu.php';?>
        </div>
        <h1>Edit Profile</h1>
        <div class="edit_profile_frame">
            <form name="edit_identity" method="POST" action="update_profile.php" enctype="multipart/form-data">
                <div>
                    <div style="display: inline-block; position: relative; margin-left: 20px; height: 100px; width: 300px;">
                        <div class="edit_image_frame">
                            <img id="edit_profile_pict" src="../img/default_profile.jpeg">
                        </div>
                        <div class="select_pict">
                            <input id="file_name" type="text" readonly="readonly">
                        </div>
                        <div class="browse_file">
                            <input type="file" name="profile_pictfile" class="upload_file" onchange="showFileName(this);">
                        </div>
                    </div>
                    <div style="display: inline; position: relative; margin-left: 20px; top: 20px;">
                        <div style="display: inline-block; position: relative; height: 100px; width: 100px;">
                            <div style="height: 30px;">
                                Your Name
                            </div>
                            <div style="height: 30px;">
                                Phone
                            </div>
                            <div style="height: 30px;">
                                Status Driver
                            </div>
                        </div>
                        <div style="display: inline-block; position: absolute; height: 100px; width: 250px;">
                            <div style="height: 30px; margin-left: 10px;">
                                <input id="current_name" name="edit_name" type="text" style="height: 20px; width: 260px;">
                            </div>
                            <div style="height: 30px; margin-left: 10px;">
                                <input id="current_phone" name="edit_phone" type="text" style="height: 20px; width: 260px;">
                            </div>
                            <div style="height: 30px; margin-left: 10px;">
                                <label class="switch" style="float: right;">
                                    <input type="checkbox" name="is_driver" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input id="hidden_userid" name="hidden_userid" type="text" style="display:none;">
                    <button class="button" style="float: left;"><a href="profile.php">BACK</a></button>
                    <input type="submit" value="SAVE" style="float: right;" class="button">
                </div>
            </form>
        </div>
    </div>
    <?php
        echo "<script>document.getElementById('current_name').value = '".$row['name']."'</script>";
        echo "<script>document.getElementById('current_phone').value = '".$row['phone']."'</script>";
        if (isset($row['pict'])) {
            echo "<script>document.getElementById('edit_profile_pict').src ='getProfilePict.php?id=".$user_id."'</script>";
        }
        echo "<script>document.getElementById('hidden_userid').value =".$user_id."</script>";
    ?>
    <script>
        function showFileName(inputFile) {
            var arrTemp = inputFile.value.split('\\');
            document.getElementById("file_name").value = arrTemp[arrTemp.length - 1];
        }
    </script>
</body>
</html>