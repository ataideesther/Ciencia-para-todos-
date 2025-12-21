<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cienciadb";

$conexao = new mysqli($servername, $username, $password, $dbname);
if ($conexao->connect_error) {
  die("Conexão falhou: " . $conexao->connect_error);
}

$alunosOptions = "";
$sqlAlunos = "SELECT id, nome FROM cadastro WHERE id_professor = 0";
$resultAlunos = $conexao->query($sqlAlunos);
if ($resultAlunos->num_rows > 0) {
  while ($row = $resultAlunos->fetch_assoc()) {
    $id = htmlspecialchars($row["id"]);
    $nome = htmlspecialchars($row["nome"]);
    $alunosOptions .= "<option value='$id'>$nome</option>";
  }
} else {
  $alunosOptions .= "<option value=''>Nenhum aluno encontrado</option>";
}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="css/criarturma.css" />
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon" />
  <title>Ciência para Todos</title>
</head>

<body>

  <?php include_once('menuProfessor.php'); ?>

  <header>
    Criar Turma
  </header>

  <section class="form-container">
    <!-- Corrigi o caminho do action para o arquivo PHP -->
    <form action="gravar_turma.php" method="POST">
      <!-- Dados da Turma -->
      <div class="form-group">
        <label for="nome-turma">Nome da Turma:</label>
        <input type="text" id="nome-turma" name="nome_turma" required placeholder="Digite o nome da turma" />
      </div>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "cienciadb";

      $conexao = new mysqli($servername, $username, $password, $dbname);

      if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
      }
      $sql = "SELECT id_trilha, nome_trilha FROM trilhas";
      $result = $conexao->query($sql);
      ?>
      <div class="form-group">
        <label for="curso">Trilha:</label>
        <select id="curso" name="curso" required>
          <option value="">Selecione a trilha</option>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . htmlspecialchars($row["id_trilha"]) . '">' . htmlspecialchars($row["nome_trilha"]) . '</option>';
            }
          } else {
            echo '<option value="">Nenhuma trilha encontrada</option>';
          }
          ?>
        </select>
      </div>

      <?php
      $conexao->close();
      ?>

      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "cienciadb";

      $conexao = new mysqli($servername, $username, $password, $dbname);

      if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
      }

      $sql = "SELECT id, nome FROM cadastro WHERE id_professor = 1";
      $result = $conexao->query($sql);
      ?>

      <div class="form-group">
        <label for="cadastro">Selecionar Professor(a):</label>
        <select id="cadastro" name="cadastro" required>
          <option value="">Selecione um(a) professor(a)</option>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["nome"]) . '</option>';
            }
          } else {
            echo '<option value="">Nenhum cadastro encontrado</option>';
          }
          ?>
        </select>
      </div>

      <?php
      $conexao->close();
      ?>


      <!-- Adicionar Alunos -->
      <div class="form-group">
        <label>Alunos:</label>
        <div id="alunos-container">
          <!-- Aluno inicial -->
          <div class="aluno-linha">
            <select name="aluno_id[]" required>
              <option value="">Selecione um aluno</option>
              <?php echo $alunosOptions; ?>
            </select>
            <button type="button" class="remover-aluno" onclick="removerAluno(this)">Remover</button>
          </div>
        </div>
        <button type="button" id="adicionar-aluno">Adicionar Aluno</button>
      </div>


      <button type="submit">Criar Turma</button>
    </form>
  </section>

  <script>
    const btnAdicionar = document.getElementById('adicionar-aluno');
  const container = document.getElementById('alunos-container');

  // Armazena as opções PHP como string JS
  const alunosOptions = `<?php echo addslashes($alunosOptions); ?>`;

  btnAdicionar.addEventListener('click', () => {
    const div = document.createElement('div');
    div.classList.add('aluno-linha');
    div.innerHTML = `
      <select name="aluno_id[]" required>
        <option value="">Selecione um aluno</option>
        ${alunosOptions}
      </select>
      <button type="button" class="remover-aluno" onclick="removerAluno(this)">Remover</button>
    `;
    container.appendChild(div);
  });

  function removerAluno(btn) {
    btn.parentElement.remove();
  }

  </script>

</body>

</html>