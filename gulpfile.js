const { src, dest, watch, series, parallel } = require('gulp');
const yargs = require('yargs');
const gulpSass = require('gulp-sass')(require('sass'));
const cleanCss = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const webpack = require('webpack-stream');
const imagemin = require('gulp-imagemin');
const browserSync = require('browser-sync').create();

const PRODUCTION = yargs.argv.prod;
const server = browserSync;

const serve = done => {
  server.init({
    proxy: "http://geoff.test"
  });
  done();
};

const reload = done => {
  server.reload();
  done();
};

const styles = () => {
  return src(['src/scss/style.scss'], { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(gulpSass().on('error', gulpSass.logError))
    .pipe(postcss([autoprefixer]))
    .pipe(cleanCss({ compatibility: 'ie11' }))
    .pipe(sourcemaps.write())
    .pipe(dest('dist/css'))
    .pipe(server.stream());
};

const scripts = () => {
  return src('src/js/**/*.js', { allowEmpty: true })
    .pipe(concat('scripts.js'))
    .pipe(dest('dist/js'))
    .pipe(minify())
    .pipe(dest('dist/js'));
};

const images = () => {
  return src('src/img/**/*.{jpg,jpeg,png,gif}', { allowEmpty: true })
    .pipe(imagemin().on('error', (err) => {
      console.error('Error in images task', err.toString());
    }))
    .pipe(dest('dist/img'));
};

// SVG Sprite
const svg = () => {
  const svgSprite = require('gulp-svg-sprite');
  const config = {
    shape: {
      dest: 'dist/img'
    },
    mode: {
      dest: 'dist/img',
      symbol: true,
      inline: true,
      bust: true
    },
    svg: {
      spriteWidth: 0,
      spriteHeight: 0,
      xmlDeclaration: false,
      doctypeDeclaration: false,
    },
  };
  return src('**/*.svg', { cwd: 'src/img/svg', allowEmpty: true })
    .pipe(svgSprite(config))
    .pipe(dest('.'));
};

const watchForChanges = () => {
  watch('src/scss/**/*.scss', series(styles, reload));
  watch('src/img/**/*.{jpg,jpeg,png,gif}', series(images, reload));
  watch('src/img/icons/**/*.{svg}', series(svg, reload));
  watch(['src/**/*', '!src/{img,js,scss}', '!src/{img,js,scss}/**/*'], series(reload));
  watch('src/js/**/*.js', series(scripts, reload));
  watch("**/*.php", reload);
};

const dev = series(parallel(styles, images, scripts), serve, watchForChanges, reload);

const build = series(parallel(styles, images, scripts));

exports.serve = serve;
exports.reload = reload;
exports.styles = styles;
exports.scripts = scripts;
exports.images = images;
exports.svg = svg;
exports.watchForChanges = watchForChanges;
exports.dev = dev;
exports.build = build;

exports.default = dev;