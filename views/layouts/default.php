<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.5.6/src/index.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="relative bg-white">
		<div class="bg-indigo-600 text-sm text-white">
			<div class="flex h-10 items-center justify-between mx-auto max-w-7xl px-4">
				Hello world
				<div class="flex items-center">	
					<a href="/login" class="text-white hover:text-gray-200 mr-4">Se connecter</a>
					<span class="h-4 w-px bg-gray-500" aria-hidden="true"></span>
					<a href="/register" class="ml-4 text-white hover:text-gray-200">S'inscrire</a>
				</div>
			</div>
		</div>

		<nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-4 px-8 border-b border-gray-200">
			<div class="">
				<div class="flex h-16 items-center">

				<!-- Logo -->
				<div class="flex">
					<a href="#">
						<span class="sr-only">Your Company</span>
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
					</a>
				</div>

				<!-- Menu -->
				<div class="ml-8 block self-stretch">
					<div class="flex h-full space-x-8">
						<div class="flex gap-8">                  
							<a href="/" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">
								Accueil
							</a>
							<a href="/products" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">
								Produits
							</a>
						</div>
					</div>
				</div>

				<div class="ml-auto flex items-center">
					<!-- Search -->
					<div class="flex ml-6">
						<a href="#" class="p-2 text-gray-400 hover:text-gray-500">
							<span class="sr-only">Search</span>
							<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
							</svg>
						</a>
					</div>

					<!-- Cart -->
					<div class="ml-4 flow-root  ml-6">
					<a href="/cart" class="group -m-2 flex items-center p-2">
						<svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
						</svg>
						<span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">
							0
						</span>
						<span class="sr-only">items in cart, view bag</span>
					</a>
					</div>
				</div>
				</div>
			</div>
		</nav>
	</header>
	<div class="mx-auto max-w-7xl sm:px-0 px-4 py-6">
		{{ content }}
	</div>
</body>
</html>