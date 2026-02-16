<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("NavBar.php");
    require_once("functions.php");
    if (isset($_POST["deleteRoom"])) {
        $id = $_POST["roomID"];
        deleteRoom($id);
        header("Location: viewRoom.php");
    }
    $room_id = $_GET["roomID"];
    $room = viewRoom($room_id);
    ?>
    <div>
        <h2 class="centered-header">Delete Room <?php echo $room[0][0] ?>?</h2>
    </div>
    <div class="main">
        <form method="post">
            <input type="hidden" name="roomID" value="<?php echo $room[0][0]; ?>">
            <input type="hidden" name="hotelID" value="<?php echo $room[0][1]; ?>" readonly>
            <input type="text" name="roomType" value="<?php echo $room[0][2]; ?>" readonly>
            <input type="text" name="roomNumber" value="<?php echo $room[0][3]; ?>" readonly>
            <input type="text" name="roomStatus" value="<?php echo $room[0][4]; ?>" readonly>
            <button type="submit" name="deleteRoom">Delete Room</button>
        </form>
    </div>
    <?php include 'footer.php'; ?> 
</body>  
</html>