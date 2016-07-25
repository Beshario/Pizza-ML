<?php
if (isset($_GET["categories"]))
{
	$menu_value=$_GET["categories"];
	print "<br>";
	$_SESSION["type"]=$menu_value;
}
elseif (isset($_SESSION["type"]))
{
	$menu_value=$_SESSION["type"];
}
else
	$menu_value = "blanc";

echo '<form action="index.php" method="get">';
print '<select name="categories">;
	<option value="blanc">Please select a category</option>';

foreach ($menu->xpath("/menu/category") as $category)
{ ?>	
	<option value="<?= $category[name]?>" <?= ($category[name]==$menu_value) ? 'selected="selected"':''; ?> select><?= $category[name]?></option>
	<? 
}

echo '</select><input type="submit"></form><br>';
if ($menu_value =="blanc") {
	echo '<h2>please choose a category';
}
else 
{
	print "<h1>$menu_value</h1>";
}
$i=0; //counter for multi array

?><form action="index.php" method="post"><?

foreach($menu->xpath("/menu/category[@name='$menu_value']") as $category) //loop through the one caregory
{
	foreach ($category->children() as $items)
	{ 
		//if (count($category) > 0)
		//{
		
			print "<li>";
			$name=$items->name;
			print $name.'<br>';
			if (isset($items->price->large)) //if the menue has large and small sizes
			{
				$price=$items->price->large; //to store the price in the loop
				print "\t Large: $price" ;
			
				$choice="large"; //choice is large, think about not hard coding it
				?>
			
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $menu_value ?>">
				
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
			
		
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
					<input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"><br>
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
					<?php
				$price=$items->price->small;				
				print "\t".". small: $price";
				$choice="small";
				$i++; 
				?>
			 
				
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $menu_value ?>">
				
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
				
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
				
					<input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"><br>
			
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
			<?php
			$i++; 
			}
			else
			{
				$price=$items->price;
				print"\t".". One Size: ". $price;
				$choice= "One Size";
				print "</li>"; ?>
	
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $type ?>">
			
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
			
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
			
					<input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"><br>
			
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
							
				<?php
				$i++;
			}
			echo "</li>";
		
		
			//}
			$i++;
		}
	}

?>
<br><input type="submit" value="Add To Cart"><br>
</form>
    <p>Total: $ <?= number_format($total, 2) ?></p>
    <a href="index.php?go=cart">Go to cart</a>
    <br />
    <a href="index.php?go=reset">RESET</a>
</body>
</html>