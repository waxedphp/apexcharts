# Apexcharts

Modern & Interactive Open-source Charts.

[https://apexcharts.com](https://apexcharts.com)

MIT license

---
### PHP:

```php
use \Waxedphp\Apexcharts\Setter as Apexcharts;

$pie = new Apexcharts($this->waxed);
$pie->chart->setHeight('400px');
$data = [
  'alpha' => 12 * 10000000,
  'beta' => 20 * 10000000,
  'gamma' => 60 * 10000000,
  'delta' => 35 * 10000000,
  'omega' => 40 * 10000000
];
$pie->addPieDataset('test', $data, '', ['alpha','beta','gamma','delta','omega']);
$pie->setFormatY('bytes')->setFormat('bytes');

$apx = new Apexcharts($this->waxed);
$apx->setTimeMetricType('column');
$apx->chart->setHeight('400px');
$apx->markers->setSize(3)->setShape('circle');
$apx->stroke->setWidth(1)->setLineCap('round')->setCurve('smooth');
$apx->setMomentX('D.MMM HH:00')->setFormatY('bytes');
$tp = new TrafficParser();
$a = $tp->loadFile('../../logs/a.traffic.log');
$apx->loadTimeMetric('tx', 'tx', 'time', $a);
$apx->loadTimeMetric('rx', 'rx', 'time', $a);
$this->waxed->pick('section1')->display([
  'data' => [
    'payload1' => $pie->value(),
    'payload4' => $apx->value(),
  ],
],$this->tpl.'/apexcharts');    


```
---
### HTML:

```html

<div class="">
  <div>
    <div class="waxed-apexcharts dark sg-col-1-4"
    data-name="data.payload1"
    data-type="donut"
    ></div>
  </div><div>
    <div class="waxed-apexcharts dark sg-col-1-4"
    data-name="data.payload2"
    data-type="bar"
    ></div>
  </div><div>
    <div class="waxed-apexcharts dark sg-col-1-4"
    data-name="data.payload3"
    data-type="rangeBar"
    ></div>
  </div><div>
    <div class="waxed-apexcharts dark sg-col-1-4"
    data-name="data.payload4"
    data-type="line"
    ></div>
  </div>
</div>


```
---
---
### PHP methods:

```php

$apx = new Apexcharts($this->waxed);

$apx->theme->setMode('dark')->setPalette('palette7');
// settings for theme, see apexcharts documentation

$apx->chart->setHeight('400px');
// various settings of chart, see apexcharts documentation

$apx->markers->setSize(3)->setShape('circle');
// various settings of markers, see apexcharts documentation

$apx->stroke->setWidth(1)->setLineCap('round')->setCurve('smooth');
// various settings of stroke, see apexcharts documentation

$apx->setMomentX('D.MMM HH:00');
// sets formatting of date

$apx->setFormatY('bytes');
// sets formatting of Y values (also the only metric in pie and donut):
// available: 
// bytes (special case, as it automatically switches kB, mB, Gb...), 
// price,
// acre, bit, byte, celsius, centimeter, day, degree,
// fahrenheit, fluid-ounce, foot, gallon, gigabit, gigabyte, gram,
// hectare, hour, inch, kilobit, kilobyte, kilogram, kilometer, liter,
// megabit, megabyte, meter, mile, mile-scandinavian, milliliter,
// millimeter, millisecond, minute, month, ounce, percent,
// petabyte, pound, second, stone, terabit, terabyte, week, yard, year

$apx->setFormatX('day');
// same as previous, for X values. On pie and donut this doesnt apply.

$apx->setTimeMetricType('txDataset', 'column');
// sets metric type for named dataset.
// available types: column, line

// string $dataset_name, string $y_column, string $x_column, array $dataset
$apx->loadTimeMetric('txDataset', 'tx', 'time', $array_of_metrics);
// loads data for named dataset

$apx->value();
// gets value

```
