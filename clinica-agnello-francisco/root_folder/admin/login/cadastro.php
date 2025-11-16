<?php

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido!";
        exit;
    }

    $check_sql = "SELECT id FROM usuarios WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Este email já está cadastrado!";
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();

    $senha_criptografada = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (email, senha) VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $email, $senha_criptografada);
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO</title>
    <link rel="stylesheet" href="../../../assets/css/login.css">
</head>

<body>
    <div id="topo"></div>
    <header class="cabecalho">
        <h1 onclick="location.reload()">Cuidado Pet - Criar conta</h1>
        <nav>
            <a href="../../../index.html">HOME</a>
            <a href="login.php">LOGIN</a>
        </nav>
    </header>

    <main>
        <section class="login">
            <form method="POST">
                <input type="email" name="email" placeholder="E-mail" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Cadastrar</button>
            </form>
        </section>
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