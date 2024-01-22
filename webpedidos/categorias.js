$(document).ready(function(){
    $("#cat").blur(function(){
        let cat = $('#cat option:selected').text();
        $.ajax({
            url: "categorias.php",
            type: "POST",
            data: {cat},
            dataType: 'json',
            success: function(response){
                let template = '';
                response.forEach(element => {
                    template += `<option value=${element.productCode}>${element.productName + ' || Precio: '+element.precio+'€'}</option>`
                });
                $('#prod').html(template);
                if (response.length > 0) {
                    $('#prodLabel, #prod').show();
                } else {
                    $('#prodLabel, #prod, #nombreLabel, #nombre').hide();
                }
                $("#prod").blur(function(){
                    let selectedProduct = $('#prod option:selected').text();
                    if (selectedProduct.trim() !== '') {
                        $('#unidadesLabel, #unidades, #añadircarrito').show();
                    } else {
                        $('#unidadesLabel, #unidades, #añadircarrito').hide();
                    }
                });
            }
        })
    })
});
