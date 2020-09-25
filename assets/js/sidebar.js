(function($){
    $('.clickme').click(function(){
        $.ajax({
            url:optionssidebar.ajaxurl,
            method: "POST",
            data: {
                "action": "filterSidebar",
                "selection":$(this).attr('value')
            },
            beforeSend: function(){
                $('#left-content').html("Cargando...");
                
            },
            success: function(data){
                console.log(data);
                let html=`<table>
                <tr>
                <th>Nombre</th>
                <th>Contacto</th>
                </tr>`;
                data.forEach(item=>{
                    html+=`<tr>
                    <td>${item.first_name} ${item.last_name}</td>
                    <td>${item.email}</td>
                    </tr>`
                })
                html+=`</table>`;
                $("#left-content").html(html);

            },
            error: function(error){
                console.log(error)
            }
        })
    })
})(jQuery);