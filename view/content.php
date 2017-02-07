<?php
if (isset($_GET["categories"]))
{
	$menu_value=$_GET["categories"];
	//print "<br>";
	$_SESSION["type"]=$menu_value;
}
elseif (isset($_SESSION["type"]))
{
	$menu_value=$_SESSION["type"];
}
else
	$menu_value = "blanc";
echo '<div class="form-group">
  <label for="category">Select a category from the list:</label><br>';
echo '<form action="index.php" method="get">';
print '<select class="form-control" name="categories">;
	<option value="blanc">Please select a category</option>';

//dropdown menu
foreach ($menu->xpath("/menu/category") as $category) 
{ ?>	
	<option value="<?= $category[name]?>" <?= ($category[name]==$menu_value) ? 'selected="selected"':''; ?> select><?= $category[name]?></option>
	<?php 
}
//warning 
echo '</select><input  class="btn btn-info" type="submit"></form><br>';
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
    echo'<table class="table">
        <tr>
            <th>Name</th>'; $n=0; //counter to only print the table headers once. (if n=0)
	foreach ($category->children() as $items)
	{ 

			$name=$items->name;
			if (isset($items->price->large)) //if the menue has large and small sizes
			{
                if ($n==0) {print'<th>Large</th><th>QTY</th><th>Small</th><th>QTY</th></tr>'; $n++;}
                print '<tr><td>'.$name.'</td>';
				$price=$items->price->large; //to store the price in the loop
				print '<td>'.($price/100).'$</td>';
			
				$choice="large"; //choice is large, think about not hard coding it
				?>
			
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $menu_value ?>">
				
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
			
		
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
            <td><input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"></td>
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
					<?php
				$price=$items->price->small;				
				print '<td>'.($price/100).'$</td>';
				$choice="small";
				$i++; 
				?>
			 
				
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $menu_value ?>">
				
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
				
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
				
					<td><input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"></td></tr>
			
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
			<?php
			$i++; 
			}
			else
			{
                if ($n==0) {print'<th>Price</th><th>QTY</th></tr>'; $n++;}
                print '<tr><td>'.$name.'</td>';
				$price=$items->price;
				print '<td>'.($price/100).'$</td>';
				$choice= "One Size";
				print "</li>"; ?>
	
					<input type='hidden' name="cart[<?= $i ?>][type]" value="<?= $type ?>">
			
				
					<input type='hidden' name="cart[<?= $i ?>][name]" value="<?= $name ?>">
			
					<input type='hidden' name="cart[<?= $i ?>][choice]" value="<?= $choice ?>">
			
					<td><input type="number" name ="cart[<?= $i ?>][quantity]"  name="quantity" min="0" max="9"></td></tr>
			
					<input type="hidden" name ="cart[<?= $i ?>][price]" value="<?= $price?>">
							
				<?php
				$i++;
			}
			$i++;
		}
	}

?>
            </table>
<br><input <?= ($menu_value =="blanc") ? 'disabled':''; ?> type="submit" value="Add To Cart"><br>
</form>
    <p>Total: $ <?= number_format($total, 2) ?></p>
    <a href="index.php?go=cart">Go to cart</a>
    <br />
    <a href="index.php?go=reset">RESET</a>
