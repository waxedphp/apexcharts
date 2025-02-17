<?php

return [
  'js' => [
    NODE . '/apexcharts/dist/apexcharts.js',
    NODE . '/luxon/build/global/luxon.js',
    //'/apexcharts/luxon-build/main.js',
    $PATH . '/plugin.js',
  ],
  'css' => [
    NODE . '/apexcharts/dist/apexcharts.css',
    $PATH . '/style.css',
  ],
];
