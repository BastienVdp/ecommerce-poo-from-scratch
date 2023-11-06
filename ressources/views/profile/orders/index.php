<div class="bg-white p-4 rounded-md shadow-sm">
	<div class="overflow-x-auto">
		<table class="w-full whitespace-nowrap">
			<tbody>
				<?php foreach($orders as $key => $order): ?>
				<tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded-lg">
					<td class="w-48">
						<div class="flex items-center pl-5">
							<p class="leading-none text-gray-700 mr-2">
								<span class="font-medium">#</span><?= $order->number ?>
							</p>
						</div>
					</td>
					<td class="px-10">
						<div class="flex items-center">
							<p class="text-sm text-gray-600 ml-2 truncate">
								<span class="font-medium">Nombres de produits :</span>
								<?= count($order->products()) ?>
							</p>
						</div>
					</td>
					<td class="w-full">
						<div class="flex items-center">
							<p class="text-sm text-gray-600 ml-2 truncate">
								<span class="font-medium">Prix total :</span>
								<?= $order->total_price ?> €
							</p>
						</div>
					</td>
					<td class="pr-4">
						<a href="/profile/orders/<?= $order->id ?>" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
							Voir
						</a>
					</td>
				</tr>
				<?php if($key + 1 !== count($orders)) { ?>
					<tr class="h-4"></tr>
				<?php } ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>