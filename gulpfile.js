/**
*   gulp libraries
*/
var gulp = require('gulp');
var less = require('gulp-less');
var css = require('gulp-mini-css');



/**
*   for gulp task
*/
var srcLessFrontend = 'application/modules/Template/views/frontend/less/*.less';
/*var srcLessFrontend = 'application/modules/Template/views/common/less/*.less';*/
var destLessFrontend = 'assets/frontend/css';

var srcLessBackend = 'application/modules/Template/views/backend/less/*.less';
var destLessBackend = 'assets/backend/css';


/**
*   gulp tasks
*/



/**
*   task to convert less to css and minify it.
*/
gulp.task('lessFrontend', function() {
    return gulp.src(srcLessFrontend)
        .pipe(less())
        .pipe(css({ext: '_min.css'}))
        .pipe(gulp.dest(destLessFrontend));
});



/**
*   task to convert less to css and minify it.
*/
gulp.task('lessBackend', function() {
    return gulp.src(srcLessBackend)
        .pipe(less())
        .pipe(css({ext: '_min.css'}))
        .pipe(gulp.dest(destLessBackend));
});



/**
*   default for tasks
*/
gulp.task('default', ['watch'], function() {
    // return gulp.watch(srcLessFrontend, ['less']);
});



/**
*   watch for tasks
*/
gulp.task('watch', ['lessFrontend', 'lessBackend'], function() {
    gulp.watch([srcLessFrontend, srcLessBackend], ['lessFrontend', 'lessBackend']);
});
