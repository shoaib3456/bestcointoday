<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include('header.php');
?>


<div class="row mx-0 py-5 justify-content-center">
    <div class="wrapper-1 col-lg-10 col-11">
        <h3 class="text-center font-weight-600">Simple tasks to earn extra money</h3>
        <p class="text-center  pt-4 py-2">Have some spare time? We provide an opportunity to earn some extra money.</p>
        <p class="text-center py-2">Paying daily in BNB for easy tasks, work on your own schedule and as much as you want.</p>
        <p class="text-center py-2 font-weight-600">For more details, please contact our support: Contact@gemvotes.com</p>
        <div class="d-flex justify-content-center py-3">
            <img src="assets/images/logo.png" style="width: 200px;"   alt="">
        </div>
    </div>
</div>


<?php 
include('footer.php');
?>