<?php

/* ::base.html.twig */
class __TwigTemplate_fb73babd94d054851ca89daac0b4d53278ec5cc3fd89a775104565092a7678c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <meta charset=\"UTF-8\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

        <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 11
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/bootstrap/dist/css/bootstrap.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/font-awesome/css/font-awesome.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/iCheck/skins/flat/green.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/jvectormap/jquery-jvectormap.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/custom.css"), "html", null, true);
        echo "\" />
    </head>
    <body class=\"nav-md\">
        ";
        // line 20
        $this->displayBlock('body', $context, $blocks);
        // line 21
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/jquery/dist/jquery.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/bootstrap/dist/js/bootstrap.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/fastclick/lib/fastclick.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/nprogress/nprogress.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Chart.js/dist/Chart.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/gauge.js/dist/gauge.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/iCheck/icheck.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/skycons/skycons.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Flot/jquery.flot.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Flot/jquery.flot.pie.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Flot/jquery.flot.time.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Flot/jquery.flot.stack.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/Flot/jquery.flot.resize.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/flot.orderbars/js/jquery.flot.orderBars.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/date.js/build/date.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/flot-spline/js/jquery.flot.spline.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/flot.curvedlines/curvedLines.js"), "html", null, true);
        echo "\" ></script>
        ";
        // line 40
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery-jvectormap-2.0.3.min.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/moment/moment.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/bootstrap-daterangepicker/daterangepicker.js"), "html", null, true);
        echo "\" ></script>

        <script src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/custom.js"), "html", null, true);
        echo "\" ></script>

        <!-- Flot -->
        <script>
            \$(document).ready(function() {
                var data1 = [
                    [gd(2012, 1, 1), 17],
                    [gd(2012, 1, 2), 74],
                    [gd(2012, 1, 3), 6],
                    [gd(2012, 1, 4), 39],
                    [gd(2012, 1, 5), 20],
                    [gd(2012, 1, 6), 85],
                    [gd(2012, 1, 7), 7]
                ];

                var data2 = [
                    [gd(2012, 1, 1), 82],
                    [gd(2012, 1, 2), 23],
                    [gd(2012, 1, 3), 66],
                    [gd(2012, 1, 4), 9],
                    [gd(2012, 1, 5), 119],
                    [gd(2012, 1, 6), 6],
                    [gd(2012, 1, 7), 9]
                ];
                \$(\"#canvas_dahs\").length && \$.plot(\$(\"#canvas_dahs\"), [
                    data1, data2
                ], {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        verticalLines: true,
                        hoverable: true,
                        clickable: true,
                        tickColor: \"#d5d5d5\",
                        borderWidth: 1,
                        color: '#fff'
                    },
                    colors: [\"rgba(38, 185, 154, 0.38)\", \"rgba(3, 88, 106, 0.38)\"],
                    xaxis: {
                        tickColor: \"rgba(51, 51, 51, 0.06)\",
                        mode: \"time\",
                        tickSize: [1, \"day\"],
                        //tickLength: 10,
                        axisLabel: \"Date\",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10
                    },
                    yaxis: {
                        ticks: 8,
                        tickColor: \"rgba(51, 51, 51, 0.06)\",
                    },
                    tooltip: false
                });

                function gd(year, month, day) {
                    return new Date(year, month - 1, day).getTime();
                }
            });
        </script>
        <!-- /Flot -->

        <!-- jVectorMap -->
        <script src=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/vendor/jvectormap/tests/assets/jquery-jvectormap-us-aea-en.js"), "html", null, true);
        echo "\" ></script>
        <script src=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/maps/gdp-data.js"), "html", null, true);
        echo "\" ></script>
        <script>
            \$(document).ready(function(){
                \$('#world-map-gdp').vectorMap({
                    map: 'world_mill_en',
                    backgroundColor: 'transparent',
                    zoomOnScroll: false,
                    series: {
                        regions: [{
                            values: gdpData,
                            scale: ['#E6F2F0', '#149B7E'],
                            normalizeFunction: 'polynomial'
                        }]
                    },
                    onRegionTipShow: function(e, el, code) {
                        el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                    }
                });
            });
        </script>
        <!-- /jVectorMap -->

        <!-- Skycons -->
        <script>
            \$(document).ready(function() {
                var icons = new Skycons({
                            \"color\": \"#73879C\"
                        }),
                        list = [
                            \"clear-day\", \"clear-night\", \"partly-cloudy-day\",
                            \"partly-cloudy-night\", \"cloudy\", \"rain\", \"sleet\", \"snow\", \"wind\",
                            \"fog\"
                        ],
                        i;

                for (i = list.length; i--;)
                    icons.set(list[i], list[i]);

                icons.play();
            });
        </script>
        <!-- /Skycons -->

        <!-- Doughnut Chart -->
        <script>
            \$(document).ready(function(){
                var options = {
                    legend: false,
                    responsive: false
                };

                new Chart(document.getElementById(\"canvas1\"), {
                    type: 'doughnut',
                    tooltipFillColor: \"rgba(51, 51, 51, 0.55)\",
                    data: {
                        labels: [
                            \"Symbian\",
                            \"Blackberry\",
                            \"Other\",
                            \"Android\",
                            \"IOS\"
                        ],
                        datasets: [{
                            data: [15, 20, 30, 10, 30],
                            backgroundColor: [
                                \"#BDC3C7\",
                                \"#9B59B6\",
                                \"#E74C3C\",
                                \"#26B99A\",
                                \"#3498DB\"
                            ],
                            hoverBackgroundColor: [
                                \"#CFD4D8\",
                                \"#B370CF\",
                                \"#E95E4F\",
                                \"#36CAAB\",
                                \"#49A9EA\"
                            ]
                        }]
                    },
                    options: options
                });
            });
        </script>
        <!-- /Doughnut Chart -->

        <!-- bootstrap-daterangepicker -->
        <script>
            \$(document).ready(function() {

                var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    \$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                };

                var optionSet1 = {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                };
                \$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                \$('#reportrange').daterangepicker(optionSet1, cb);
                \$('#reportrange').on('show.daterangepicker', function() {
                    console.log(\"show event fired\");
                });
                \$('#reportrange').on('hide.daterangepicker', function() {
                    console.log(\"hide event fired\");
                });
                \$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    console.log(\"apply event fired, start/end dates are \" + picker.startDate.format('MMMM D, YYYY') + \" to \" + picker.endDate.format('MMMM D, YYYY'));
                });
                \$('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                    console.log(\"cancel event fired\");
                });
                \$('#options1').click(function() {
                    \$('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                });
                \$('#options2').click(function() {
                    \$('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                });
                \$('#destroy').click(function() {
                    \$('#reportrange').data('daterangepicker').remove();
                });
            });
        </script>
        <!-- /bootstrap-daterangepicker -->

        <!-- gauge.js -->
        <script>
            var opts = {
                lines: 12,
                angle: 0,
                lineWidth: 0.4,
                pointer: {
                    length: 0.75,
                    strokeWidth: 0.042,
                    color: '#1D212A'
                },
                limitMax: 'false',
                colorStart: '#1ABC9C',
                colorStop: '#1ABC9C',
                strokeColor: '#F0F3F3',
                generateGradient: true
            };
            var target = document.getElementById('foo'),
                    gauge = new Gauge(target).setOptions(opts);

            gauge.maxValue = 6000;
            gauge.animationSpeed = 32;
            gauge.set(3200);
            gauge.setTextField(document.getElementById(\"gauge-text\"));
        </script>
        <!-- /gauge.js -->

        ";
        // line 312
        $this->displayBlock('javascripts', $context, $blocks);
        // line 313
        echo "    </body>
</html>
";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 20
    public function block_body($context, array $blocks = array())
    {
    }

    // line 312
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  463 => 312,  458 => 20,  453 => 10,  447 => 9,  441 => 313,  439 => 312,  249 => 125,  245 => 124,  241 => 123,  159 => 44,  154 => 42,  150 => 41,  145 => 40,  141 => 38,  137 => 37,  133 => 36,  129 => 35,  125 => 34,  121 => 33,  117 => 32,  113 => 31,  109 => 30,  105 => 29,  101 => 28,  97 => 27,  93 => 26,  89 => 25,  85 => 24,  81 => 23,  77 => 22,  72 => 21,  70 => 20,  64 => 17,  60 => 16,  56 => 15,  52 => 14,  48 => 13,  44 => 12,  39 => 11,  37 => 10,  33 => 9,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/*     <head>*/
/*         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">*/
/*         <meta charset="UTF-8" />*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1">*/
/* */
/*         <title>{% block title %}Welcome!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/vendor/iCheck/skins/flat/green.css') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap.css') }}" />*/
/*         <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />*/
/*     </head>*/
/*     <body class="nav-md">*/
/*         {% block body %}{% endblock %}*/
/*         <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/fastclick/lib/fastclick.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/nprogress/nprogress.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Chart.js/dist/Chart.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/gauge.js/dist/gauge.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/iCheck/icheck.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/skycons/skycons.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Flot/jquery.flot.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Flot/jquery.flot.pie.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Flot/jquery.flot.time.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Flot/jquery.flot.stack.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/Flot/jquery.flot.resize.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/flot.orderbars/js/jquery.flot.orderBars.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/date.js/build/date.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/flot-spline/js/jquery.flot.spline.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/flot.curvedlines/curvedLines.js') }}" ></script>*/
/*         {#<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap.js') }}" ></script>#}*/
/*         <script src="{{ asset('assets/js/jquery-jvectormap-2.0.3.min.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/moment/moment.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}" ></script>*/
/* */
/*         <script src="{{ asset('assets/js/custom.js') }}" ></script>*/
/* */
/*         <!-- Flot -->*/
/*         <script>*/
/*             $(document).ready(function() {*/
/*                 var data1 = [*/
/*                     [gd(2012, 1, 1), 17],*/
/*                     [gd(2012, 1, 2), 74],*/
/*                     [gd(2012, 1, 3), 6],*/
/*                     [gd(2012, 1, 4), 39],*/
/*                     [gd(2012, 1, 5), 20],*/
/*                     [gd(2012, 1, 6), 85],*/
/*                     [gd(2012, 1, 7), 7]*/
/*                 ];*/
/* */
/*                 var data2 = [*/
/*                     [gd(2012, 1, 1), 82],*/
/*                     [gd(2012, 1, 2), 23],*/
/*                     [gd(2012, 1, 3), 66],*/
/*                     [gd(2012, 1, 4), 9],*/
/*                     [gd(2012, 1, 5), 119],*/
/*                     [gd(2012, 1, 6), 6],*/
/*                     [gd(2012, 1, 7), 9]*/
/*                 ];*/
/*                 $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [*/
/*                     data1, data2*/
/*                 ], {*/
/*                     series: {*/
/*                         lines: {*/
/*                             show: false,*/
/*                             fill: true*/
/*                         },*/
/*                         splines: {*/
/*                             show: true,*/
/*                             tension: 0.4,*/
/*                             lineWidth: 1,*/
/*                             fill: 0.4*/
/*                         },*/
/*                         points: {*/
/*                             radius: 0,*/
/*                             show: true*/
/*                         },*/
/*                         shadowSize: 2*/
/*                     },*/
/*                     grid: {*/
/*                         verticalLines: true,*/
/*                         hoverable: true,*/
/*                         clickable: true,*/
/*                         tickColor: "#d5d5d5",*/
/*                         borderWidth: 1,*/
/*                         color: '#fff'*/
/*                     },*/
/*                     colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],*/
/*                     xaxis: {*/
/*                         tickColor: "rgba(51, 51, 51, 0.06)",*/
/*                         mode: "time",*/
/*                         tickSize: [1, "day"],*/
/*                         //tickLength: 10,*/
/*                         axisLabel: "Date",*/
/*                         axisLabelUseCanvas: true,*/
/*                         axisLabelFontSizePixels: 12,*/
/*                         axisLabelFontFamily: 'Verdana, Arial',*/
/*                         axisLabelPadding: 10*/
/*                     },*/
/*                     yaxis: {*/
/*                         ticks: 8,*/
/*                         tickColor: "rgba(51, 51, 51, 0.06)",*/
/*                     },*/
/*                     tooltip: false*/
/*                 });*/
/* */
/*                 function gd(year, month, day) {*/
/*                     return new Date(year, month - 1, day).getTime();*/
/*                 }*/
/*             });*/
/*         </script>*/
/*         <!-- /Flot -->*/
/* */
/*         <!-- jVectorMap -->*/
/*         <script src="{{ asset('assets/vendor/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}" ></script>*/
/*         <script src="{{ asset('assets/vendor/jvectormap/tests/assets/jquery-jvectormap-us-aea-en.js') }}" ></script>*/
/*         <script src="{{ asset('assets/js/maps/gdp-data.js') }}" ></script>*/
/*         <script>*/
/*             $(document).ready(function(){*/
/*                 $('#world-map-gdp').vectorMap({*/
/*                     map: 'world_mill_en',*/
/*                     backgroundColor: 'transparent',*/
/*                     zoomOnScroll: false,*/
/*                     series: {*/
/*                         regions: [{*/
/*                             values: gdpData,*/
/*                             scale: ['#E6F2F0', '#149B7E'],*/
/*                             normalizeFunction: 'polynomial'*/
/*                         }]*/
/*                     },*/
/*                     onRegionTipShow: function(e, el, code) {*/
/*                         el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');*/
/*                     }*/
/*                 });*/
/*             });*/
/*         </script>*/
/*         <!-- /jVectorMap -->*/
/* */
/*         <!-- Skycons -->*/
/*         <script>*/
/*             $(document).ready(function() {*/
/*                 var icons = new Skycons({*/
/*                             "color": "#73879C"*/
/*                         }),*/
/*                         list = [*/
/*                             "clear-day", "clear-night", "partly-cloudy-day",*/
/*                             "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",*/
/*                             "fog"*/
/*                         ],*/
/*                         i;*/
/* */
/*                 for (i = list.length; i--;)*/
/*                     icons.set(list[i], list[i]);*/
/* */
/*                 icons.play();*/
/*             });*/
/*         </script>*/
/*         <!-- /Skycons -->*/
/* */
/*         <!-- Doughnut Chart -->*/
/*         <script>*/
/*             $(document).ready(function(){*/
/*                 var options = {*/
/*                     legend: false,*/
/*                     responsive: false*/
/*                 };*/
/* */
/*                 new Chart(document.getElementById("canvas1"), {*/
/*                     type: 'doughnut',*/
/*                     tooltipFillColor: "rgba(51, 51, 51, 0.55)",*/
/*                     data: {*/
/*                         labels: [*/
/*                             "Symbian",*/
/*                             "Blackberry",*/
/*                             "Other",*/
/*                             "Android",*/
/*                             "IOS"*/
/*                         ],*/
/*                         datasets: [{*/
/*                             data: [15, 20, 30, 10, 30],*/
/*                             backgroundColor: [*/
/*                                 "#BDC3C7",*/
/*                                 "#9B59B6",*/
/*                                 "#E74C3C",*/
/*                                 "#26B99A",*/
/*                                 "#3498DB"*/
/*                             ],*/
/*                             hoverBackgroundColor: [*/
/*                                 "#CFD4D8",*/
/*                                 "#B370CF",*/
/*                                 "#E95E4F",*/
/*                                 "#36CAAB",*/
/*                                 "#49A9EA"*/
/*                             ]*/
/*                         }]*/
/*                     },*/
/*                     options: options*/
/*                 });*/
/*             });*/
/*         </script>*/
/*         <!-- /Doughnut Chart -->*/
/* */
/*         <!-- bootstrap-daterangepicker -->*/
/*         <script>*/
/*             $(document).ready(function() {*/
/* */
/*                 var cb = function(start, end, label) {*/
/*                     console.log(start.toISOString(), end.toISOString(), label);*/
/*                     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));*/
/*                 };*/
/* */
/*                 var optionSet1 = {*/
/*                     startDate: moment().subtract(29, 'days'),*/
/*                     endDate: moment(),*/
/*                     minDate: '01/01/2012',*/
/*                     maxDate: '12/31/2015',*/
/*                     dateLimit: {*/
/*                         days: 60*/
/*                     },*/
/*                     showDropdowns: true,*/
/*                     showWeekNumbers: true,*/
/*                     timePicker: false,*/
/*                     timePickerIncrement: 1,*/
/*                     timePicker12Hour: true,*/
/*                     ranges: {*/
/*                         'Today': [moment(), moment()],*/
/*                         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],*/
/*                         'Last 7 Days': [moment().subtract(6, 'days'), moment()],*/
/*                         'Last 30 Days': [moment().subtract(29, 'days'), moment()],*/
/*                         'This Month': [moment().startOf('month'), moment().endOf('month')],*/
/*                         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
/*                     },*/
/*                     opens: 'left',*/
/*                     buttonClasses: ['btn btn-default'],*/
/*                     applyClass: 'btn-small btn-primary',*/
/*                     cancelClass: 'btn-small',*/
/*                     format: 'MM/DD/YYYY',*/
/*                     separator: ' to ',*/
/*                     locale: {*/
/*                         applyLabel: 'Submit',*/
/*                         cancelLabel: 'Clear',*/
/*                         fromLabel: 'From',*/
/*                         toLabel: 'To',*/
/*                         customRangeLabel: 'Custom',*/
/*                         daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],*/
/*                         monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],*/
/*                         firstDay: 1*/
/*                     }*/
/*                 };*/
/*                 $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));*/
/*                 $('#reportrange').daterangepicker(optionSet1, cb);*/
/*                 $('#reportrange').on('show.daterangepicker', function() {*/
/*                     console.log("show event fired");*/
/*                 });*/
/*                 $('#reportrange').on('hide.daterangepicker', function() {*/
/*                     console.log("hide event fired");*/
/*                 });*/
/*                 $('#reportrange').on('apply.daterangepicker', function(ev, picker) {*/
/*                     console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));*/
/*                 });*/
/*                 $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {*/
/*                     console.log("cancel event fired");*/
/*                 });*/
/*                 $('#options1').click(function() {*/
/*                     $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);*/
/*                 });*/
/*                 $('#options2').click(function() {*/
/*                     $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);*/
/*                 });*/
/*                 $('#destroy').click(function() {*/
/*                     $('#reportrange').data('daterangepicker').remove();*/
/*                 });*/
/*             });*/
/*         </script>*/
/*         <!-- /bootstrap-daterangepicker -->*/
/* */
/*         <!-- gauge.js -->*/
/*         <script>*/
/*             var opts = {*/
/*                 lines: 12,*/
/*                 angle: 0,*/
/*                 lineWidth: 0.4,*/
/*                 pointer: {*/
/*                     length: 0.75,*/
/*                     strokeWidth: 0.042,*/
/*                     color: '#1D212A'*/
/*                 },*/
/*                 limitMax: 'false',*/
/*                 colorStart: '#1ABC9C',*/
/*                 colorStop: '#1ABC9C',*/
/*                 strokeColor: '#F0F3F3',*/
/*                 generateGradient: true*/
/*             };*/
/*             var target = document.getElementById('foo'),*/
/*                     gauge = new Gauge(target).setOptions(opts);*/
/* */
/*             gauge.maxValue = 6000;*/
/*             gauge.animationSpeed = 32;*/
/*             gauge.set(3200);*/
/*             gauge.setTextField(document.getElementById("gauge-text"));*/
/*         </script>*/
/*         <!-- /gauge.js -->*/
/* */
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
