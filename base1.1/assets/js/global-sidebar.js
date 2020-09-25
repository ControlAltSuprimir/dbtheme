(function($){
    $('#option_p').click(function(){
        $.ajax({
            url:optionp.ajaxurl,
            method: "POST",
            data: {
                "action": "filterYear",
                "year":$(this).find(':selected').val()
            },
            beforeSend: function(){
                $('#articles-this-year').html("Cargando...");
            },
            success: function(data){
                console.log(data);
                let html=`<table>
                <tr>
                <th>Autores</th>
                <th>Título</th>
                </tr>`;
                data.forEach(item=>{
                    html+=`<tr>
                    <td>${item.bad_authors}</td>
                    <td>${item.bad_title}</td>
                    </tr>`
                })
                html+=`</table>`;
                $("#caca").html(html);

            },
            error: function(error){
                console.log(error)
            }
        })
    })
})(jQuery);