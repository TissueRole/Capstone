<?php
    include '../connection.php';

    if (isset($_GET['id'])){
        $id =$_GET['id'];

        $sql = "SELECT * FROM plant WHERE plant_id = $id";
        $result=$conn->query($sql);

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $description = $row['description'];
            $image = $row['image'];
            $container_soil = $row['container_soil'];
            $watering = $row['watering'];
            $sunlight = $row['sunlight'];
            $tips = $row['tips'];
        }
        else{
            echo "No module found";
        }
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $container_soil = mysqli_real_escape_string($conn, $_POST['container_soil']);
        $watering = mysqli_real_escape_string($conn, $_POST['watering']);
        $sunlight = mysqli_real_escape_string($conn, $_POST['sunlight']);
        $tips = mysqli_real_escape_string($conn, $_POST['tips']);

        $id = $_POST['id'];

        if(!empty($name)&& !empty($description)&& !empty($image)&& !empty($container_soil) && !empty($watering) && !empty($sunlight) && !empty($tips)){
            $sql ="UPDATE plant SET name='$name', description='$description', image= '$image', container_soil= '$container_soil', watering= '$watering', sunlight= '$sunlight', tips= '$tips'  WHERE plant_id='$id'";
            
            if($conn->query($sql)=== TRUE){
                echo "<h1 class='text-center fs-3 mt-5'>Modules updated sucessfully!</h1>";
                header("Location: adminpage.php#plantinder-management");
            }
            else{
                echo "<h1 class='text-center fs-3 mt-5'>Update Failed: " . mysqli_error($conn) . "</h1>";
            }
        }
        else{
            echo "<h1 class='text-center fs-3 '>Fill all the fields!</h1>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
            <form action="editplant.php" method="POST" class=" p-5 bg-dark ">
                <h2 class="fs-3 mb-4 text-white">Enter Plant Details</h2>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <label for="name" class="form-label fw-semibold fs-5 text-white">Name:</label>
                <input type="text" class="form-control mb-3" id="name" name="name" value="<?php echo $name;?>">

                <label for="description" class="form-label fw-semibold fs-5 text-white">Description:</label>
                <textarea class="form-control mb-3" id="description" name="description" rows="5"><?php echo $description;?></textarea>

                <label for="image" class="form-label fw-semibold fs-5 text-white">Image:</label>
                <input class="form-control mb-3" id="image" name="image" value="<?php echo $image;?>">

                <label for="container_soil" class="form-label fw-semibold fs-5 text-white">Container & Soil:</label>
                <input class="form-control mb-3" id="container_soil" name="container_soil" value="<?php echo $container_soil;?>">

                <label for="watering" class="form-label fw-semibold fs-5 text-white">Watering:</label>
                <input type="text" class="form-control mb-3" id="watering" name="watering" value="<?php echo $watering;?>">

                <label for="sunlight" class="form-label fw-semibold fs-5 text-white">Sunlight:</label>
                <input type="text" class="form-control mb-3" id="sunlight" name="sunlight" value="<?php echo $sunlight;?>">

                <label for="tips" class="form-label fw-semibold fs-5 text-white">Tips:</label>
                <input type="text" class="form-control mb-3" id="tips" name="tips" value="<?php echo $tips;?>">

                <input type="submit" value="Edit" class="btn btn-light mt-3">
                <a href="adminpage.php" class="btn btn-light mt-3">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
