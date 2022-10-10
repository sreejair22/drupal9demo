<?php

namespace Drupal\custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Serialization\Json;
/**
 * Provides a button subscribe to newsletter.
 *
 * @Block(
 *   id = "custom_popupform_block",
 *   admin_label = @Translation("Subscribe to Newsletter"),
 * )
 */
class PopupFormBlock extends BlockBase {

	public function build() {
		$link_url = Url::fromRoute('custom.multistep_form1');
    $link_url->setOptions([
      'attributes' => [
        'class' => ['use-ajax', 'button', 'button--small'],
        'data-dialog-type' => 'modal',
        'data-dialog-options' => Json::encode(['width' => 400]),
      ]
    ]);

    return array(
      '#type' => 'markup',
      '#markup' => Link::fromTextAndUrl(t('Open modal'), $link_url)->toString(),
      '#attached' => ['library' => ['core/drupal.dialog.ajax']]
    );
	   /* $text = '<a href="/custom/form/multistep" class="use-ajax" data-dialog-type="modal">Subscribe</a>';
	    return [

	      '#markup' =>$text,
	      '#attached' => array(
	        'library' => array(
	          'core/drupal.dialog.ajax',
	          'core/jquery.form',
	        ),
	      ),
	    ];*/
	  }

}