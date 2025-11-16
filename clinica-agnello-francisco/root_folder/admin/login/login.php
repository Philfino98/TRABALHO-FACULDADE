<?php

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['senha'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header("Location: ../../../index.php");
                exit();
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuário não encontrado!";
        }
    } else {
        $erro = "Por favor, preencha todos os campos!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../../../assets/css/login.css">
</head>

<body>
    <div id="topo"></div>
    <header class="cabecalho">
        <h1 onclick="location.reload()">Cuidado Pet - Login</h1>
        <nav>
            <a href="../../../index.html">HOME</a>
        </nav>
    </header>

    <main>
        <section class="login">
            <form method="POST" action="login.php">
                <input type="email" name="email" placeholder="E-mail" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Entrar</button>
            </form>
            <?php
                if (isset($erro)) {
                    echo "<p style='color: red;'>$erro</p>";
                }
            ?>
            <p>_______________________________</p>
            <p>
                <button onclick="window.location.href='cadastro.php'">Criar conta</button>
            </p>
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