var myArr = [];
var elements = 0;

$.ajax(
    {
        type:'POST',
        url: 'select.php',
        data: "read=",
        success:function (html) {
            myArr = JSON.parse(html);
        }
});

while (myArr.length > elements && myArr.length > 0) {
    if (myArr[elements]) {
        createDivElement(myArr[elements], elements);
        elements++;
    }
    else
        myArr.splice(elements, 1);
}

function sendToServer(str){
    $.ajax(
        {
            type:'POST',
            url: 'insert.php',
            data: "write=" + str,
            success:function (html) {
                console.log(html);
            }
        });
}


function delMe (thisElem) {
    if (confirm("Remove: " + thisElem.innerHTML + "?")) {
        thisElem.remove();
        myArr[thisElem.id] = "";
        sendToServer(JSON.stringify(myArr));
    }
}

function createDivElement(str, id) {
    var div = document.createElement("div");
    div.innerHTML = str;
    div.id = id;
    div.onclick = function (){delMe(this)};
    ft_list.insertBefore(div, ft_list.firstChild);
}

$("#ft_list").click(function addElement() {
    var str = prompt("TO DO");

    if (str) {
        createDivElement(str, myArr.length);
        myArr.push(str);
        sendToServer(JSON.stringify(myArr));
    }
});