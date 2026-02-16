<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; 
    require_once "functions.php";
    if (isset($_POST["updateBooking"])) {
        $bookingID = $_POST["bookingID"];
        $roomID = $_POST["roomID"];
        $guestID = $_POST["guestID"];
        $checkInDate = $_POST["checkInDate"];
        $checkOutDate = $_POST["checkOutDate"];
        $numOfGuests = $_POST["numOfGuests"];
        $totalPrice = $_POST["totalPrice"];
        $paymentStatus = $_POST["paymentStatus"];

        updateBooking($bookingID, $roomID, $guestID, $checkInDate, $checkOutDate, $numOfGuests, $totalPrice, $paymentStatus);
        header("Location: viewBooking.php");
    }

    $bookingID = $_GET["bookingID"];
    $booking = viewBooking($bookingID);
    ?>
    <div>
        <h2 class="centered-header">Update Booking ID <?php echo $booking[0][0] ?>?</h2>
    </div>
    <div class="main">
         <form method="post">
            <input type="hidden" id="bookingID" name="bookingID" value="<?php echo $booking[0][0] ?>">
            <input type="hidden" id="roomID" name="roomID" value="<?php echo $booking[0][1] ?>">
            <input type="hidden" id="guestID" name="guestID" value="<?php echo $booking[0][2] ?>">
            <label class=amazing-text for="Check In Date:">Check in date:</label>
            <input type="date" id="checkInDate" name="checkInDate" value="<?php echo $booking[0][3] ?>" required>
            <label class=amazing-text for="Check Out Date:">Check out date:</label>
            <input type="date" id="checkOutDate" name="checkOutDate" value="<?php echo $booking[0][4] ?>" required>
            <label class=amazing-text for="Number of Guests:">Number of Guests:</label>
            <input type="text" id="numOfGuests" name="numOfGuests" value="<?php echo $booking[0][5] ?>" required>
            <label class=amazing-text for="Total Price:">Total Price:</label>
            <input type="text" id="totalPrice" name="totalPrice" value="<?php echo $booking[0][6] ?>" required>
            <label class=amazing-text for="Payment Status:">Payment Status:</label>
            <input type="text" id="paymentStatus" name="paymentStatus" value="<?php echo $booking[0][7] ?>" required>
            <button type="submit" name="updateBooking">Update Booking</button>
         </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>