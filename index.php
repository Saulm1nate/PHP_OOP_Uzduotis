<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud</title>
</head>
<body>
<?php require_once 'forma.php'; ?>

<?php
if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
</div>
<?php endif ?>


<div class="container">
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
?>

<div class="row justify-content-center">
    <table class="table">
        <thead>
        <tr>
            <th>Užduotis</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['task'];?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>"
                   class="btn btn-info">Redaguoti</a>
                <a href="forma.php?delete=<?php echo $row['id']; ?>"
                   class="btn btn-info">Ištrinti</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>
    <?php

    function pre_r( $array ) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>
<div class="row justify-content-center">
<form action="forma.php" method="POST">
    <div class="form-group">
    <label>Užduotis</label>
    <input type="text" name="task" class="form-control"
           value="<?php echo $task; ?>" placeholder="Uzduotis">
    </div>
    <div class="form-group">
        <?php
            if ($update == true):
        ?>
        <button type="submit" class="btn btn-info" name="update">Redaguoti</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Išsaugoti</button>
        <?php endif; ?>
    </div>
</form>
</div>
</div>
</body>
</html>