<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pizza_runner"
);
$affectedRow = 0;
$xml =
    simplexml_load_file("runner_data.xml")
    or die("ERROR: cannot create object");
foreach ($xml->children() as $row) {
    $order_id = $row->order_id;
    $runner_id = $row->runner_id;
    $pickup_time = $row->pickup_time;
    $distance = $row->distance;
    $duration = $row->duration;
    $cancellation = $row->cancellation;
    
    $sql = "INSERT INTO
runner_orders(order_id,
runner_id,
pickup_time,
distance,
duration,
cancellation) VALUES ('" .
        $order_id . "',
 '" . $runner_id .
        "',
 '" . $pickup_time .
        "',
 '" . $distance . "',
 '" .
        $duration . "',
 '" . $cancellation .
        "')";
    $result = mysqli_query($conn, $sql);
    if (!empty($result)) {
        $affectedRow++;
    } else {
        $error_message = mysqli_error($conn) .
            "\n";
    }
    ;
}
?>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . "\n" .
        "Records inserted";
} else {
    $message = "No records inserted";
}
;
?>
<style>
    body {
        font-family: Arial;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .affected-row {
        background: green;
        margin-left: 10px;
        padding: 10px;
        border: #dab2b2 1px solid;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        height: 20px;
        display: flex;
        justify-content: center;
    }

    .error-message {
        background: #eac0c0;
        padding: 10px;
        border: #dab2b2 1px solid;
        border-radius: 2px;
        color: #5d5b5b;
    }

    .card {
        display: flex;
        align-items: center;
        border: 2px solid black;
        padding: 15px;
        border-radius: 20px;
        box-shadow: 10px 10px 10px rgba(0, 0, 0,
                0.3);
    }

    .main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="main">
    <h1>XML TO MYSQL</h1>
    <div class="card">
        <h3>RESULT : </h3>
        <div class="affected-row">
            <?php echo $message; ?>
        </div>
    </div>
</div>
<?php
if (!empty($error_message)) {
    ?>
    <div class="error-message">
        <?php
        echo n12br($error_message);
        ?>
    </div>
    <?php
}
?>
