<?php

function calcular_media_anual($notas) {
    $notas_validas = array_filter($notas, fn($nota) => $nota !== null);
    $total_notas = count($notas_validas);
    $soma_notas = array_sum($notas_validas);
    return $total_notas > 0 ? $soma_notas / $total_notas : 0;
}

function exibir_tabela($alunos, $titulo, $limite_classificados) {
    echo "<h2>$titulo</h2>";
    
    if (empty($alunos)) {
        echo "<p>Não há alunos classificados para exibir.</p>";
    } else {
        echo "<table>";
        echo "<tr><th>CLASSIFICAÇÃO</th><th>Nº INSCRIÇÃO</th><th>NOME DO ALUNO</th><th>MÉDIA</th><th>RESULTADO PRELIMINAR</th></tr>";
        foreach ($alunos as $aluno) {
            echo "<tr>";
            echo "<td>" . $aluno['posicao'] . "º</td>";
            echo "<td>" . $aluno['n_inscricao'] . "</td>";
            echo "<td style='width: 30%;'>" . $aluno['nome'] . "</td>";
            echo "<td>" . number_format($aluno['media'], 2) . "</td>";
            echo "<td>" . $aluno['classificacao'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

function obter_dados() {
    $conn = new mysqli("localhost", "root", "", "sisep_bd");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT dp.n_inscricao, dp.nome, dp.curso_desejado,
               c.deficiente, c.escola_privada, c.localidade, c.ampla_concorrencia,
               s.nota_portugues_sexto, s.nota_matematica_sexto, s.nota_historia_sexto, 
               s.nota_geografia_sexto, s.nota_ciencias_sexto, s.nota_artes_sexto, 
               s.nota_religioso_sexto, s.nota_ingles_sexto, s.nota_ed_fisica_sexto,
               st.nota_portugues_setimo, st.nota_matematica_setimo, st.nota_historia_setimo, 
               st.nota_geografia_setimo, st.nota_ciencias_setimo, st.nota_artes_setimo, 
               st.nota_religioso_setimo, st.nota_ingles_setimo, st.nota_ed_fisica_setimo,
               o.nota_portugues_oitavo, o.nota_matematica_oitavo, o.nota_historia_oitavo, 
               o.nota_geografia_oitavo, o.nota_ciencias_oitavo, o.nota_artes_oitavo, 
               o.nota_religioso_oitavo, o.nota_ingles_oitavo, o.nota_ed_fisica_oitavo,
               n.nota_portugues_nono, n.nota_matematica_nono, n.nota_historia_nono, 
               n.nota_geografia_nono, n.nota_ciencias_nono, n.nota_artes_nono, 
               n.nota_religioso_nono, n.nota_ingles_nono, n.nota_ed_fisica_nono
        FROM dados_pessoais dp
        LEFT JOIN sexto_ano s ON dp.n_inscricao = s.n_inscricao
        LEFT JOIN setimo_ano st ON dp.n_inscricao = st.n_inscricao
        LEFT JOIN oitavo_ano o ON dp.n_inscricao = o.n_inscricao
        LEFT JOIN nono_ano n ON dp.n_inscricao = n.n_inscricao
        LEFT JOIN cotas c ON dp.n_inscricao = c.n_inscricao";

    $result = $conn->query($sql);

    $alunos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $notas_sexto = [
                $row['nota_portugues_sexto'], $row['nota_matematica_sexto'], $row['nota_historia_sexto'],
                $row['nota_geografia_sexto'], $row['nota_ciencias_sexto'], $row['nota_artes_sexto'],
                $row['nota_religioso_sexto'], $row['nota_ingles_sexto'], $row['nota_ed_fisica_sexto']
            ];
            $notas_setimo = [
                $row['nota_portugues_setimo'], $row['nota_matematica_setimo'], $row['nota_historia_setimo'],
                $row['nota_geografia_setimo'], $row['nota_ciencias_setimo'], $row['nota_artes_setimo'],
                $row['nota_religioso_setimo'], $row['nota_ingles_setimo'], $row['nota_ed_fisica_setimo']
            ];
            $notas_oitavo = [
                $row['nota_portugues_oitavo'], $row['nota_matematica_oitavo'], $row['nota_historia_oitavo'],
                $row['nota_geografia_oitavo'], $row['nota_ciencias_oitavo'], $row['nota_artes_oitavo'],
                $row['nota_religioso_oitavo'], $row['nota_ingles_oitavo'], $row['nota_ed_fisica_oitavo']
            ];
            $notas_nono = [
                $row['nota_portugues_nono'], $row['nota_matematica_nono'], $row['nota_historia_nono'],
                $row['nota_geografia_nono'], $row['nota_ciencias_nono'], $row['nota_artes_nono'],
                $row['nota_religioso_nono'], $row['nota_ingles_nono'], $row['nota_ed_fisica_nono']
            ];

            $media_sexto = calcular_media_anual($notas_sexto);
            $media_setimo = calcular_media_anual($notas_setimo);
            $media_oitavo = calcular_media_anual($notas_oitavo);
            $media_nono = calcular_media_anual($notas_nono);

            $media_final = ($media_sexto + $media_setimo + $media_oitavo + $media_nono) / 4;

            $curso = $row['curso_desejado'];
            $cota = '';
            if ($row['ampla_concorrencia'] == 1) {
                $cota = 'Ampla Concorrência';
            } elseif ($row['deficiente'] == 1) {
                $cota = 'Deficiente';
            } elseif ($row['escola_privada'] == 1) {
                $cota = 'Escola Privada';
            } elseif ($row['localidade'] != null) {
                $cota = 'Localidade';
            }

            if (!isset($alunos[$curso][$cota])) {
                $alunos[$curso][$cota] = [];
            }
            $alunos[$curso][$cota][] = [
                'n_inscricao' => $row['n_inscricao'],
                'nome' => $row['nome'],
                'media' => $media_final,
                'classificacao' => ''
            ];
        }
    }

    foreach ($alunos as $curso => &$alunos_por_cota) {
        foreach ($alunos_por_cota as $cota => &$alunos_da_cota) {
            usort($alunos_da_cota, function($a, $b) {
                return $b['media'] <=> $a['media'];
            });

            $limite_classificados = 45;
            foreach ($alunos_da_cota as $index => &$aluno) {
                $aluno['posicao'] = $index + 1;
                if ($index < $limite_classificados) {
                    $aluno['classificacao'] = "Classificado";
                } else {
                    $aluno['classificacao'] = "Classificável";
                }
            }
        }
    }

    $conn->close();

    return $alunos;
}

$alunos_por_curso = obter_dados();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />
    <title>Ranqueamento</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px; 
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ranqueamento de Alunos por Curso</h1>
        <?php
        foreach ($alunos_por_curso as $curso => $alunos_por_cota) {
            foreach ($alunos_por_cota as $cota => $alunos) {
                $titulo = "$curso - $cota";
                if ($cota == 'Localidade') {
                    $localidade = isset($alunos[0]['localidade']) ? $alunos[0]['localidade'] : '';
                    if (!empty($localidade)) {
                        $titulo .= " ($localidade)";
                    }
                }
                exibir_tabela($alunos, $titulo, 45);
            }
        }
        ?>
    </div>
</body>
</html>
