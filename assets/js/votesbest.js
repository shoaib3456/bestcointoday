

// /new

var myModal = new bootstrap.Modal(document.getElementById('votemodal'), {
  keyboard: false
})

const voteitbest  =(ele)=>{
  var objXMLHttpRequest = new XMLHttpRequest();
  objXMLHttpRequest.onreadystatechange = function() {
    if(objXMLHttpRequest.readyState === 4) {
      if(objXMLHttpRequest.status === 200) {
        if(objXMLHttpRequest.responseText!=''){
          ele.innerHTML = objXMLHttpRequest.responseText;
          if(ele.children[0].classList.contains('active')){
            myModal.show()
          }
          if(ele.classList.contains('info-vote')){
            if(ele.children[0].classList.contains('active')){
              ele.children[0].innerHTML = '🚀 VOTED!'
            }
            else{
              ele.children[0].innerHTML = '🚀 VOTE'
            }
          } 
        }
        else{
          // window.location.href="login.php"
        }
      } else {
            alert('Error Code: ' +  objXMLHttpRequest.status);
            alert('Error Message: ' + objXMLHttpRequest.statusText);
      }
    }
  }


  var request = "votebest.php?id="+ele.id.split('-')[1]
  objXMLHttpRequest.open('GET',request,true);
  objXMLHttpRequest.send();
}