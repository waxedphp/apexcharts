<?php
namespace Waxedphp\Apexcharts\Php;

use \Waxedphp\Waxedphp\Php\Setters\AbstractSetter;

class ConfigChart extends AbstractSetter {

  protected ?array $animations = null;
  protected ?string $background = null;
  protected ?array $brush = null;
  protected ?string $defaultLocale = null;
  protected ?array $dropShadow = null;
  //protected ?$events = null;
  protected ?string $fontFamily = null;
  protected ?string $foreColor = null;
  protected ?string $group = null;
  protected ?string $height = null;
  protected ?string $id = null;
  protected ?array $locales = null;
  protected ?string $nonce = null;
  protected ?int $offsetX = null;
  protected ?int $offsetY = null;
  protected ?int $parentHeightOffset = null;
  protected ?bool $redrawOnParentResize = null;
  protected ?bool $redrawOnWindowResize = null;
  protected ?array $selection = null;
  protected ?array $sparkline = null;
  protected ?bool $stacked = null;
  protected ?string $stackType = null;
  protected ?bool $stackOnlyBar = null;
  protected ?array $toolbar = null;
  protected ?string $type = null;
  protected ?string $width = null;
  protected ?array $zoom = null;

  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'animations', 'background', 'brush', 'defaultLocale', 'dropShadow',
    //events
    'fontFamily', 'foreColor', 'group', 'height', 'id', 'locales', 'nonce',
    'offsetX', 'offsetY', 'parentHeightOffset', 'redrawOnParentResize',
    'redrawOnWindowResize', 'selection', 'sparkline', 'stacked', 
    'stackType', 'stackOnlyBar', 'toolbar', 'type', 'width', 'zoom'
  ];

  /**
  * value
  *
  * @param mixed $value
  * @return array<mixed>
  */
  public function value(mixed $value = null): array {
    $a = $this->getArrayOfAllowedOptions();
    return $a;
  }

}
