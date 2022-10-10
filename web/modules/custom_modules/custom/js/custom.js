(function ($) {

    Drupal.behaviors.submitForm = { 
        attach: function (context) {
            var $form = $("form#validated_form", context);
            var $submitButton = $('input[type="submit"]', $form);

            $form
                .once('submitForm')
                .off('submit')
                .on('submit', function(e){

                    // Prevent normal form submission
                    e.preventDefault();
                    var $form = $(this);

                    // The trigger value should match what you have in your $form['submit'] array's ajax array
                    //if the form is valid, trigger the ajax event
                    if($form.valid()) {
                        $submitButton.trigger('submit_form');
                    }
            });

        }
    };
})(jQuery);