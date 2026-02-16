<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Guest</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; 
    require_once "functions.php";
    if (isset($_POST["updateGuest"])) {
        $guestID = $_POST["guestID"];
        $firstName = $_POST["first-name"];
        $middleName = $_POST["middle-name"];
        $lastName = $_POST["last-name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];


        updateGuest($guestID, $firstName, $middleName, $lastName, $email, $phone);
        header("Location: viewGuest.php");
    }

    $guest_ID = $_GET["guestID"];
    $guest1 = viewGuest($guest_ID);
    ?>
    <div>
        <h2 class="centered-header">Update <?php echo $guest1[0][1] ?>'s Details?</h2>
    </div>
    <div class="main">
         <form method="post">
           <input type="hidden" id="ID" name="guestID" value="<?php echo $guest1[0][0] ?>">
           <label class=amazing-text for="First Name:">First Name:</label>
           <input type="text" id="first-name" name="first-name" value="<?php echo $guest1[0][1] ?>" required>
           <label class=amazing-text for="Middle Name:">Middle Name:</label>
           <input type="text" id="middle-name" name="middle-name" value="<?php echo $guest1[0][2] ?>">
           <label class=amazing-text for="Last Name:">Last Name:</label>
           <input type="text" id="last-name" name="last-name" value="<?php echo $guest1[0][3] ?>" required>
           <label class=amazing-text for="Email:">Email:</label>
           <input type="text" id="email" name="email" value="<?php echo $guest1[0][4] ?>" required>
           <label class=amazing-text for="Phone Number:">Phone Number:</label>
           <input type="text" id="phone" name="phone" value="<?php echo $guest1[0][5] ?>" required>
           <button type="submit" name="updateGuest">Update Guest</button>
         </form>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>