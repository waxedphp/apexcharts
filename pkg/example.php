<?php
return [
'payload1' =>
  [
    'foreColor' => '#cecece',
    'tooltipTheme' => 'dark',
    'series' => [44, 55, 41, 17, 15],
    'labels' => ['alpha','beta','gamma','delta','omega'],
    //'colors' => ['lime','green','yellow','blue','orange'],
  ],
'payload2' => [
  'foreColor' => '#cecece',
  'tooltipTheme' => 'dark',
  'series' => [[
    'data' => [[
        'x' => 'category A',
        'y' => 10
      ], [
        'x' => 'category B',
        'y' => 18
      ], [
        'x' => 'category C',
        'y' => 13
      ]]
    ]],
  'plotOptions' => [
    'bar' => [
      'horizontal' => true
      ]
    ]
  ],
  'payload3' => [
  'foreColor' => '#cecece',
  'tooltipTheme' => 'dark',
  'series' => [[
    'data' => [[
        'x' => 'category A',
        'y' => [10,13],
      ], [
        'x' => 'category B',
        'y' => [18,22],
      ], [
        'x' => 'category C',
        'y' => [12,15],
      ]]
    ]],
  'plotOptions' => [
    'bar' => [
      'horizontal' => true
      ]
    ]
  ],
  'payload4' => [
    'foreColor' => '#cecece',
    'tooltipTheme' => 'dark',
    'series' => [[
      'type' => 'line',
      'name' => 'alpha',
      'data' => [10, 41, 35, 51, 49, 62, 69, 91, 148],
      ],[
      'type' => 'column',
      'name' => 'beta',
      'data' => [10, 41, 35, 51, 49, 62, 69, 91, 148],
      ],[
      'type' => 'column',
      'name' => 'gamma',
      'data' => [11, 40, 30, 30, 31, 33, 36, 38, 40],
      ]
    ],
  ]

];

