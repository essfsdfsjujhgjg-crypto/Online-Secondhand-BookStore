<!DOCTYPE html> 
<html>
<head>
  <meta charset="UTF-8">
  <title>Registration Successful</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
      body {
      font-family: "Montserrat", sans-serif;
      background-color: #ecf0f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      max-width: 500px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      text-align: center;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #181818;
    }
    p {
      font-size: 16px;
      margin-bottom: 20px;
      color: #181818;
    }
    .btn-container {
      text-align: center;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4B70E2;
      color: #f9f9f9;
      text-decoration: none;
      border-radius: 25px;
      transition: background-color 0.3s ease;
      font-size: 14px;
      letter-spacing: 1.15px;
      font-weight: 700;
      box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #f9f9f9;
    }
    .btn:hover {
      background-color: #3a599c;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Registration Successful</h1>
    <?php
      if (isset($_POST['username'])) {
        echo '<p>Thank you for registering, ' . $_POST['username'] . '!</p>';
      } else {
        echo '<p>Thank you for registering!</p>';
      }
    ?>
    <div class="btn-container">
      <a href="loader4.html" class="btn">Proceed to Login</a>
    </div>
  </div>
</body>
</html>