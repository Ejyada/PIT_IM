<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "xml"
);
$affectedRow = 0;
$xml =
    simplexml_load_file("employees_data.xml")
    or die("ERROR: cannot create object");
foreach ($xml->children() as $row) {
    $employee_id = $row->employee_id;
    $first_name = $row->first_name;
    $last_name = $row->last_name;
    $email = $row->email;
    $phone_number = $row->phone_number;
    $hire_date = $row->hire_date;
    $job_id = $row->job_id;
    $salary = $row->salary;
    $sql = "INSERT INTO
employees(employee_id,
 first_name,
 last_name,
 email,
 phone_number,
 hire_date,
 job_id,
 salary) VALUES ('" .
        $employee_id . "',
 '" . $first_name .
        "',
 '" . $last_name .
        "',
 '" . $email . "',
 '" .
        $phone_number . "',
 '" . $hire_date .
        "',
 '" . $job_id . "',
 '" . $salary . "')";
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