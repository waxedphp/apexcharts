<?php
namespace Waxedphp\Apexcharts\Php;

use \Waxedphp\Waxedphp\Php\Setters\AbstractSetter;

class ConfigTheme extends AbstractSetter {

   protected ?string $mode = null;
   //'light';
   protected ?string $palette = null;
   //: 'palette1', 

  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'mode', 'palette'
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
