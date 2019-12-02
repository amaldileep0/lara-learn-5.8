$(function () {
    "use strict";

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
});