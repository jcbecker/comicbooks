function Mudarestado(el) {
var display = document.getElementById(el).style.display;
if(display == "none")
    document.getElementById(el).style.display = 'block';
else
    document.getElementById(el).style.display = 'none';
}

function contarCaracteres(box,valor,campospan,myself){
    var conta = valor - box.length;
    document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + " caracteres";
    if(box.length >= valor){
        document.getElementById(campospan).innerHTML = "Opss.. você não pode mais digitar..";
        document.getElementById(myself).value = document.getElementById(myself).value.substr(0,valor);
    }	
}
