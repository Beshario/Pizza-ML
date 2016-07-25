<?php
	
	
function showCart(){
	if (isset($_SESSION["cart"]) && count($_SESSION["cart"])>0)
	{
?>
<form action="index.php?go=cart" method="post">
	<table>
		<pre>
				<?
				print_r ($_SESSION["cart"]);
				echo '</pre>';
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
						<?= $pr ?> :
						<input type='hidden' name="update[<?= $i ?>][type]" value="<?= $ty ?>">
						<input type='hidden' name="update[<?= $i ?>][name]" value="<?= $nm ?>">
						<input type='hidden' name="update[<?= $i ?>][choice]" value="<?= $ch ?>">
						<input type="number" name="update[<?= $i ?>][quantity]" value='<?= $qt ?>'>
						<a href="index.php?go=cart&remove=True&id=<?= $i ?>">remove</a></td><br>
					<?
				}
				?>
				<input type="submit" value="Update"></td>

			</table>
		</form>
		<div><a href="threeaces.php?go=checkout">Check Out</a></div>
		<?
	} else {
					  
		?>
		<h2>Cart is Empty</h2>
		<?
	}
}
?>

<?

function getCartTotal() {
    if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
        return 0;
    }
    $total = 0.00;
    foreach ($_SESSION["cart"] as $item) {
        $price = $item["price"];
        $total += intval($price[0]) * $item["quantity"];
    }
    return $total;
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
