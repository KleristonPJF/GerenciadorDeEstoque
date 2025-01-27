const valorComprado = document.getElementById("Valor_Comprado");
const porcentagem = document.getElementById("Porcentagem");
const valorFinal = document.getElementById("valorFinal");

function calcularValorFinal() {
    const valor = parseFloat(valorComprado.value) || 0; 
    const porc = parseFloat(porcentagem.value) || 0;    

    const resultado = valor + (valor * (porc / 100));

    valorFinal.textContent = `Valor Final: R$ ${resultado.toFixed(2)}`;
}


valorComprado.addEventListener("input", calcularValorFinal);
porcentagem.addEventListener("input", calcularValorFinal);
