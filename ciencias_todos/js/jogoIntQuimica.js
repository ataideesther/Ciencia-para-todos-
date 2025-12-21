const correctAnswers = { 0: "Eletrosfera", 1: "Elétron", 2: "Núcleo" };

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
    ev.target.textContent = draggedElement.textContent; 
    ev.target.setAttribute("data-answer", draggedElement.textContent);
    updateProgress();
    draggedElement.style.opacity = "0.5";
    draggedElement.style.cursor = "default";
    draggedElement.setAttribute("draggable", "false");
    ev.target.style.backgroundColor = "white";
    
    // Adiciona animação de entrada
    ev.target.style.transform = "scale(1.1)";
    setTimeout(() => {
      ev.target.style.transform = "translateY(-2px)";
    }, 200);
  } 
}

function updateProgress() {
  const boxes = document.querySelectorAll('.drop-box[data-answer]');
  const progressBar = document.getElementById('progressBar');
  const progressText = document.querySelector('.progress-text');
  
  progressBar.style.width = (boxes.length / 3 * 100) + '%';
  progressText.textContent = `${boxes.length}/3 conceitos posicionados`;
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
  
  if (correct === 3) { 
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
  });
  
  // Reseta os elementos arrastáveis
  document.querySelectorAll('.draggable').forEach(drag => {
    drag.style.opacity = "1";
    drag.style.cursor = "grab";
    drag.setAttribute("draggable", "true");
  });
  
  // Reseta a barra de progresso
  document.getElementById('progressBar').style.width = '0%';
  document.querySelector('.progress-text').textContent = '0/3 conceitos posicionados';
}

// Inicialização das dicas ao passar o mouse sobre os conceitos
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.draggable').forEach((draggable, index) => {
    const tipId = "tip" + (index + 1);
    const tip = document.getElementById(tipId);
    
    draggable.addEventListener('mouseenter', () => {
      tip.classList.add('visible');
      tip.style.top = (draggable.offsetTop + draggable.offsetHeight) + 'px';
      tip.style.left = (draggable.offsetLeft + draggable.offsetWidth/2 - tip.offsetWidth/2) + 'px';
    });
    
    draggable.addEventListener('mouseleave', () => {
      tip.classList.remove('visible');
    });
  });
});