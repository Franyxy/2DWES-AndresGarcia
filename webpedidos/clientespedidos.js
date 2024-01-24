$(document).ready(function(){
    $("#cliente").change(function(){
        let id_cliente = $('#cliente').val();
        $.ajax({
            url: "clientespedidos.php",
            type: "POST",
            data: {id_cliente},
            dataType: 'json',
            success: function(response){
                let template = '';
                if (response.length > 0) {
                    $('#LaberOrder, #order').show();
                    response.forEach(element => {
                        template += `<option value="${element.orderNumber}">Nº Pedido: ${element.orderNumber} || Fecha de Pedido: ${element.orderDate} || Estado de Pedido: ${element.status}</option>`;
                    });
                } else {
                    $('#LaberOrder, #order').hide();
                }
                $('#order').html(template);
            }
        });
    });
});
$(document).ready(function(){
    $("#order").change(function(){
        let id_order = $('#order').val();
        $.ajax({
            url: "clientepedidos2.php",
            type: "POST",
            data: { id_order },
            dataType: 'json',
            success: function(response){
                console.log(response); // Agrega este console.log para depurar
                let template = '<table><tr><th>Order Line Number</th><th>Product Name</th><th>Quantity Ordered</th><th>Price Each</th></tr>';
                response.forEach(element => {
                    template += `<tr>
                                    <td>${element.orderLineNumber}</td>
                                    <td>${element.productName}</td>
                                    <td>${element.quantityOrdered}</td>
                                    <td>${element.priceEach}</td>
                                </tr>`;
                });
                template += '</table>';
                $('#tablapedido').html(template);
            }
        });
    });
});
