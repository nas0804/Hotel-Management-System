<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel</title>
    <link rel="stylesheet" href="style.css">    
  </head>

  <body>
    <?php include 'navbar.php'; 
    require_once 'functions.php';
    if (isset($_POST["createHotel"])) {
        $hotelName = $_POST["hotel-name"];
        $hotelAddress = $_POST["hotel-address"];
        $city = $_POST["city"];
        $postCode = $_POST["postCode"];
        $phone = $_POST["phone"];
        addHotel($hotelName, $hotelAddress, $city, $postCode, $phone);
    }
    ?>
    <div class="container">
      <div id="navbar-container"></div> 
      <div class="main">
         <h2>Create New Hotel</h2>

         <form method="post">
           <input type="text" id="hotel-name" name="hotel-name" placeholder="Hotel Name" required>
           <input type="text" id="hotel-address" name="hotel-address" placeholder="Hotel Address" required>
           <input type="text" id="city" name="city" placeholder="City" required>
           <input type="text" id="postCode" name="postCode" placeholder="Post Code" required>
           <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
           
            <button type="submit" name="createHotel">Submit</button>
            <button type="reset" name="clearForm">Clear</button>
           </form>   

        </div>
      </div>
    <?php include 'footer.php'; ?>
  </body>


</html>