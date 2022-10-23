<?php
include_once("config.php");
include_once("entidades/clientes.php");

$clientes = new Cliente();




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="css/fontasome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <script src="css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">



    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-md navbar-dark  ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">JHONATAN BARBER</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active " href="court.php">Cortes</a>

                        </li>


                        <li class="nav-item">
                            <a class="nav-link active " href="agenda.php">Servicio</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>

    </header>
    <main>




        <Section>
            <div class="row">
                <div class="col-12 text-center pt-2 pb-3">

                    <h1>Listado de Turnos </h1>
                </div>
                <div class="p-4">

                    <?php
                    $clientes->obtenerTodos();


                    ?>
                </div>



            </div>

        </Section>
    </main>
    <footer class="text-center">
        <span style="letter-spacing:0.08em;"> ©2022 Estiven Carvajal Rojas</span>


    </footer>



</body>

</html>