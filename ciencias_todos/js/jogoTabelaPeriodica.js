window.onload = function() {
  const opcoes = [
    'Hidrogênio', 'Ouro', 'Ferro', 'Carbono', 'Urânio', 'Lítio', 'Prata',
    'Mercúrio', 'Nitrogênio', 'Oxigênio', 'Fósforo', 'Alumínio'
  ];

  function embaralhar(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }

  const selects = document.querySelectorAll('.item select');
  selects.forEach(select => {
    const opcoesEmbaralhadas = embaralhar([...opcoes]);
    opcoesEmbaralhadas.forEach(op => {
      const option = document.createElement('option');
      option.value = op;
      option.textContent = op;
      select.appendChild(option);
    });
  });
};

// Função para verificar respostas
function verificarRespostas() {
  const selects = document.querySelectorAll('.item select');
  let acertos = 0;
  let total = selects.length;

  selects.forEach((select) => {
    const item = select.closest('.item');
    const respostaCorreta = item.getAttribute('data-answer');

    // Resetar estilos
    select.style.backgroundColor = '';
    select.style.color = '';

    if (select.value === respostaCorreta) {
      select.style.backgroundColor = '#28a745';
      select.style.color = 'white';
      acertos++;
    } else {
      select.style.backgroundColor = '#dc3545';
      select.style.color = 'white';
    }
  });

  // Exibir feedback apropriado
  if (acertos === total) {
    document.getElementById('success-feedback').style.display = 'flex';
  } else {
    document.getElementById('error-feedback').style.display = 'flex';
  }
}

// Função para tentar novamente
function tentarNovamente() {
  document.getElementById('error-feedback').style.display = 'none';
  
  // Resetar estilos dos selects
  document.querySelectorAll('.item select').forEach(select => {
    select.style.backgroundColor = '';
    select.style.color = '';
  });
}

// Função para ir para o próximo módulo
function proximoModulo() {
  window.location.href = 'ligacoesQuimicas.php';
}

// Função para voltar à página inicial
function irParaInicio() {
  window.location.href = 'paginaInicialAluno.php';
}