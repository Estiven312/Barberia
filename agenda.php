<?php

include_once("config.php");

include_once("entidades/clientes.php");
include_once("entidades/dia.php");
   date_default_timezone_set('America/Bogota');

$cliente = new Cliente();
$cliente->eliminar_todo();

$dia = new Dia($_REQUEST);




if ($_POST) {




    if ($_POST["boton"] == "enviar") {
        $cliente->cargarFormulario($_REQUEST);

        if ($cliente->consulta_filas() == 0) {
            $cliente->insertar();
            $msg["texto"] = "   " . $cliente->codigo . "   Este código es un identificativo para que ninguna otra persona borre tu agenda sin autorización, tenlo presente o anótalo, si requieres eliminar el turno este código será su única forma";
            $msg["codigo"] = "alert-success";
        } else {
            $msg["texto"] = "El turno ya está ocupado por favor consulta el día y horas disponibles";
            $msg["codigo"] = "alert-success";
        }
    }

    if ($_POST["boton"] == "eliminar") {
        $cliente->cargarCodigo($_REQUEST);
        $cliente->eliminar();
    }

    if ($_POST["boton"] == "consulta") {


        header('Location: consulta.php?dia=' . $_REQUEST["lstDia1"]);
    }
}








?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagenes/scissors-icon-25525.jpg" type="image/x-icon">
    <title> Agenda </title>

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
                            <a class="nav-link active " href="#">Servicio</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>

    </header>
    <main>
        <secction>

            <div class="row">
                <div class="col-12 text-center pt-2 pb-3">

                    <h1>Listado de Turnos </h1>
                </div>
                <div class="col-12">
                    <div class="alert"> <?php

                                        if (isset($msg["texto"])) : ?>
                            <div class="alert <?php echo $msg["codigo"]; ?>" role="alert">
                                <?php echo $msg["texto"]; ?>
                            </div>


                        <?php endif;


                        ?>
                    </div>
                </div>
                <div class=" col-12 col-sm-4 p-4 ">
                    <form action="" method="POST">
                        <div class="pb-4">
                            <label for="txtNombre">Nombre*:</label>
                            <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
                        </div>
                        <div class="pb-4">
                            <label for="textDni">Día</label>
                            <?php $cliente->validar_option(); ?>

                        </div>
                        <div class="pb-4">
                            <label for="textDni">Hora</label>
                            <select name="lstHora" name="lstHora" id="lstHora" class="form-control " required>

                                <option value="8:00AM">8:00AM</option>
                                <option value="8:20AM">8:20AM</option>
                                <option value="8:40AM">8:40AM</option>



                                <option value="9:00AM">9:00AM</option>
                                <option value="9:20AM">9:20AM</option>

                                <option value="9:40AM">9:40AM</option>

                                <option value="10:00AM">10:00AM</option>
                                <option value="10:20AM">10:20AM</option>
                                <option value="10:40AM">10:40AM</option>

                                <option value="11:00AM">11:00AM</option>
                                <option value="11:20AM">11:20AM</option>
                                <option value="11:40AM">11:40AM</option>

                                <option value="1:00PM">1:00PM</option>
                                <option value="1:20PM">1:20PM</option>
                                <option value="1:40PM">1:40PM</option>

                                <option value="2:00PM">2:00PM</option>
                                <option value="2:20PM">2:20PM</option>
                                <option value="2:40PM">2:40PM</option>

                                <option value="3:00PM">3:00PM</option>
                                <option value="3:20PM">3:20PM</option>
                                <option value="3:40PM">3:40PM</option>

                                <option value="4:00PM ">4:00PM</option>
                                <option value="4:20PM ">4:20PM</option>
                                <option value="4:40PM ">4:40PM</option>


                                <option value="5:00PM">5:00PM</option>
                                <option value="5:20PM">5:20PM</option>
                                <option value="5:40PM">5:40PM</option>

                                <option value="6:00PM">6:00PM</option>
                                <option value="6:20PM">6:20PM</option>
                                <option value="6:40PM">6:40PM</option>




                            </select>



                        </div>

                        <div class="boton">

                            <button class="btn   m-1  bg-primary" type="submit" name="boton" value="enviar"><span></span>
                                <span></span>
                                <span></span>
                                <span></span> Enviar</button>

                        </div>

                    </form>

                    <div class="row">
                        <div class="col-6">

                            <form action="" method="post">
                                <div class="boton">
                                    <label for="">Codigo</label>
                                    <p class="text">El codigo solo cuando vayas a eliminar</p>
                                    <input type="number" name="numCodigo" id="numCodigo" class="form-control" required>


                                    <button class="btn   m-1  bg-danger" type="submit" name="boton" value="eliminar"><span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span> Eliminar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">


                            <form action="" method="post">
                                <label for="">Cosulta</label>
                                <P class="text">Colsulta la agenda del día</P>

                                <select name="lstDia1" name="lstDia1" id="lstDia1" class="form-control " required>
                                    <?php $dia->validar_option() ?>

                                </select>



                                <div class="boton">



                                    <button class="btn   m-1  bg-primary" type="submit" name="boton" value="consulta"><span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span> Consultar</button>

                                </div>


                            </form>
                        </div>




                    </div>




                </div>
                <div class="  color col-12 col-sm-8 p-2 ">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Turnos agendados</h2>
                        </div>
                    </div>
                    <div>
                        <?php $cliente->obtenerTodos() ?>
                    </div>




                </div>
            </div>
        </secction>
    </main>
    <footer class="text-center">
        <span style="letter-spacing:0.08em;"> ©2022 Estiven Carvajal Rojas</span>


    </footer>


</body>

</html>