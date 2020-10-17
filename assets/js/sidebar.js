function printList(data) {
    let html = ``;
    if (data[0]['university'] == null) {
        data.forEach(item => {
            html += `<p>
            <a class="clickme-sidebar-member" value="test_members">
             ${item.first_name} ${item.last_name}
             </a>
             , contacto: ${item.email}.
             </p>`;

        })
    } else {
        data.forEach(item => {

            html += `<p>
            <a class="clickme-sidebar-member" value="test_members" href="?page_id=2&nombre=${item.first_name}&apellido=${item.last_name}">
            ${item.first_name} ${item.last_name}. ${item.grade}, ${item.university}, ${item.grade_year}. Contacto: ${item.email}.
            </a>
            </p>`;
        })
    }
    return html;
}

(function($) {
    $('.clickme-sidebar-member').click(function() {
        $.ajax({
            url: optionssidebar.ajaxurl,
            method: "POST",
            data: {
                "action": "filterSidebar",
                "selection": $(this).attr('value')
            },
            beforeSend: function() {
                $('#left-content').html("Cargando...<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");

            },
            success: function(data) {
                console.log(data);
                //console.table(data);
                let html = ``;
                if ((data[0]['university'] == null)) {
                    var Doctorantes = [];
                    var Magisteres = [];
                    data.forEach(item => {
                        if (item.grade == 'doctorado') {
                            Doctorantes.push(item);
                        } else {
                            Magisteres.push(item)
                        }
                    })

                    html += `<h2>Magíster</h2>`;
                    html += printList(Magisteres);
                    html += `<h2>Doctorado</h2>`;
                    html += printList(Doctorantes);
                    $("#left-content").html(html);
                } else {
                    html += `<h2> Docentes </h2>`;
                    html += printList(data);
                    $("#left-content").html(html);


                    /*
                    html+=`</p>`;
                    */
                }
                $("#left-content").html(html);

            },
            error: function(error) {
                console.log(error)
            }
        })
    })
})(jQuery);