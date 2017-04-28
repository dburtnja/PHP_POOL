$('#ft_list').append(decodeURIComponent(document.cookie));

$("input").click(function addElement() {
    var str = prompt("TO DO");

    if (str) {
        $('#ft_list').prepend($('<div/>').attr("class", "todo").text(str));
        document.cookie = encodeURIComponent($('#ft_list').html());
    }
})

$(document).on("click", ".todo", function(){
    if (confirm("Remove: " + $(this).html() + "?")) {
        $(this).remove();
        document.cookie = encodeURIComponent($('#ft_list').html());
    }
});