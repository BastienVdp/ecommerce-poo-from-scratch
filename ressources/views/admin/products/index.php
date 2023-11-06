<header class="bg-white shadow">
	<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
		<h1 class="text-3xl font-bold tracking-tight text-gray-900">Produits</h1>
		<div class="flex items-center justify-between gap-4">
			<a href="/admin/products/create" type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
				Ajouter
			</a>
		</div>
	</div>
</header> 
<main>
	<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">  
		<div class="bg-white p-4 rounded-md shadow-sm">
			<div class="overflow-x-auto">
				<table class="w-full whitespace-nowrap">
					<tbody>
						<?php foreach($products as $key => $product): ?>
						<tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded-lg">
							<td class="">
								<div class="w-36 flex items-center pl-5">
									<p class="truncate text-base font-medium leading-none text-gray-700 mr-2">
										<?= $product->name ?>
									</p>
									<a href="/products/<?= $product->id ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
											<path d="M6.66669 9.33342C6.88394 9.55515 7.14325 9.73131 7.42944 9.85156C7.71562 9.97182 8.02293 10.0338 8.33335 10.0338C8.64378 10.0338 8.95108 9.97182 9.23727 9.85156C9.52345 9.73131 9.78277 9.55515 10 9.33342L12.6667 6.66676C13.1087 6.22473 13.357 5.62521 13.357 5.00009C13.357 4.37497 13.1087 3.77545 12.6667 3.33342C12.2247 2.89139 11.6251 2.64307 11 2.64307C10.3749 2.64307 9.77538 2.89139 9.33335 3.33342L9.00002 3.66676" stroke="#3B82F6" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M9.33336 6.66665C9.11611 6.44492 8.8568 6.26876 8.57061 6.14851C8.28442 6.02825 7.97712 5.96631 7.66669 5.96631C7.35627 5.96631 7.04897 6.02825 6.76278 6.14851C6.47659 6.26876 6.21728 6.44492 6.00003 6.66665L3.33336 9.33332C2.89133 9.77534 2.64301 10.3749 2.64301 11C2.64301 11.6251 2.89133 12.2246 3.33336 12.6666C3.77539 13.1087 4.37491 13.357 5.00003 13.357C5.62515 13.357 6.22467 13.1087 6.66669 12.6666L7.00003 12.3333" stroke="#3B82F6" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</a>
								</div>
							</td>
							<td class="px-10">
								<div class="flex items-center w-36">
									<svg xmlns="http://www.w3.org/2000/svg" class="flex-none" width="20" height="20" viewBox="0 0 20 20" fill="none">
										<path d="M9.16667 2.5L16.6667 10C17.0911 10.4745 17.0911 11.1922 16.6667 11.6667L11.6667 16.6667C11.1922 17.0911 10.4745 17.0911 10 16.6667L2.5 9.16667V5.83333C2.5 3.99238 3.99238 2.5 5.83333 2.5H9.16667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
										<circle cx="7.50004" cy="7.49967" r="1.66667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></circle>
									</svg>
									<p class="text-sm text-gray-600 ml-2 truncate">
										<?= $product->description ?>
									</p>
								</div>
							</td>
							<td class="w-full">
								<div class="w-full flex items-center">
									<p class="text-sm leading-none text-gray-600 ml-2">
										<b>Catégorie:</b>	
										<?= $product->category() ? $product->category()->name : ''?>
									</p>
								</div>
							</td>
							<td class="">
								<div class="pr-16 flex items-center">
									<p class="text-sm leading-none text-gray-600 ml-2">
										<b>Prix:</b>
										<?= $product->price ?>€
									</p>
								</div>
							</td>
							<td class="pr-4">
								<a href="/admin/products/<?= $product->id ?>/edit" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
									Editer
								</a>
							</td>
							<td class="pr-4">
								<a href="/admin/products/<?= $product->id ?>/delete" class="py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded">
									Supprimer
								</a>
							</td>
						</tr>
						<?php if($key + 1 !== count($products)) { ?>
							<tr class="h-4"></tr>
						<?php } ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>
