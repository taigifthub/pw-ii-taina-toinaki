

function openaModalAdd() {
    const modal = document.getElementById('modalAdicionar').style.display = "block";
}

function closeModalAdd() {
    const modal = document.getElementById('modalAdicionar').style.display = "none"; // Esconde a modal
}

function openModalEditar(id, titulo, reportagem, img, imgNome) {
    const modal = document.getElementById('modalEditar').style.display = "block";
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-titulo").value = titulo;
    document.getElementById("edit-reportagem").value = reportagem;
    document.getElementById("edit-img").value = img;
    document.getElementById("edit-img-nome").value = imgNome;
}

function closeModalEditar() {
    const modal = document.getElementById('modalEditar').style.display = "none"; 
}
function vernoticiad() {
    const modal = document.getElementById('modaller').style.display = "block";
}
function openModalEditar(id) {
    document.getElementById("id_noticias").value = id;
    document.getElementById("modalEditar").style.display = "block";
}

function verNoticia(titulo, imagem, reportagem) {
    document.querySelector("#modaller h3").textContent = titulo;
    document.querySelector("#modaller img").src = imagem;
    document.querySelector("#modaller p").textContent = reportagem;
    document.getElementById("modaller").style.display = "block";
}

function closeModalAdd() {
    document.getElementById("modalAdicionar").style.display = "none";
}

function closeModalEditar() {
    document.getElementById("modalEditar").style.display
}
function closeModaller() {
    const modal = document.getElementById('modaller').style.display = "none"; 
}
