// Load Gulp...of course
let gulp = require('gulp');

// CSS related plugins
let sass = require('gulp-sass');
let autoprefixer = require('gulp-autoprefixer');
let minifycss = require('gulp-uglifycss');

// JS related plugins
let concat = require('gulp-concat');
let uglify = require('gulp-uglify');
let babelify = require('babelify');
let browserify = require('browserify');
let source = require('vinyl-source-stream');
let buffer = require('vinyl-buffer');
let stripDebug = require('gulp-strip-debug');

// Utility plugins
let rename = require('gulp-rename');
let sourcemaps = require('gulp-sourcemaps');
let notify = require('gulp-notify');
let plumber = require('gulp-plumber');
let options = require('gulp-options');
let gulpif = require('gulp-if');

// Browsers related plugins
let browserSync = require('browser-sync').create();
let reload = browserSync.reload;

let styleSRC = './src/scss/**/*.*ss';
let styleURL = './assets/css/';
let mapURL = './';

let jsFiles = ['plugin_template_script.js', 'index.js'];
let jsURL = './assets/js/';
let jsFolder = './src/js/';

let styleWatch = './src/scss/**/*.*ss';
let jsWatch = './src/js/**/*.js';
let phpWatch = './**/*.php';

// Tasks
// gulp.task('browser-sync', function () {
//     browserSync.init({
//         proxy: projectURL,
//         https: {
//             key: '/Users/alecaddd/.valet/Certificates/test.dev.key',
//             cert: '/Users/alecaddd/.valet/Certificates/test.dev.crt'
//         },
//         injectChanges: true,
//         open: false
//     });
// });

gulp.task('styles', function () {
    gulp.src(styleSRC)
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }))
        .on('error', console.error.bind(console))
        .pipe(autoprefixer({browsers: ['last 2 versions', '> 5%', 'Firefox ESR']}))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write(mapURL))
        .pipe(gulp.dest(styleURL))
        .pipe(browserSync.stream());
});

gulp.task('js', function () {
    jsFiles.map(file => {
        return browserify({
            entries: [jsFolder + file]
        })
            .transform(babelify, {presets: ['env']})
            .bundle()
            .pipe(source(file))
            .pipe(buffer())
            .pipe(gulpif(options.has('production'), stripDebug()))
            .pipe(sourcemaps.init({loadMaps: true}))
            .pipe(uglify())
            .pipe(rename({suffix: '.min'}))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(jsURL))
            .pipe(browserSync.stream());
    });
});

function triggerPlumber(src, url) {
    return gulp.src(src)
        .pipe(plumber())
        .pipe(gulp.dest(url));
}

gulp.task('default', ['styles', 'js'], function () {
    gulp.src(jsURL + 'plugin_template_script.min.js')
        .pipe(notify({message: 'Assets Compiled!'}));
});

// gulp.task('watch', ['default', 'browser-sync'], function () {
gulp.task('watch', ['default'], function () {
    gulp.watch(phpWatch, reload);
    gulp.watch(styleWatch, ['styles']);
    gulp.watch(jsWatch, ['js', reload]);
    gulp.src(jsURL + 'plugin_template_script.min.js')
        .pipe(notify({message: 'Gulp is Watching, Happy Coding!'}));
});