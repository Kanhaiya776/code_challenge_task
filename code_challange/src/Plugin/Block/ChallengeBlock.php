<?php
namespace Drupal\code_challange\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/** 
 * @Block(
 * id = "challange_block",
 * admin_label = @Translation("Simple challange Block")
 * )
*/

class ChallengeBlock extends BlockBase {
    /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\code_challange\Form\ChallangeForm'); 
    return $form; 
  }
}