<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookings</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div>
        <h2 class="centered-header">Bookings</h2>
    </div>
    <div class = "main">
      <?php
      $db = new SQLite3('S&M Hotel Database.db');

      // Pagination setup
      $records_per_page = 5;
      $current_page = isset($_GET['page']) ? intval($_GET['page']) :1;
      if ($current_page < 1) $current_page = 1;
      $offset = ($current_page - 1) * $records_per_page;
        
      $total_query = "SELECT COUNT(*) as total FROM BOOKING";
      $total_result = $db->query($total_query);
      $total_row = $total_result->fetchArray(SQLITE3_ASSOC);
      $total_records = $total_row['total'];
      $total_pages = ceil($total_records / $records_per_page);
        
      $select_query = "SELECT * FROM BOOKING LIMIT $records_per_page OFFSET $offset";
      $result = $db->query($select_query);

      echo "<table>";
      echo "
      <thead>
        <tr>
          <td>Booking No.</td>
          <td>Room ID</td>
          <td>Guest ID</td>
          <td>Check-In Date</td>
          <td>Check-Out Date</td>
          <td>No. of Guests</td>
          <td>Total Cost</td>
          <td>Payment Status</td>
          <td style ='text-align: center' colspan='2'>Action</td> 
        </tr>
      </thead>";

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $bookingID = $row['bookingID'];
        $roomID = $row['roomID'];
        $guestID = $row['guestID'];
        $checkInDate = $row['checkInDate'];
        $checkOutDate = $row['checkOutDate'];
        $numOfGuests = $row['numOfGuests'];
        $totalCost = $row['totalCost'];
        $paymentStatus = $row['paymentStatus'];
        echo"
        <tbody>
          <tr>
            <td>$bookingID</td>
            <td>$roomID</td>
            <td>$guestID</td>
            <td>$checkInDate</td>
            <td>$checkOutDate</td>
            <td>$numOfGuests</td>
            <td>$totalCost</td>
            <td>$paymentStatus</td>
            <td><a class = update-delete href='updateBooking.php?bookingID=$bookingID'>Update</a></td>
            <td><a class = update-delete href='deleteBooking.php?id=$bookingID'>Delete</a></td>
          </tr>
        </tbody>";
      }
      
      echo "</table>";

      // Pagination links
      echo "<ul class='pagination'>";
      $prev_page = $current_page - 1;
      if ($current_page > 1) {
          echo "<li><a href='viewBooking.php?page=$prev_page'>Previous</a></li>";
      }

      for ($i = 1; $i <= $total_pages; $i++) {
          if ($i == $current_page) {
              echo "<li class='active'><a href='#'>$i</a></li>";
          } else {
              echo "<li><a href='viewBooking.php?page=$i'>$i</a></li>";
          }
      }

      if ($current_page < $total_pages) {
          $next_page = $current_page + 1;
          echo "<li><a href='viewBooking.php?page=$next_page'>Next</a></li>";
      }

      echo "</ul>"; 
      $db->close();
      ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
