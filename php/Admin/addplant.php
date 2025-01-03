<?php
    include '../connection.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $message = ""; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $container_soil = mysqli_real_escape_string($conn, $_POST['container_soil']);
        $watering = mysqli_real_escape_string($conn, $_POST['watering']);
        $sunlight = mysqli_real_escape_string($conn, $_POST['sunlight']);
        $tips = mysqli_real_escape_string($conn, $_POST['tips']);

        if (!empty($name) && !empty($description) && !empty($image)) {
            $sql = "INSERT INTO plant (name, description, image, container_soil, watering, sunlight, tips) VALUES ('$name','$description','$image', '$container_soil', '$watering', '$sunlight', '$tips')";

            if ($conn->query($sql) === TRUE) {
                $message = "<h3 class='text-success text-center'>New plant added successfully!</h3>";
            } else {
                $message = "<h3 class='text-danger text-center'>Failed to add new plant</h3>";
            }
        } else {
            $message = "<h3 class='text-warning text-center'>Please fill all the fields</h3>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .d-flex {
            height: 100%;
            justify-content: center;
            align-items: center;
        }


        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="adminpage.php">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="d-flex">
        <div class="container p-5">
            <?php if (!empty($message)) echo $message; ?>
            <form action="addplant.php" method="POST" class=" p-3 bg-dark  border-light rounded-3 mt-5">
                <h2 class="fs-3 mb-4 text-white">Enter Plant Details:</h2>

                <label for="name" class="form-label fw-semibold fs-5 text-white">Plant Name:</label>
                <input type="text" class="form-control mb-3" id="name" name="name">

                <label for="description" class="form-label fw-semibold fs-5 text-white">Description:</label>
                <textarea class="form-control mb-3" id="description" name="description" rows="3"></textarea>

                <label for="image" class="form-label fw-semibold fs-5 text-white">Image:</label>
                <input type="text" class="form-control mb-3" id="image" name="image">

                <label for="container_soil" class="form-label fw-semibold fs-5 text-white">Container & Soil:</label>
                <input type="text" class="form-control mb-3" id="container_soil" name="container_soil">

                <label for="watering" class="form-label fw-semibold fs-5 text-white">Watering:</label>
                <input type="text" class="form-control mb-3" id="watering" name="watering">

                <label for="sunlight" class="form-label fw-semibold fs-5 text-white">Sunlight:</label>
                <input type="text" class="form-control mb-3" id="sunlight" name="sunlight">

                <label for="tips" class="form-label fw-semibold fs-5 text-white">Tips:</label>
                <input type="text" class="form-control mb-3" id="tips" name="tips">

                <input type="submit" value="Add Plant" class="btn btn-light mt-3">
                <a href="adminpage.php#plantinder-management" class="btn btn-light mt-3">Back</a>
            </form>
        </div>
    </div>

</body>
</html>
