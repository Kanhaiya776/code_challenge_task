<?php
namespace Drupal\code_challange\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/** 
 * @Block(
 * id = "vehicle_block",
 * admin_label = @Translation("Simple vehicle Block")
 * )
*/

class VehicleBlock extends BlockBase {
    /**
   * {@inheritdoc}
   */
  public function build() {
    // We will provide details of vehicle as per your requirements
  }
}