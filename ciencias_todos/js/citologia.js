const organelasInfo = {
    // Célula Vegetal
    "nucleo-veg": {
        titulo: "Núcleo",
        descricao: "É o centro da célula. Ele guarda as informações que mandam no funcionamento da célula."
    },
    "vacuolo-veg": {
        titulo: "Vacúolo",
        descricao: "É como um reservatório. Guarda água, comida e restos. Ajuda a manter a célula firme."
    },
    "cloroplasto-veg": {
        titulo: "Cloroplasto",
        descricao: "É onde a planta faz comida (ATP) com a luz do sol. Tem uma substância verde chamada clorofila."
    },
    "reticulo-veg": {
        titulo: "Retículo Endoplasmático",
        descricao: "É uma rede que leva substâncias para outras partes da célula. Pode ter pontinhos (ribossomos) ou não."
    },
    "citoplasma-veg": {
        titulo: "Citoplasma",
        descricao: "É um gel que preenche a célula. As organelas ficam dentro dele."
    },
    "mitocondria-veg": {
        titulo: "Mitocôndria",
        descricao: "É onde a célula produz energia(ATP). A energia vem dos alimentos."
    },
    "lisossomo-veg": {
        titulo: "Lisossomo",
        descricao: "É como um 'lixinho'. Ele quebra restos de comida e partes velhas da célula."
    },
    "ribossomo-veg": {
        titulo: "Ribossomo",
        descricao: "Faz proteínas, que são importantes para a célula funcionar bem."
    },
    "parede-veg": {
        titulo: "Parede Celular",
        descricao: "Fica por fora da célula. É dura e protege. Dá forma à célula da planta."
    },

    // Célula Animal
    "nucleo-ani": {
        titulo: "Núcleo",
        descricao: "É o centro da célula. Ele guarda as informações que mandam no funcionamento da célula."
    },
    "lisossomo-ani": {
        titulo: "Lisossomo",
        descricao: "É como um 'lixinho'. Ele quebra restos de comida e partes velhas da célula."
    },
    "ribossomo-ani": {
        titulo: "Ribossomo",
        descricao: "Faz proteínas, que são importantes para a célula funcionar bem."
    },
    "reticulo-ani": {
        titulo: "Retículo Endoplasmático",
        descricao: "É uma rede que leva substâncias para outras partes da célula. Pode ter pontinhos (ribossomos) ou não."
    },
    "citoplasma-ani": {
        titulo: "Citoplasma",
        descricao: "É um gel que preenche a célula. As organelas ficam dentro dele."
    },
    "mitocondria-ani": {
        titulo: "Mitocôndria",
        descricao: "É onde a célula produz energia. A energia vem dos alimentos."
    },
    "golgi-ani": {
        titulo: "Complexo de Golgi",
        descricao: "Empacota e envia proteínas feitas pela célula para onde elas precisam ir."
    },
    "centriolo-ani": {
        titulo: "Centríolo",
        descricao: "Ajuda a célula a se dividir. Só existe em células animais."
    },
    "membrana-ani": {
        titulo: "Membrana Plasmática",
        descricao: "Envolve a célula. Controla o que pode entrar e sair dela."
    }
};


// Configurar os popups para cada organela
const popup = document.getElementById("popup");
const popupTitle = document.getElementById("popup-title");
const popupContent = document.getElementById("popup-content");
const closeBtn = document.getElementsByClassName("close")[0];

// Adicionar evento de clique a todas as partes da célula
const cellParts = document.querySelectorAll(".cell-part");
cellParts.forEach(part => {
    part.addEventListener("click", function () {
        const info = organelasInfo[this.id];
        if (info) {
            popupTitle.innerText = info.titulo;
            popupContent.innerText = info.descricao;
            popup.style.display = "block";
        }
    });
});

// Fechar o popup ao clicar no X
closeBtn.addEventListener("click", function () {
    popup.style.display = "none";
});

// Fechar o popup ao clicar fora dele
window.addEventListener("click", function (event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
});