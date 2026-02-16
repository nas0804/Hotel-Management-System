<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Room Type</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; 
    require_once "functions.php";
    if (isset($_POST["updateRoomType"])) {
        $roomTypeID = $_POST["roomTypeID"];
        $typeName = $_POST["typeName"];
        $bedCount = $_POST["bedCount"];
        $maxOccupancy = $_POST["maxOccupancy"];
        $pricePerNight = $_POST["pricePerNight"];


        updateRoomType($roomTypeID, $typeName, $bedCount, $maxOccupancy, $pricePerNight);
        header("Location: viewRoomType.php");
    }

    $roomType_ID = $_GET["roomTypeID"];
    $roomType = viewRoomType($roomType_ID);
    ?>
    <div>
        <h2 class="centered-header">Update Details of Room <?php echo $roomType[0][1] ?>?</h2>
    </div>
    <div class="main">
         <form method="post">
           <input type="hidden" id="roomTypeID" name="roomTypeID" value="<?php echo $roomType[0][0] ?>">
           <input type="hidden" id="typeName" name="typeName" value="<?php echo $roomType[0][1] ?>">
           <label class=amazing-text for="bedCount">Bed Count:</label>
           <input type="text" id="bedCount" name="bedCount" value="<?php echo $roomType[0][2] ?>" required>
           <label class=amazing-text for="maxOccupancy">Max Occupancy:</label>
           <input type="text" id="maxOccupancy" name="maxOccupancy" value="<?php echo $roomType[0][3] ?>" required>
           <label class=amazing-text for="pricePerNight">Price Per Night:</label>
           <input type="text" id="pricePerNight" name="pricePerNight" value="<?php echo $roomType[0][4] ?>" required>
           <button type="submit" name="updateRoomType">Update Room Type</button>
         </form>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>