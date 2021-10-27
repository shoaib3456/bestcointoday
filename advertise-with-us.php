<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$pageTitle = "GemVote - Advertise with us";
include('admin/config.php');
require 'vendor/autoload.php';
use Carbon\Carbon;
include('header.php');
?>


<div class="container">


<div class="row mx-0 py-5 justify-content-center">
    <div class="wrapper-1 col-lg-12 col-12">
        <h5>💎 Need to boost your marketing efforts?</h5>
        <p>You are in the right place and your ad will be shown to the right audience.</p>
        <!-- <img src="assets/images/graph-1.jpg" class="img-fluid border" style="border-radius: 20px;" alt=""> -->
        <!-- <small class="w-100 row py-3"><i class="text-center col-12 px-0">Statistics for 24 hours</i></small> -->
        <p class="text-center">Driving traffic is our expertise and we are constantly growing</p>
        <strong class="text-center d-flex justify-content-center ">Promote your coin to 10k to 25k unique users daily!</strong>
        <!-- <img src="assets/images/graph-1.jpg" class="img-fluid border" style="border-radius: 20px;" alt=""> -->
        <!-- <small class="w-100 row py-3"><i class="text-center col-12 px-0">Statistics for 7 days</i></small> -->
        <!-- <h4 class="text-center">💎 Promote packages and prices</h4> -->
        <div class="row mx-0 pt-2">
            <strong class="text-center col-12  pb-3 ">Accepted formats: jpg, png, gif Max size: 1mb</strong>
            <div class="col-lg-6 d-flex flex-column align-items-center ">
                <div>
                    <strong>Promoted coins section</strong>
                    <ul class="ps-4 pt-2">
                       <li>Wide header banner (1022x115px)</li>
                       <li>Highlight Banner (800x170px)</li>
                       <li>Carousel Banner (1000x400px)</li>
                       <li>Pop-up on all pages (any size)</li>
                    </ul>

                    <strong class="">Choose duration</strong>
                    <ul class="ps-4 pt-2">
                        <li>1 day</li>
                        <li>3 days</li>
                        <li>5 days</li>
                        <li>1 week</li>
                    </ul>
                    <strong class="">Bonus </strong>
                    <ul class="ps-4 pt-2">
                        <li>Promoted Badge</li>
                        
                    </ul>
                </div>
            </div>
           
            <p class="text-center mb-1 pt-2" style="font-size: 19px;">For any questions, or to get your coin promoted, feel free to hit us up: </p>
            <p class="text-center" style="font-size: 19px;"><strong>Contact@gemvotes.com</strong> or on Telegram
                <strong> <a href="https://t.me/gemvotesadmin" class="text-dark font-weight-600">@Gemvotesadmin</a></strong>
            </p>
        </div>
    </div>
</div>
</div>


<div class="container  table-wrapper hide-on-search">
      
      <table class="table table-coin-1">
      
        <thead >
          <tr class="">
            <th scope="col " class="text-center">Name </th>
            <th scope="col " class="text-center">Symbol</th>
            <th scope="col " class="text-center">Launch</th>
            <th scope="col " class="text-center">Market Cap</th>
            <th scope="col " class="text-center">Upvotes</th>
          </tr>
        </thead>
        <tbody>
        <?php
                $sql = mysqli_query($con,"SELECT * FROM `coins` where ispromote='1' AND adminapproval='1' ORDER BY votes + 0 DESC ");
                if(mysqli_num_rows($sql)>0){
                foreach($sql as $result){
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
                        $human_dt =  Carbon::now()->diffForHumans($result['created_at']);
                        $human_dt  = explode("after",$human_dt)[0]; 
                        if(strpos($human_dt, 'hours')){
                            $human_dt = "Launched Today";
                        }    
                        echo '
                          <tr>
                          <td class="td-logo" onclick=\'coininfo("'.$result['coinname'].'")\'><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center" onclick=\'coininfo("'.$result['coinname'].'")\'><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['coinname'].'")\'><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['coinname'].'")\'><span class="nformator">$'.$result['Marketcap'].'</span></td>
                            <td class="text-center"><span onclick="voteit(this)" id="promote-'.$result['id'].'"><button class="btn btn-outline-success btn-over-off '.$isactive.'" >🚀 '.$result['votes'].'</button></span></td>
                          </tr>
                          ';
                          }
                      }
                      else{
                        echo '<tr><td class="w-100 text-center text-danger py-3 font-weight-600" colspan="5">  Coins Not Found !</td></tr>';
                      }
                  ?>
        </tbody>
      </table>
    </div>

<?php 
include('footer.php');
?>

<script src="assets/js/votes.js?v=<?php echo time();?>"></script>
<script >
  function coininfo(e){
    window.location.href="coininfo.php?name="+e
  }
</script>