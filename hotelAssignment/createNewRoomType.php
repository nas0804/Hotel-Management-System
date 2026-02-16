<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Type</title>
    <link rel="stylesheet" href="style.css">    
  </head>

  <body>
    <?php include 'navbar.php'; 
    require_once 'functions.php';
    if (isset($_POST['createRoomType'])) {
        $typeName = $_POST["typeName"];
        $bedCount = $_POST["bedCount"];
        $maxOccupancy = $_POST["maxOccupancy"];
        $pricePerNight = $_POST["pricePerNight"];
        addRoomType($typeName, $bedCount, $maxOccupancy, $pricePerNight);
    }
    ?>
    <div class="container">
      <div id="navbar-container"></div> 
      <div class="main">
         <h2>Create New Room Type</h2>

         <form method="post">
           <input type="text" id="typeName" name="typeName" placeholder="Room Type Name" required>
           <input type="number"  id="bedCount" name="bedCount" min="1" max="10" step="1" placeholder="Bed Count" required>
           <input type="number"  id="maxOccupancy" name="maxOccupancy" min="1" max="10" step="1" placeholder="Max Occupancy" required>
           <input type="number"  id="pricePerNight" name="pricePerNight" min="0" step="0.01" placeholder="Price Per Night" required>
          
           <button type="submit" name="createRoomType">Create Room Type</button>
           <button type="reset" name="clearForm">Clear</button>
           </form>   

        </div>
      </div>
    <?php include 'footer.php'; ?>
  </body>


</html>