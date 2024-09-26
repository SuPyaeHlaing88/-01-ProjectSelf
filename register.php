<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrap{
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Register</h1>

        <?php  if(isset($_GET['error'])) :      ?>
            <div class="alert alert-warning">Cannot creat acoout.Please Try Again!</div>
        <?php endif ?>

        <form action="_actions/create.php" method="post">
            <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
            <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
            <input type="text" name="phone" placeholder="Phone" class="form-control mb-2" required>
            <textarea name="address" placeholder="Address" style="width: 100%" required></textarea>
            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
            <button class="btn btn-lg btn-primary w-100">Register</button>
        </form>
        <br>
        <a href="index.php">Login</a>
    </div>
</body>
</html>