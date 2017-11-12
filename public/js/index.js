$( function() {
  $('.form-delete').on('submit', function(e) {
    var con = confirm('are you sure to delete this item? ');

    if (con) {
      return true;
    }

    e.preventDefault();
  });
});