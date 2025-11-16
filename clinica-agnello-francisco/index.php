<?php

include 'root_folder/admin/config/database.php';
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
    header("Location: index.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <?php echo $_SESSION['nome']; ?>
    <section id="topo"></section>
    <header class="cabecalho">
        <h1 onclick="location.reload()">Clínica Veterinária - Cuidado Pet</h1>
        <nav>
            <a class="borda" href="index.php">HOME</a>
            <a href="root_folder/assets/pages/sobreNos.php">SOBRE-NÓS</a>
            <a href="root_folder/assets/pages/servicosEEspecialidades.php">SERVIÇOS-E-ESPECIALIDADES</a>
            <button class="atendimento" onclick="window.location.href='root_folder/admin/service/atendimento.php'">ATENDIMENTO</button>
            <button class="logout" onclick="window.location.href='root_folder/admin/config/logout.php'">LOGOUT</button>
        </nav>
    </header>

    <main class="conteudo">
        <section class="principal">
            <section class="unica">
                <img src="assets/img/gatos.png" alt="">
                <div>
                    <p>Bem-vindo à Clínica Veterinária Cuidado Pet; um espaço criado com amor, onde cada animal é
                        tratado
                        como parte da família. Nossa paixão por pets vai além do cuidado clínico: acreditamos que cada
                        vida
                        merece respeito, carinho e atenção especial.</p>

                    <p>Desde o momento em que você e seu pet chegam, nossa missão é oferecer um ambiente acolhedor,
                        seguro e
                        confiável. Contamos com uma equipe apaixonada e experiente em diversas áreas da medicina
                        veterinária, sempre pronta para cuidar com dedicação.</p>

                    <p>Seja para consultas, vacinas, exames, cirurgias ou orientações sobre bem-estar, estamos aqui para
                        garantir saúde, conforto e qualidade de vida ao seu melhor amigo.</p>
                </div>
            </section>


            <section class="sessoes">
                <div>
                    <p>Oferecer um atendimento veterinário de excelência, com ética, profissionalismo e compaixão.</p>
                </div>

                <div>
                    <p>Cuidar da saúde física e emocional dos animais, promovendo uma relação de confiança e respeito
                        com seus tutores.</p>
                </div>

                <div>
                    <p>Ser referência em medicina veterinária na região, reconhecida pela qualidade dos serviços,
                        tecnologia de ponta e compromisso com o bem-estar animal.</p>
                </div>

                <div>
                    <p>Contribuir para uma convivência mais saudável e harmoniosa entre pets e humanos.</p>
                </div>
            </section>
        </section>

        <section class="secundario">
            <h2>HORÁRIOS</h2>
            <section class="funcionamento">
                <div>
                    <p>Funcionamento das 8h as 18h</p>
                </div>
                <div>
                    <p>Segunda a Sábado</p>
                </div>
                <div>
                    <p>O melhor para o seu pet</p>
                </div>
            </section>
        </section>
        </section>

        <section class="terciario">
            <h2>SAIBA-MAIS</h2>
            <section class="dicas">
                <div class="card">
                    <h2>Dicas!</h2>
                    <p>Mantenha a vacinação do seu pet sempre em dia.</p>
                    <p>Uma alimentação equilibrada faz toda a diferença na saúde do seu amigo.</p>
                    <p>Brincadeiras diárias ajudam a evitar o estresse e a ansiedade.</p>
                </div>

                <div class="card">
                    <h2>🐱Gatos & Cachorros🐶</h2>
                    <span>O seu melhor amigo!</span>
                    <p>Clique em SERVIÇOS-E-ESPECIALIDADES no cabeçalho para saber mais.</p>
                </div>
            </section>
        </section>

        <section class="quaternario">
            <h2>ONDE-ESTAMOS</h2>
            <section class="localizacao">
                <div class="maps">
                    <h2>Nosso Endereço</h2>
                    <p>Centro Universitário Estácio</p>
                    <p>Taguatinga, Brasília - DF</p>
                    <p>Taguatinga Sul</p>
                    <p>Q CS CSG 9 Lotes 11/12/15/16</p>
                    <p>CEP: 72035-509</p>
                </div>

                <div class="maps">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3837.7654502704872!2d-48.033288984801814!3d-15.868920169329128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x935a2d98f7ffffff%3A0x4f7d7a315233f8c1!2sCentro%20Universit%C3%A1rio%20Est%C3%A1cio!5e0!3m2!1spt-BR!2sbr!4v1762319661907!5m2!1spt-BR!2sbr">
                    </iframe>
                </div>
            </section>
        </section>

        <section class="quintenario">
            <div>
                <p>Manter as vacinas em dia e realizar exames de rotina são passos fundamentais para garantir a saúde e
                    o bem-estar do seu pet seja gato ou cachorro.</p>
                <p>Na Cuidado Pet, estamos comprometidos em oferecer o
                    melhor cuidado veterinário, com atenção personalizada e tratamentos adequados às necessidades de
                    cada animal.</p>
                <p>Agende uma consulta conosco e descubra como podemos ajudar a manter seu melhor amigo saudável e
                    feliz!</p>
            </div>
            <img src="assets/img/gato&cachorro.png" alt="2">
        </section>
    </main>

    <footer class="rodape">
        <section class="social">
            <div>
                <h2>Contato-direto</h2>
                <p>clinicacuidadopet@gmail.com</p>
                <p>(61) 9 8202-8446</p>
            </div>

            <div>
                <a href="" target="_blank"><i class="fab fa-instagram"> INSTAGRAM</i></a>
                <a href="" target="_blank"><i class="fab fa-whatsapp"> WHATSAPP</i></a>
            </div>
        </section>

        <section class="copyright">
            <p>© 2025 Cuidado Pet Clínica Veterinária. Todos os direitos reservados.</p>
        </section>
    </footer>

    <section class="botao-topo">
        <button>↑</button>
    </section>

    <section class="botao-baixo">
        <button>↓</button>
    </section>

    <section id="baixo"></section>


    <script src="assets/js/script.js"></script>
</body>

</html>