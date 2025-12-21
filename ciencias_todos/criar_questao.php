<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="css/criarquestao.css" />
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon" />
    <title>Criar Questão</title>
    
</head>
<body>

    <?php   
        include_once('menuProfessor.php');  
    ?>
    <header>Criar Nova Questão</header>
    
    <div id="successMessage" class="mensagem success">
        Questão criada com sucesso!
    </div>
    
    <div id="errorMessage" class="mensagem error">
        Ocorreu um erro ao criar a questão. Por favor, tente novamente.
    </div>
    
    <div class="form-container">
        <form id="questaoForm">
            <div class="form-group">
                <label for="trilha">Trilha:</label>
                <select id="trilha" name="trilha" required>
                    <option value="">Selecione uma trilha</option>
                    <option value="1">Introdução à Química</option>
                    <option value="2">Modelos Atômicos</option>
                    <option value="3">Tabela Periódica</option>
                    <option value="4">Ligações Químicas</option>
                    <option value="5">Citologia</option>
                    <option value="6">Ecologia</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="enunciado">Enunciado da questão:</label>
                <textarea id="enunciado" name="enunciado" required placeholder="Digite o enunciado da questão aqui..."></textarea>
            </div>
            
            <div class="form-group">
                <label>Alternativas:</label>
                <div class="alternativas-container">
                    <div class="alternativa">
                        <label>A)</label>
                        <input type="text" id="alternativa_a" name="alternativa_a" required placeholder="Digite a alternativa A">
                        <div class="radio-group">
                            <input type="radio" name="correta" value="A" required>
                            <span>Correta</span>
                        </div>
                    </div>
                    
                    <div class="alternativa">
                        <label>B)</label>
                        <input type="text" id="alternativa_b" name="alternativa_b" required placeholder="Digite a alternativa B">
                        <div class="radio-group">
                            <input type="radio" name="correta" value="B">
                            <span>Correta</span>
                        </div>
                    </div>
                    
                    <div class="alternativa">
                        <label>C)</label>
                        <input type="text" id="alternativa_c" name="alternativa_c" required placeholder="Digite a alternativa C">
                        <div class="radio-group">
                            <input type="radio" name="correta" value="C">
                            <span>Correta</span>
                        </div>
                    </div>
                    
                    <div class="alternativa">
                        <label>D)</label>
                        <input type="text" id="alternativa_d" name="alternativa_d" required placeholder="Digite a alternativa D">
                        <div class="radio-group">
                            <input type="radio" name="correta" value="D">
                            <span>Correta</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit">Salvar Questão</button>
        </form>
    </div>

    <script>
        document.getElementById('questaoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('criarQuestao.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('errorMessage').style.display = 'none';
                    document.getElementById('questaoForm').reset();
                    
                    // Esconde a mensagem de sucesso após 3 segundos
                    setTimeout(() => {
                        document.getElementById('successMessage').style.display = 'none';
                    }, 3000);
                } else {
                    document.getElementById('errorMessage').style.display = 'block';
                    document.getElementById('successMessage').style.display = 'none';
                    
                    // Esconde a mensagem de erro após 3 segundos
                    setTimeout(() => {
                        document.getElementById('errorMessage').style.display = 'none';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('errorMessage').style.display = 'block';
                document.getElementById('successMessage').style.display = 'none';
                
                // Esconde a mensagem de erro após 3 segundos
                setTimeout(() => {
                    document.getElementById('errorMessage').style.display = 'none';
                }, 3000);
            });
        });
    </script>
</body>
</html>