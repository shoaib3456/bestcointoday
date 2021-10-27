<?php 
include 'header.php' ;
include('admin/config.php');
require 'vendor/autoload.php';
use Carbon\Carbon;




// pagination code 

$num_per_page=10;


	if(isset($_GET["page"]))
	{
		$page=$_GET["page"];
	}
	else
	{
		$page=1;
	}

	$start_from=($page-1)*10;


?>
<!-- banners  -->

<div class="container pb-3">
    <div class="row justify-content-center">
        <?php 
        $banner  = mysqli_query($con,"SELECT * FROM `banner`");
        if(mysqli_num_rows($banner)>0){
            foreach ($banner as $key => $result) {
                $src = explode('../',$result['image'])[1];
                echo '
                <a href="'.$result['link'].'" class="col-lg-10 col-12 pt-3">
                    <img src="'.$src.'" class="w-100  " style="border-radius: 10px;"  >
                </a>
                ';
            }
        }
        ?>
    </div>
</div>

<!-- ads slider -->
<div class="container  py-2">
  <div class="ads-class">
    <?php
            $sql = mysqli_query($con,"SELECT * FROM `slider` ");
            foreach ($sql as $key => $value) {
              $src = explode('../',$value['image'])[1];
              echo '<a href="'.$value['link'].'" class="slice-ad-items-1" ><img src="'.$src.'" alt=""></a>';
            } 
          ?>
  </div>
</div>

<div class="container  table-wrapper ">
  <table class="table table-coin-1">
      <thead>
        <tr class="">
          <th scope="col " class="text-center">Name </th>
          <th scope="col " class="text-center hide-on-mobile">Symbol</th>
          <th scope="col " class="text-center hide-on-mobile">Launch</th>
          <th scope="col " class="text-center ">Market Cap</th>
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
                        $D=date("Y-m-d");
                        if($result['Launchdate']>$D){
                            $arbaz="Pre-Sale";
                        }
                        else{
                            $arbaz='<span class="nformator">$'.$result['Marketcap'].'</span>';
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
                        echo '
                          <tr>
                          <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\'><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\'><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\'><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\' >'.$arbaz.'</td>
                            <td class="text-center"><span onclick="voteit(this)" id="promote-'.$result['id'].'"><button class="btn btn-outline-success btn-over-off '.$isactive.'" >🚀 '.$result['votes'].'</button></span></td>
                          </tr>
                          ';
                          }
                      }else{
                        echo '<tr><td class="w-100 text-center text-danger py-3 font-weight-600" colspan="5">  Coins Not Found !</td></tr>';
                      }
                  ?>
    </tbody>
  </table>
</div>

<div class="">

  <div class="table-tray  container py-4 px-4 nav nav-pills" id="pills-tab" role="tablist">
    <button class="btn   nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
      type="button" role="tab" aria-controls="pills-home" aria-selected="true">🔥 Today <span class="d-lg-inline d-none">'s Hot</span> </button>
    <button class="btn  nav-link  text-light " id="pills-profile-tab" data-bs-toggle="pill"
      data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">🥇
      All Time<span class="d-lg-inline d-none"> Best <span></button>
    <button class="btn  nav-link text-light " id="pills-contact-tab" data-bs-toggle="pill"
      data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">🙌
      New</button>
    <button class="btn nav-link text-light" id="pills-presale-tab" data-bs-toggle="pill" data-bs-target="#pills-presale" type="button" role="tab" aria-controls="pills-presale" aria-selected="false" >
    Pre-Sales
    </button>
    
    <div class="seach-bar">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Search coins..." onkeyup="searchCoins(event,this)">
    </div>
    <!-- <p class="mb-0">Coins can be upvoted once every 24h</p> -->
    <div class="timer-style">
      <i class="fa fa-refresh" aria-hidden="true"></i>
      <p id="timer"></p>
    </div>

  </div>


</div>

<div class="tab-content hide-searches " id="pills-tabContent">
  <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container table-wrapper ">
      <table class="table table-coin-1">
      <thead>
        <tr class="">
          <th scope="col " class="text-center">Name </th>
          <th scope="col " class="text-center hide-on-mobile">Symbol</th>
          <th scope="col " class="text-center hide-on-mobile">Launch</th>
          <th scope="col " class="text-center ">Market Cap</th>
          <th scope="col " class="text-center">Upvotes</th>
        </tr>
      </thead>
        <tbody id="sort-table">
          <?php
                 $sql = mysqli_query($con,"SELECT * FROM `coins` WHERE  adminapproval='1'   ORDER BY votes + 0 DESC limit $start_from,$num_per_page ");
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
                         $D=date("Y-m-d");
                         if($result['Launchdate']>$D){
                             $arbaz="Pre-Sale";
                         }
                         else{
                             $arbaz='<span class="nformator">$'.$result['Marketcap'].'</span>';
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
                          $cid = $result['id'];
                         $sqlTodayBest = mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$cid' AND created_at LIKE CONCAT(CURRENT_DATE(),'%')");    
                         $sqlTodayBestRow =0;
                         if(mysqli_num_rows($sqlTodayBest) > 0){
                          foreach ($sqlTodayBest as  $value) {
                            $sqlTodayBestRow = $sqlTodayBestRow + $value['coin'];
                          } 
                         }
                       
                        echo '
                          <tr data-order="'.$sqlTodayBestRow.'">
                            <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\' ><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname']  . '</small></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\' >'.$arbaz.'</td>
                            <td class="text-center"><span onclick="voteitbest(this)" id="promote-'.$result['id'].'"><button class="btn btn-outline-success btn-over-off '.$isactive.'" >🚀 '.$sqlTodayBestRow.'</button></span></td>
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
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="container table-wrapper">
      <table class="table table-coin-1">
        <thead>
          <tr class="">
          <th scope="col " class="text-center">Name </th>
        <th scope="col " class="text-center hide-on-mobile">Symbol</th>
        <th scope="col " class="text-center hide-on-mobile">Launch</th>
        <th scope="col " class="text-center ">Market Cap</th>
        <th scope="col " class="text-center">Upvotes</th>
          </tr>
        </thead>
        <tbody>
          <?php
                $sql = mysqli_query($con,"SELECT * FROM `coins`  WHERE adminapproval='1'  ORDER BY votes + 0 DESC limit $start_from,$num_per_page  ");
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
                        $D=date("Y-m-d");
                        if($result['Launchdate']>$D){
                            $arbaz="Pre-Sale";
                        }
                        else{
                            $arbaz='<span class="nformator">$'.$result['Marketcap'].'</span>';
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
                        echo '
                          <tr>
                          <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\' ><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\' >'.$arbaz.'</td>
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
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <div class="container table-wrapper">
      <table class="table table-coin-1">
        <thead>
          <tr class="">
          <th scope="col " class="text-center">Name </th>
        <th scope="col " class="text-center hide-on-mobile">Symbol</th>
        <th scope="col " class="text-center hide-on-mobile">Launch</th>
        <th scope="col " class="text-center ">Market Cap</th>
        <th scope="col " class="text-center">Upvotes</th>
          </tr>
        </thead>
        <tbody>
          <?php
                $sql = mysqli_query($con,"SELECT * FROM `coins`  WHERE adminapproval='1'  ORDER BY created_at DESC limit $start_from,$num_per_page ");
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
                        $D=date("Y-m-d");
                        if($result['Launchdate']>$D){
                            $arbaz="Pre-Sale";
                        }
                        else{
                            $arbaz='<span class="nformator">$'.$result['Marketcap'].'</span>';
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
                        echo '
                          <tr>
                          <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\' ><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\' >'.$arbaz.'</td>
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
  </div>
  <div class="tab-pane fade" id="pills-presale" role="tabpanel" aria-labelledby="pills-presale-tab">
      <div class="container table-wrapper">
      <table class="table table-coin-1">
        <thead>
          <tr class="">
          <th scope="col " class="text-center">Name </th>
        <th scope="col " class="text-center hide-on-mobile">Symbol</th>
        <th scope="col " class="text-center hide-on-mobile">Launch</th>
        <th scope="col " class="text-center ">Market Cap</th>
        <th scope="col " class="text-center">Upvotes</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            $d=date("Y-m-d");
                $sql = mysqli_query($con,"SELECT * FROM `coins`  WHERE adminapproval='1' and Launchdate>'$d'");
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
                        $D=date("Y-m-d");
                        if($result['Launchdate']>$D){
                            $arbaz="Pre-Sale";
                        }
                        else{
                            $arbaz='<span class="nformator">$'.$result['Marketcap'].'</span>';
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
                        echo '
                          <tr>
                          <td class="td-logo" onclick=\'coininfo("'.$result['id'].'")\' ><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick=\'coininfo("'.$result['id'].'")\' ><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick=\'coininfo("'.$result['id'].'")\' >'.$arbaz.'</td>
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
  </div>
  
</div>

<div class="search-res"></div>

<div class="">

    <div class="container  d-flex flex-column py-4">
      <div class="pagination-custom">
        
    <?php 
    
      $prevPage='1';
      if(isset($_GET['page']) && $_GET['page']>1){
        $prevPage = $_GET['page']-1;
        echo ' <span><a href="index.php?page='.$prevPage.'"><i class="fa fa-angle-double-left"></i></a></span>';
      }

   
    
      $rs_result=mysqli_query($con,"SELECT * from `coins`");
      $total_records=mysqli_num_rows($rs_result);
      $total_pages=ceil($total_records/$num_per_page);
      
      for($i=1;$i<=$total_pages;$i++)
      {
        $ispageactive='';
         if(isset($_GET['page']) && $_GET['page'] == $i){
             $ispageactive = 'active';
         } 
         else{
          $ispageactive='';
         }
          echo "<span class=".$ispageactive."><a href='index.php?page=".$i."'>".$i."</a></span>" ;
      }

      $nextPage='1';
      if(isset($_GET['page']) && $_GET['page'] < $total_pages){
        $nextPage = $_GET['page']+1;
      }
      echo ' <span><a href="index.php?page='.$nextPage.'"><i class="fa fa-angle-double-right"></i></a></span>';
      


    
    ?>
    

      
      </div>
    </div>
    </div> 



<div class="search-res">
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

<script src="assets/js/votes.js?v=<?php echo time();?>"></script>
<script src="assets/js/votesbest.js?v=<?php echo time();?>"></script>


<?php
  
  if(isset($_GET['tab']) && $_GET['tab']=='todaysbest' ){
    echo '
      <script>
        document.getElementById("pills-home-tab").click(); 
      </script>
    ';
  }
  if(isset($_GET['tab']) && $_GET['tab']=='alltimebest' ){
    echo '
      <script>
        document.getElementById("pills-profile-tab").click();
      </script>
    ';
  }
  if(isset($_GET['tab']) && $_GET['tab']=='newlisting' ){
    echo '
      <script>
        document.getElementById("pills-contact-tab").click();
      </script>
    ';
  }
  
  
  ?>



<script>

  function coininfo(e) {
    window.location.href = "details/"+e
  }

</script>


<script src="assets/js/timer.js"></script>
<script src="assets/js/sort-table.js?v=<?php echo time();?>"></script>
<script src="assets/js/search.js?v=<?php echo time();?>"></script>