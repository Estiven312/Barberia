<?php
class Cliente
{
    private $nombre;
    private $dia;
    private $hora;
    private $codigo;
    private $codigoRe;
    private $mensaje;


    public function __construct()
    {
    }

    public function __get($valor)
    {
        return $this->$valor;
    }

    public function __set($propiedad, $valor)
    {

        return $this->$propiedad = $valor;
    }

    public function eliminar_todo()
    {
        date_default_timezone_set('America/Bogota');
        $day = date("l");
        $hora=date('h'.':'.'i'.''.'a');
        print_r($day.$hora);
        if ($day == "Saturday" && $hora=="11:29pm") {
            $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);

            $sql = " DELETE FROM clientes";
            if (!$mysqli->query($sql)) {
                printf("Error en query: %s\n", $mysqli->error . " " . $sql);
            };
        }
    }
    public  function validar_option()
    {
        $dia = date('l');


        if ($dia == "Monday") {
            echo  '<select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
        if ($dia == "Tuesday") {
            echo  ' <select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                
                                <option value="Martes">Martes</option>
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
        if ($dia == "Wednesday") {
            echo ' <select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
        if ($dia == "Thursday") {
            echo '  <select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                <
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
        if ($dia == "Friday") {
            echo ' <select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
        if ($dia == "Saturday") {
            echo '   <select name="lstDia" name="lstDia" id="lstDia" class="form-control " required>
                                
                                <option value="Sabado">Sábado</option>

                            </select>';
        }
    }

    public function  validar_hora()
    {
        date_default_timezone_set('America/Bogota');

        $valor =  date('g' . ':' . 'i' . 'A');
        if ($valor == "8:00PM") {
        }
    }

    public function cargarFormulario($request)
    {
        $this->codigo = rand(1000, 9999);
        $this->nombre = isset($request["txtNombre"]) ? $request["txtNombre"] : "";
        $this->dia = isset($request["lstDia"]) ? $request["lstDia"] : "";
        $this->hora = isset($request["lstHora"]) ? $request["lstHora"] : "";
    }
    public function cargarCodigo($request)
    {

        $this->codigoRe = isset($request["numCodigo"]) ? $request["numCodigo"] : "";
    }

    public function consulta_filas()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);

        $sql = "SELECT * FROM clientes WHERE hora LIKE'$this->hora' AND dia LIKE '$this->dia'";

        if (!$consulta = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $filas = mysqli_num_rows($consulta);
        return $filas;
    }

    public function insertar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);



        $sql = "INSERT INTO clientes (
codigo, nombre ,dia,hora
) VALUES (
$this->codigo,
'$this->nombre',
'$this->dia',
'$this->hora'
);";

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $mysqli->close();
    }

    public function eliminar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);

        $sql = " DELETE FROM clientes WHERE codigo =" . $this->codigoRe;

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function lunes()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Lunes'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();

        //Convierte el resultado en un array asociativo



        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;;
    }
    public function martes()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Martes'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $valor = "";

        //Convierte el resultado en un array asociativo


        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;
    }
    public function miercoles()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Miercoles'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }



        $valor = "";


        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;
    }

    public function Jueves()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Jueves'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }


        $valor = "";


        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;
    }
    public function viernes()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Viernes'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();

        $valor = "";


        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;
    }
    public function sabado()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT nombre , dia , hora
        FROM clientes where dia = 'Sabado'
        ORDER BY 
        FIELD(hora,'7:00AM','7:20AM','7:40AM','8:00AM','8:20AM','8:40AM','9:00AM','9:20AM','9:40AM','10:00AM','10:20AM','10:40AM','11:00AM','1:00PM','1:20PM','1:40PM','2:00PM','2:20PM','2:40PM','3:00PM','3:20PM','3:40PM','4:00PM','4:20PM','4:40PM','5:00PM','5:20PM','5:40PM','6:00PM','6:20PM','6:40PM','7PM')";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $valor = "";


        //Convierte el resultado en un array asociativo


        while ($filas = mysqli_fetch_assoc($resultado)) {
            # code...



            $valor = " <tr>" .

                "<td>" . $filas['nombre'] . "</td>" .
                "<td>" . $filas['dia'] . "</td>" .
                "<td>" . $filas['hora'] . "</td>" .


                "</tr>";
        }
        return $valor;
    }





    public function obtenerTodos()
    {
        $day = date("l");
        $en = new Cliente();

        //Convierte el resultado en un array asociativo
        echo " <table class='table table-hover border bg-white '>";

        echo "<thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>DÍA</th>
                    <TH>HORA</TH>
                </tr>
            </thead>
            <tbody>";

        if ($day == "Monday") {
            echo $en->lunes();
            echo   $en->martes();
            echo   $en->miercoles();
            echo   $en->Jueves();
            echo   $en->viernes();
            echo   $en->sabado();
        }
        if ($day == "Tuesday") {
            echo   $en->martes();
            echo   $en->miercoles();
            echo   $en->Jueves();
            echo   $en->viernes();
            echo   $en->sabado();
            # code...
        }
        if ($day == "Wednesday") {
            echo   $en->miercoles();
            echo   $en->Jueves();
            echo   $en->viernes();
            echo   $en->sabado();
        }
        if ($day == "Thursdya") {
            echo   $en->Jueves();
            echo   $en->viernes();
            echo   $en->sabado();
        }
        if ($day == "Friday") {
            echo   $en->viernes();
            echo   $en->sabado();
        }
        if ($day == "Saturday") {
            # code...

            echo   $en->sabado();
        }







        echo " </tbody>" .


            "
        </table>";


        //Convierte el resultado en un array asociativo





    }
}
