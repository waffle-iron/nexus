var gulp = require('gulp'),
    bundle = require('gulp-bundle-assets'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync = require('browser-sync').create(),
    gulpCopy = require('gulp-copy'),
    clean = require('gulp-clean');

gulp.task('bundle', function() {
    return gulp.src('./bundle.config.js')
        .pipe(bundle())
        .pipe(gulp.dest('./web/assets/bundles/vendors'));
});

var directories = {};
directories.fonts  = './web/assets/bundles/fonts';
directories.images = './web/assets/bundles/vendors';


gulp.task('clean-images',function(){
    gulp.src(directories.images + '/*.{png,jpeg,jpg}',{read:false})
        .pipe(clean());
});

var bower_images = [
    './bower_components/iCheck/skins/flat/green@2x.png'
]

gulp.task('copy-images', function() {
    // gulp.src('./bower_components/**/*.{png,jpeg,jpg}')
    //     .pipe(rename({dirname:''}))
    //     .pipe(gulp.dest(directories.images));

    gulp.src(bower_images)
        .pipe(rename({dirname:''}))
        .pipe(gulp.dest(directories.images));
});

gulp.task('clean-fonts',function(){
    gulp.src(directories.fonts+'/*.{png,jpeg,jpg}',{read:false})
        .pipe(clean());
});

gulp.task('copy-fonts', function() {

    gulp.src('./bower_components/**/*.{ttf,woff,woff2,eof,svg}',{read:false})
        .pipe(rename({dirname:''}))
        .pipe(gulp.dest(directories.fonts));
});

gulp.task('copy',['clean-fonts','copy-fonts','clean-images','copy-images']);
gulp.task('default', ['bundle','copy']);

// /usr/local/var/www/nexus/bower_components/bootstrap/fonts/glyphicons-halflings-regular.woff2
// http://localhost:8080/assets/bundles/vendors/green@2x.png