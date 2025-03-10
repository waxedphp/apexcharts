<?php
namespace Waxedphp\Apexcharts\Php;

use \Waxedphp\Waxedphp\Php\Setters\AbstractSetter;

class ConfigStroke extends AbstractSetter {

  protected ?bool $show = null;
  
  protected ?string $curve = null;
  protected ?string $lineCap = null;
  protected ?int $width = null;
  protected ?int $dashArray = null;
  
  protected ?string $colors = null;
  //onClick: undefined,
  //onDblClick: undefined,

  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'show', 'curve', 'lineCap', 'colors', 'width', 'dashArray'
  ];

  public function setCurve(string $shape) {
    $allowed = [
      'straight',//: connect the points in straight lines.
      'smooth',//: Uses the simplest smoothing function which produces flowing lines that are accurate
      'monotoneCubic',//: Connects the points to create a monotone cubic spline.
      'stepline',//: points are connected by horizontal and vertical line segments, looking like steps of a staircase.
      'linestep',//: Another alternative version of stepline
    ];
    if (!in_array($shape, $allowed)) return $this;
    $this->curve = $shape;
    return $this;
  }

  public function setLineCap(string $shape) {
    $allowed = [
      'butt',//: ends the stroke with a 90-degree angle
      'square',//: similar to butt except that it extends the stroke beyond the length of the path
      'round',//: ends the path-stroke with a radius that smooths out the start and end points
    ];
    if (!in_array($shape, $allowed)) return $this;
    $this->lineCap = $shape;
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
