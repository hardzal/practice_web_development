<?php
require_once './database.php';
require_once './model.php';

$db = new Database();
$model = new Model($db->connect());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>Data Customer</h1>

        <table class="table table-bordered">
            <tr>
                <th>CustomerID</th>
                <th>CompanyName</th>
                <th>ContactName</th>
                <th>Actions</th>
            </tr>
            <?php
            $show = $model->showAllCustomer();
            while ($data = $show->fetch_object()) :
                ?>
                <tr>
                    <td><?= $data->CustomerID; ?></td>
                    <td><?= $data->CompanyName; ?></td>
                    <td><?= $data->ContactName; ?></td>
                    <td><a href="order.php?id=<?= $data->CustomerID; ?>" class="btn btn-primary">Lihat Order</a></td>
                <?php
                endwhile;
                ?>
        </table>
    </div>
</body>

</html>