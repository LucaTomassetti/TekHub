<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin dashboard</title>
    </head>
<body>

pio
   
{if isset($search_form)}
    <h2>Search Products</h2>
    <form action="/TekHub/utente/searchProducts" method="post">
        <input type="text" name="search" placeholder="Enter Product ID">
        <input type="submit" value="Search">
    </form>
{/if}

{if isset($search_results)}
    <h2>Search Results</h2>
    {if $products|@count > 0}
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Color</th>
            </tr>
            {foreach $products as $product}
                <tr>
                    <td>{$product->getIdProdotto()}</td>
                    <td>{$product->getNome()}</td>
                    <td>{$product->getDescrizione()}</td>
                    <td>{$product->getMarca()}</td>
                    <td>{$product->getModello()}</td>
                    <td>{$product->getColore()}</td>
                </tr>
            {/foreach}
        </table>
    {else}
        <p>No products found.</p>
    {/if}
{/if}

</body>