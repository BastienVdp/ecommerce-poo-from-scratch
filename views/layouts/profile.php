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
	<?php include_once 'header.php' ?>
	<div class="mx-auto max-w-7xl sm:px-0 px-8 py-6">
		<div class="flex gap-x-6">
			<div class="w-1/4">
				<div class="inline-block text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm">
					<div class="p-3">
						<div class="flex items-center justify-between mb-2">
							<div class="flex gap-2">
								<a href="#">
									<img class="w-12 h-12 rounded-full" src="http://via.placeholder.com/150" alt="Jese Leos">
								</a>
								<div class="flex flex-col justify-center gap-1">
									<p class="block text-base font-semibold leading-none text-gray-900 dark:text-white">
										<span href="#"><?= App\Core\Application::$app->user->username ?></span>
									</p>
									<p class="text-sm font-normal">
										<span href="#" class="hover:underline">Admin</span>
									</p>
								</div>
							</div>
						</div>
						
						<p class="mb-4 text-sm">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quia?
						</p>
						<ul class="flex text-sm">
							<li class="mr-2">
								<a href="#" class="hover:underline">
									<span class="font-semibold text-gray-900 dark:text-white">799</span>
									<span>Following</span>
								</a>
							</li>
							<li>
								<a href="#" class="hover:underline">
									<span class="font-semibold text-gray-900 dark:text-white">3,758</span>
									<span>Followers</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="w-3/4">			
				<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4">
					<ul class="flex flex-wrap">
						<li class="mr-2">
							<a href="/profile" class="inline-block p-4 pb-4 py-0 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
								Informations
							</a>
						</li>
						<li class="mr-2">
							<a href="/profile/orders" class="inline-block p-4 pb-4 py-0 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
								Commandes
							</a>
						</li>
					</ul>
				</div>
				{{ content }}
			</div>
		</div>
	</div>
</body>
</html>