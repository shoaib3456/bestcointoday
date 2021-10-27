<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(!isset($_SESSION['user_info'])){
    header('location:login.php');
} 
include('header.php');
include('admin/config.php');
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
                    <img src="'.$src.'" class="w-100  " style="border-radius: 10px;"  >
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
            $sql = mysqli_query($con,"SELECT * FROM `slider` ");
            foreach ($sql as $key => $value) {
              $src = explode('../',$value['image'])[1];
              echo '<a href="'.$value['link'].'" class="slice-ad-items-1" ><img src="'.$src.'" alt=""></a>';
            } 
          ?>
  </div>
</div>
<div class="container">

<div class="row mx-0 py-5 justify-content-center">
    <div class="wrapper-1 col-lg-12  col-12">
        <?php 
        if(isset($_SESSION['coin_error'])){
            echo $_SESSION['coin_error'];
            unset($_SESSION['coin_error']);
        }
        ?>
        <form id="coinform" action="addcoindb.php" method="POST" enctype='multipart/form-data'>

            <div class="row mx-0">
                <div class="col-lg-6 col-12 ">
                    <label for="exampleInputEmail1" class="form-label font-weight-600">Name <small class="req-small">Reduired</small></label>
                    <input type="text" name="coinname" class="form-control cs-inp-1 req-inp" placeholder="Name"
                        required>
                    <div class="pt-3">
                        <label for="exampleInputEmail1" class="form-label font-weight-600">Symbol <small class="req-small">Reduired</small> </label>
                        <input type="text" name="Symbol" class="form-control cs-inp-1 req-inp" placeholder="BTC"
                            required>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Description <small class="req-small">Reduired</small></label>
                        <textarea type="text" id="Description" name="Description" class="form-control cs-inp-1 req-inp"
                            placeholder=""></textarea>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Market Cap in USD <small class="req-small">Reduired</small></label>
                        <input type="text"  name="Marketcap" onkeyup="formateInput(this)" class="form-control cs-inp-1 req-inp" placeholder="0.000"
                            required>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Price <small class="req-small">Reduired</small></label>
                        <input type="text"  name="price" onkeyup="formateInput(this)" class="form-control cs-inp-1 " placeholder="0.000">
                    </div>

                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Launch Date <small class="req-small">Reduired</small></label>
                        <input type="date" name="Launchdate" class="form-control cs-inp-1 req-inp"
                            placeholder="https://coinsniper.net" required>
                    </div>
                    <h5>Contract addresses</h5>
        
                    <div class="pt-3">
                        <label for="exampleInputEmail1" class="form-label  font-weight-600">Chain <small class="req-small">Reduired</small> </label>
                        <div class="select-wrapper">
                            <select name="NetworkChain" class="form-control cs-inp-1 ">
                                <option value="bsc" selected="">Binance Smart Chain (BSC)</option>
                                <option value="eth">Ethereum (ETH)</option>
                                <option value="matic">Polygon (MATIC)</option>
                                <option value="trx">Tron (TRX)</option>
                            </select>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="my-3" id="contract_add">
                        <label for="exampleInputPassword1" class="form-label font-weight-600"> Address <small class="req-small">Reduired</small></label>
                        <input type="text" name="contract_address" class="form-control cs-inp-1 req-inp"
                            placeholder="" required>
                    </div>
                </div>
                <div class="col-lg-6 col-12 ">
                    
                    <div class="my-3 mt-0">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Website </label>
                        <input type="text" name="Website" class="form-control cs-inp-1 "
                            placeholder="https://coinsniper.net" >
                    </div>
                   
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Telegram <small class="req-small">Reduired</small></label>
                        <input type="text" name="Telegram" class="form-control cs-inp-1 req-inp"
                            placeholder="https://t.me/coinsniper" required>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Twitter </label>
                        <input type="text" name="Twitter" class="form-control cs-inp-1"
                            placeholder="https://twitter.com/coinsniper">
                    </div>
                    <div class=" coin-form-group">
                        <label for="exampleInputEmail1" class="form-label font-weight-600 ">Logo <small class="req-small">Reduired</small></label>
                        <div class="coin-form-control cm-file-inp ">
                            <span class="logo-btn btn " id="logo-btn" >Upload Photo</span>
                            <div class="logo-span" id="logo-name">No file chosen</div>
                            <input type="file"  class="form-control " onchange="readURL(this)"  name="Logo" id="Logo" required>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Additional information, other links and addresses</label>
                        <textarea type="text" name="information" id="information" class="form-control cs-inp-1 "
                            placeholder=""></textarea>
                    </div>
                   
                </div>
            </div>
            

            <div class="row mx-0 justify-content-center">
                <input type="submit" id="coinsubbtn" name="submitt" class="btn btn-success  mt-3 col-lg-3 col-12"style="padding: 10px; text-transform: uppercase;" value="Submit coin">
            </div>
        </form>

    </div>
</div>
    
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

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


 <script >

document.querySelector('#logo-btn').onclick = () =>{
    document.querySelector('#Logo').click()
}
let iCount  = 0
function readURL(input) {
        if (input.files && input.files[0]) {
            if (input.files[0].type == 'image/png' || input.files[0].type == 'image/jpg' || input.files[0].type == 'image/jpeg') {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.querySelector('#logo-name').innerText = input.files[0].name
                    console.log(input.files)
                    iCount = 1
                };

                reader.readAsDataURL(input.files[0]);
             if (input.files) {

            }
            }else{
                window.alert("Please select valid image format Ex:( PNG , JPG , JPEG)")
                input.value=""
                document.querySelector('#logo-name').innerText = "No file chosen"
                iCount  = 0
            }
        }
    }


let coinform = document.querySelector('#coinform')
let coinsubbtn = document.querySelector('#coinsubbtn')


coinform.onsubmit =(e)=>{
    e.preventDefault()
}
let isclickyes = 0
coinsubbtn.onclick =()=>{
    let requiredInput = document.querySelectorAll('.req-inp')
    let count  = 0
    count = count+iCount
    requiredInput.forEach((ele)=>{
        if(ele.value==''){
            ele.style="border:2px solid #DE3CB1 !important;"
        }
        else{
            // ele.style="unset !important;"
            count++
        }
    })
    count = count+isclickyes
    if (count == 8 ) {
        coinform.submit();
    }
}


// text editor code !!

$(document).ready(function() {
  $('#Description').summernote(
    {
        placeholder: 'Describe your coin here. What is the goal, plans, why is this coin unique?',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['']],
          ['font', ['bold', 'underline', 'italic']],
          ['color', ['']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['']],
          ['insert', ['link', '', '']],
          ['view', ['', '', '']]
        ]
      }
  );
});
$(document).ready(function() {
  $('#information').summernote(
    {
        placeholder: '',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['']],
          ['font', ['bold', 'underline', 'italic']],
          ['color', ['']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['']],
          ['insert', ['link', '', '']],
          ['view', ['', '', '']]
        ]
      }
  );
});

</script>