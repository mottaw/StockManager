function popExcluir(id) {
    document.querySelectorAll(".modal").forEach(m => {
        m.style.display = "none";
    });

    console.log("clicou", id);

    const modal = document.getElementById("popupExcluir_" + id)

    console.log(modal);

    if (modal){
        modal.style.display = "block";

    } else {
        alert("popup nao encontrado");
    }
}

function popEditar(id) {
    document.querySelectorAll(".modal").forEach(m => {
        m.style.display = "none";
        });

    console.log("clicou", id);
    const modal = document.getElementById("popupEditar_" + id)
    console.log(modal);
    if (modal){
        modal.style.display = "block";

    } else {
        alert("popup nao encontrado");
    }
}

function fecharPopupEditar(id) {
    console.log("clicou", id);

    const modal = document.getElementById("popupEditar_" + id)

    console.log(modal);

    modal.style.display = "none"
}

function fecharPopupExcluir(id) {
    console.log("clicou", id);

    const modal = document.getElementById("popupExcluir_" + id)

    console.log(modal);

    modal.style.display = "none"
}

