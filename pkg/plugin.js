
;(function ( $, window, document, undefined ) {

    var pluginName = 'apexcharts',
        _search = '.waxed-apexcharts',
        _api = [],
        defaults = {
            propertyName: "value"
        },
        inited = false
        ;

    function Instance(pluggable,element,dd){
      var that = this;
      this.pluggable = pluggable;
      this.element = element;
      this.o = element;
      this.t = pluginName;
      this.xUnit = '';
      this.yUnit = '';
      this.yUnit2 = '';
      this.locale = 'sk';
      this.luxonX = 'yyyy LLL';
      this.dd = dd;
      this.name = '';
      this.cfg = {
        //animations : {enabled:false},
        chart: {
          type: 'line',
          events: {}
        },
        tooltip: {},
        toolbar: {},
        series: [],
        noData: {
          text: 'Loading...'
        },
        plotOptions: {
        },
        yaxis: [{
          labels: {
            formatter: function (value) {
              return Number(value).toFixed(2) + that.yUnit;
              //return Math.round((value + Number.EPSILON) * 100) / 100;
            }
          }
        }
        ]
      };

      this.invalidate = function(RECORD){

      },

      this.setRecord = function(RECORD){
        if (typeof that.dd.name == 'undefined') return;
        var rec = that.pluggable.getvar(that.dd.name, RECORD);
        if (typeof rec != 'object') { return; };

        var optionsChanged = false;

        if (typeof rec.labels == 'object') {
          this.cfg.labels = rec.labels;
          optionsChanged = true;
        };
        if (typeof rec.colors == 'object') {
          this.cfg.colors = rec.colors;
          if (typeof this.cfg.fill == 'undefined') this.cfg.fill = {};
          this.cfg.fill.colors = rec.colors;
          optionsChanged = true;
        };
        if (typeof rec.foreColor == 'string') {
          this.cfg.chart.foreColor = rec.foreColor;
          optionsChanged = true;
        };
        if (typeof rec.tooltipTheme == 'string') {
          this.cfg.tooltip.theme = rec.tooltipTheme;
          optionsChanged = true;
        };
        if (typeof rec.options == 'object') {
          this.cfg.options = rec.options;
          optionsChanged = true;
        };
        if (typeof rec.config == 'object') {
          let cfg = _.merge(_.cloneDeep(this.cfg), rec.config);
          //$.extend(cfg, rec.config);
          this.chart.updateOptions(cfg);
          this.cfg = cfg;
          //console.log('APEXCFG',cfg, rec.config);
        };
        if (typeof rec.plotOptions == 'object') {
          this.cfg.plotOptions = rec.plotOptions;
          optionsChanged = true;
        };
        if (optionsChanged) {
          this.chart.updateOptions(this.cfg);
        };

        if (typeof rec.TimeSeries == 'object') {
          let a = rec.TimeSeries;
          for (let i=0; i < a.length; i++) {
            a[i].data = that.timeSerie(a[i].data);
          };
          this.chart.updateSeries(a);
        };
        if (typeof rec.appendTimeSeries == 'object') {
          let a = rec.appendTimeSeries;
          for (let i=0; i < a.length; i++) {
            a[i].data = that.timeSerie(a[i].data);
          };
          this.chart.appendSeries(a);
        };

        if (typeof rec.series == 'object') {
          this.chart.updateSeries(rec.series);
        };
        if (typeof rec.appendSeries == 'object') {
          this.chart.appendSeries(rec.appendSeries);
        };
        if (typeof rec.luxonX == 'string') {
          this.luxonX = rec.luxonX;
        };
        if (typeof rec.locale == 'string') {
          this.locale = rec.locale;
        };
      },

      this.timeSerie = function(a) {
        for (let i=0; i<a.length; i++) {
          if (/^\d+$/.test(a[i].x)) {
            a[i].x = parseInt(a[i].x);
            continue;
          }
          a[i].x = new Date(a[i].x).getTime();
        };
        return a;
      },


      this.free = function() {

      },

      this.init=function() {
        //console.log('APEX');
        this.available = {
          'line':{},
          'area':{},
          'bar':{},
          'column':{},
          'boxPlot':{},
          'candlestick':{},
          'rangeBar':{},
          'rangeArea':{},
          'heatmap':{},
          'treemap':{},
          'funnel':{},
          'pie':{},
          'donut':{},
          'radar':{},
          'radialBar':{}
        };
        if (typeof this.dd.type !== 'undefined') {
          if (typeof this.available[this.dd.type] !== 'undefined') {
            this.cfg.chart.type = this.dd.type;
          };
        };
        if (typeof this.dd.datetime !== 'undefined') {
          this.cfg.xaxis = {
            type: 'datetime',
            labels: {
              formatter: function(value) {
                return DateTime.fromMillis(value).setLocale(that.locale).toFormat(that.luxonX);
              }

            }
          };
        };
        if (typeof this.dd.yUnit !== 'undefined') {
          this.yUnit = this.dd.yUnit;
        };
        if (typeof this.dd.yUnit2 !== 'undefined') {
          this.yUnit2 = this.dd.yUnit2;
          //this.cfg.yaxis[0].name = 'temperature';
          //this.cfg.animations = {enabled:false};
          this.cfg.yaxis.push({
            opposite: true,
            //name: 'wind_speed',
            labels: {
              formatter: function (value) {
                return value.toFixed(2) + that.yUnit2;
              //return Math.round((value + Number.EPSILON) * 100) / 100;
              }
            }
          });
        };
        if (typeof this.dd.xUnit !== 'undefined') {
          this.xUnit = this.dd.xUnit;
        };
        this.cfg.chart.events.click = function(event, chartContext, config) {
          //console.log($(event.target.instance.node).attr('j'));
          //console.log(event.target.instance.node);
          //console.log(chartContext);
          //console.log(config);
          //console.log(event.layerX+' '+event.layerY);
          //console.log(event);
        }
        
        //this.cfg.chart.foreColor = '#ffffff';

        this.chart = new ApexCharts(that.element, this.cfg);
        this.chart.render();
        inited = true;
      },
      this._init_();
    }

    $.waxxx(pluginName, _search, Instance, _api);


})( jQuery, window, document );
/*--*/
//# sourceURL: /js/jam/boilerplate/plugin.js
