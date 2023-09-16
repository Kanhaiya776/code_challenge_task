(function ($, Drupal) {
    Drupal.behaviors.codeChallenge = {
      attach: function (context, settings) {
        if ($('#edit-veh-make').val() == '2|Make') {
          $('#edit-veh-make').prop('disabled', true);
        }
        if ($('#edit-veh-model').val() == '3|Model') {
            $('#edit-veh-model').prop('disabled', true);
          }
        // Enable or disable veh_make field based on veh_year selection.
      $('#edit-veh-year', context).on('change', function() {
        if ($(this).val() !== '') {
          $('#edit-veh-make').prop('disabled', false);
        } else {
          $('#edit-veh-make').prop('disabled', true);
        }
      });
      $('#edit-veh-make', context).on('change', function() {
        
        if ($(this).val() !== '') {
            $('#edit-veh-make').prop('disabled', false);
          } else {
            $('#edit-veh-make').prop('disabled', true);
          }
       
      });
      
      }
    };
  })(jQuery, Drupal);
  