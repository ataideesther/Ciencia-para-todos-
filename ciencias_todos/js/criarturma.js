// Adicionar Aluno
document.getElementById('adicionar-aluno').addEventListener('click', function() {
  const alunoTable = document.getElementById('alunoTable');
  const novaLinha = document.createElement('tr');
  novaLinha.innerHTML = `
      <td><input type="text" name="aluno_nome[]" placeholder="Nome do Aluno" required /></td>
      <td><button type="button" class="remover-aluno">Remover</button></td>
  `;
  alunoTable.appendChild(novaLinha);

  // Adicionar funcionalidade para remover aluno
  novaLinha.querySelector('.remover-aluno').addEventListener('click', function() {
      novaLinha.remove();
  });
});
