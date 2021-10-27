
let table  = document.getElementById('sort-table')
tableArr = table.children;
tmp = []
for (let i = 0; i < tableArr.length; i++) {
    tmp.push(tableArr[i])
    
}

let a = tmp.sort(function(a, b) {
    return parseFloat(a.dataset.order) - parseFloat(b.dataset.order);
});

 a  = a.reverse()


console.log(a.innerHTML);

table.innerHTML=""
for (let i = 0; i < a.length; i++) {
    table.innerHTML=table.innerHTML+a[i].outerHTML
}