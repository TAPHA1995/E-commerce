<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order E-mail</title>
</head>
<body>
<p>Bonjour </p>
<p>votre commande est acception avec succes</p>
<table style="width: 600px; text-align:right">
    <thead>
        <tr>
            <th>Image</th>
            <th>titre</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mailData['order']->products as $product)
        <tr>
            <td><img
                src="assets/image_produit/{{$product->product->image}}"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
            </td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->price * $product->quantity}} Cfa</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td>Sous total : {{$mailData['order']->subtotal}} Cfa</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <?php

        $subtotal = (float) $mailData['order']->subtotal; // Convertit la valeur en nombre

        $total = $subtotal + 1000;

        ?>

        <td>Total : {{ $total }} Cfa</td>
        </tr>
    </tbody>
</table>
</body>
</html>
