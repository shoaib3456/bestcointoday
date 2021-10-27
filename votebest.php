<?php
session_start();

    if(isset($_GET['id'])){
        include('admin/config.php');
        $coin_id = $_GET['id'];
        if(isset($_SESSION['user_info'])){
            $user_id = $_SESSION['user_info']['id'];
        }
        else{
            $user_id = $_SESSION['random_id'];
        }

        

        if(mysqli_num_rows(mysqli_query($con,"SELECT * from `votes` WHERE user_id='$user_id' AND coin_id='$coin_id'")) == 0 ){
            $sql = mysqli_query($con,"INSERT INTO  `votes` (`user_id`,`coin_id`) VALUES('$user_id','$coin_id')");
            if($sql){
                mysqli_query($con,"UPDATE `coins` SET `votes`=`votes`+1 WHERE id='$coin_id'");
                $sql_getcoin = mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$coin_id' AND created_at LIKE CONCAT(CURRENT_DATE(),'%')  ");
                $coinCon = 0 ; 
                if(mysqli_num_rows($sql_getcoin) > 0){
                    foreach ($sql_getcoin as  $value) {
                        $coinCon = $coinCon + $value['coin'];
                    }
                }
                echo '<button class="btn btn-outline-success active btn-over-off" > 🚀 '.$coinCon.'</button>';
            }
        }
        else{
            $sql = mysqli_query($con,"DELETE FROM `votes`   WHERE user_id='$user_id' AND coin_id='$coin_id'");
            if($sql){
                mysqli_query($con,"UPDATE `coins` SET `votes`=`votes`-1 WHERE id='$coin_id'");
                $sql_getcoin = mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$coin_id' AND created_at LIKE CONCAT(CURRENT_DATE(),'%')  ");
                $coinCon = 0 ; 
                if(mysqli_num_rows($sql_getcoin) > 0){
                    foreach ($sql_getcoin as  $value) {
                      $coinCon = $coinCon + $value['coin'];
                    }
                }
                echo '<button class="btn btn-outline-success btn-over-off" > 🚀 '.$coinCon.'</button>';
            }
        }
    }

else {
    echo "";
}
