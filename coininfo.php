<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include('header.php');
include('admin/config.php');
require 'vendor/autoload.php';
use Carbon\Carbon;
$arr = explode('/',$router);
  if(isset($arr[2])){
      $coinName = $arr[2];
  }
$coinName =  str_replace("%20"," ",$coinName );
$sql = mysqli_query($con,"SELECT * FROM `coins` WHERE id='$coinName'");
$row = mysqli_fetch_assoc($sql);
$coin_id = $row['id'];

$todays_votes = 0;
$sql2 = mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$coin_id' AND created_at LIKE CONCAT(CURRENT_DATE(),'%')");    
if(mysqli_num_rows($sql2) > 0){
 foreach ($sql2 as  $value) {
   $todays_votes = $todays_votes + $value['coin'];
 } 
}


$created_at = $row['created_at'];
$created_at = Carbon::parse($created_at)->format('M d Y');
$launced_at = $row['Launchdate'];
$launced_at = Carbon::parse($launced_at)->format('M d Y');
$isactive = '';
$actText = 'Vote';
if(isset($_SESSION['user_info'])){
    $user_id = $_SESSION['user_info']['id'];
    $sql_vote =  mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$coin_id' AND user_id='$user_id' ");
    if(mysqli_num_rows($sql_vote) > 0){
        $isactive = 'active';
        $actText = 'Voted';
    }
}
else{
    $user_id = $_SESSION['random_id'];
    $sql_vote =  mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$coin_id' AND user_id='$user_id' ");
    if(mysqli_num_rows($sql_vote) > 0){
        $isactive = 'active';
        $actText = 'Voted';
    }
}


?>

<div class="container">
    <div class="row justify-content-center">
        <?php 
        $banner  = mysqli_query($con,"SELECT * FROM `banner`");
        if(mysqli_num_rows($banner)>0){
            foreach ($banner as $key => $result) {
                $src = explode('../',$result['image'])[1];
                echo '
                <a href="'.$result['link'].'" class="col-lg-10 col-12 pt-3">
                    <img src="../'.$src.'" class="w-100  " style="border-radius: 10px;"  >
                </a>
                ';
            }
        }
        ?>
    </div>
</div>

<div class="container  py-2">
  <div class="ads-class">
    <?php
            $sqlslider = mysqli_query($con,"SELECT * FROM `slider` ");
            foreach ($sqlslider as $key => $value) {
              $src = explode('../',$value['image'])[1];
              echo '<a href="'.$value['link'].'" class="slice-ad-items-1" ><img src="../'.$src.'" alt=""></a>';
            } 
          ?>
  </div>
</div>


<div class="container">
    <div class="row mx-0 py-5 justify-content-center">
        <div class="wrapper-1 col-lg-12 col-11">
            <div class="row mx-0">
                <div class="col-lg-8 px-0">
                    <div class="ci-head flex-lg-row flex-column">
                        <img src="<?php echo $row['Logo'];?>" class="logo" alt="">
                        <div class="ps-3 pt-lg-0 pt-3">
                            <div class="d-flex align-items-center justify-content-lg-start justify-content-center">
                                <h2 class="mb-0"><?php echo $row['coinname'];?></h2>
                            </div>
                            <div class="pt-2 d-flex align-items-center">
                                <span class="sym-badge"><?php echo $row['Symbol'];?></span>
                                <span class="sym-badge sym-badge-outline"><small>Votes</small><?php echo $row['votes'];?></span>
                                <span class="sym-badge   sym-badge-outline"><small>Today</small><?php echo $todays_votes ; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class=" clipboard">
                                <span> <span style="text-transform: uppercase;"><?php echo $row['NetworkChain'];?></span>  Contract Address : </span> <strong id="copy-text"><?php echo $row['contract_address'];?></strong><i class="fa fa-copy px-2" onclick="copyspan()" title="copy to clipboard " aria-hidden="true"></i>
                            </div>
                    <div class="badge-div mt-2">
                        <div>
                            <small>Market cap</small>
                            <span class="nformator">$<?php echo $row['Marketcap'];?></span>
                        </div>
                        <div>
                            <small>Price</small>
                            <span class="nformator">$<?php echo $row['price'];?></span>
                        </div>
                        <div>
                            <small>Launch</small>
                            <span><?php echo $launced_at;?></span>
                        </div>
                    </div>
                    <p class="mt-2" style="text-align:justify;"><?php echo $row['Description'];?></p>
                    <p class="mt-2"><?php echo $row['information'];?></p>
                  
                </div>
                <div class="col-lg-4 ps-lg-5 ps-0">
                    <div class="row mx-0">
                      
                        <div class="col px-0 d-flex flex-column">
                        <?php
                            
                            if($row['Website']!=''){
                                echo '<a href="'.$row['Website'].'" class="btn btn-outline-success mt-2">    <span>Visit Website</span> </a>' ;
                            }
                            if($row['Telegram']!=''){
                                echo '<a href="'.$row['Telegram'].'" class="btn btn-outline-success mt-2">  <span>Join Telegram</span>   </a>' ;
                            }
                            if($row['Twitter']!=''){
                                echo '<a href="'.$row['Twitter'].'" class="btn btn-outline-success mt-2">    <span>Follow Twitter</span>  </a>' ;
                            }
                            
                        ?>
                        </div>
                    </div>
                  
                    
                </div>
                <div class="col-12 mt-lg-4 mt-4 d-flex flex-column">
                <?php
                    echo '<span onclick="voteit(this)" class="info-vote " id="promote-'.$row['id'].'"><button class="btn btn-outline-success btn-over-off '.$isactive.'">🚀 '.$actText.'</button></span>';
                ?>
                 <small class="mt-2 text-center col-12"> <i class="tex-center w-100">You can vote once every 24 hours.</i> </small>
                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container  table-wrapper hide-on-search">
      
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
                          <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\'><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\'><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\'><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\'><span class="nformator">$'.$result['Marketcap'].'</span></td>
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

<script>
  $('.ads-class').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    prevArrow: false,
    nextArrow: false,
    responsive: [
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      }
    ]
  });
</script>
  <script src="../assets/js/votes.js?v=<?php echo time();?>"></script>


<script >
    
    async function copyspan() {
        var copyText = document.getElementById("copy-text");
        await navigator.clipboard.writeText(copyText.innerText);
    }


    function coininfo(e) {
    window.location.href = ""+e
  }

 

</script>


