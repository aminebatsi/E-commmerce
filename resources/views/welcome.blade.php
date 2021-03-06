<nav class="p-6 mt-4 text-white bg-black sm:flex sm:justify-center sm:items-center">
   <div class="flex flex-col sm:flex-row">
      <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="/">Home</a>
      <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('products.list')}}">Shop</a>
      <a href="{{ route('cart.list') }}" class="flex items-center">
         <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
         </svg>
         {{ Cart::getTotalQuantity()}}
      </a>

   </div>
</nav>

----------------------------------------------------------------------------------------------------------------------

@extends('home')

@section('content')
<div class="container px-6 mx-auto">
   <h3 class="text-2xl font-medium text-gray-700">Product List</h3>
   <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      @foreach ($products as $product)
      <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
         <img src="{{ url($product->image) }}" alt="" class="w-full max-h-60">
         <div class="flex items-end justify-end w-full bg-cover">

         </div>
         <div class="px-5 py-3">
            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
            <span class="mt-2 text-gray-500">${{ $product->price }}</span>
            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="hidden" value="{{ $product->id }}" name="id">
               <input type="hidden" value="{{ $product->name }}" name="name">
               <input type="hidden" value="{{ $product->price }}" name="price">
               <input type="hidden" value="{{ $product->image }}" name="image">
               <input type="hidden" value="1" name="quantity">
               <button class="px-4 py-2 text-white bg-blue-800 rounded">Add To Cart</button>
            </form>
         </div>

      </div>
      @endforeach
   </div>
</div>

@endsection

----------------------------------------------------------------------------------------------------------------------------------

<main class="my-8">
   <div class="container px-6 mx-auto">
      <div class="flex justify-center my-6">
         <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
            @if ($message = Session::get('success'))
            <div class="p-4 mb-3 bg-green-400 rounded">
               <p class="text-green-800">{{ $message }}</p>
            </div>
            @endif
            <h3 class="text-3xl text-bold">Cart List</h3>
            <div class="flex-1">
               <table class="w-full text-sm lg:text-base" cellspacing="0">
                  <thead>
                     <tr class="h-12 uppercase">
                        <th class="hidden md:table-cell"></th>
                        <th class="text-left">Name</th>
                        <th class="pl-5 text-left lg:text-right lg:pl-0">
                           <span class="lg:hidden" title="Quantity">Qtd</span>
                           <span class="hidden lg:inline">Quantity</span>
                        </th>
                        <th class="hidden text-right md:table-cell"> price</th>
                        <th class="hidden text-right md:table-cell"> Remove </th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($cartItems as $item)
                     <tr>
                        <td class="hidden pb-4 md:table-cell">
                           <a href="#">
                              <img src="{{ $item->attributes->image }}" class="w-20 rounded" alt="Thumbnail">
                           </a>
                        </td>
                        <td>
                           <a href="#">
                              <p class="mb-2 md:ml-4">{{ $item->name }}</p>

                           </a>
                        </td>
                        <td class="justify-center mt-6 md:justify-end md:flex">
                           <div class="h-10 w-28">
                              <div class="relative flex flex-row w-full h-8">

                                 <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id}}">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-6 text-center bg-gray-300" />
                                    <button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
                                 </form>
                              </div>
                           </div>
                        </td>
                        <td class="hidden text-right md:table-cell">
                           <span class="text-sm font-medium lg:text-base">
                              ${{ $item->price }}
                           </span>
                        </td>
                        <td class="hidden text-right md:table-cell">
                           <form action="{{ route('cart.remove') }}" method="POST">
                              @csrf
                              <input type="hidden" value="{{ $item->id }}" name="id">
                              <button class="px-4 py-2 text-white bg-red-600">x</button>
                           </form>

                        </td>
                     </tr>
                     @endforeach

                  </tbody>
               </table>
               <div>
                  Total: ${{ Cart::getTotal() }}
               </div>
               <div>
                  <form action="{{ route('cart.clear') }}" method="POST">
                     @csrf
                     <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
                  </form>
               </div>


            </div>
         </div>
      </div>
   </div>
</main>

----------------------------------------------------------------------------------------------------------------------

<!DOCTYPE html>
<html>

<head>
   <title>Stripe Payment Page - HackTheStuff</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <style type="text/css">
      .panel-title {
         display: inline;
         font-weight: bold;
      }

      .display-table {
         display: table;
      }

      .display-tr {
         display: table-row;
      }

      .display-td {
         display: table-cell;
         vertical-align: middle;
         width: 61%;
      }
   </style>
</head>

<body>
   <div class="container">
      <h1>Stripe Payment Page - HackTheStuff</h1>
      <div class="row">
         <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
               <div class="panel-heading display-table">
                  <div class="row display-tr">
                     <h3 class="panel-title display-td">Payment Details</h3>
                     <div class="display-td">
                        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  @if (Session::has('success'))
                  <div class="alert alert-success text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">??</a>
                     <p>{{ Session::get('success') }}</p>
                  </div>
                  @endif
                  <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                     @csrf
                     <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                           <label class='control-label'>Name on Card</label> <input class='form-control' size='4' type='text'>
                        </div>
                     </div>
                     <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                           <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                        </div>
                     </div>
                     <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                           <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                           <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                           <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                     </div>
                     <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                           <div class='alert-danger alert'>Please correct the errors and try
                              again.
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
   $(function() {
      var $form = $(".require-validation");
      $('form.require-validation').bind('submit', function(e) {
         var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
               'input[type=text]', 'input[type=file]',
               'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
         $errorMessage.addClass('hide');
         $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
               $input.parent().addClass('has-error');
               $errorMessage.removeClass('hide');
               e.preventDefault();
            }
         });
         if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
               number: $('.card-number').val(),
               cvc: $('.card-cvc').val(),
               exp_month: $('.card-expiry-month').val(),
               exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
         }
      });

      function stripeResponseHandler(status, response) {
         if (response.error) {
            $('.error')
               .removeClass('hide')
               .find('.alert')
               .text(response.error.message);
         } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
         }
      }
   });
</script>

</html>