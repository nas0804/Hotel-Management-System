<?php
require_once 'db_connect.php';

//==========HOTEL FUNCTIONS==========
function addHotel($name, $address, $city, $postcode, $phone)
{
    $db = db_connect();
    $stmt = $db->prepare("INSERT INTO HOTEL (hotelName, hotelAddress, city, postcode,hotelTelNo) VALUES (:name, :address, :city, :postcode, :phone)");
    $stmt->bindValue(":name", $name, SQLITE3_TEXT);
    $stmt->bindValue(":address", $address, SQLITE3_TEXT);
    $stmt->bindValue(":city", $city, SQLITE3_TEXT);
    $stmt->bindValue(":postcode", $postcode, SQLITE3_TEXT);
    $stmt->bindValue(":phone", $phone, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "A new Hotel created successfully!";
    } else {
        echo "Failed to create hotel.";
    }
    $db->close();
}

function dropdownHotel(): void
{
    $db = db_connect();
    $query = "SELECT hotelID, hotelName FROM HOTEL";
    $result = $db->query($query);
    echo '<select name ="hotelID">';
    echo '<option value="">Select Hotel</option>';

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo '<option value="' . $row['hotelID'] . '">' . $row['hotelName'] . '</option>';
    }
    echo '</select>';
    $db->close();
}

function viewHotel($hotelID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM HOTEL WHERE hotelID = :id");
    $stmt->bindValue(":id", $hotelID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $hotel_detail = [];
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $hotel_detail[] = $row;
    }

    $result->finalize();
    $db->close();

    return $hotel_detail;
}

function updateHotel($hotelID, $name, $address, $city, $postcode, $phone) 
{
    $db = db_connect();
    $stmt = $db->prepare("UPDATE HOTEL SET hotelName = :name, hotelAddress = :address, city = :city, postcode = :postcode, hotelTelNo = :phone WHERE hotelID = :hotelID");
    $stmt->bindValue(":hotelID", $hotelID, SQLITE3_INTEGER);
    $stmt->bindValue(":name", $name, SQLITE3_TEXT);
    $stmt->bindValue(":address", $address, SQLITE3_TEXT);
    $stmt->bindValue(":city", $city, SQLITE3_TEXT);
    $stmt->bindValue(":postcode", $postcode, SQLITE3_TEXT);
    $stmt->bindValue(":phone", $phone, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Hotel updated successfully!";
    } else {
        echo "Failed to update hotel." . $db->lastErrorMsg();
    }
    $db->close();
}

function deleteHotel($hotelID)
{
    $db = db_connect();
    $stmt = $db->prepare("DELETE FROM HOTEL WHERE hotelID = :hotelID");
    $stmt->bindValue(":hotelID", $hotelID, SQLITE3_INTEGER);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Hotel deleted successfully!";
    } else {
        echo "Failed to delete hotel.";
    }
    $db->close();
}

//==========BOOKING FUNCTIONS==========
function addBooking($roomID, $guestID, $checkInDate, $checkOutDate, $numOfGuests, $totalPrice)
{
    $db = db_connect();
    $stmt = $db->prepare("INSERT INTO BOOKING (roomID, guestID, checkInDate, checkOutDate, numOfGuests, totalCost, paymentStatus) 
                          VALUES (:roomID, :guestID, :checkInDate, :checkOutDate, :numOfGuests, :totalCost, :paymentStatus)");
    $stmt->bindValue(":roomID", $roomID, SQLITE3_INTEGER);                      
    $stmt->bindValue(":guestID", $guestID, SQLITE3_INTEGER);
    $stmt->bindValue(":checkInDate", $checkInDate, SQLITE3_TEXT);
    $stmt->bindValue(":checkOutDate", $checkOutDate, SQLITE3_TEXT);
    $stmt->bindValue(":numOfGuests", $numOfGuests, SQLITE3_INTEGER);
    $stmt->bindValue(":totalCost", $totalPrice, SQLITE3_FLOAT);
    $stmt->bindValue(":paymentStatus", "Pending", SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "A new Booking created successfully!";
    } else {
        echo "Failed to create booking.";
    }
    $db->close();
}

function viewBooking($bookingID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM BOOKING WHERE bookingID = :id");
    $stmt->bindValue(":id", $bookingID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $booking_detail = [];
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $booking_detail[] = $row;
    }

    $result->finalize();
    $db->close();

    return $booking_detail;
}

function updateBooking($bookingID, $roomID, $guestID, $checkInDate, $checkOutDate, $numOfGuests, $totalPrice, $paymentStatus)   
{
    $db = db_connect();
    $stmt = $db->prepare("UPDATE BOOKING SET roomID = :roomID, guestID = :guestID, checkInDate = :checkInDate, checkOutDate = :checkOutDate, numOfGuests = :numOfGuests, totalCost = :totalCost, paymentStatus = :paymentStatus WHERE bookingID = :bookingID");
    $stmt->bindValue(":bookingID", $bookingID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomID", $roomID, SQLITE3_INTEGER);                      
    $stmt->bindValue(":guestID", $guestID, SQLITE3_INTEGER);
    $stmt->bindValue(":checkInDate", $checkInDate, SQLITE3_TEXT);
    $stmt->bindValue(":checkOutDate", $checkOutDate, SQLITE3_TEXT);
    $stmt->bindValue(":numOfGuests", $numOfGuests, SQLITE3_INTEGER);
    $stmt->bindValue(":totalCost", $totalPrice, SQLITE3_FLOAT);
    $stmt->bindValue(":paymentStatus", $paymentStatus, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Booking updated successfully!";
    } else {
        echo "Failed to update booking." . $db->lastErrorMsg();
    }
    $db->close();
}

function deleteBooking($bookingID)
{
    $db = db_connect();
    
    // First, get the roomID from the booking
    $selectStmt = $db->prepare("SELECT roomID FROM BOOKING WHERE bookingID = :bookingID");
    $selectStmt->bindValue(":bookingID", $bookingID, SQLITE3_INTEGER);
    $selectResult = $selectStmt->execute();
    $row = $selectResult->fetchArray(SQLITE3_ASSOC);
    
    if ($row) {
        $roomID = $row['roomID'];
        
        // Delete the booking
        $stmt = $db->prepare("DELETE FROM BOOKING WHERE bookingID = :bookingID");
        $stmt->bindValue(":bookingID", $bookingID, SQLITE3_INTEGER);
        
        if ($stmt->execute()) {
            // Update room status to Available after deleting booking
            $updateStmt = $db->prepare("UPDATE ROOM SET roomStatus = :roomStatus WHERE roomID = :roomID");
            $updateStmt->bindValue(":roomStatus", "Available", SQLITE3_TEXT);
            $updateStmt->bindValue(":roomID", $roomID, SQLITE3_INTEGER);
            $updateStmt->execute();
            
            echo "Booking deleted successfully!";
        } else {
            echo "Failed to delete booking.";
        }
    } else {
        echo "Booking not found.";
    }
    
    $db->close();
}

//==========GUEST FUNCTIONS==========
function addGuest($firstName, $middleName, $lastName, $email, $phone)
{
    $db = db_connect();
    $stmt = $db->prepare("INSERT INTO GUEST (F_Name, M_Name, L_Name, email, phoneNum) 
                          VALUES (:firstName, :middleName, :lastName, :email, :phone)");
    $stmt->bindValue(":firstName", $firstName, SQLITE3_TEXT);
    $stmt->bindValue(":middleName", $middleName, SQLITE3_TEXT);
    $stmt->bindValue(":lastName", $lastName, SQLITE3_TEXT);
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $stmt->bindValue(":phone", $phone, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "A new Guest created successfully!";
    } else {
        echo "Failed to create guest.";
    }
    $db->close();
}

function dropdownGuest(): void
{
    $db = db_connect();
    $query = "SELECT guestID, F_Name || ' ' || L_Name AS fullName FROM GUEST";
    $result = $db->query($query);
    echo '<select name ="guestID">';
    echo '<option value="">Select Guest</option>';

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo '<option value="' . $row['guestID'] . '">' . $row['fullName'] . '</option>';
    }
    echo '</select>';
    $db->close();
}

function viewGuest($guestID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM GUEST WHERE guestID = :id");
    $stmt->bindValue(":id", $guestID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $guest_detail = [];
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $guest_detail[] = $row;
    }

    $result->finalize();
    $db->close();

    return $guest_detail;
}

function updateGuest($guestID, $firstName, $middleName, $lastName, $email, $phone) 
{
    $db = db_connect();
    $stmt = $db->prepare("UPDATE GUEST SET F_Name = :firstName, M_Name = :middleName, L_Name = :lastName, email = :email, phoneNum = :phone WHERE guestID = :guestID");
    $stmt->bindValue(":guestID", $guestID, SQLITE3_INTEGER);
    $stmt->bindValue(":firstName", $firstName, SQLITE3_TEXT);
    $stmt->bindValue(":middleName", $middleName, SQLITE3_TEXT);
    $stmt->bindValue(":lastName", $lastName, SQLITE3_TEXT);
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $stmt->bindValue(":phone", $phone, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Guest updated successfully!";
    } else {
        echo "Failed to update guest." . $db->lastErrorMsg();
    }
    $db->close();
}

function deleteGuest($guestID)
{
    $db = db_connect();
    $stmt = $db->prepare("DELETE FROM GUEST WHERE guestID = :guestID");
    $stmt->bindValue(":guestID", $guestID, SQLITE3_INTEGER);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Guest deleted successfully!";
    } else {
        echo "Failed to delete guest.";
    }
    $db->close();
}

//==========ROOM FUNCTIONS==========
function addRoom($hotelID, $roomTypeID, $roomNum, $roomStatus)
{
    $db = db_connect();
    $stmt = $db->prepare("INSERT INTO ROOM (hotelID, roomTypeID, roomNumber, roomStatus) 
                          VALUES (:hotelID, :roomTypeID, :roomNum, :roomStatus)");
    $stmt->bindValue(":hotelID", $hotelID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomNum", $roomNum, SQLITE3_INTEGER);
    $stmt->bindValue(":roomStatus", $roomStatus, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "A new Room created successfully!";
    } else {
        echo "Failed to create room.";
    }
    $db->close();
}

function viewRoom($roomID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM ROOM WHERE roomID = :id");
    $stmt->bindValue(":id", $roomID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $room_detail = [];
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $room_detail[] = $row;
    }

    $result->finalize();
    $db->close();

    return $room_detail;
}

function updateRoom($roomID, $hotelID, $roomTypeID, $roomNum, $roomStatus) 
{
    $db = db_connect();
    $stmt = $db->prepare("UPDATE ROOM SET hotelID = :hotelID, roomTypeID = :roomTypeID, roomNumber = :roomNum, roomStatus = :roomStatus WHERE roomID = :roomID");
    $stmt->bindValue(":roomID", $roomID, SQLITE3_INTEGER);
    $stmt->bindValue(":hotelID", $hotelID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomNum", $roomNum, SQLITE3_INTEGER);
    $stmt->bindValue(":roomStatus", $roomStatus, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Room updated successfully!";
    } else {
        echo "Failed to update room." . $db->lastErrorMsg();
    }
    $db->close();
}

function deleteRoom($roomID)
{
    $db = db_connect();
    $stmt = $db->prepare("DELETE FROM ROOM WHERE roomID = :roomID");
    $stmt->bindValue(":roomID", $roomID, SQLITE3_INTEGER);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Room deleted successfully!";
    } else {
        echo "Failed to delete room.";
    }
    $db->close();
}

function getRoomByType($roomTypeID)
{
    $db = db_connect();

    // Get all available rooms of that room type
    $stmt = $db->prepare("SELECT roomID FROM ROOM WHERE roomTypeID = :roomTypeID AND roomStatus = :roomStatus");
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);
    $stmt->bindValue(":roomStatus", "Available", SQLITE3_TEXT);

    $result = $stmt->execute();

    $rooms = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $rooms[] = $row["roomID"];
    }

    // No available rooms for that type
    if (count($rooms) === 0) {
        return null;
    }

    // Pick a random roomID
    $randomRoomID = $rooms[array_rand($rooms)];

    // Update the room status to Occupied
    $updateStmt = $db->prepare("UPDATE ROOM SET roomStatus = :roomStatus WHERE roomID = :roomID");
    $updateStmt->bindValue(":roomStatus", "Occupied", SQLITE3_TEXT);
    $updateStmt->bindValue(":roomID", $randomRoomID, SQLITE3_INTEGER);
    $updateStmt->execute();

    $db->close();

    return $randomRoomID;
}


//==========ROOM TYPE FUNCTIONS==========
function addRoomType($typeName, $bedCount, $maxOccupancy, $price)
{
    $db = db_connect();
    $stmt = $db->prepare("INSERT INTO ROOMTYPE (typeName, bedCount, maxOccupancy, pricePerNight) 
                          VALUES (:typeName, :bedCount, :maxOccupancy, :price)");
    $stmt->bindValue(":typeName", $typeName, SQLITE3_TEXT);
    $stmt->bindValue(":bedCount", $bedCount, SQLITE3_INTEGER);
    $stmt->bindValue(":maxOccupancy", $maxOccupancy, SQLITE3_INTEGER);
    $stmt->bindValue(":price", $price, SQLITE3_FLOAT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "A new Room Type created successfully!";
    } else {
        echo "Failed to create room type.";
    }
    $db->close();
}

function dropdownRoomType(): void
{
    $db = db_connect();
    $query = "SELECT roomTypeID, typeName FROM ROOMTYPE";
    $result = $db->query($query);
    echo '<select name ="roomTypeID">';
    echo '<option value="">Select Room Type</option>';

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo '<option value="' . $row['roomTypeID'] . '">' . $row['typeName'] . '</option>';
    }
    echo '</select>';
    $db->close();
}

function viewRoomType($roomTypeID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM ROOMTYPE WHERE roomTypeID = :id");
    $stmt->bindValue(":id", $roomTypeID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $roomtype_detail = [];
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $roomtype_detail[] = $row;
    }

    $result->finalize();
    $db->close();

    return $roomtype_detail;
}

function updateRoomType($roomTypeID, $typeName, $bedCount, $maxOccupancy, $price) 
{
    $db = db_connect();
    $stmt = $db->prepare("UPDATE ROOMTYPE SET typeName = :typeName, bedCount = :bedCount, maxOccupancy = :maxOccupancy, pricePerNight = :price WHERE roomTypeID = :roomTypeID");
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);
    $stmt->bindValue(":typeName", $typeName, SQLITE3_TEXT);
    $stmt->bindValue(":bedCount", $bedCount, SQLITE3_INTEGER);
    $stmt->bindValue(":maxOccupancy", $maxOccupancy, SQLITE3_INTEGER);
    $stmt->bindValue(":price", $price, SQLITE3_FLOAT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Room Type updated successfully!";
    } else {
        echo "Failed to update room type." . $db->lastErrorMsg();
    }
    $db->close();
}

function deleteRoomType($roomTypeID)
{
    $db = db_connect();
    $stmt = $db->prepare("DELETE FROM ROOMTYPE WHERE roomTypeID = :roomTypeID");
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Room Type deleted successfully!";
    } else {
        echo "Failed to delete room type.";
    }
    $db->close();
}

function getRoomTypePrice($roomTypeID)
{
    $db = db_connect();
    $stmt = $db->prepare("SELECT pricePerNight FROM ROOMTYPE WHERE roomTypeID = :roomTypeID");
    $stmt->bindValue(":roomTypeID", $roomTypeID, SQLITE3_INTEGER);

    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();

    return $row ? $row['pricePerNight'] : null;
}



?>