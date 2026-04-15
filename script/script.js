var modal = document.getElementById("popup");
var btn = document.getElementById("excluir");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == span) {
        modal.style.display = "none";
    }
}