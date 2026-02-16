<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("NavBar.php");
    require_once("functions.php");
    if (isset($_POST["deleteBooking"])) {
        $id = $_POST["bookingID"];
        deleteBooking($id);
        header("Location: viewBooking.php");
    }
    $booking_id = $_GET["id"];
    $booking = viewBooking($booking_id);
    ?>
    <div>
        <h2 class="centered-header">Delete Booking ID <?php echo $booking[0][0] ?>'s Details?</h2>
    </div>
    <div class="main">
        <form method="post">
            <input type="hidden" name="bookingID" value="<?php echo $booking[0][0]; ?>">
            <input type="text" name="roomID" value="<?php echo $booking[0][1]; ?>" readonly>
            <input type="text" name="guestID" value="<?php echo $booking[0][2]; ?>" readonly>
            <input type="text" name="checkInDate" value="<?php echo $booking[0][3]; ?>" readonly>
            <input type="text" name="checkOutDate" value="<?php echo $booking[0][4]; ?>" readonly>
            <input type="text" name="numOfGuests" value="<?php echo $booking[0][5]; ?>" readonly>
            <input type="text" name="totalPrice" value="<?php echo $booking[0][6]; ?>" readonly>
            <input type="text" name="paymentStatus" value="<?php echo $booking[0][7]; ?>" readonly>
            <button type="submit" name="deleteBooking">Delete Booking</button>
        </form>
    </div>
    <?php include 'footer.php'; ?> 
</body>  
</html>