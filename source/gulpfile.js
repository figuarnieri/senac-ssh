var gulp = require('gulp'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  sass = require('gulp-sass'),
  image = require('gulp-image'),
  imagemin = require('gulp-imagemin'),
  rename = require('gulp-rename'),
  babel = require('gulp-babel'),
  jsArray = [
    'js/lib/default.js',
    'js/lib/*.js',
    'js/vendor/*.js',
    'js/themes/*.js'
  ],
  imgArray = [
    'img/*',
    'img/**/*',
    'img/**/**/*'
  ]

gulp.task('css', ['cssdev'], function () {
  return gulp.src(['scss/*.scss', 'scss/**/*.scss'])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../dist/css'))
})
.task('cssdev', function () {
  return gulp.src(['scss/*.scss', 'scss/**/*.scss'])
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(gulp.dest('../dist/css'))
})
.task('jsdev', function () {
  return gulp.src(jsArray)
        .pipe(babel({
          presets: ['env']
        }))
        .pipe(concat('all.js'))
        .pipe(gulp.dest('../dist/js'))
})
.task('jsmin', ['jsdev'], function () {
  return gulp.src(jsArray)
        .pipe(babel({
          presets: ['env']
        }))
        .pipe(uglify({
          preserveComments: false
        }))
        .pipe(concat('all.min.js'))
        .pipe(gulp.dest('../dist/js'))
})
.task('js', ['jsmin'], function () {
  return gulp.src(jsArray)
        .pipe(babel({
          presets: ['env']
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify({
          preserveComments: false
        }))
        .pipe(gulp.dest('../dist/js'))
})
.task('img', ['imgdev'], function () {
  gulp.src(imgArray)
    .pipe(image({
      pngquant: true,
      optipng: true,
      zopflipng: false,
      jpegRecompress: true,
      jpegoptim: true,
      mozjpeg: true,
      gifsicle: true,
      svgo: true,
      concurrent: 7
    }))
    .pipe(gulp.dest('../dist/img'))
})
.task('imgdev', function () {
  gulp.src(imgArray)
    .pipe(imagemin())
    .pipe(gulp.dest('../dist/img'))
})
.task('watch', function () {
  gulp.watch('scss/**/*.scss', ['css'])
  gulp.watch(jsArray, ['jsdev'])
  gulp.watch(imgArray, ['imgdev'])
})
.task('default', ['watch'])
