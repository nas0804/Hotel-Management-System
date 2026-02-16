<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Types</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div>
        <h2 class="centered-header">Room Types</h2>
    </div>
    <div class = "main">
      <?php
      $db = new SQLite3('S&M Hotel Database.db');

      // Pagination setup
      $records_per_page = 5;
      $current_page = isset($_GET['page']) ? intval($_GET['page']) :1;
      if ($current_page < 1) $current_page = 1;
      $offset = ($current_page - 1) * $records_per_page;
        
      $total_query = "SELECT COUNT(*) as total FROM ROOMTYPE";
      $total_result = $db->query($total_query);
      $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
      $total_records = $total_row['total'];
      $total_pages = ceil($total_records / $records_per_page);
        
      $select_query = "SELECT roomTypeID, typeName, bedCount, maxOccupancy, '£' || '' || pricePerNight AS pricePerNight FROM ROOMTYPE LIMIT $records_per_page OFFSET $offset";
      $result = $db->query($select_query);
      echo "<table>";
      echo "
      <thead>
        <tr>
          <td>Room Type ID</td>
          <td>Room Type Name</td>
          <td>Bed Count</td>
          <td>Max Occupancy</td>
          <td>Price Per Night</td>
          <td style ='text-align: center' colspan='2'>Action</td> 
        </tr>
      </thead>";

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $roomTypeID = $row['roomTypeID'];
        $roomTypeName = $row['typeName'];
        $bedCount = $row['bedCount'];
        $maxOccupancy = $row['maxOccupancy'];
        $pricePerNight = $row['pricePerNight'];
        echo"
        <tbody>
          <tr>
            <td>$roomTypeID</td>
            <td>$roomTypeName</td>
            <td>$bedCount</td>
            <td>$maxOccupancy</td>
            <td>$pricePerNight</td>
            <td><a class = 'update-delete' href='updateRoomType.php?roomTypeID=$roomTypeID'>Update</a></td>
            <td><a class = 'update-delete' href='deleteRoomType.php?roomTypeID=$roomTypeID'>Delete</a></td>
          </tr>
        </tbody>";
      }

      echo "</table>";

      // Pagination links
      echo "<ul class='pagination'>";
      $prev_page = $current_page - 1;
      if ($current_page > 1) {
          echo "<li><a href='viewRoomType.php?page=$prev_page'>Previous</a></li>";
      }

      for ($i = 1; $i <= $total_pages; $i++) {
          if ($i == $current_page) {
              echo "<li class='active'><a href='#'>$i</a></li>";
          } else {
              echo "<li><a href='viewRoomType.php?page=$i'>$i</a></li>";
          }
      }

      if ($current_page < $total_pages) {
          $next_page = $current_page + 1;
          echo "<li><a href='viewRoomType.php?page=$next_page'>Next</a></li>";
      }

      echo "</ul>"; 
      $db->close();
      ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
