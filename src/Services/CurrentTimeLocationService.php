<?php

namespace Drupal\current_time_location\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DrupalDateTime;


/**
 * Class CurrentTimeLocationService.
 */
class CurrentTimeLocationService implements CurrentTimeLocationServiceInterface {
  /**
   * @var \Drupal\Core\Config\ConfigFactory
   */
  
  protected $configFactory;

  /**
   * The config factory.
   *
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getRegionTime() {
   $timezone = $this->configFactory->get('current_time_location.site_location_settings')->get('timezone');
   $current_date = strtotime("now");

   $location_time = \Drupal::service('date.formatter')->format($current_date, 'custom', 'jS M Y - g:i A', $timezone);
   return $location_time;
  }
}
