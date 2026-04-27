<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IoT Ultrasonic Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        header {
            background: #1e3a8a;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
            margin-top: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .value {
            font-size: 40px;
            font-weight: bold;
            color: #2563eb;
        }

    </style>
</head>

<body>

<header>
    <h1>Ultrasonic IoT Dashboard</h1>
</header>

<div class="container">

    <!-- Latest Value -->
    <div class="card">
        <h2>Latest Distance</h2>

        <?php
        $conn = new mysqli("localhost", "root", "", "iot_db");

        $result = $conn->query("SELECT * FROM sensor_data ORDER BY id DESC LIMIT 1");
        $row = $result->fetch_assoc();
        ?>

        <div class="value">
            <?= $row['distance'] ?> cm
        </div>

        <p>Last update: <?= $row['created_at'] ?></p>
    </div>

    <!-- History -->
    <div class="card">
        <h2>History (Last 10 readings)</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Distance (cm)</th>
                <th>Time</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM sensor_data ORDER BY id DESC LIMIT 10");

            while($row = $result->fetch_assoc()) {
            ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['distance'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>

            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>