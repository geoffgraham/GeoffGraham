import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import webpack from 'webpack-stream';
import imagemin from 'gulp-imagemin';
import browserSync from "browser-sync";

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: "http://geoff.dev"
  });
  done();
};
export const reload = done => {
  server.reload();
  done();
};

export const styles = () => {
  return src(['src/scss/style.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([ autoprefixer ]))
    .pipe(cleanCss({compatibility:'ie11'}))
    .pipe(sourcemaps.write())
    .pipe(dest('dist/css'))
    .pipe(server.stream());
}

export const scripts = () => {
  return src('src/js/scripts.js')
  .pipe(webpack({
    module: {
      rules: [
        {
          test: /\.js$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: []
            }
          }
        }
      ]
    },
    mode: PRODUCTION ? 'production' : 'development',
    devtool: !PRODUCTION ? 'inline-source-map' : false,
    output: {
      filename: 'scripts.js'
    },
  }))
  .pipe(dest('dist/js'));
}

export const images = () => {
  return src('src/img/**/*.{jpg,jpeg,png,gif}')
    .pipe(imagemin())
    .pipe(dest('dist/img'));
}

export const svg = () => {
  return src('src/img/**/*.{svg}')
    .pipe(dest('dist/img'));
}

export const watchForChanges = () => {
  watch('src/scss/**/*.scss', series(styles, reload));
  watch('src/images/**/*.{jpg,jpeg,png,gif}', series(images, reload));
	watch('src/images/**/*.{svg}', series(images, reload));
	watch(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'], series(reload));
  watch('src/js/**/*.js', series(scripts, reload));
  watch("**/*.php", reload);
}

export const dev = series(parallel(styles, images, scripts), serve, watchForChanges, reload);

export const build = done => {
	series(parallel(styles, images, scripts));
	done();
};

export default dev;