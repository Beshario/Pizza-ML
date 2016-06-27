<?php
#echo "<pre>";
#print_r($menu);
#$result = $menu->xpath("/menu");
#echo "</pre>";

foreach ($menu->xpath("/menu/category") as $category)

{
	print "<h1>" .$category[name]. "</h1>";
	
	foreach ($category->children() as $items){ //prints the children of categories ( which are items)
		print "<li>";
		print $items->name;
		if (isset($items->price->large))
		{
			print"\t"."Large:". $items->price->large;
			print "\t"."Large:". $items->price->small;
			print "</li>";
		}
		else
		{
			print"\t"." One Size:". $items->price;
		}
	}
}