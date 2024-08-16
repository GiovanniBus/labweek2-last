<?php

define('CUSTOMERS_FILE_PATH', 'registrations.csv');

function get_customers_data()
{
    if (!file_exists(CUSTOMERS_FILE_PATH)) {
        die("The file does not exist!");
    }

    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');

    $data = [];
    $headers = [];
    $row_count = 0;

    while (($row = fgetcsv($opened_file_handler, 1024)) !== FALSE) {
        if ($row_count == 0) {
            $headers = $row; 
        } else {
           
            $data[] = $row;
        }

        $row_count++;
    }

    fclose($opened_file_handler);

    return [
        'headers' => $headers,
        'data' => $data
    ];
}

$customers = get_customers_data();

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>
    Registrants
</h1>
<table aria-label="Registrants Dataset" border="1">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Password</th>
            <th>Birth Date</th>
            <th>Sex</th>
            <th>Address</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Program</th>
            <th>Agree</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($customers['data'])): ?>
        <?php foreach ($customers['data'] as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row[0]); ?></td> <!-- Full Name -->
                <td><?php echo htmlspecialchars($row[1]); ?></td> <!-- Email Address -->
                <td><?php echo htmlspecialchars($row[2]); ?></td> <!-- Password -->
                <td><?php echo htmlspecialchars($row[3]); ?></td> <!-- Birth Date -->
                <td><?php echo htmlspecialchars($row[4]); ?></td> <!-- Sex -->
                <td><?php echo htmlspecialchars($row[5]); ?></td> <!-- Address -->
                <td><?php echo htmlspecialchars($row[6]); ?></td> <!-- Age -->
                <td><?php echo htmlspecialchars($row[7]); ?></td> <!-- Contact Number -->
                <td><?php echo htmlspecialchars($row[8]); ?></td> <!-- Program -->
                <td><?php echo htmlspecialchars($row[9]); ?></td> <!-- Agree -->
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">No data available.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
