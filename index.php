<?php
$texto = "";
session_start();

if (isset($_POST["botones"])) {
    $texto = $_POST["resultado"] . $_POST["botones"];
}

if (isset($_POST["operacion"])) {
    $num1 = floatval($_POST["resultado"]);
    $_SESSION["num1"] = $num1;
    $_SESSION["signo"] = $_POST["operacion"];
    $texto = "";
}

if (isset($_POST["resultado"]) && $_POST["resultado"] == "" && isset($_POST["operacion"]) && $_POST["operacion"] == "-") {
    $texto = $_POST["operacion"];
}

if (isset($_POST["igual"])) {
    $num2 = floatval($_POST["resultado"]);

    try {
        if ($_SESSION["signo"] === "*") {
            $texto = $_SESSION["num1"] * $num2;
        } else if ($_SESSION["signo"] === "-") {
            $texto = $_SESSION["num1"] - $num2;
        } else if ($_SESSION["signo"] === "+") {
            $texto = $_SESSION["num1"] + $num2;
        } else if ($_SESSION["signo"] === "/") {
            ($num2 != 0) ? $texto = $_SESSION["num1"] / $num2 : throw new Exception("Sintax error: no es posible dividir entre 0");
        }
    } catch (Exception $e) {
        $texto = $e->getMessage();
    }
}

if (isset($_POST["funciones"])) {
    if ($_POST["funciones"] === "←") {
        $numeros = $_POST["resultado"];
        $texto = substr($numeros, 0, -1);
    } else if ($_POST["funciones"] === "ce") {
        $texto = "";
    } else if ($_POST["funciones"] === "π") {
        $texto = M_PI;
    } else if ($_POST["funciones"] === "x²") {
        $numElevado = floatval($_POST["resultado"]);
        $texto = $numElevado ** 2;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalculadoraPHP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=Rubik+Wet+Paint&family=Tilt+Prism&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculadora">
        <div class="col" style="margin-left: 20rem;margin-top: 9rem;">
        <form  method="POST">
            <div class="row">
                <h1>CALCULADORA</h1>
                <input type="text" class="resultado" name="resultado"  value="<?php echo $texto ?>">
            </div>
            <div class="row">
                <div class="col">
                        <div class="row">
                            <button type="submit" class="borrador" name="funciones"  value="←">←</button>
                            <button type="submit" class="botones" name="funciones"  value="π">π</button>
                            <button type="submit" class="botones" name="operacion"  value="*">*</button>
                            <button type="submit" class="botones" name="operacion"  value="-">-</button>
                        </div>
                        <div class="row">
                            <button type="submit" class="botones" name="botones"  value="7">7</button>
                            <button type="submit" class="botones" name="botones"  value="8">8</button>
                            <button type="submit" class="botones" name="botones"  value="9">9</button>
                            <button type="submit" class="botones" name="operacion"  value="+">+</button>
                        </div>
                        <div class="row">
                            <button type="submit" class="botones" name="botones"  value="4">4</button>
                            <button type="submit" class="botones" name="botones"  value="5">5</button>
                            <button type="submit" class="botones" name="botones"  value="6">6</button>
                            <button type="submit" class="botones" name="operacion"  value="/">/</button>
                        </div>
                        <div class="row">
                            <button type="submit" class="botones" name="botones"  value="1">1</button>
                            <button type="submit" class="botones" name="botones"  value="2">2</button>
                            <button type="submit" class="botones" name="botones"  value="3">3</button>
                            <button type="submit" class="botones" name="funciones"  value="x²">X²</button>
                        </div>
                        <div class="row">
                            <button type="submit" class="botones" name="botones"  value="0">0</button>
                            <button type="submit" class="botones" name="botones"  value=".">.</button>
                            <button type="submit" class="botones" name="funciones"  value="ce">CE</button>
                            <button type="submit" name="igual"  id="igual" value="=">=</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>