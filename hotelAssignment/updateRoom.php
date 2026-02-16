<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; 
    require_once "functions.php";
    if (isset($_POST["updateRoom"])) {
        $roomID = $_POST["roomID"];
        $hotelID = $_POST["hotelID"];
        $roomType = $_POST["room-type"];
        $roomNumber = $_POST["room-number"];
        $roomStatus = $_POST["room-status"];


        updateRoom($roomID, $hotelID, $roomType, $roomNumber, $roomStatus);
        header("Location: viewRoom.php");
    }

    $room_ID = $_GET["roomID"];
    $room1 = viewRoom($room_ID);
    ?>
    <div>
        <h2 class="centered-header">Update Details of Room <?php echo $room1[0][0] ?>?</h2>
    </div>
    <div class="main">
         <form method="post">
           <input type="hidden" id="roomID" name="roomID" value="<?php echo $room1[0][0] ?>">
           <input type="hidden" id="hotelID" name="hotelID" value="<?php echo $room1[0][1] ?>">
           <label class=amazing-text for="Room Type:">Room Type:</label>
           <input type="text" id="room-type" name="room-type" value="<?php echo $room1[0][2] ?>" required>
           <label class=amazing-text for="Room Number:">Room Number:</label>
           <input type="text" id="room-number" name="room-number" value="<?php echo $room1[0][3] ?>" required>
           <label class=amazing-text for="Room Status:">Room Status:</label>
           <input type="text" id="room-status" name="room-status" value="<?php echo $room1[0][4] ?>" required>
           <button type="submit" name="updateRoom">Update Room</button>
         </form>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>