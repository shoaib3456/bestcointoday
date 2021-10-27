
setInterval(function time(){
    var d = new Date();
    var hours = 24 - d.getUTCHours();
    var min = 60 - d.getUTCMinutes();
    if((min + '').length == 1){
      min = '0' + min;
    }
    var sec = 60 - d.getUTCSeconds();
    if((sec + '').length == 1){
          sec = '0' + sec;
    }
    document.getElementById("timer").innerHTML = hours + '   : ' + min + ' : ' + sec
  }, 1000);




