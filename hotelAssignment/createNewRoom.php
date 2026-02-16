<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <?php include 'navbar.php'; 
    require_once 'functions.php';
    if (isset($_POST["createRoom"])) {
        $hotelID = $_POST["hotelID"];
        $roomTypeID = $_POST["roomTypeID"];
        $roomNum = $_POST["roomNum"];
        $roomStatus = $_POST["roomStatus"];
        addRoom($hotelID, $roomTypeID, $roomNum, $roomStatus);
    }
    ?>
    <div class="container">
      <div id="navbar-container"></div> 
      <div class="main">
         <h2>Create New Room</h2>

         <form method="post">
          <!--DROPDOWN HOTEL-->
           <?php dropdownHotel(); ?>
           <!--DROPDOWN ROOM TYPE-->
           <?php dropdownRoomType(); ?>
           <!--SELECT ROOM NUMBER-->
           <input type="number"  id="roomNum" name="roomNum" min="1" max="10000" step="1" placeholder="Room Number" required>
           <!--DROPDOWN ROOM STATUS-->
           <select id="roomStatus" name="roomStatus" required>
             <option value="">Select Room Status</option>
             <option value="Available">Available</option>
             <option value="Occupied">Occupied</option>
             <option value="Cleaning">Cleaning</option>
             <option value="Maintenance">Maintenance</option>
           </select>

           <button type="submit" name="createRoom">Create Room</button>
           <button type="reset" name="clearForm">Clear</button>
           </form>   

        </div>
      </div>
    <?php include 'footer.php'; ?>
  </body>


</html>