<html>
<head>
    <title>U Wanna Call Me Beibh?</title>
    <link rel="stylesheet" type="text/css" href="../css/default_style.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
</head>
<body>
    <div class="frame">
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
            ?>
        </div>
        <div class="menu_container">
            <?php include'../template/menu.php';?>
        </div>
        <div class="profile_container">
            <div class="subheader">
                <div class="title"><h1>My Profile</h1></div>
                <div class="edit_profile_button"><a href=<?php echo 'edit_profile.php?id='.$user_id; ?>>✎</a></div>
            </div>
            <div class="profile_info_container">
                <div class="profile_pict_frame">
                    <img id="profile_pict" src="../img/default_profile.jpeg">
                </div>
                <div class="profile_data_container">
                    <?php
                        echo "</br><p><strong>".$row['username']."</strong></p>";
                        echo "<p>".$row['name']."</p>";
                        if ($row['status'] == "driver") {
                            echo "<p>Driver | <span id='driver_rating'>Rating (xxx Votes)</span></p>";
                        } else {
                            echo "<p>Non-Driver</p>";
                        }
                        echo "<p>".$row['email']."</p>";
                        echo "<p>".$row['phone']."</p>";
                        if (isset($row['pict'])) {
                            echo "<script>document.getElementById('profile_pict').src ='getProfilePict.php?id=".$user_id."'</script>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="display_prefloc" class="prefloc_container">
            <div class="subheader">
                <div class="title"><h1>Preferred Locations</h1></div>
                <div class="edit_prefloc_button"><a href=<?php echo 'edit_location.php?id='.$user_id; ?>>✎</a></div>
            </div>
            <div class="prefloc_list">
                <?php
                    if ($row['status'] != "driver") {
                        echo '<script>document.getElementById("display_prefloc").style.display = "none";</script>';
                    }
                    $query=mysqli_query($con,"SELECT pref_loc FROM driver_prefloc WHERE driver_id='".$user_id."'") or die(mysqli_error());
                    $numrows = mysqli_num_rows($query);
                    if($numrows !=0)
                    {
                        $i = 1;
                        $buffer = '<ul>';
                        while ($row=mysqli_fetch_assoc($query)) {
                            if ($i != $numrows) {
                                $buffer .= '<li>►'.$row['pref_loc'].'</li><ul>';
                                $i++;
                            } else {
                                $buffer .= '<li>►'.$row['pref_loc'].'</li>';
                            }
                        }
                        for ($i = 0;$i <= $row; $i++) {
                            $buffer .= '</ul>';
                        }
                        echo $buffer;
                    }
                    mysqli_close($con);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
