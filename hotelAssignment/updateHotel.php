<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; 
    require_once "functions.php";
    if (isset($_POST["updateHotel"])) {
        $hotelNo = $_POST["hotelID"];
        $hotelName = $_POST["hotel-name"];
        $hotelAddress = $_POST["hotel-address"];
        $city = $_POST["city"];
        $postalCode = $_POST["postCode"];
        $phoneNumber = $_POST["phone"];


        updateHotel($hotelNo, $hotelName, $hotelAddress, $city, $postalCode, $phoneNumber);
        header("Location: viewHotel.php");
    }

    $hotel_ID = $_GET["hotelID"];
    $hotel1 = viewHotel($hotel_ID);
    ?>
    <div>
        <h2 class="centered-header">Update <?php echo $hotel1[0][1] ?> Details?</h2>
    </div>
    <div class="main">
         <form method="post">
           <input type="hidden" id="hotelID" name="hotelID" value="<?php echo $hotel1[0][0] ?>">
           <label class=amazing-text for="Hotel Name:">Hotel Name:</label>
           <input type="text" id="hotel-name" name="hotel-name" value="<?php echo $hotel1[0][1] ?>" required>
           <label class=amazing-text for="Hotel Address:">Hotel Address:</label>
           <input type="text" id="hotel-address" name="hotel-address" value="<?php echo $hotel1[0][2] ?>" required>
            <label class=amazing-text for="City:">City:</label>
           <input type="text" id="city" name="city" value="<?php echo $hotel1[0][3] ?>" required>
            <label class=amazing-text for="Post Code:">Post Code:</label>
           <input type="text" id="postCode" name="postCode" value="<?php echo $hotel1[0][4] ?>" required>
           <label class=amazing-text for="Phone Number:">Phone Number:</label>
           <input type="text" id="phone" name="phone" value="<?php echo $hotel1[0][5] ?>" required>
           <button type="submit" name="updateHotel">Update Hotel</button>
         </form>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>