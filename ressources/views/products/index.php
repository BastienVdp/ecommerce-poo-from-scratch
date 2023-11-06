<main class="">
	<div class="flex items-baseline justify-between border-b border-gray-200 pb-6">
		<h1 class="text-4xl font-bold tracking-tight text-gray-900">
			Produits
		</h1>

		<div class="flex items-center">
			<div class="relative inline-block text-left">
				<div>
					<button type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
						Trier
					<svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
					</svg>
					</button>
				</div>
				<div class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
					<div class="py-1" role="none">
						<a href="/products/sort/price/asc" class="<?= self::getCurrentPath() === '/products/sort/price/asc' ? 'font-medium text-black' : 'text-gray-500' ?> block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Prix décroissant</a>
						<a href="/products/sort/price/desc" class="<?= self::getCurrentPath() === '/products/sort/price/desc' ? 'font-medium text-black' : 'text-gray-500' ?> block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-4">Prix croissant</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section aria-labelledby="products-heading" class="pb-24 pt-6">
		<div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
			<form class="block">
				<ul role="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
					<li>
						<a href="/products">
							Tout
						</a>
					</li>
					<?php foreach($categories as $category): ?> 
					<li>
						<a href="/products/category/<?= $category->id ?>">
							<?= $category->name ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</form>

			<!-- Product grid -->
			<div class="lg:col-span-3 grid grid-cols-3 gap-4">
			<?php 
					foreach($products as $product):
				?>
				<div class="group">
					<a href="/products/<?= $product->id ?>">
						<div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
							<img 
								src="/images/products/<?= $product->image ?>" 
								alt="<?= $product->name ?>"
							>
						</div>
						<h3 class="mt-4 text-sm text-gray-700 flex items-center justify-between">
							<?= $product->name ?>
						</h3>
						<p class="mt-1 text-lg font-medium text-gray-900"><?= $product->price ?>€</p>
					</a>
				</div>
				<?php endforeach; ?> 
			</div>
	</div>
	</section>
</main>

