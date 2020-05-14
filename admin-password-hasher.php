<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Magento 2 admin account password hash generator</title>
</head>
<body>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1>Magento 2 admin account password hash generator</h1>
        </div>
    </div>
    <br><br>
    <br>
    <div class="row">
        <div class="col-sm">
            <form action ="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Password: </label>
                    <input type="" class="form-control" placeholder="Enter password" name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Salt.<br>  </label>
                    <input type="" class="form-control" placeholder="Found in magento-root/app/etc/env.php" name="salt" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin username.<em> Optional</em></em><br>  </label>
                    <input type="" class="form-control" placeholder="Admin username" name="username">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php if(isset($_REQUEST['password']) && isset($_REQUEST['salt'])){ ?>
        <?php
            $password = $_REQUEST['password'];
            $salt = $_REQUEST['salt'];
            $passwordSalt = $salt . $password;
            $sha256  = hash ('sha256',$passwordSalt);
            $hashToDB = $sha256 . ":" . $salt . ":1";

            if (isset($_REQUEST['username'])) {
                $username = $_REQUEST['username'];
                $query = "UPDATE admin_user SET password='$hashToDB' WHERE username='$username'";
                $output = "The query is:<br><br><b>$query</b>";
            }


        ?>

        10d3fddf40a36c6f99345f472ba9c93b49fd0c566fc6906c633157887ea0b56d:3pZHRbxdhbNEyc5l:2

        <br><br>
        <div class="row">
            <div class="col-sm">
                <div class="alert alert-success" role="alert">
                    The hash is: <b><?=$hashToDB?></b><br>
                    For the password: <b><?=$password ?></b><br>
                    <?=$output?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<?php






