<?php
    foreach($_GET as $get => $value){
        if($value == "on"){
            $$get = true;
        } else {
            $$get = $value;
        }
    }
    if(!isset($num)){
        $num = 10;
    }
    if(!isset($mayus)){
        $mayus = true;
    }
    if(!isset($char_num)){
        $char_num = true;
    }
    if(!isset($especial)){
        $especial = true;
    }

    function generarContrasena($num, bool $mayus, bool $char_num, bool $especial) : string {
        $caracteres = match(true){
            ($mayus && $char_num && $especial) => array_merge(/*0-9*/range(48, 58),/*?,@*/range(63,64),/*A-Z*/range(65, 90),/*[,\,]*/range(91,93),/*a-z*/range(97,122),/*{,|,}*/range(123,125),/*esp*//*range(128,155)*/),
            (!$mayus && $char_num && $especial) => array_merge(range(48, 58),range(63,64),range(65, 90),range(91,93),range(97,122),range(123,125),/*range(128,155)*/),
            ($mayus && !$char_num && $especial) => array_merge(range(48, 58),range(63,64),range(65, 90),range(91,93),range(97,122),range(123,125),/*range(128,155)*/),
            ($mayus && $char_num && !$especial) => array_merge(range(48, 58),range(65,90),range(97,122)),
            (!$mayus && !$char_num && $especial) => array_merge(range(97,122),range(63,64),range(91,93),range(123,125),/*range(128,155)*/),
            ($mayus && !$char_num && !$especial) => array_merge(range(97,122),range(65,90)),
            (!$mayus && !$char_num && !$especial) => range(97,122),
        };
            
            $contrasena = "";
            $letras_contra = "";
            for($i = 0; $i < count($caracteres); $i++){
                $letras_contra .= chr($caracteres[$i]);
            }
            echo "<p>$letras_contra</p>";
            for($i = 0; $i < $num; $i++){
                $xd = random_int(0,count($caracteres)-1);
                //echo $caracteres[$xd]. "<br>";
                $contrasena .= chr($caracteres[$xd]);
            }
        return $contrasena;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
    <label for="num">Numero de caracteres:<input type="number" id="num" name="num"></label>
    <label for="mayus">Mayusculas:<input type="checkbox" id="mayus" name="mayus"></label>
    <label for="mayus">Especiales:<input type="checkbox" id="especial" name="especial"></label>
    <label for="mayus">Numeros:<input type="checkbox" id="char_num" name="char_num"></label>
    <input type="submit" value="enviar">
    </form>
    <p>
    <?php echo generarContrasena($num,$mayus,$especial,$char_num);?>
    </p>
</body>
</html>