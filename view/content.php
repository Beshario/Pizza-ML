<?php
#echo "<pre>";
#print_r($menu);
#$result = $menu->xpath("/menu");
#echo "</pre>";
echo '<form action="../html/index.php" method="get">';
/*echo '<select name=“categories">
	<option value="blanc">Please select a category</option>>';*/
foreach ($menu->xpath("/menu/category") as $category)
{ /*?>
	
	<option value="<?=$category[name]?>"><?= $category[name]?></option>
	
	
	<? */
	

	//if (isset($_GET["categories"]))
	print "<h1>{$category["name"]}</h1>";
	
		foreach ($category->children() as $items)
		{ //
			print "<li>";
			print $items->name;
			if (isset($items->price->large))
			{
				print"\t".". Large: ". $items->price->large;
				print "\t".". small: ". $items->price->small;
				print "</li>";
			}
			else
			{
				print"\t".". One Size: ". $items->price;
			}
		}
}
		
echo '</select><input type="submit" value="Submit"><form>';
?>