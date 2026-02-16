<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room Type</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    include("NavBar.php");
    require_once("functions.php");
    if (isset($_POST["deleteRoomType"])) {
        $id = $_POST["roomTypeID"];
        deleteRoomType($id);
        header("Location: viewRoomType.php");
    }
    $roomType_id = $_GET["roomTypeID"];
    $roomType = viewRoomType($roomType_id);
    ?>
    <div>
        <h2 class="centered-header">Delete <?php echo $roomType[0][1] ?> Room Type?</h2>
    </div>
    <div class="main">
        <form method="post">
            <input type="hidden" name="roomTypeID" value="<?php echo $roomType[0][0]; ?>">
            <input type="text" name="typeName" value="<?php echo $roomType[0][1]; ?>" readonly>
            <input type="text" name="bedCount" value="<?php echo $roomType[0][2]; ?>" readonly>
            <input type="text" name="maxOccupancy" value="<?php echo $roomType[0][3]; ?>" readonly>
            <input type="text" name="pricePerNight" value="<?php echo $roomType[0][4]; ?>" readonly>
            <button type="submit" name="deleteRoomType">Delete Room Type</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</html>