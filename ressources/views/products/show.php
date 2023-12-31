<div class="flex gap-4 w-full flex">
	<div class="w-3/4 flex flex-col">
		<nav aria-label="Breadcrumb">
			<ol role="list" class="flex items-center space-x-2 mb-3">
				<li>
					<div class="flex items-center">
						<a href="/products" class="mr-2 text-sm font-medium text-gray-900">
							Produits
						</a>
						<svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
							<path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
						</svg>
					</div>
				</li>
				<li class="text-sm">
					<a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">
						<?= $product->name ?>
					</a>
				</li>
			</ol>
		</nav>
		<div class="w-full">
			<img 
				src="/images/products/<?= $product->image ?>" 
				alt="<?= $product->name ?>" 
				class="w-full object-cover object-center rounded-lg">
		</div>
	</div>
	<div class="w-2/4">
		<h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
		<?= $product->name ?>
		</h1>
		<div class="mt-4 lg:mt-0">
			<p class="text-3xl tracking-tight text-gray-900 my-2"><?= $product->price ?>€</p>
			<!-- Description and details -->
			<div>
				<h3 class="sr-only">Description</h3>
				<div class="space-y-6">
					<p class="text-base text-gray-900">
						<?= $product->description ?>
					</p>
				</div>
			</div>
			<!-- Reviews -->
			<div class="mt-6">
			<h3 class="sr-only">Reviews</h3>
			<div class="flex items-center">
				<div class="flex items-center">
				<!-- Active: "text-gray-900", Default: "text-gray-200" -->
				<svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
				</svg>
				<svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
				</svg>
				<svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
				</svg>
				<svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
				</svg>
				<svg class="text-gray-200 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
				</svg>
				</div>
				<p class="sr-only">4 out of 5 stars</p>
				<a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117 reviews</a>
			</div>
			</div>

			<form class="mt-10" action="/cart/add/<?= $product->id ?>" method="post">          
				<button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Ajouter au panier
				</button>
			</form>
		</div>
	</div>
</div>