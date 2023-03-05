<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First</title>
</head>

<body>
    <?php
    $amounts = array(500, 150, 120.5, 140.5, 600, 65.5);

    $int_count = 0;
    $int_total = 0;
    $float_count = 0;
    $float_total = 0;
    foreach ($amounts as $price) {
        if (is_numeric($price)) {
            if (intval($price) == $price) {
                $int_count++;
                $int_total += $price;
            } else {
                $float_count++;
                $float_total += $price;
            }
        }
    }
    echo "<h3>Input array: </h3>";
    echo "<pre>";
    print_r($amounts);
    echo "</pre>";
    echo "<br>";
    echo "Number of integer amount: $int_count<br>";
    echo "Total integer amount: $int_total<br>";
    echo "Number of float amount: $float_count<br>";
    echo "Total float amount: $float_total<br>";
    ?>
</body>

</html>