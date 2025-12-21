const correctAnswers = {
  0: "Substância Pura",
  1: "Mistura Homogênea",
  2: "Mistura Heterogênea",
  3: "Substância Composta"
};

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  const data = ev.dataTransfer.getData("text");
  const draggedElement = document.getElementById(data);

  if (ev.target.classList.contains('drop-box')) {
    // Remove o texto de qualquer outra dropbox que tenha o mesmo conteúdo
    document.querySelectorAll('.drop-box').forEach(box => {
      if (box.textContent === draggedElement.textContent) {
        box.textContent = '';
        box.removeAttribute("data-answer");
        box.style.backgroundColor = "white";
      }
    });

    ev.target.textContent = draggedElement.textContent;
    ev.target.setAttribute("data-answer", draggedElement.textContent);
    updateProgress();

    // Efeito visual ao soltar
    ev.target.style.transform = "scale(1.05)";
    setTimeout(() => {
      ev.target.style.transform = "translateY(-2px)";
    }, 200);
  }
}

function updateProgress() {
  const boxes = document.querySelectorAll('.drop-box[data-answer]');
  const progressBar = document.getElementById('progressBar');
  const progressText = document.querySelector('.progress-text');

  const progress = (boxes.length / 4 * 100);
  progressBar.style.width = progress + '%';
  progressText.textContent = `${boxes.length}/4 conceitos posicionados`;

  // Muda a cor da barra conforme o progresso
  if (progress >= 75) {
    progressBar.style.backgroundColor = '#4CAF50'; // verde
  } else if (progress >= 50) {
    progressBar.style.backgroundColor = '#FFC107'; // amarelo
  } else {
    progressBar.style.backgroundColor = '#FF9800'; // laranja
  }
}

function checkAnswers() {
  let correct = 0;
  document.querySelectorAll('.drop-box').forEach(box => {
    const index = box.getAttribute('data-index');
    const answer = box.getAttribute('data-answer');

    if (answer === correctAnswers[index]) {
      box.style.backgroundColor = '#80e2a7'; // verde
      correct++;
    } else {
      box.style.backgroundColor = '#f66'; // vermelho
    }
  });

  document.getElementById("overlay").classList.remove("hidden");

  if (correct === 4) {
    document.getElementById("parabens").classList.remove("hidden");
    document.getElementById("erro").classList.add("hidden");
  } else {
    document.getElementById("erro").classList.remove("hidden");
    document.getElementById("parabens").classList.add("hidden");
  }
}

function tentarNovamente() {
  document.getElementById("erro").classList.add("hidden");
  document.getElementById("overlay").classList.add("hidden");

  document.querySelectorAll('.drop-box').forEach(box => {
    box.textContent = "";
    box.removeAttribute("data-answer");
    box.style.backgroundColor = "white";
    box.style.transform = "none";
  });

  // Reseta a barra de progresso
  document.getElementById('progressBar').style.width = '0%';
  document.querySelector('.progress-text').textContent = '0/4 conceitos posicionados';
}

function closeFeedback() {
  document.getElementById("parabens").classList.add("hidden");
  document.getElementById("overlay").classList.add("hidden");
}

// Inicialização das dicas ao passar o mouse sobre os conceitos
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.draggable').forEach((draggable, index) => {
    const tipId = "tip" + (index + 1);
    const tip = document.getElementById(tipId);

    draggable.addEventListener('mouseenter', () => {
      tip.classList.add('visible');
      tip.style.top = (draggable.offsetTop + draggable.offsetHeight + 5) + 'px';
      tip.style.left = draggable.offsetLeft + 'px';
    });

    draggable.addEventListener('mouseleave', () => {
      tip.classList.remove('visible');
    });
  });
});