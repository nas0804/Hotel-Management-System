<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Hotel</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("NavBar.php");
    require_once("functions.php");
    if (isset($_POST["deleteHotel"])) {
        $id = $_POST["hotelID"];
        deleteHotel($id);
        header("Location: viewHotel.php");
    }
    $hotel_id = $_GET["id"];
    $hotel = viewHotel($hotel_id);
    ?>
    <div>
        <h2 class="centered-header">Delete <?php echo $hotel[0][1] ?> Hotel?</h2>
    </div>
    <div class="main">
        <form method="post">
            <input type="hidden" name="hotelID" value="<?php echo $hotel[0][0]; ?>">
            <input type="text" name="hotelName" value="<?php echo $hotel[0][1]; ?>" readonly>
            <input type="text" name="hotelAddress" value="<?php echo $hotel[0][2]; ?>" readonly>
            <input type="text" name="city" value="<?php echo $hotel[0][3]; ?>" readonly>
            <input type="text" name="postcode" value="<?php echo $hotel[0][4]; ?>" readonly>
            <input type="text" name="hotelTelNo" value="<?php echo $hotel[0][5]; ?>" readonly>
            <button type="submit" name="deleteHotel">Delete Hotel</button>
        </form>
    </div>
    <?php include 'footer.php'; ?> 
</body>  
</html>