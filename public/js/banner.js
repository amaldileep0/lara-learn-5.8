$(function () {
    "use strict";

    if ($("#banner-list-table").length > 0) {
        $('#banner-list-table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "oLanguage": {
              "sEmptyTable": "No records found"
          }
        });
    }
});