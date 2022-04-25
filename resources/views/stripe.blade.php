<!DOCTYPE html>
<html>

<head>
    <title>Paie ment</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

    </style>
    <style>
        /*
module.exports = {
    plugins: [require('@tailwindcss/forms'),]
};
*/
        .form-radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            flex-shrink: 0;
            border-radius: 100%;
            border-width: 2px;
        }

        .form-radio:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media not print {
            .form-radio::-ms-check {
                border-width: 1px;
                color: transparent;
                background: inherit;
                border-color: inherit;
                border-radius: inherit;
            }
        }

        .form-radio:focus {
            outline: none;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            background-repeat: no-repeat;
            padding-top: 0.5rem;
            padding-right: 2.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
        }

        .form-select::-ms-expand {
            color: #a0aec0;
            border: none;
        }

        @media not print {
            .form-select::-ms-expand {
                display: none;
            }
        }

        @media print and (-ms-high-contrast: active),
        print and (-ms-high-contrast: none) {
            .form-select {
                padding-right: 0.75rem;
            }
        }

    </style>


</head>

<body>
    @if (Session::has('success'))
        <div class="">
            <div class="bg-indigo-900 text-center py-4 lg:px-4">
                <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('success') }}</span>
                    <a href="#" class="" data-dismiss="alert" aria-label="close">×</a>
                </div>
            </div>
        </div>
    @endif
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 pb-10 pt-16">
            <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
                <div class="w-full pt-1 pb-5">
                    <div
                        class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                        <i class="mdi mdi-credit-card-outline text-3xl"></i>
                    </div>
                </div>
                <div class="mb-10">
                    <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>
                </div>
                <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label font-bold text-sm mb-2 ml-1'>Nom de la carte</label>
                            <input placeholder="nom"
                                class='form-control w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors'
                                size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label font-bold text-sm mb-2 ml-1'>Numero de la carte</label> <input
                                class='form-control card-number w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors'
                                size='20' type='text' placeholder="XXXX - XXXX - XXXX - XXXX">
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label font-bold text-sm mb-2 ml-1'>CVC</label> <input
                                autocomplete='off'
                                class='form-control card-cvc w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors'
                                placeholder='CVC' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label font-bold text-sm mb-2 ml-1'>Mois d'expiration</label> <input
                                class='form-control card-expiry-month w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors'
                                placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label font-bold text-sm mb-2 ml-1'>Date d'expiration</label> <input
                                class='form-control card-expiry-year w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors'
                                placeholder='YYYY' size='4' type='text'>
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
                            <button
                                class="block mt-2 w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i
                                    class="mdi mdi-lock-outline mr-1"></i> PAY NOW (${{ Cart::getTotal() }})</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </form>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
