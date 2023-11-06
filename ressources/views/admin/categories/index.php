<header class="bg-white shadow">
	<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
		<h1 class="text-3xl font-bold tracking-tight text-gray-900">
			Catégories
		</h1>
		<div class="flex items-center justify-between gap-4">
			<a href="/admin/categories/create" type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
						<?php foreach($categories as $key => $category): ?>
						<tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded-lg">
							<td class="">
								<div class="w-36 flex items-center pl-5">
									<p class="truncate text-base font-medium leading-none text-gray-700 mr-2">
										<?= $category->name ?>
									</p>
								</div>
							</td>
							<td class="w-full">
								<div class="flex items-center">
									<svg xmlns="http://www.w3.org/2000/svg" class="flex-none" width="20" height="20" viewBox="0 0 20 20" fill="none">
										<path d="M9.16667 2.5L16.6667 10C17.0911 10.4745 17.0911 11.1922 16.6667 11.6667L11.6667 16.6667C11.1922 17.0911 10.4745 17.0911 10 16.6667L2.5 9.16667V5.83333C2.5 3.99238 3.99238 2.5 5.83333 2.5H9.16667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
										<circle cx="7.50004" cy="7.49967" r="1.66667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></circle>
									</svg>
									<p class="text-sm text-gray-600 ml-2 truncate">
										<?= $category->description ?>
									</p>
								</div>
							</td>
							<td class="pr-4">
								<a href="/admin/categories/<?= $category->id ?>/edit" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
									Editer
								</a>
							</td>
							<td class="pr-4">
								<a href="/admin/categories/<?= $category->id ?>/delete" class="py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded">
									Supprimer
								</a>
							</td>
						</tr>
						<?php if($key + 1 !== count($categories)) { ?>
							<tr class="h-4"></tr>
						<?php } ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>
