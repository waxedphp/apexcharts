<?php
namespace Waxedphp\Apexcharts;

use \Waxedphp\Waxedphp\Setters\AbstractSetter;

class Setter extends AbstractSetter {

  /**
  * height: The height size of the editor. default: clientHeight||'auto' {Number|String}
  * @var ?string $height
  */
  protected ?string $xUnit = null;
  protected ?string $yUnit = null;
  protected ?string $label = null;
  protected ?string $luxonX = null;
  protected ?string $locale = null;

  protected array $timeSeries = [];

  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'xUnit', 'yUnit', 'label', 'luxonX', 'locale'
  ];

  public function setTimeMetricType(string $name, string $type): Setter {
    if (!in_array($type, ['column', 'line'])) throw new \Exception('Not supported type.');
    if (!isset($this->timeSeries[$name])) {
      $this->timeSeries[$name] = ['name' => $name, 'data' => []];
    }
    $this->timeSeries[$name]['type'] = $type;
    return $this;
  }

  public function loadTimeMetric(string $name, string $metricKey, string $timeKey, array $data): Setter {
    if (!isset($this->timeSeries[$name])) {
      $this->timeSeries[$name] = ['name' => $name, 'data' => []];
    }
    foreach ($data as $k => $v) {
      if ((isset($v[$metricKey]))&&(isset($v[$timeKey]))) {
        $this->timeSeries[$name]['data']['.' . $v[$timeKey]] = [
          'x' => $v[$timeKey],
          'y' => $v[$metricKey],
        ];
      }
    }
    return $this;
  }

  function getTimeSeries() {
    $a = $this->timeSeries;
    foreach ($a as $k => $v) {
      ksort($a[$k]['data']);
      $a[$k]['data'] = array_values($a[$k]['data']);
    }
    return array_values($a);
  }

  /**
  * value
  *
  * @param mixed $value
  * @return array<mixed>
  */
  public function value(mixed $value): array {
    $a = $this->getArrayOfAllowedOptions();

    if ($value) {
      $a['TimeSeries'] = [[
        'data' => $value,
      ]];
    } else {
      $a['TimeSeries'] = $this->getTimeSeries();
    }
    $a['config'] = [
      'xaxis' => [
        'type' => 'datetime',
      ],
      'stroke' => [
        //'curve' => 'smooth',
        'width' => 3,
        //'colors' => [ '#E8D824', '#66DA26', '#546E7A', '#E91E63', '#FF9800']
      ],
    ];
    return $a;
  }

}
