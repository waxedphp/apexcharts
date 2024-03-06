#!/bin/bash

# npm install --save ...
npm install apexcharts --save
npm install luxon --save

mkdir 'luxon-build';
webpack --config ../../webpack.config.cjs --entry="./build.js" --output-path="./luxon-build/"
