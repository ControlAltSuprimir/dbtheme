(function($) {
    $('.click').click(function() {
        $.ajax({
            url: workingList.ajaxurl,
            method: "POST",
            cache: false,
            data: {
                "action": "showList",
                "selection": $(this).attr('value')
            },
            beforeSend: function() {
                $('#left-content').html("Loading...");

            },
            success: function(html) {
                $("#left-content").html(html);


            },
            error: function(error) {
                console.log(error)
            }
        })
    })
})(jQuery);