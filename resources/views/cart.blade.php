@extends('home')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="p-4 mb-3 bg-green-400 rounded">
                <p class="text-green-800">{{ $message }}</p>
            </div>
        @endif
        <table class="highlight">
            <thead>
                <tr>
                    <th class="text-center">Image</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Prix</th>
                    <th class="text-center">Quantite</th>
                    <th class="text-center">Supprimer de la carte</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr> 
                        <td>
                            
                            <img src="image/{{ $item->attributes->image }}" class="rounded-full" width="100" height="100"
                                alt="{{ $item->name }}">
                        </td>
                        <td class="hidden text-left md:table-cell">
                            <p class="mb-2 md:ml-4">{{ $item->name }}</p>
                        </td>
                        <td class="hidden text-left md:table-cell">
                            <p class="mb-2 md:ml-4">${{ $item->price }}</p>
                        </td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="flex">
                                    <div class="w-1/2 ml-6">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                            class="w-24 text-center bg-gray-300" />
                                    </div>
                                    <div class="w-1/2 ml-5">

                                        <button type="submit"
                                            class="btn-floating btn-large waves-effect waves-light indigo ml-6">
                                            <i class="material-icons">update</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="hidden text-left md:table-cell">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf

                                <div class="mb-1 md:ml-4 center">
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="btn-floating btn-large waves-effect waves-light red" type="submit"
                                        name="action">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <blockquote class="">
                <p
                    class="text-2xl font-mono text-transparent bg-clip-text bg-gradient-to-br from-black to-indingo-600">
                    Total: ${{ Cart::getTotal() }}</p>
            </blockquote>
        </div>
        <div class="flex">
            <div class="w-1/2">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button
                        class="block mt-2 w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i
                            class="material-icons left">delete_forever</i>
                        <p class="mt-0.5">supprimer tous les produits</p>
                    </button>
                </form>
            </div>
            <div class="w-1/2">
                <form action="\stripe">
                    @csrf
                    <button
                        class="block mt-2 w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i
                            class="material-icons left">payment</i>
                        <p class="mt-0.5"> paiement (${{ Cart::getTotal() }})
                        <p>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
