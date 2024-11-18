// Seleciona os campos e o elemento de exibição
const valorComprado = document.getElementById("Valor_Comprado");
const porcentagem = document.getElementById("Porcentagem");
const valorFinal = document.getElementById("valorFinal");

// Função para calcular e atualizar o valor final
function calcularValorFinal() {
    const valor = parseFloat(valorComprado.value) || 0; // Obtém o valor comprado
    const porc = parseFloat(porcentagem.value) || 0;    // Obtém a porcentagem

    // Calcula o valor final
    const resultado = valor + (valor * (porc / 100));

    // Atualiza o texto do elemento HTML em tempo real
    valorFinal.textContent = `Valor Final: R$ ${resultado.toFixed(2)}`;
}

// Monitora alterações em ambos os campos
valorComprado.addEventListener("input", calcularValorFinal);
porcentagem.addEventListener("input", calcularValorFinal);
