<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Calc\Calc;

$calc = new Calc();
$result = null;

if (isset($_POST['formula'])){
    $result = $calc->calc($_POST['formula']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="single_calc.php" method="post">
        <div>
            <label for="formula">Formula</label>
            <input type="text" name="formula" id="formula" placeholder="type yor sheet formula"/>
        </div>
        <button type="submit">Calc!</button>
    </form>
    <?php if (!is_null($result)) echo $result ?>
</body>
</html>
