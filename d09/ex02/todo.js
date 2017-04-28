
var ft_list = document.getElementById("ft_list");
var myArr = [];
var cookie = decodeURIComponent(document.cookie);
if (cookie) {
    myArr = JSON.parse(cookie);
}
var elements = 0;


while (myArr.length > elements && myArr.length > 0) {
    if (myArr[elements]) {
        createDivElement(myArr[elements], elements);
        elements++;
    }
    else
        myArr.splice(elements, 1);
}

function delMe (thisElem) {
    if (confirm("Remove: " + thisElem.innerHTML + "?")) {
        thisElem.remove();
        myArr[thisElem.id] = "";
        cookie = JSON.stringify(myArr);
        document.cookie = encodeURIComponent(cookie);
    }
}

function createDivElement(str, id) {
    var div = document.createElement("div");
    div.innerHTML = str;
    div.id = id;
    div.onclick = function (){delMe(this)};
    ft_list.insertBefore(div, ft_list.firstChild);
}

function addElement() {
    var str = prompt("TO DO");

    if (str) {
        createDivElement(str, myArr.length);
        myArr.push(str);
        cookie = JSON.stringify(myArr);
        document.cookie = encodeURIComponent(cookie);
    }
}