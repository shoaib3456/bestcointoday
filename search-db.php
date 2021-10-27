<?php

include('admin/config.php');
session_start();
require 'vendor/autoload.php';

use Carbon\Carbon;

$search_key  = $_GET['search'];
if (!empty($search_key)) {
    $sql = mysqli_query($con, "SELECT * FROM `coins` WHERE adminapproval='1' AND coinname LIKE '%$search_key%' ");
    $result = mysqli_fetch_assoc($sql);
    $output = '';
    if (mysqli_num_rows($sql) > 0) {
        $output .= '
        <div class="container table-wrapper mt-0">
          <table class="table table-coin-1">
            <thead >
              <tr class="">
              <th scope="col " class="text-center">Name </th>
                <th scope="col " class="text-center hide-on-mobile">Symbol</th>
                <th scope="col " class="text-center hide-on-mobile">Launch</th>
                <th scope="col " class="text-center">Market Cap</th>
                <th scope="col " class="text-center">Upvotes</th>
              </tr>
            </thead>
            <tbody>
      ';
        foreach ($sql as $result) {
            $isactive = "";
            $cid = $result['id'];
            if(isset($_SESSION['user_info'])){
                $uid = $_SESSION['user_info']['id'];
                if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0){
                    $isactive = 'active';
                }
            }
            else{
                $uid = $_SESSION['random_id'];
                if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0){
                    $isactive = 'active';
                }
            }
            $human_dt =  Carbon::now()->diffForHumans($result['Launchdate']);
            if(strpos($human_dt, 'after') !== false){
              $human_dt  = explode("after",$human_dt)[0] .' '. explode("after",$human_dt)[1] = 'ago' ; 
            } 
            if(strpos($human_dt, 'before') !== false){
              $human_dt  =explode("before",$human_dt)[1] = 'In'.' ' . explode("before",$human_dt)[0]; 
            } 
            if(strpos($human_dt, 'hours')){
                $human_dt = "Launched Today";
            } 
            $output .= '
                            <tr>
                                <td class="td-logo" onclick=\'coininfo("'.$result['coinname'].'")\' ><img src="' . $result['Logo'] . '" alt=""> <small>' . $result['coinname'] . '</small></td>
                                <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['coinname'].'")\' ><span>' . $result['Symbol'] . '</span></td>
                                <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['coinname'].'")\' ><span>' . $human_dt . '</span></td>
                                <td class="text-center" onclick=\'coininfo("'.$result['coinname'].'")\' ><span class="nformator">$' . $result['Marketcap'] . '</span></td>
                                <td class="text-center"><span onclick="voteit(this)" id="promote-' . $result['id'] . '"><button class="btn btn-outline-success btn-over-off ' . $isactive . '" >🚀 ' . $result['votes'] . '</button></span></td>
                            </tr>
                            ';
        }

        $output .= '
                </tbody>
                </table>
                </div>
                </div>
                ';
        echo $output;
    }
    else {
        echo  $output =  '<div class="w-100 text-center container text-danger py-3 rounded wrapper-1 font-weight-600 bg-white"> Result Not Found !</div>';
    }
}