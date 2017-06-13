<?php ?>

<!DOCTYPE html>
<html>
    <body>

        <form method="post" action="chavesLocarDesLocar.php">
            Número chave:<br>
            <input type="text" name="nome@loc" value="">
            <br>
            <input name="loc@chaves!!" type="submit" value="Locar">

            <?php chavesLocadas() ?>
        </form> 

    </body>
</html>

<?php

function chavesLocadas() {

    $i = 0;

    $chaves = $_GET;

    foreach ($chaves as $key) {
        
        if ($i > 0) {

           // echo $chaves[$i][0] . "  " . $chaves[$i][0] . "<br>";
            
            echo "<input type=\"hidden\" value=\"" . $chaves[$i][0] . "\" name=\"" . $chaves[$i][0] . "\" id=\"" . $chaves[$i][0] . "\" /> ";
        }
        $i += 1;
    }
}
?>