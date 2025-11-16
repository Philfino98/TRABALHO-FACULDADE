<?php

include '../config/database.php';
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
    header("Location: ../../../index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['user_id'];

    $nome = $_POST['nome'] ?? '';
    $nome_pet = $_POST['nome-pet'] ?? '';
    $pet = $_POST['pet'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $assunto = $_POST['assunto'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $horario = $_POST['horario'] ?? '';

    $sql = "INSERT INTO atendimentos (usuario_id, nome, nome_pet, pet, sexo, assunto, mensagem, dia, horario)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("issssssss", $usuario_id, $nome, $nome_pet, $pet, $sexo, $assunto, $mensagem, $dia, $horario);
        if ($stmt->execute()) {
            echo "<script>alert('Atendimento enviado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao enviar atendimento.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Erro na preparação do SQL.');</script>";
    }
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
            <legend>ATENDIMENTO</legend>

            <div>
                <label for="nome"></label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo..." autocomplete="name" required />
            </div>

            <div>
                <label for="nome-pet"></label>
                <input type="text" id="nome-pet" name="nome-pet" placeholder="Nome do seu animal..." />
            </div>

            <div>
                <label for="pet">Pet:</label>
                <select id="pet" name="pet">
                    <option value="gato">Gato</option>
                    <option value="cachorro">Cachorro</option>
                </select>
            </div>

            <div>
                <label for="sexo">Gênero:</label>
                <select id="sexo" name="sexo">
                    <option value="femea">Fêmea</option>
                    <option value="macho">Macho</option>
                </select>
            </div>

            <div>
                <label for="assunto">Assunto:</label>
                <select id="assunto" name="assunto">
                    <option value="vacinacao">Vacina</option>
                    <option value="consulta">Consulta</option>
                    <option value="outro">Outros</option>
                </select>
            </div>

            <div>
                <label for="mensagem"></label>
                <textarea id="mensagem" name="mensagem" rows="4" placeholder="Digite sua mensagem..."></textarea>
            </div>

            <div class="agendamento">
                <label for="dia">Agendamento</label>
                <select id="dia" name="dia">
                    <option value="segunda">Segunda</option>
                    <option value="terca">Terça</option>
                    <option value="quarta">Quarta</option>
                    <option value="quinta">Quinta</option>
                    <option value="sexta">Sexta</option>
                    <option value="sabado">Sábado</option>
                </select>

                <label for="horario"></label>
                <select id="horario" name="horario">
                    <option value="manha">8:30-11:30</option>
                    <option value="tarde">13:00-17:30</option>
                </select>
                <p>O atendimento será realizado por ordem de chegada</p>
            </div>

            <div>
                <button type="submit" id="submitBtn">Enviar</button>
            </div>

            <div>
                <p>Já enviou o formulário?</p>
                <button type="button" onclick="window.location.href='editarAtendimento.php'">Editar informações</button>
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