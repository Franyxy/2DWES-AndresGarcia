$(document).ready(function(){
    $("#cat").change(function(){
        let cat = $('#cat option:selected').text();
        $.ajax({
            url: "categoriaLineStock.php",
            type: "POST",
            data: {cat},
            dataType: 'json',
            success: function(response){
                let template = '<tr><th>Producto</th><th>Unidades</th></tr>';
                response.forEach(element => {
                    template += `<tr><td>${element.Nombre}</td><td>${element.Unidades}</td></tr>`
                });
                $('#tableStock').html(template);
            }
        })
    })
});
