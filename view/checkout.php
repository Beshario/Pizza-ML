<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <div>Your total: <?= "$ " . $total ?></div>
    <div>You order has been checked out</div>
    <div>THANKS!</div>
    <? session_destroy(); ?>
    <a href="index.php">HOME</a>
</body>
</html>
