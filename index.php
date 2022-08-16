<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <div class="jumbotron">
            <p><img src="https://ibraeducacional.com.br/images/FaculdadeIBRA.png" style="    width: 20%;" class="img-responsive"></p>
            <h1 class="display-4">Finalizar Compraa</h1>
            <hr class="my-4">
            <p>Preencha os dados corretamente</p>

        </div>

        <form class="row" method="POST" action="sistema.php" id="form-dados">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome">

            </div>
            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">

            </div>
            <div class="form-group col-md-6">
                <label for="Endereço">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">

            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">

            </div>
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf">

            </div>
            <div class="form-group col-md-6">
                <label for="gInstrucao">Grau de Instrução</label>
                <input type="text" class="form-control" id="gInstrucao" name="gInstrucao">

            </div>

            <div class="col-md-12 text-center">
                <button class="btn btn-info">Enviar e ir para pagamentos</button>

            </div>
        </form>
    </div>

    <script>
        $('#form-dados').submit(function(event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                dataType: "text",
                url: "sistema.php",
                data: {

                    'nome': $('#nome').val(),
                    'telefone': $('#telefone').val(),
                    'endereco': $('#endereco').val(),
                    'email': $('#email').val(),
                    'cpf': $('#cpf').val(),
                    'gInstrucao': $('#gInstrucao').val(),

                },

                success: function(resposta) {

                    console.log(resposta);
                },
                error: function(request, status, error) {

                    console.log(error);
                }
            });
            $('#exampleModal').modal('show');

        });
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realizar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="smart-button-container">
                        <div style="text-align: center;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=BRL" data-sdk-integration-source="button-factory"></script>
                    <script>
                        function initPayPalButton() {
                            paypal.Buttons({
                                style: {
                                    shape: 'rect',
                                    color: 'gold',
                                    layout: 'horizontal',
                                    label: 'buynow',

                                },

                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            "description": "Cursos",
                                            "amount": {
                                                "currency_code": "BRL",
                                                "value": 1
                                            }
                                        }]
                                    });
                                },

                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(orderData) {

                                        // Full available details
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                                        // Show a success message within this page, e.g.
                                        const element = document.getElementById('paypal-button-container');
                                        element.innerHTML = '';
                                        element.innerHTML = '<h3>Compra realizada com sucesso!</h3>';
                                        element.innerHTML = '<p>Você será redirecionado....</p>';


                                        setTimeout(function() {
                                            window.location.href = "https://ibra-assinatura.conted.tech/login";
                                        }, 5000);


                                        // Or go to another URL:  actions.redirect('thank_you.html');

                                    });
                                },

                                onError: function(err) {
                                    console.log(err);
                                }
                            }).render('#paypal-button-container');
                        }
                        initPayPalButton();
                    </script>
                </div>

            </div>
        </div>
    </div>

</body>

</html>