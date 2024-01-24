$(document).ready(function(){
    $("#cat").change(function(){
        let cat = $('#cat option:selected').text();
        $.ajax({
            url: "categorias.php",
            type: "POST",
            data: {cat},
            dataType: 'json',
            success: function(response){
                let template = '';
                response.forEach(element => {
                    template += `<option value=${element.productCode}>${element.productName}</option>`;
                });
                $('#prod').html(template);
                if (response.length > 0) {
                    $('#prodLabel, #prod').show();
                } else {
                    $('#prodLabel, #prod, #nombreLabel, #nombre').hide();
                }
            }
        });
    });

    $("#prod").change(function(){
        let selectedProduct = $('#prod').val();
        $.ajax({
            url: "categoriasStock.php",
            type: "POST",
            data: {selectedProduct},
            dataType: 'json',
            success: function(response1){
                let template = '';
                response1.forEach(element => {
                    template += `Stock: ${element.Stock}`;
                });
                $('#tableStock').html(template);
            }
        });
    });
});
