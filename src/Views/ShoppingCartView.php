<?php
declare(strict_types=1);

namespace Shopping\Views;

/**
 * Class ShoppingCartView
 * @package Shopping
 * @author David Sullivan
 *
 */
class ShoppingCartView
{
	protected array $products;
	protected ?array $selectedProducts;
	protected string $url;

	public function __construct(string $url, array $products, ?array $selectedProducts)
	{
		$this->url = $url;
		$this->products = $products;
		$this->selectedProducts = $selectedProducts;
	}

	/**
	 * list all the products available for selection.
	 */
	public function listProducts()
	{
		$first = true;
		foreach ($this->products as $name => $cost) {
			if ($first) {
				$first = false;
				echo "
				<div class='has-background-light '>
				<h1 class='title is-flex is-2 is-justify-content-center '>Shopping Cart</h1>
				<h2 class='title is-flex is-3 is-justify-content-center '>Product</h2>
				<div class='is-flex-direction-column is-flex is-justify-content-center is-align-items-center'>
				<table class='table is-striped'>
					<thead >
						<th>Name</th>
						<th>Cost</th>
					</thead>
				";
			}		
			echo "
			<tr>
			<td> " . $name . "</td>
			<td>" . number_format((float)$cost, 2) . "</td>
			<td> 
				" 
					. '<a  class="button is-success" href="' . $this->url . '?f=add&p=' . $name . '
					">Add
				
			</td>';
			echo "</tr>";
		}
		echo "
		</table>
		</div>";
	}

	/**
	 * list all the products selected (in the cart).
	 */
	public function listSelectedItems()
	{
		if (!$this->selectedProducts)
		{
			error_log('No SELECTED FOUND!!!'. PHP_EOL);
			return;
		}

		$total = 0;
		$first = true;
		foreach ($this->selectedProducts as $name => $qty) {
			if ($first && $qty) {
				$first = false;
				echo "
				<div class='is-flex-direction-column is-justify-content-flex-end m-4 p-4  '>
				<h2 class='title is-flex is-3 is-justify-content-center '>Selected Items</h2>
				<div class='is-flex-direction-column  is-flex is-justify-content-center is-align-items-center'>
				<table class='table is-striped'>
				<thead>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
				</thead>";
			}
			if ($qty) {
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . number_format($qty, 2) . "</td>";
				echo "<td>" . $qty . "</td>";
				$itemTotal = round($qty * (float)$this->products[$name], 2);
				$total += $itemTotal;
				echo "<td>" . number_format($itemTotal, 2) . "</td>";
				echo "<td>" . '<a class="button is-danger" href="' . $this->url . '?f=remove&p=' . $name . '">Remove</a></td>';
				echo "</tr>";
			}
		}
		if ($total > 0.005) {
			echo "<tr>";
			echo "<td><b>Overall Total</b></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td><b>" . number_format($total, 2) . "</b></td>";
			echo "</tr>";
		}
		echo "</table>

		</div>
		</div>";
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  </head>
  <body>
</body>
