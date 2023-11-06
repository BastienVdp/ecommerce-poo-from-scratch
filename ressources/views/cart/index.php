<div class="flex flex-col space-y-4">
	<h2 class="text-xl font-semibold">Mon panier</h2>
	<?php 
		if(empty($productsInCart)) {
			echo "<p>Votre panier est vide</p>";
		} else {
	?>
	<ul class="flex flex-col divide-y divide-gray-700">
		<?php foreach($productsInCart as $product): ?>
		<li class="flex flex-col py-6 sm:flex-row sm:justify-between">
			<div class="flex w-full space-x-2 sm:space-x-4">
			<img 
				class="flex-shrink-0 w-20 dark:border-transparent rounded outline-none sm:w-32 sm:h-32 dark:bg-gray-500" 
				src="/images/products/<?= $product['image']; ?>" 
				alt="<?= $product['name']; ?>"
			>
				<div class="flex flex-col justify-between w-full pb-4">
					<div class="flex justify-between w-full pb-2 space-x-2">
						<div class="space-y-1">
							<h3 class="text-lg font-semibold leading-snug sm:pr-8"><?= $product['name']; ?> (<?= $product['quantity'] ?>)</h3>
							<p class="text-sm dark:text-gray-400"><?= $product['description']; ?></p>
						</div>
						<div class="text-right">
							<p class="text-lg font-semibold"><?= $product['price'] * $product['quantity']; ?>€</p>
						</div>
					</div>
					<div class="text-sm">
						<form action="/cart/remove/<?= $product['id'] ?>" method="POST">
							<button type="submit" class="flex items-center px-2 py-1 pl-0 space-x-1 text-red-400">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
									<path d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z"></path>
									<rect width="32" height="200" x="168" y="216"></rect>
									<rect width="32" height="200" x="240" y="216"></rect>
									<rect width="32" height="200" x="312" y="216"></rect>
									<path d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z"></path>
								</svg>
								<span>Supprimer</span>
							</button>
						</form>
					</div>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="border-t pt-8">
		<p class="text-right text-xl font-medium">Total : <span class="text-lg text-indigo-600"><?= $totalCart ?>€</span></p>
		<?php if(App\Core\Application::isConnected()): ?>
		<form action="/cart/checkout" method="POST">
			<button type="submit" class="float-right px-4 py-2 mt-4 text-white bg-indigo-500 rounded hover:bg-indigo-600">Commander</button>
		</form>
		<?php else: ?>
			<a href="/login" class="float-right px-4 py-2 mt-4 text-white bg-indigo-500 rounded hover:bg-indigo-600">
				Se connecter pour commander
			</a>
		<?php endif; ?>
	</div>
	<?php } ?>
</div>