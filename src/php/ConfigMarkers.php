<?php
namespace Waxedphp\Apexcharts\Php;

use \Waxedphp\Waxedphp\Php\Setters\AbstractSetter;

class ConfigMarkers extends AbstractSetter {

  protected ?int $size = null;
  
  protected ?string $colors = null;
  protected ?string $strokeColors = null;
  protected ?int $strokeWidth = null;
  protected ?int $strokeOpacity = null;
  protected ?int $strokeDashArray = null;
  protected ?int $fillOpacity = null;
  protected ?array $discrete = null;
  protected ?string $shape = null;
  protected ?int $offsetX = null;
  protected ?int $offsetY = null;
  //onClick: undefined,
  //onDblClick: undefined,
  protected ?bool $showNullDataPoints = null;
  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'size', 'colors', 'strokeColors', 'strokeWidth', 'strokeOpacity',
    'strokeDashArray', 'fillOpacity', 'discrete', 'shape', 'offsetX',
    'offsetY', 'showNullDataPoints'
  ];

  public function setShape(string $shape) {
    $allowed = [
    'circle', 'square', 'line', 'plus', 'cross', 'star', 'sparkle', 'diamond', 'triangle'
    ];
    if (!in_array($shape, $allowed)) return $this;
    $this->shape = $shape;
    return $this;
  }

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
