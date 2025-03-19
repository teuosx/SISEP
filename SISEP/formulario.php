<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição</title>
    <link rel="stylesheet" href="style - desenvolvedor.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="icon" href="logo.svg" type="image/svg">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Formulário de Inscrição</h1>
        </div>
        <form id="registrationForm" method="POST" action="inserir_dados.php">
            <!-- Dados Pessoais -->
            <div class="form-page active" id="page1">
                <div class="dados-pessoais">Dados Pessoais</div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
                <label for="curso_desejado" class="curso-desejado">Curso Desejado:</label>
                <select id="curso_desejado" name="curso_desejado" required>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "sisep_bd";

                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Conexão falhou: " . $conn->connect_error);
                        }

                        $sql = "SELECT nome FROM cursos";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhum curso disponível</option>";
                        }
                        $conn->close();
                    ?>
                </select>
                <label for="municipio">Município:</label>
                <input type="text" id="municipio" name="municipio" required>
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
                <div class="form-buttons">
                    <button type="button" class="proximo1" onclick="nextPage()">Próximo</button>
                </div>
            </div>
            <!-- Sexto Ano -->
            <div class="form-page" id="page2">
                <div class="sexto-ano">Sexto Ano</div>
                <label for="nota_portugues_sexto">Nota Português:</label>
                <input type="number" step="0.01" id="nota_portugues_sexto" name="nota_portugues_sexto" required>
                <label for="nota_matematica_sexto">Nota Matemática:</label>
                <input type="number" step="0.01" id="nota_matematica_sexto" name="nota_matematica_sexto" required>
                <label for="nota_historia_sexto">Nota História:</label>
                <input type="number" step="0.01" id="nota_historia_sexto" name="nota_historia_sexto" required>
                <label for="nota_geografia_sexto">Nota Geografia:</label>
                <input type="number" step="0.01" id="nota_geografia_sexto" name="nota_geografia_sexto" required>
                <label for="nota_ciencias_sexto">Nota Ciências:</label>
                <input type="number" step="0.01" id="nota_ciencias_sexto" name="nota_ciencias_sexto" required>
                <label for="nota_artes_sexto">Nota Artes:</label>
                <input type="number" step="0.01" id="nota_artes_sexto" name="nota_artes_sexto" required>
                <label for="nota_religioso_sexto">Nota Ensino Religioso:</label>
                <input type="number" step="0.01" id="nota_religioso_sexto" name="nota_religioso_sexto" required>
                <label for="nota_ed_fisica_sexto">Nota Educação Física:</label>
                <input type="number" step="0.01" id="nota_ed_fisica_sexto" name="nota_ed_fisica_sexto" required>
                <label for="nota_ingles_sexto">Nota Inglês:</label>
                <input type="number" step="0.01" id="nota_ingles_sexto" name="nota_ingles_sexto" required>
                <div class="form-buttons">
                    <button type="button" onclick="prevPage()">Voltar</button>
                    <button type="button" onclick="nextPage()">Próximo</button>
                </div>
            </div>
            <!-- Sétimo Ano -->
            <div class="form-page" id="page3">
                <div class="setimo-ano">Sétimo Ano</div>
                <label for="nota_portugues_setimo">Nota Português:</label>
                <input type="number" step="0.01" id="nota_portugues_setimo" name="nota_portugues_setimo" required>
                <label for="nota_matematica_setimo">Nota Matemática:</label>
                <input type="number" step="0.01" id="nota_matematica_setimo" name="nota_matematica_setimo" required>
                <label for="nota_historia_setimo">Nota História:</label>
                <input type="number" step="0.01" id="nota_historia_setimo" name="nota_historia_setimo" required>
                <label for="nota_geografia_setimo">Nota Geografia:</label>
                <input type="number" step="0.01" id="nota_geografia_setimo" name="nota_geografia_setimo" required>
                <label for="nota_ciencias_setimo">Nota Ciências:</label>
                <input type="number" step="0.01" id="nota_ciencias_setimo" name="nota_ciencias_setimo" required>
                <label for="nota_artes_setimo">Nota Artes:</label>
                <input type="number" step="0.01" id="nota_artes_setimo" name="nota_artes_setimo" required>
                <label for="nota_religioso_setimo">Nota Ensino Religioso:</label>
                <input type="number" step="0.01" id="nota_religioso_setimo" name="nota_religioso_setimo" required>
                <label for="nota_ed_fisica_setimo">Nota Educação Física:</label>
                <input type="number" step="0.01" id="nota_ed_fisica_setimo" name="nota_ed_fisica_setimo" required>
                <label for="nota_ingles_setimo">Nota Inglês:</label>
                <input type="number" step="0.01" id="nota_ingles_setimo" name="nota_ingles_setimo" required>
                <div class="form-buttons">
                    <button type="button" onclick="prevPage()">Voltar</button>
                    <button type="button" onclick="nextPage()">Próximo</button>
                </div>
            </div>
            <!-- Oitavo Ano -->
            <div class="form-page" id="page4">
                <div class="oitavo-ano">Oitavo Ano</div>
                <label for="nota_portugues_oitavo">Nota Português:</label>
                <input type="number" step="0.01" id="nota_portugues_oitavo" name="nota_portugues_oitavo" required>
                <label for="nota_matematica_oitavo">Nota Matemática:</label>
                <input type="number" step="0.01" id="nota_matematica_oitavo" name="nota_matematica_oitavo" required>
                <label for="nota_historia_oitavo">Nota História:</label>
                <input type="number" step="0.01" id="nota_historia_oitavo" name="nota_historia_oitavo" required>
                <label for="nota_geografia_oitavo">Nota Geografia:</label>
                <input type="number" step="0.01" id="nota_geografia_oitavo" name="nota_geografia_oitavo" required>
                <label for="nota_ciencias_oitavo">Nota Ciências:</label>
                <input type="number" step="0.01" id="nota_ciencias_oitavo" name="nota_ciencias_oitavo" required>
                <label for="nota_artes_oitavo">Nota Artes:</label>
                <input type="number" step="0.01" id="nota_artes_oitavo" name="nota_artes_oitavo" required>
                <label for="nota_religioso_oitavo">Nota Ensino Religioso:</label>
                <input type="number" step="0.01" id="nota_religioso_oitavo" name="nota_religioso_oitavo" required>
                <label for="nota_ed_fisica_oitavo">Nota Educação Física:</label>
                <input type="number" step="0.01" id="nota_ed_fisica_oitavo" name="nota_ed_fisica_oitavo" required>
                <label for="nota_ingles_oitavo">Nota Inglês:</label>
                <input type="number" step="0.01" id="nota_ingles_oitavo" name="nota_ingles_oitavo" required>
                <div class="form-buttons">
                    <button type="button" onclick="prevPage()">Voltar</button>
                    <button type="button" onclick="nextPage()">Próximo</button>
                </div>
            </div>
            <!-- Nono Ano -->
            <div class="form-page" id="page5">
                <div class="nono-ano">Nono Ano</div>
                <label for="nota_portugues_nono">Nota Português:</label>
                <input type="number" step="0.01" id="nota_portugues_nono" name="nota_portugues_nono" required>
                <label for="nota_matematica_nono">Nota Matemática:</label>
                <input type="number" step="0.01" id="nota_matematica_nono" name="nota_matematica_nono" required>
                <label for="nota_historia_nono">Nota História:</label>
                <input type="number" step="0.01" id="nota_historia_nono" name="nota_historia_nono" required>
                <label for="nota_geografia_nono">Nota Geografia:</label>
                <input type="number" step="0.01" id="nota_geografia_nono" name="nota_geografia_nono" required>
                <label for="nota_ciencias_nono">Nota Ciências:</label>
                <input type="number" step="0.01" id="nota_ciencias_nono" name="nota_ciencias_nono" required>
                <label for="nota_artes_nono">Nota Artes:</label>
                <input type="number" step="0.01" id="nota_artes_nono" name="nota_artes_nono" required>
                <label for="nota_religioso_nono">Nota Ensino Religioso:</label>
                <input type="number" step="0.01" id="nota_religioso_nono" name="nota_religioso_nono" required>
                <label for="nota_ed_fisica_nono">Nota Educação Física:</label>
                <input type="number" step="0.01" id="nota_ed_fisica_nono" name="nota_ed_fisica_nono" required>
                <label for="nota_ingles_nono">Nota Inglês:</label>
                <input type="number" step="0.01" id="nota_ingles_nono" name="nota_ingles_nono" required>
                <div class="form-buttons">
                    <button type="button" onclick="prevPage()">Voltar</button>
                    <button type="button" onclick="nextPage()">Próximo</button>
                </div>
            </div>
            <!-- Cotas -->
            <div class="form-page" id="page6">
                <div class="cotas">Cotas</div>
                <select id="cotas" name="cotas">
                    <option value="0">Não se enquadra em nenhuma cota</option>
                    <option value="1">Deficiente</option>
                    <option value="2">Escola Privada</option>
                    <option value="3">Localidade</option>
                </select>
                <div class="form-buttons">
                    <button type="button" onclick="prevPage()">Voltar</button>
                    <button type="submit" class="finalizar">Finalizar</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        var currentPage = 0;
        var formPages = document.querySelectorAll('.form-page');

        function nextPage() {
            if (currentPage < formPages.length - 1) { 
                formPages[currentPage].classList.remove('active'); 
                currentPage++; 
                formPages[currentPage].classList.add('active'); 
            }
        }

        function prevPage() {
            if (currentPage > 0) { 
                formPages[currentPage].classList.remove('active'); 
                currentPage--;
                formPages[currentPage].classList.add('active');
            }
        }
    </script>
</body>
</html>
