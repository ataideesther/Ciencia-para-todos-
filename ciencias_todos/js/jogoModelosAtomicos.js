// Drag and Drop básico
document.addEventListener('DOMContentLoaded', function() {
  const draggables = document.querySelectorAll('.draggable');
  const dropzones = document.querySelectorAll('.dropzone');
  const container = document.getElementById('opcoes');
  
  // Inicializa o estado das dropzones
  dropzones.forEach(zone => {
    zone.textContent = "";
  });

  // Embaralha as opções
  const opcoes = Array.from(container.querySelectorAll('.draggable'));
  embaralhar(opcoes);
  opcoes.forEach(opcao => container.querySelector('.linha-opcoes').appendChild(opcao));

  // Configuração dos eventos de arrastar
  draggables.forEach(elem => {
    elem.addEventListener('dragstart', function(e) {
      e.dataTransfer.setData('text/plain', e.target.textContent);
      e.target.classList.add('dragging');
    });
    
    elem.addEventListener('dragend', function() {
      this.classList.remove('dragging');
    });
  });

  // Configuração dos eventos das zonas de soltar
  dropzones.forEach(zone => {
    zone.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.classList.add('drag-over');
    });
    
    zone.addEventListener('dragleave', function() {
      this.classList.remove('drag-over');
    });
    
    zone.addEventListener('drop', function(e) {
      e.preventDefault();
      this.classList.remove('drag-over');
      const data = e.dataTransfer.getData('text/plain');
      this.textContent = data;
      this.classList.remove('green', 'red');
    });
  });
});

// Verificação de respostas
function verificar() {
  const modelos = document.querySelectorAll('.modelo');
  let totalCorretos = 0;

  modelos.forEach(modelo => {
    const zonas = modelo.querySelectorAll('.dropzone');
    const respostasUsuario = Array.from(zonas).map(zone => zone.textContent.trim().toLowerCase());
    const respostasCorretas = modelo.dataset.correto.toLowerCase().split('|');

    // Verifica se todas as respostas corretas estão nas respostas do usuário
    const todasCorretas = respostasCorretas.every(resposta => 
      respostasUsuario.includes(resposta));
    
    // Verifica se cada zona tem resposta correta
    zonas.forEach(zone => {
      if (respostasCorretas.includes(zone.textContent.trim().toLowerCase())) {
        zone.classList.add('green');
        zone.classList.remove('red');
      } else {
        zone.classList.add('red');
        zone.classList.remove('green');
      }
    });

    if (todasCorretas) {
      totalCorretos++;
    }
  });

  // Mostra feedback apropriado
  if (totalCorretos === modelos.length) {
    document.getElementById('overlay').classList.remove('hidden');
    document.getElementById('parabens').classList.remove('hidden');
  } else {
    document.getElementById('overlay').classList.remove('hidden');
    document.getElementById('erro').classList.remove('hidden');
  }
}

// Função para tentar novamente
function tentarNovamente() {
  document.getElementById('overlay').classList.add('hidden');
  document.getElementById('erro').classList.add('hidden');

  const zonas = document.querySelectorAll('.dropzone');
  zonas.forEach(zone => {
    zone.classList.remove('green', 'red');
  });
}

// Função para embaralhar array
function embaralhar(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}