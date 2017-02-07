<?php

// now start the controller

require(C. "helper.php");

//intializing cart in sessions
if (empty($_SESSION["cart"])) {
    // php 5.3 does not support shorthand [] for array().
    $_SESSION["cart"] = array();
}


//add to cart
if (isset($_POST["cart"])) {
	$update = $_POST["cart"];
	foreach ($update as $item) {
		if (!empty($item["quantity"]) &&
		is_numeric($item["quantity"])) {
			$addToCart = True;
			// check if item exists in cart
			foreach($_SESSION["cart"] as $i => $itemInCart) {
				if ($itemInCart["type"] == $item["type"] &&
					$itemInCart["name"] == $item["name"] &&
						$itemInCart["choice"] == $item["choice"]
				) {
					//print_r($_SESSION["cart"]);
					$_SESSION["cart"][$i]["quantity"] += $item["quantity"];
					$addToCart = False;
					//print "<p>already exists. updating quantity</p>";
					break;
				} 
			}
			// add to cart if not exists
			if ($addToCart) {
				$_SESSION["cart"][] = $item;
			}
		}
	}
}

// remove item completely thru remove link
if (isset($_GET["remove"]) && $_GET["remove"] == True) {
	unset($_SESSION["cart"][$_GET["id"]]);
	$_SESSION["cart"] = array_values($_SESSION["cart"]);

}

// update quantity or remove item from cart
if (isset($_POST["update"])) {
	foreach($_POST["update"] as $key => $item) {
		if (is_numeric($item["quantity"])) {

			if ($item["quantity"] <= 0) {
				unset($_SESSION["cart"][$key]);
			} else {
				$_SESSION["cart"][$key]["quantity"] = $item["quantity"];
			}
		}
	}
	$_SESSION["cart"] = array_values($_SESSION["cart"]);
    

}

//routing logic

if (isset($_GET["go"])) {
	switch ($_GET["go"]) {
		// temporary reset link to empty cart
		case "reset":
		session_destroy();
		break;
		
		case "cart":
		usort($_SESSION["cart"], "cmpChoice");
		usort($_SESSION["cart"], "cmpName");
		usort($_SESSION["cart"], "cmpType");
		include(M . "model.php");
		include(V . "cart.php");
		exit;
		break;
		
		case "checkout":
		include(M . "model.php");
		$total = getCartTotal();
		include(V . "checkout.php");
		exit;
		break;
		
		default:
		break;
	}
}

include(M . "model.php");

$total = getCartTotal();

include(V . "view.php");

?>