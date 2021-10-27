document.querySelectorAll('.nformator').forEach(element => {
    let number = element.innerText
    number = number.split('$')
    number  = number[1]
    element.innerText ='$'+  new Intl.NumberFormat().format(number);
});

let previnptVal;
const formateInput = (element) =>{
    
    let  ex = /^[0-9]+$/;
    let number = element.value.split(",").join("");
    if(number.match(ex)){
        formatedNumber =  new Intl.NumberFormat().format(number) 
        element.value =formatedNumber
        // previnptVal = formatedNumber
    }
    else{
        // element.value = previnptVal
    }
}

console.log("we");