(function() {
    $(document).ready(function() {
        $('#anslutamotornform').on('submit', function (e) {
            e.preventDefault();
            var $url = $(this).attr('action');
            var $data = $(this).serialize();
            $.ajax({
                dataType: 'json',
                url: $url,
                data: $data
            }).done(function(data) {
                if (data.results !== undefined && data.error === undefined) {
                    //console.log(data.results);
                    $(data.results).each(function() {
                        console.log(this);
                    })
                }
                if (data.error !== undefined) {
                    console.log(data.error);
                }
            }).fail(function(data) {
            }).always(function(data) {
            });
        });
    });
})();