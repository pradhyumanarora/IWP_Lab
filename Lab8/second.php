<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second</title>
</head>

<body>
    <?php
    $customers = array(
        array("Pradhyuman", 9897236420, 112),
        array("Gourav", 98345634569, 267),
        array("Rahul", 9871679210, 1000),
        array("Rajat", 9803581310, 1500),
        array("Raj", 9872245671, 600),
    );

    echo "<h2>BSNL 4G Data Usage Bill</h2>";

    foreach ($customers as $customer) {
        $customerName = $customer[0];
        $customerNumber = $customer[1];
        $dataUsage = $customer[2];

        // Amount to be paid for the current customer
        if ($dataUsage <= 200) {
            $amount = 350;
        } elseif ($dataUsage <= 500) {
            $amount = 500 + ($dataUsage - 200) * 0.3;
        } elseif ($dataUsage <= 1000) {
            $amount = 750 + ($dataUsage - 500) * 0.5;
        } else {
            $amount = 1000;
        }
        echo "<p>Name: $customerName  |  Amount Due  : Rs. $amount</p>";
    }
    ?>
</body>

</html>
