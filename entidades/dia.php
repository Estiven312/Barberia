<?php
  

class Dia
{   
 
    



    private $dia;

    public function __construct()
    {
    }

    public function __get($valor)
    {
        return $this->$valor;
    }
    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }

    public function cargarFormulario($request)

    {

        $this->dia = isset($request["lstDia1"]) ? $request["lstDia1"] : "";
    }

    public  function validar_option()
    {
        $dia = date('l');


        if ($dia == "Monday") {
            echo  '
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                           ';
        }
        if ($dia == "Tuesday") {
            echo  ' 
                                
                                <option value="Martes">Martes</option>
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>
                             ';
        }
        if ($dia == "Wednesday") {
            echo ' 
                                <option value="Miercoles ">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            ';
        }
        if ($dia == "Thursday") {
            echo ' 
                                <
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            ';
        }
        if ($dia == "Friday") {
            echo ' 
                                
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sábado</option>

                            ';
        }
        if ($dia == "Saturday") {
            echo '   
                                
                                <option value="Sabado">Sábado</option>

                           ';
        }
    }



    public function consulta_dia($valor,$en){


        if ($valor== "Lunes") {
            echo $en->lunes();
           
        }
        if ($valor == "Martes") {
            echo   $en->martes();
            
            # code...
        }
        if ($valor == "Miercoles") {
            echo   $en->miercoles();
            
        }
        if ($valor == "Jueves") {
            echo   $en->Jueves();
           
        }
        if ($valor == "Viernes") {
            echo   $en->viernes();
            
        }
        if ($valor == "Sabado") {
           
            echo   $en->sabado();
        }


       

        
    }
}
