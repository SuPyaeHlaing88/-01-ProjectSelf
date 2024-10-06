<?php
include ("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;

$table= new UsersTable(new MySQL());
$all = $table->getAll();
$auth= Auth::check();
// var_dump($auth->value);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="js/bootstrap.bundle.min.js"> -->
     <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div style="float: right;">
            <a href="profile.php">Profile</a> |
            <a href="_actions/logout.php" class="text-danger">Logout</a>
        </div>
        <h1 class="mt-5 mb-5">
            Manage Users
            <span class="badge bg-danger text-white">
                <?= count($all) ?>
            </span>
        </h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>ROLE</th>
                <th>ACTIONS</th>
            </tr>
            <!-- for each user row -->
            <?php foreach($all as $user) : ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->phone ?></td>
                    <!-- Role -->
                    <td>
                        <?php if($user->value ==='1') : ?>
                            <span class="badge bg-secondary">
                            <?= $user->role ?>
                            </span>
                        <?php elseif($user->value ==='2') : ?>
                            <span class="badge bg-primary">
                            <?= $user->role ?>
                            </span>
                        <?php elseif($user->value ==='3') : ?>
                            <span class="badge bg-success">
                            <?= $user->role ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-blue">
                            <small>none</small>
                            </span>
                        <?php endif ?>
                    </td>
                    <!-- Actions -->
                    <td>
                        <?php if($auth->value>=1):?>
                            <!-- dorpdown -->
                            <div class="btn-group dropdown">
                                <a href="#" 
                                class="btn btn-outline-primary dropdown-toggle"
                                data-bs-toggle="dropdown">
                                Change Role</a>

                                <div class="dropdown-menu dropdown-menu-dark">
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=1" class="dropdown-item">User</a>
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=2" class="dropdown-item">Manager</a>
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=3" class="dropdown-item">Admin</a>
                                </div>

                                <?php if ($user->suspended) : ?>
									<a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-danger">Suspended</a>
								<?php else : ?>
									<a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-success">Active</a>
								<?php endif ?>

                                <?php if($user->id !== $auth->id): ?>
                                    <a href="_actions/delete.php?id=<?= $user->id ?>" 
                                    class="btn btn-sm btn-outline-danger"
                                    onClick="return confirm('Are you sure')">Delete</a>
                                <?php endif ?>
                            </div>
                            <?php else: ?>
                                <p class="text-muted">###</p>
                            <?php endif ?>
                    </td>
                </tr>
                <?php endforeach ?>
        </table>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>