//Asignamos variables
let buttonCosecha = document.getElementById("insert_cosecha");
let insertPeso = document.getElementById("peso");
let insertRendimiento = document.getElementById("rendimiento");
let peso = document.getElementById("peso").value;
let rendimiento = document.getElementById("rendimiento").value;
let regPeso = /[0-9]+/;
let regRendimiento = /[0-9]{2,2}/;

//Comprobamos expresiones regulares asignadas a cada campo y cambiamos el estilo de los inputs en caso de que no coincida
buttonCosecha.addEventListener("click", function () {
  let validPeso = regPeso.test(peso);
  let validRendimiento = regRendimiento.test(rendimiento);

  if (!validPeso) {
    insertPeso.style.border = "2px solid red";
    insertPeso.style.borderRadius = "15px";
  }

  if (!validRendimiento) {
    insertRendimiento.style.border = "2px solid red";
    insertRendimiento.style.borderRadius = "15px";
  }
});
