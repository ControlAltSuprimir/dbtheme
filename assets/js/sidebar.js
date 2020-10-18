function printList(data) {
    let html = ``;
    if (data[0]['university'] == null) {
        data.forEach(item => {
            html += `<p>
            <a href="${item.current}&type=graduates&member=${item.id_graduates}">
             ${item.first_name} ${item.last_name}
             </a>
             , contacto: ${item.email}.
             </p>`;

        })
    } else {
        data.forEach(item => {

            html += `<p>
            <a href="${item.current}&type=test_members&member=${item.id_test_members}">
            ${item.first_name} ${item.last_name}. 
            </a>
            ${item.grade}, ${item.university}, ${item.grade_year}. Contacto: ${item.email}.
            </p>`;
        })
    }
    return html;
}

(function($) {
    $('.clickme-sidebar-member').click(function() {
        $.ajax({
            url: optionssidebar.ajaxurl, //equivalente a option.php ->functions.php
            method: "POST",
            data: {
                "action": "filterSidebar", //funcion dentro del functions.php?action=filterSidebar&url=&selection=
                "url": $(this).attr('value1'), // <a class="clickme-sidebar-member" value1="currenturl" value="graduates">gRADUATES</a>
                "selection": $(this).attr('value')
            },
            beforeSend: function() { // class=. id=# id=left-content
                $('#left-content').html(" <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");

            },
            success: function(data) {
                //console.log(data);
                console.table(data);
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
                    $("#left-content").html(html).hide().fadeIn();
                } else {
                    html += `<h2> Docentes </h2>`;
                    html += printList(data);
                    $("#left-content").html(html).hide().fadeIn();



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