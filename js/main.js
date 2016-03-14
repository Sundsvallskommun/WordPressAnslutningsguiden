(function () {
    var $dataset;
    $(document).ready(function () {
        $('#anslutamotornform').on('submit', function (e) {
            e.preventDefault();
            var $url = $(this).attr('action');
            var $data = $(this).serialize();
            $.ajax({
                dataType: 'json',
                url: $url,
                data: $data
            }).done(function (data) {
                if (data.results !== undefined && data.error === undefined) {
                    $('#error-results, #no-results').hide();
                    $('.results').show();
                    $dataset = data.results;
                    displayData(data.results.slice(0, 4));
                    setupPagination();
                }
                else if (data.nothing !== undefined) {
                    $('.results, #error-results').hide();
                    $('#no-results').show();
                }
                else if (data.error !== undefined) {
                    $('.results, #no-results').hide();
                    $('#error-results').show();
                }
            }).fail(function (data) {
            }).always(function (data) {
            });
        });

        $('.opener').on('click', function (e) {
            e.preventDefault();
            $('nav ul').toggleClass('active');
        });


        /**
         * Handle embeded video from youtube so they're responsive
         */
        // Find all YouTube videos
        //var $allVideos = $("iframe[src^='//www.youtube.com']");
        var $allVideos = $("iframe");
        // The element that is fluid width
        $fluidEl = $(".movie");

        // Figure out and save aspect ratio for each video
        $allVideos.each(function () {
            $(this)
                .data('aspectRatio', this.height / this.width)
                // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        });

        // When the window is resized
        $(window).resize(function () {
            var newWidth = $fluidEl.innerWidth();
            // Resize all videos according to their own aspect ratio
            $allVideos.each(function () {
                var $el = $(this);
                $el
                    .width(newWidth)
                    .height(newWidth * $el.data('aspectRatio'));
            });
            // Kick off one resize to fix all videos on page load
        }).resize();
    });

    function displayData($items) {
        $('#results').html('');
        $.each($items, function (i, item) {
            /**
             * Check various variables
             * If source is "connect", there's a link they can use to apply
             * If source is "connected",
             */
            if (item.status !== undefined && item.status == 'connected') {
                /* This address is already connected */
                $row = constructRow(item.address + ', ' + item.city, item.premise, "Ansluten", '', '');
                $row.appendTo($('#results'));
            }
            else if (item.source == 'connect') {
                $row = constructRow(item.address + ', ' + item.city, item.premise, "Ej ansluten", 'Ansök', 'http://www.servanet.se' + item.link);
                $row.appendTo($('#results'));
            }

        });
    }

    function setupPagination() {
        /* Empty old pagination list */
        $('#pagination').html('');

        /* Calculate number of pages */
        if ($dataset.length > 4) {
            var $no = Math.ceil($dataset.length / 4);
            for ($i = 1; $i <= $no; $i++) {
                var $li = $('<li/>');
                var $a = $('<a/>', {href: '#',});
                if ($i == 1) {
                    $a.addClass('active');
                }
                $offset = ($i - 1) * 4;
                $a.attr('data-offset', $offset);
                $a.text($i);
                $a.appendTo($li);
                $li.appendTo($('#pagination'));
            }
            $('#pagination li a').on('click', function (e) {
                e.preventDefault();
                $('#pagination li a').removeClass('active');
                $(this).addClass('active');
                displayData($dataset.slice($(this).data('offset'), $(this).data('offset') + 4));
            });
        }
    }


    function constructRow($address, $apartment, $status, $linkText, $link) {
        if ($apartment === undefined || $apartment == '') {
            $apartment = '-';
        }
        var $li = $('<li/>');
        var $div = $('<div/>', {class: 'result-wrapper'});

        var $addressEl = $('<div/>', {class: 'address'});
        $addressEl.html($address);
        $addressEl.appendTo($div);

        var $apartmentEl = $('<div/>', {class: 'apartment'});
        $apartmentEl.html('<span>Lägenhet:</span>'+$apartment);
        $apartmentEl.appendTo($div);

        var $statusEl = $('<div/>', {class: 'status'});
        $statusEl.html($status);
        $statusEl.appendTo($div);

        var $linkEl = $('<div/>', {class: 'link-column'});
        if ($linkText != '') {
            var $buttonEl = $('<a/>', {class: 'link', href: $link, target: '_blank'});
            $buttonEl.html($linkText);
            $buttonEl.appendTo($linkEl);
        }
        $linkEl.appendTo($div);

        $div.appendTo($li);


        return $li;
    }
})();