<?php 

include 'header.php'; 

?>

<style>
    .req-small{
        color: rgb(255, 0, 128);
    }
</style>

<div class="container-fluid">
    <div class="card-body bg-white rounded d-flex flex-column">
        <h3>Add Coin</h3>
        <form id="" class="d-flex flex-column" action="addcoin-db.php" method="POST" enctype="multipart/form-data">

            <div class="row mx-0">
                <div class="col-lg-6 col-12 ">
                    <label for="exampleInputEmail1" class="form-label font-weight-600">Name <small class="req-small">Reduired</small></label>
                    <input type="text" name="coinname" class="form-control cs-inp-1 req-inp" placeholder="Name" required="">
                    <div class="pt-3">
                        <label for="exampleInputEmail1" class="form-label font-weight-600">Symbol <small class="req-small">Reduired</small> </label>
                        <input type="text" name="Symbol" class="form-control cs-inp-1 req-inp" placeholder="BTC" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Description <small class="req-small">Reduired</small></label>
                        <textarea type="text" name="Description" id="Description" class="form-control cs-inp-1 req-inp" placeholder="Describe your coin here. What is the goal, plans, why is this coin unique?"></textarea>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Market Cap in USD <small class="req-small">Reduired</small></label>
                        <input type="number"  step="any" name="Marketcap" class="form-control cs-inp-1 req-inp" placeholder="0.000" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Price <small class="req-small">Reduired</small></label>
                        <input type="number" step="any" name="price" class="form-control cs-inp-1 "    placeholder="0.000" >
                    </div>

                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Launch Date <small class="req-small">Reduired</small></label>
                        <input type="date" name="Launchdate" class="form-control cs-inp-1 req-inp" placeholder="https://coinsniper.net" required="">
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
                        </div>
                    </div>
                    <div class="my-3" id="contract_add">
                        <label for="exampleInputPassword1" class="form-label font-weight-600"> Address <small class="req-small">Reduired</small></label>
                        <input type="text" name="contract_address" class="form-control cs-inp-1 req-inp" placeholder="" required="">
                    </div>
                </div>
                <div class="col-lg-6 col-12 ">
                    
                    <div class="my-3 mt-0">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Website </label>
                        <input type="text" name="Website" class="form-control cs-inp-1 " placeholder="https://coinsniper.net">
                    </div>
                   
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Telegram <small class="req-small">Reduired</small></label>
                        <input type="text" name="Telegram" class="form-control cs-inp-1 req-inp" placeholder="https://t.me/coinsniper" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Twitter </label>
                        <input type="text" name="Twitter" class="form-control cs-inp-1" placeholder="https://twitter.com/coinsniper">
                    </div>
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label font-weight-600 ">Logo <small class="req-small">Reduired</small></label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input"  name="Logo" id="Logo" required="">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Additional information, other links and addresses</label>
                        <textarea type="text" name="information" id="information" class="form-control cs-inp-1 " placeholder=""></textarea>
                    </div>
                   
                </div>
            </div>
            

            <div class="row mx-0 justify-content-center mb-3">
                <input type="submit" id="coinsubbtn" name="submitt" class="btn btn-success col-lg-3 " style="padding: 10px; text-transform: uppercase;" value="Submit coin">
            </div>
        </form>
    </div>
</div>




<?php include 'footer.php'; ?>