<!DOCTYPE HTML>
<html>

<head>
  <title>Make Your outdoor Activities Safer</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width" , initial-scale=1.0 />
  <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
  <link rel="stylesheet" href="styles.css">
  <script type="text/javascript" src="script.js" defer></script>
  <script type="text/javascript" src="../user/common.js" defer></script>

</head>

<body>
  <div class="container">
    <h1 id=quote>Make your outdoor activities safer</h1>
    <div class="form-box">
      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="moveToLogin()"> Sign In</button>
        <button type="button" class="toggle-btn" onclick="moveToRegister()"> Sign Up</button>
      </div>
      <div class="social-icons">
        <img src='../images/meta.png'>
        <img src='../images/insta.png'>
        <img src="../images/twitter.png">
      </div>
      <!-- login form -->
      <form id="login" class="input-group" action="validation.php" method="post">
        <input type="email" class="input-field" name="email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" placeholder="email" required>
        <input type="password" class="input-field" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="password" required>
        <input type="checkbox" name="remember" id='rememberme' <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?> /><span class='info'>Remember me</span>
        <button type="submit" class="sumbit-btn">Log In </button>
        <!-- Remind Passowrd -->
        <div>
          <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

      </form>
      <input type="checkbox" class="check_box" id="checkbox_id" onclick='showPass()'>
      <label for="checkbox_id">
      <!-- registration -->
      <form id="register" class="input-group">
        <input type="email" id='ml' class="input-field" name="email" placeholder="email" required>
        <input type="text" id='name' class="input-field" name="username"  placeholder="username" required>
        <input type="password" id='pass' class="input-field" name="password" placeholder="password" required>
        <label id='msg'></label>
        <br>
        <input type="checkbox" id='agree'> <span class='info'>I agree to the terms & conditions</span>
        <button type="submit" id='reg-btn' class="sumbit-btn">Register</button>
      </form>
    </div>
  </div>
</body>

</html>