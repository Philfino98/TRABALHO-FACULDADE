<?php

include '../config/database.php';
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
    header("Location: ../../../index.html");
    exit;
}

$usuario_id = $_SESSION['user_id'];
$mensagem = "";

$sql = "SELECT * FROM atendimentos WHERE usuario_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$atendimento = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $nome_pet = $_POST['nome-pet'] ?? '';
    $pet = $_POST['pet'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $assunto = $_POST['assunto'] ?? '';
    $mensagem_form = $_POST['mensagem'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $horario = $_POST['horario'] ?? '';

    if ($atendimento) {
        $update = "UPDATE atendimentos 
                   SET nome=?, nome_pet=?, pet=?, sexo=?, assunto=?, mensagem=?, dia=?, horario=?
                   WHERE usuario_id=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ssssssssi", $nome, $nome_pet, $pet, $sexo, $assunto, $mensagem_form, $dia, $horario, $usuario_id);

        if ($stmt->execute()) {
            $mensagem = "<p style='color:green;'>✅ Atendimento atualizado com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro ao atualizar atendimento.</p>";
        }
    } else {
        $insert = "INSERT INTO atendimentos (usuario_id, nome, nome_pet, pet, sexo, assunto, mensagem, dia, horario)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("issssssss", $usuario_id, $nome, $nome_pet, $pet, $sexo, $assunto, $mensagem_form, $dia, $horario);

        if ($stmt->execute()) {
            $mensagem = "<p style='color:green;'>✅ Atendimento criado com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro ao criar atendimento.</p>";
        }
    }

    $sql = "SELECT * FROM atendimentos WHERE usuario_id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $atendimento = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATENDIMENTO</title>
    <link rel="stylesheet" href="../../../assets/css/atendimento.css">
</head>

<body>
    <div id="topo"></div>
    <header class="cabecalho">
        <h1 onclick="location.reload()">Cuidado Pet - Atendimento</h1>
        <nav>
            <a href="../../../index.php">HOME</a>
            <button class="logout" onclick="window.location.href='../config/logout.php'">LOGOUT</button>
        </nav>
    </header>

    <main class="principal">
        <form class="atendimento" method="POST">
            <fieldset>
                <legend>EDITAR ATENDIMENTO</legend>

                <?= $mensagem ?>

                <div>
                    <label for="nome"></label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($atendimento['nome'] ?? '') ?>"
                        placeholder="Digite seu nome completo..." required />
                </div>

                <div>
                    <label for="nome-pet"></label>
                    <input type="text" id="nome-pet" name="nome-pet"
                        value="<?= htmlspecialchars($atendimento['nome_pet'] ?? '') ?>"
                        placeholder="Nome do seu animal..." />
                </div>

                <div>
                    <label for="pet">Pet:</label>
                    <select id="pet" name="pet">
                        <option value="gato" <?= isset($atendimento['pet']) && $atendimento['pet'] == 'gato' ? 'selected' : '' ?>>Gato</option>
                        <option value="cachorro" <?= isset($atendimento['pet']) && $atendimento['pet'] == 'cachorro' ? 'selected' : '' ?>>Cachorro</option>
                    </select>
                </div>

                <div>
                    <label for="sexo">Gênero:</label>
                    <select id="sexo" name="sexo">
                        <option value="femea" <?= isset($atendimento['sexo']) && $atendimento['sexo'] == 'femea' ? 'selected' : '' ?>>Fêmea</option>
                        <option value="macho" <?= isset($atendimento['sexo']) && $atendimento['sexo'] == 'macho' ? 'selected' : '' ?>>Macho</option>
                    </select>
                </div>

                <div>
                    <label for="assunto">Assunto:</label>
                    <select id="assunto" name="assunto">
                        <option value="vacinacao" <?= isset($atendimento['assunto']) && $atendimento['assunto'] == 'vacinacao' ? 'selected' : '' ?>>Vacina</option>
                        <option value="consulta" <?= isset($atendimento['assunto']) && $atendimento['assunto'] == 'consulta' ? 'selected' : '' ?>>Consulta</option>
                        <option value="outro" <?= isset($atendimento['assunto']) && $atendimento['assunto'] == 'outro' ? 'selected' : '' ?>>Outros</option>
                    </select>
                </div>

                <div>
                    <label for="mensagem"></label>
                    <textarea id="mensagem" name="mensagem" rows="4"
                        placeholder="Digite sua mensagem..."><?= htmlspecialchars($atendimento['mensagem'] ?? '') ?></textarea>
                </div>

                <div class="agendamento">
                    <label for="dia">Agendamento</label>
                    <select id="dia" name="dia">
                        <?php
                        $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];
                        foreach ($dias as $d) {
                            $sel = (isset($atendimento['dia']) && $atendimento['dia'] == $d) ? 'selected' : '';
                            echo "<option value='$d' $sel>" . ucfirst($d) . "</option>";
                        }
                        ?>
                    </select>

                    <label for="horario"></label>
                    <select id="horario" name="horario">
                        <option value="manha" <?= isset($atendimento['horario']) && $atendimento['horario'] == 'manha' ? 'selected' : '' ?>>8:30-11:30</option>
                        <option value="tarde" <?= isset($atendimento['horario']) && $atendimento['horario'] == 'tarde' ? 'selected' : '' ?>>13:00-17:30</option>
                    </select>
                    <p>O atendimento será realizado por ordem de chegada</p>
                </div>

                <div>
                    <button type="submit">Salvar alterações</button>
                </div>

                <div>
                    <p>Voltar para o formulário?</p>
                    <button type="button" onclick="window.location.href='atendimento.php'">Voltar</button>
                </div>
            </fieldset>
        </form>
    </main>


    <footer class="rodape">
        <p>
            &copy; 2025 Cuidado Pet Clínica Veterinária. Todos os direitos reservados.
        </p>
    </footer>

    <section class="botao-topo">
        <button>↑</button>
    </section>

    <section class="botao-baixo">
        <button>↓</button>
    </section>

    <section id="baixo"></section>


    <script src="../../../assets/js/script.js"></script>
</body>

</html>