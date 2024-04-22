<!DOCTYPE html>
<html lang="en">
<head>
     <title>Register</title>
     <link rel="stylesheet" href="css2.css">
</head>
<body>
    <h1>Registration Form</h1>
    <form action="regiSubmit.php" method="post">
  <div class="container">

    <label for="email"><b>Email</b></label><br>
    <input type="text" placeholder="Enter Email" name="email" id="email" required><br><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password" placeholder="Enter password" name="psw" id="psw" required><br><br>

    <label for="Comfirm-pass"><b>Confirm password</b></label><br>
    <input type="password" placeholder="Confirm password" name="psw-repeat" id="psw-repeat" required><br><br>
    
    <label for="name"><b>Name</b></label><br>
    <input type="text" placeholder="Enter Name" name="name" id="name" required><br><br>

    <label for="gender"><b>Gender</b></label><br>
    <input type="radio" value ="0" name="gender" id="male">Male</input><br>
    <input type="radio" value="1" name="gender" id="female">Female</input><br><br>

    <label for="city"><b>City</b></label><br>
    <input type="text" placeholder="Enter city" name="city" id="city" required><br><br>

    <label for="class"><b>Class</b></label><br>
    <input type="text" placeholder="Enter class" name="class" id="class" required><br><br>

    <label for="stream"><b>Stream</b></label><br>
    <input type="text" placeholder="Enter stream" name="stream" id="stream" required><br><br>

    <button type="submit" class="registerbtn">Register</button>
  </div>
</form>
</body>
</html>