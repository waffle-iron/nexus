// https://github.com/dowjones/gulp-bundle-assets/blob/master/examples/bower/bundle.config.js
// https://www.npmjs.com/package/gulp-bundle-assets
module.exports = {
    bundle: {
        vendors: {
            scripts: [
                './bower_components/jquery/dist/jquery.min.js',
                './bower_components/bootstrap/dist/js/bootstrap.min.js',
                './bower_components/fastclick/lib/fastclick.js',
                './bower_components/nprogress/nprogress.js',
                './bower_components/Chart.js/dist/Chart.min.js',
                './bower_components/gauge.js/dist/gauge.min.js',
                './bower_components/bootstrap-progressbar/bootstrap-progressbar.min.js',
                './bower_components/iCheck/icheck.min.js',
                './bower_components/skycons/skycons.js',
                './bower_components/Flot/jquery.flot.js',
                './bower_components/Flot/jquery.flot.pie.js',
                './bower_components/Flot/jquery.flot.time.js',
                './bower_components/Flot/jquery.flot.stack.js',
                './bower_components/Flot/jquery.flot.resize.js',
                './bower_components/flot.orderbars/js/jquery.flot.orderBars.js',
                './bower_components/date.js/build/date.js',
                './bower_components/flot-spline/js/jquery.flot.spline.min.js',
                './bower_components/flot.curvedlines/curvedLines.js',
                './bower_components/moment/moment.js',
                './bower_components/bootstrap-daterangepicker/daterangepicker.js'
            ],
            styles: [
                './bower_components/bootstrap/dist/css/bootstrap.min.css',
                './bower_components/font-awesome/css/font-awesome.min.css',
                './bower_components/iCheck/skins/flat/green.css',
                './bower_components/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
                './bower_components/jvectormap/jquery-jvectormap.css',
            ],
            
            options: {
                rev: false
            }
        }
    },
    copy: [
        {
            src: './bower_components/**/*.{woff2,woff}',
            base: 'craig/'
        },
        {
            src: './bower_components/**/*.{png}',
            base: 'craig/'
        }
    ]
};