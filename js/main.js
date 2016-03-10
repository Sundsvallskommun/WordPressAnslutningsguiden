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
        $allVideos.each(function() {
            $(this)
                .data('aspectRatio', this.height / this.width)
                // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        });

        // When the window is resized
        $(window).resize(function() {
            var newWidth = $fluidEl.innerWidth();
            // Resize all videos according to their own aspect ratio
            $allVideos.each(function() {
                var $el = $(this);
                $el
                    .width(newWidth)
                    .height(newWidth * $el.data('aspectRatio'));
            });
            // Kick off one resize to fix all videos on page load
        }).resize();
    });
})();