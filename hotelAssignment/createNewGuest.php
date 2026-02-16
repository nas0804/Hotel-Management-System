<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guest</title>
    <link rel="stylesheet" href="style.css">    
  </head>

  <body>
    <?php include 'navbar.php'; 
    require_once 'functions.php';
    if (isset($_POST["createGuest"])) {
        $firstName = $_POST["first-name"];
        $middleName = $_POST["middle-name"];
        $lastName = $_POST["last-name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        addGuest($firstName, $middleName, $lastName, $email, $phone);
    }
    ?>
    <div class="container">
      <div id="navbar-container"></div> 
      <div class="main">
         <h2>Create New Guest</h2>

         <form method="post">
           <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
           <input type="text" id="middle-name" name="middle-name" placeholder="Middle Name">
           <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
            <input type="email" id="email" name="email" placeholder="exampleEmail@provider.com" required>
            <input type="text" id="phone" name="phone" placeholder="Phone Number" required>

           <button type="submit" name="createGuest">Create Guest</button>
           <button type="reset" name="clearForm">Clear</button>
           </form>   

        </div>
      </div>
    <?php include 'footer.php'; ?>
  </body>


</html>