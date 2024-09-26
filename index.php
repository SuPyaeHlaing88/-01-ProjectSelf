<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center mt-4" style="max-width: 600px;">
        <h1 class="h3 mb-3">Login</h1>
        <?php if (isset($_GET['registered'])) : ?>
            <div class="alert alert-success">Account created. Please Login.</div>
        <?php endif ?>
        <?php if (isset($_GET['suspended'])) : ?>
            <div class="alert alert-danger">Your Account is suspended.</div>
        <?php endif ?>
        <?php if (isset($_GET['incorrect'])): ?>
            <div class="alert alert-warning">Incorrect Email or Password</div>
        <?php endif ?>

        <!-- action and method are important! -->
        <form action="_actions/login.php" method="post">
            <div class="my-2">
                <label for="" style="text-align: left;">Email</label>
                <input type="email" name="email" placeholder="a@b.c" class="form-control" required>
            </div>
            <div class="my-2">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="enter your password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <div class="my-2">
            <a href="register.php">Register</a>
        </div>
    </div>
</body>

</html>