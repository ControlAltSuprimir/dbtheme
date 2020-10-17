(function($){
    $('#select-year').change(function(){
        $.ajax({
            url:selectyear.ajaxurl,
            method: "POST",
            data: {
                "action": "filterYear",
                "year":$(this).find(':selected').val()
            },
            beforeSend: function(){
                $('#articles-this-year').html("Cargando...");
            },
            success: function(data){
                window.history.pushState({}, null, 'newUrl');
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
                $("#articles-this-year").html(html);

            },
            error: function(error){
                console.log(error)
            }
        })
    })
})(jQuery);