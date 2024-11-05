//Asignamos variables
let buttonCatastro = document.getElementById("insert_ref");
let insertCatastro = document.getElementById("catastro");
let catastro = document.getElementById("catastro").value;
let regCatastro = /^[0-9]{5}[A-Z]{1}[0-9]{12}[A-Z]{2}/;

//Comprobamos expresiones regulares asignadas a cada campo y cambiamos el estilo de los inputs en caso de que no coincida
buttonCatastro.addEventListener("click", function () {
  let validCatastro = regCatastro.test(catastro);
  if (!validCatastro) {
    insertCatastro.style.border = "2px solid red";
    insertCatastro.style.borderRadius = "15px";
  }
});
