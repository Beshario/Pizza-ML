<?php
	
	
function showCart(){
	if (isset($_SESSION["cart"]) && count($_SESSION["cart"])>0)
	{
?>
<form action="index.php?go=cart" method="post">
	<table>
				<?
				//print_r ($_SESSION["cart"]);
				foreach ($_SESSION["cart"] as $i=>$item){
				
					$ty = $item['type'];
					$nm = $item['name'];
					$ch = $item['choice'];
					$pr = $item['price'];
					$qt = $item['quantity'];
					?>	

					<li>
						
						<?= $ty ?> :
						<?= $nm ?> :
						<?= $ch ?> :
						<?= ($pr/100) ?> :
						<input type='hidden' name="update[<?= $i ?>][type]" value="<?= $ty ?>">
						<input type='hidden' name="update[<?= $i ?>][name]" value="<?= $nm ?>">
						<input type='hidden' name="update[<?= $i ?>][choice]" value="<?= $ch ?>">
						<input type="number" name="update[<?= $i ?>][quantity]" value='<?= $qt ?>'>
						<a href="index.php?go=cart&remove=True&id=<?= $i ?>">remove</a></td><br>
					<?
				}
        $total = getCartTotal();
				?>
				<input type="submit" value="Update"></td>

			</table>
		</form>
<div>Your Total Due at the store is: <?= ($total) ?>$</div>
		<div><a href="index.php?go=checkout">Check Out</a></div>
		<?
	} else {
					  
		?>
		<h2>Cart is Empty</h2>
		<?
	}
    echo'<div><a href="index.php">Keep Ordering</a></div>';
}
?>

<?

function getCartTotal() {
    if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
        return 0;
    }
    $total = 0.00;
    foreach ($_SESSION["cart"] as $item) {
        $price = $item["price"]; //print $price;
        $total +=  ($price) * $item["quantity"];
    };
    return ($total/100);
}
?>

<?php

function sortCart() {
    $tempArr = array();
    foreach($_SESSION["cart"] as $itemKey => $item) {
        $tempArr[$itemKey] = $item["choice"];
    }
    asort($tempArr);
    $tempArr = array_reverse($tempArr, $preserve_keys = true);
    print_r($tempArr);

}

function cmpChoice($a, $b) {
    if ($a["choice"] == $b["choice"]) {
        return 0;
    }
    return ($a["choice"] > $b["choice"]) ? -1 : 1;
}
function cmpName($a, $b) {
    if ($a["name"] == $b["name"]) {
        return 0;
    }
    return ($a["name"] < $b["name"]) ? -1 : 1;
}
function cmpType($a, $b) {
    if ($a["type"] == $b["type"]) {
        return 0;
    }
    return ($a["type"] < $b["type"]) ? -1 : 1;
}



?>
