Homepage :D
```
<?php foreach($products as $product): ?>
	<div>
		<h1><?= $product->name ?></h1>
		<p><?= $product->description ?></p>
		<p><?= $product->price ?></p>
	</div>
<?php endforeach; ?>