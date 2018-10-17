(function ($) {
    var $downloadBtn = $("#downloadBtn"),
        $dashboardBody = $(".cricket-wrapper"),
        $downloadLinks = $(".download-dashboard-link"),
        TYPE_PDF = 'pdf',
        $getCanvas;

    $downloadBtn.on('click', function () {
        html2canvas($dashboardBody, {
            dpi: 300, // Set to 300 DPI
            scale: 3, // Adjusts your resolution
            onrendered: function (canvas) {
                $getCanvas = canvas;
            }
        });
    });

    $downloadLinks.each(function () {
        var thisLink = $(this),
            id = thisLink.attr('id'),
            extension = thisLink.attr('data-type');
        thisLink.on('click', function () {
            var imageData = $getCanvas.toDataURL("image/png"),
                newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");

            if (extension === TYPE_PDF) {
                var doc = new jsPDF('p', 'px', 'a3');
                doc.addImage(imageData, 'png', 10, 20);
                doc.save('dashboard.' + extension);
            } else {
                thisLink.attr("download", 'dashboard.' + extension).attr("href", newData);

            }
        });

    });
})(jQuery);
