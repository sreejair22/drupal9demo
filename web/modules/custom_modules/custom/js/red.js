

(function($, Drupal, drupalSettings){
 
'use strict';

  Drupal.behaviors.jsTestRedWeight = {
    attach: function(context,settings){
       once('jsTestRedWeight', 'html', context).forEach( function (element) {
        myfunction();
      });
      var weight = drupalSettings.custom.js_weights.red;
      var newDiv = $('<div></div>').css('color','red').html('I have a weight of '+weight);
      $('#js-weights').append(newDiv);

    }
  };

  function myfunction(){
    var weight = drupalSettings.custom.js_weights.red;
    console.log(weight);
  }
}

)(jQuery,Drupal,drupalSettings);