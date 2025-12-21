document.addEventListener('DOMContentLoaded', function () {
    const organisms = document.querySelectorAll('.organism');
    const dropSlots = document.querySelectorAll('.drop-slot');
    const confirmBtn = document.querySelector('.confirm-btn');
    const mensagemSucesso = document.getElementById('mensagem-sucesso');
    const mensagemErro = document.getElementById('mensagem-erro');
    const botaoTentar = document.getElementById('botao-tentar');
    const botaoInicio = document.getElementById('botao-inicio');
    let draggedItem = null;

    // Criar overlay (se não existir)
    let overlay = document.querySelector('.overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'overlay';
        document.body.appendChild(overlay);
    }

    const correctOrder = {
        1: 'sol',
        2: 'grama',
        3: 'gafanhoto',
        4: 'cobra',
        5: 'fungo'
    };

    function shuffleOrganisms() {
        const container = document.querySelector('.drag-items');
        const organisms = Array.from(container.children);

        for (let i = organisms.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [organisms[i], organisms[j]] = [organisms[j], organisms[i]];
        }

        organisms.forEach(organism => container.appendChild(organism));
    }

    shuffleOrganisms();

    organisms.forEach(organism => {
        organism.addEventListener('dragstart', dragStart);
        organism.addEventListener('dragend', dragEnd);
        organism.addEventListener('touchstart', touchStart, { passive: false });
        organism.addEventListener('touchmove', touchMove, { passive: false });
        organism.addEventListener('touchend', touchEnd);
    });

    dropSlots.forEach(slot => {
        slot.addEventListener('dragover', dragOver);
        slot.addEventListener('dragenter', dragEnter);
        slot.addEventListener('dragleave', dragLeave);
        slot.addEventListener('drop', drop);
    });

    function dragStart() {
        draggedItem = this;
        setTimeout(() => {
            this.classList.add('dragging');
            if (this.parentElement.classList.contains('drop-slot')) {
                this.parentElement.classList.remove('filled');
                this.parentElement.setAttribute('data-content', '');
            }
        }, 0);
    }

    function dragEnd() {
        this.classList.remove('dragging');
        draggedItem = null;
    }

    function dragOver(e) { e.preventDefault(); }

    function dragEnter(e) {
        e.preventDefault();
        this.classList.add('drag-over');
    }

    function dragLeave() {
        this.classList.remove('drag-over');
    }

    function drop() {
        this.classList.remove('drag-over');
        if (this.children.length > 0) return;
        if (draggedItem.parentElement.classList.contains('drop-slot')) {
            draggedItem.parentElement.classList.remove('filled');
            draggedItem.parentElement.setAttribute('data-content', '');
        }
        this.appendChild(draggedItem);
        this.classList.add('filled');
        this.setAttribute('data-content', draggedItem.getAttribute('data-type'));
        draggedItem.style.width = '100%';
        draggedItem.querySelector('img').style.width = '80px';
        draggedItem.querySelector('img').style.height = '80px';
    }

    function touchStart(e) {
        e.preventDefault();
        draggedItem = this;
        if (this.parentElement.classList.contains('drop-slot')) {
            this.parentElement.classList.remove('filled');
            this.parentElement.setAttribute('data-content', '');
        }
        this.classList.add('dragging');
        this.style.position = 'absolute';
        this.style.zIndex = 1000;
        moveAt(e.touches[0].clientX, e.touches[0].clientY);
        this.style.opacity = '0.9';
    }

    function touchMove(e) {
        e.preventDefault();
        if (draggedItem) {
            moveAt(e.touches[0].clientX, e.touches[0].clientY);
        }
    }

    function touchEnd(e) {
        if (!draggedItem) return;
        this.classList.remove('dragging');
        this.style.position = '';
        this.style.left = '';
        this.style.top = '';
        this.style.zIndex = '';
        this.style.opacity = '';
        let dropTarget = null;
        dropSlots.forEach(slot => {
            const rect = slot.getBoundingClientRect();
            const lastTouch = e.changedTouches[0];
            if (lastTouch.clientX >= rect.left && lastTouch.clientX <= rect.right &&
                lastTouch.clientY >= rect.top && lastTouch.clientY <= rect.bottom) {
                dropTarget = slot;
            }
        });
        if (dropTarget && dropTarget.children.length === 0) {
            dropTarget.appendChild(draggedItem);
            dropTarget.classList.add('filled');
            dropTarget.setAttribute('data-content', draggedItem.getAttribute('data-type'));
            draggedItem.style.width = '100%';
            draggedItem.querySelector('img').style.width = '80px';
            draggedItem.querySelector('img').style.height = '80px';
        } else {
            document.querySelector('.drag-items').appendChild(draggedItem);
            draggedItem.style.width = '160px';
            draggedItem.querySelector('img').style.width = '100px';
            draggedItem.querySelector('img').style.height = '100px';
        }
        draggedItem = null;
    }

    function moveAt(x, y) {
        const width = draggedItem.offsetWidth / 2;
        const height = draggedItem.offsetHeight / 2;
        draggedItem.style.left = (x - width) + 'px';
        draggedItem.style.top = (y - height) + 'px';
    }

    confirmBtn.addEventListener('click', checkAnswer);

    function checkAnswer() {
        let isCorrect = true;
        let allSlotsFilled = true;

        dropSlots.forEach(slot => {
            const position = slot.getAttribute('data-position');
            const content = slot.getAttribute('data-content');

            if (!content || content === '') {
                allSlotsFilled = false;
            }

            if (content && content !== correctOrder[position]) {
                isCorrect = false;
            }
        });

        if (!allSlotsFilled) {
            alert('Preencha todos os espaços antes de confirmar!');
            return;
        }

        showFeedback(isCorrect);
    }

    function showFeedback(isCorrect) {
        overlay.style.display = 'block';

        if (isCorrect) {
            mensagemSucesso.style.display = 'block';
        } else {
            mensagemErro.style.display = 'block';
        }
    }

    // Adicionar evento para o botão "Tentar Novamente"
    botaoTentar.addEventListener('click', function () {
        resetGame();
        hideFeedback();
    });

    botaoInicio.addEventListener('click', function () {
        window.location.href = 'paginaInicialAluno.php'; 
    });

    function hideFeedback() {
        mensagemSucesso.style.display = 'none';
        mensagemErro.style.display = 'none';
        overlay.style.display = 'none';
    }

    function resetGame() {
        dropSlots.forEach(slot => {
            if (slot.children.length > 0) {
                const organism = slot.children[0];
                document.querySelector('.drag-items').appendChild(organism);
                slot.classList.remove('filled');
                slot.setAttribute('data-content', '');
                organism.style.width = '160px';
                organism.querySelector('img').style.width = '100px';
                organism.querySelector('img').style.height = '100px';
            }
        });
        shuffleOrganisms();
    }
});