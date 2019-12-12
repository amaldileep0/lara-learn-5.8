$(function () {
    "use strict";

    $(document).on( 'click', '.btn-banner-del', function(e) {
        var id = $(this).data("id");
    	window.App.Ui.Modals.confirm('Are you sure', 'Yor are about to delete selected banner. ?')
            .then(function(result) {
                if (result == 'ok') {
                    deleteBanner(id)
                    .then(function (response) {
                        window.location.reload();
                    }).fail(function (err) {
                        window.location.reload();
                    })
                }
            })
    });

    var deleteBanner = function(id) {
        return window.App.Ajax.request({ url:'/banner/' + id, method: 'DELETE'})
    };

    $('#banner-image').on('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#banner-image-preview').attr('src', e.target.result)
            };
            reader.readAsDataURL(this.files[0]);
        } 
    });
});