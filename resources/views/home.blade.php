<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to cart</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>

<body class="bg-gray-100">

    <nav class="grey darken-3">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo ml-6">E-com</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{ route('cart.list') }}"><i
                            class="material-icons left">add_shopping_cart</i>{{ Cart::getTotalQuantity() }}</a></li>
                <li><a href="{{ route('products.list') }}"><i class="material-icons left">shopping_cart</i>Continuer
                        shop</a></li>
            </ul>
        </div>
    </nav>
    <main class="my-8">
        @yield('content')
    </main>


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
