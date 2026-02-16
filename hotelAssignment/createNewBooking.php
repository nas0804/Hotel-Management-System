<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking</title>
    <link rel="stylesheet" href="style.css">    
  </head>

  <body>
    <?php 
    include "navbar.php"; 
    require_once "functions.php";

    if (isset($_POST["createBooking"])) {
        $roomID = getRoomByType($_POST["roomTypeID"]);
        $guestID = $_POST["guestID"];
        $checkInDate = $_POST["checkInDate"];
        $checkOutDate = $_POST["checkOutDate"];
        $numOfGuests = $_POST["guestNum"];

        // Calculate total price based on room type price and length of stay
        $difference = floor((strtotime($checkOutDate) - strtotime($checkInDate)) / (60 * 60 * 24));
        $totalPrice = getRoomTypePrice($_POST["roomTypeID"]) * $difference;

        addBooking($roomID, $guestID, $checkInDate, $checkOutDate, $numOfGuests, $totalPrice);
    }
    ?>

    <div class="container">
      <div id="navbar-container"></div> 
      <div class="main">
         <h2>Create New Booking</h2>

         <form method="post">
          <!--DROPDOWN ROOM TYPE-->
           <?php dropdownRoomType(); ?>
            <!--DROPDOWN GUEST-->
           <?php dropdownGuest(); ?>
          <!--SELECT CHECK IN AND CHECK OUT DATES-->
          <div class="amazing-text">
            <label for="Check In Date:">Check in date:</label>
            <input type="date" id="checkInDate" name="checkInDate" placeholder="dd/mm/yyyy" min="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="amazing-text">
            <label for="Check Out Date:">Check out date:</label>
            <input type="date" id="checkOutDate" name="checkOutDate" placeholder="dd/mm/yyyy" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
          </div>
           <!--NUMBER OF GUESTS-->
           <input type="number"  id="guestNum" name="guestNum" min="1" max="10" step="1" placeholder="Number of Guests" required>
  
           
           <!--SUBMIT BUTTON-->
           <button type="submit" name="createBooking">Create Booking</button>
           <button type="reset" name="clearForm">Clear</button> 
           </form>   

        </div>
      </div>
    <?php include 'footer.php'; ?>
  </body>


</html>