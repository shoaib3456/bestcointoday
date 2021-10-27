let searchres = document.querySelector('.search-res')
const searchCoins = (e, ele) => {
    let hideElements = document.querySelectorAll('.hide-searches')
    console.log(ele.value);

    re = /^[a-z0-9]+$/i
    if (ele.value != '' && ele.value != ' ' && re.test(ele.value)) {
        hideElements.forEach(element => {
            element.style.display = "none"
        })
        searchres.innerHTML=''
        if (ele.value != '' && ele.value != ' ' && re.test(ele.value)) {
            searchres.style.display="block"
            hideElements.forEach(element => {
                element.style.display = "none"
            })




            // ajax query 

            var objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status === 200) {
                        if (objXMLHttpRequest.responseText != '') {
                            res = objXMLHttpRequest.responseText
                            // res = JSON.parse(res)
                            if (searchres) {
                                searchres.innerHTML = res
                            }
                        }
                    } else {
                        alert('Error Code: ' + objXMLHttpRequest.status);
                        alert('Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var request = "search-db.php?search=" + ele.value
            objXMLHttpRequest.open('GET', request, true);
            objXMLHttpRequest.send();

            // !!!!!ajax query 



        }
    }
    else {
        hideElements.forEach(element => {
            element.style.display = "block"
            searchres.style.display="none"
        })
    }
}