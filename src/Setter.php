<?php
namespace Waxedphp\Apexcharts;

use \Waxedphp\Waxedphp\Php\Setters\AbstractSetter;

class Setter extends AbstractSetter {

  /**
  * height: The height size of the editor. default: clientHeight||'auto' {Number|String}
  * @var ?string $height
  */
  protected ?string $xUnit = null;
  protected ?string $yUnit = null;
  protected ?string $label = null;
  protected ?string $luxonX = null;
  protected ?string $momentX = null;
  protected ?string $formatX = null;
  protected ?string $formatY = null;
  protected ?string $format = null;
  protected ?string $locale = null;
  
  protected string $tooltipTheme = 'dark';
  
  
  public php\ConfigChart $chart;
  public php\ConfigMarkers $markers;
  public php\ConfigStroke $stroke;
  public php\ConfigTheme $theme;

  protected array $timeSeries = [];
  protected array $datasets = [];
  protected array $labels = [];

  /**
   * allowed options
   *
   * @var array<mixed> $_allowedOptions
   */
  protected array $_allowedOptions = [
    'xUnit', 'yUnit', 'label', 'luxonX', 'momentX', 'formatX', 'formatY', 'format', 'locale'
  ];
  
  /**
  * constructor
  *
  * @param \JasterStary\Waxed\Php\Base $base
  */
  public function __construct(\Waxedphp\Waxedphp\Php\Base $base){
    $this->base = &$base;
    $this->chart = new php\ConfigChart($this->base);
    $this->markers = new php\ConfigMarkers($this->base);
    $this->stroke = new php\ConfigStroke($this->base);
    $this->theme = new php\ConfigTheme($this->base);
  }

  function addPieDataset($label,$data, $dd='', $keys=['used','free']) {
    $data = self::_traverse($data, $dd);
    if (!is_array($data)) {
      return false;
    };
    $n = count($this->datasets);
    $this->datasets[$n] = [];
    $this->labels[$n] = $label;
    foreach ($data as $key=>$val) {
      if (in_array($key,$keys)) {
        if (!isset($this->col[$key])) {
          $this->col[$key] = $key;
        };
        $this->datasets[$n][$key] = $val;
      };
    };
    return $this;
  }

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
  
  function setTooltipTheme(string $theme) {
    $this->tooltipTheme = $theme;
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

    if ($value) {
      $a['TimeSeries'] = [[
        'data' => $value,
      ]];
    } else {
      $ts = $this->getTimeSeries();
      if (!empty($ts)) $a['TimeSeries'] = $ts;
    };
    
    if (!empty($this->datasets)) {
      $a['series'] = array_values($this->datasets[0]);
      $a['labels'] = array_keys($this->datasets[0]);
    };
    if (!empty($this->labels)) {
      //$a['labels'] = $this->labels;
    };
        
    $a['tooltipTheme'] = $this->tooltipTheme;
    
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
    $b = $this->chart->value();
    if (!empty($b)) {
      $a['config']['chart'] = $b;
    };
    $b = $this->markers->value();
    if (!empty($b)) {
      $a['config']['markers'] = $b;
    };
    $b = $this->stroke->value();
    if (!empty($b)) {
      $a['config']['stroke'] = $b;
    };
    $b = $this->theme->value();
    if (!empty($b)) {
      $a['config']['theme'] = $b;
    };
    return $a;
  }

}
