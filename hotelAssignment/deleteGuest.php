<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Guest</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("NavBar.php");
    require_once("functions.php");
    if (isset($_POST["deleteGuest"])) {
        $id = $_POST["guestID"];
        deleteGuest($id);
        header("Location: viewGuest.php");
    }
    $guest_id = $_GET["id"];
    $guest = viewGuest($guest_id);
    ?>
    <div>
        <h2 class="centered-header">Delete <?php echo $guest[0][1] ?>'s Details?</h2>
    </div>
    <div class="main">
        <form method="post">
            <input type="hidden" name="guestID" value="<?php echo $guest[0][0]; ?>">
            <input type="text" name="firstName" value="<?php echo $guest[0][1]; ?>" readonly>
            <input type="text" name="middleName" value="<?php echo $guest[0][2]; ?>" readonly>
            <input type="text" name="lastName" value="<?php echo $guest[0][3]; ?>" readonly>
            <input type="text" name="email" value="<?php echo $guest[0][4]; ?>" readonly>
            <input type="text" name="phone" value="<?php echo $guest[0][5]; ?>" readonly>
            <button type="submit" name="deleteGuest">Delete Guest</button>
        </form>
    </div>
    <?php include 'footer.php'; ?> 
</body>  
</html>