<header class="bg-white shadow">
	<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
		<h1 class="text-3xl font-bold tracking-tight text-gray-900">Ajouter un produit</h1>
		<div class="flex items-center justify-between gap-4">
			<a href="/admin/products" class="inline-flex items-center rounded-md bg-gray-200 text-gray-600 px-3 py-2 text-sm font-medium shadow-sm hover:bg-gray-300">
				Retour
			</a>
		</div>
	</div>
</header>
<main>
	<div class="mx-auto max-w-xl py-6 sm:px-6 lg:px-8"> 
		<div class="bg-white p-4 rounded-md shadow-sm">
			<form action="/admin/products/create" method="POST" enctype="multipart/form-data">
				<div class="mb-4">
					<label for="username"class="block text-gray-700 font-bold mb-2">
						Nom du produit
					</label>
					<input 
						id="username"
						name="name" 
						type="text" 
						class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					/>
					<?= isset($errors['name'])
						? '<p class="text-red-500 text-xs italic">' . $errors['name'] . '</p>' 
						: '' 
					?>
				</div> 
				<div class="mb-4">
					<label for="description"class="block text-gray-700 font-bold mb-2">
						Description du produit
					</label>
					<textarea 
						id="description"
						name="description"
						class="min-h-20 h-20 resize-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					></textarea>
					<?= isset($errors['description'])
						? '<p class="text-red-500 text-xs italic">' . $errors['description'] . '</p>' 
						: '' 
					?>
				</div> 
				<div class="mb-4">
					<label for="price"class="block text-gray-700 font-bold mb-2">
						Prix du produit
					</label>
					<input 
						id="price" 
						type="number"
						name="price"
						class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					/>
					<?= isset($errors['price'])
						? '<p class="text-red-500 text-xs italic">' . $errors['price'] . '</p>' 
						: '' 
					?>
				</div> 
				<div class="mb-4">
					<label for="image"class="block text-gray-700 font-bold mb-2">
						Image du produit
					</label>
					<input
						class="relative appearance-none m-0 block shadow w-full min-w-0 flex-auto rounded border px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:bg-indigo-600 file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] hover:file:bg-indigo-700"
						type="file"
						name="image"
						id="image" 
					/>
					<?= isset($errors['image'])
						? '<p class="text-red-500 text-xs italic">' . $errors['image'] . '</p>' 
						: '' 
					?>
				</div>
				<div class="flex border-t pt-4">
					<button type="submit" class="ml-auto inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
						Ajouter
					</button>
				</div>
			</form>
		</div>
	</div>
</main> 