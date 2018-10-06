'use strict';

var gulp = require('gulp'), //основной плагин gulp
  sass = require('gulp-sass'),
  notify = require('gulp-notify'),
  prefixer = require('gulp-autoprefixer'), //расставление автопрефиксов
  cssmin = require('gulp-minify-css'), //минификация css
  uglify = require('gulp-uglify'), //минификация js
  rigger = require('gulp-rigger'), //работа с инклюдами в html и js
  imagemin = require('gulp-imagemin'), //минимизация изображений
  rimraf = require('rimraf'), //очистка
  sourcemaps = require('gulp-sourcemaps'), //sourcemaps
  rename = require("gulp-rename"), //переименвоание файлов
  plumber = require("gulp-plumber"), //предохранитель для остановки гальпа
  watch = require('gulp-watch'), //расширение возможностей watch
  connect = require('gulp-connect'), //livereload
  mysftp = require('gulp-sftp-up4'), // sftp
  changed = require('gulp-changed');

var path = {
  build: { //Тут мы укажем куда складывать готовые после сборки файлы
    html: 'build/',
    js: 'build/js/',
    css: 'build/css/',
    img: 'build/css/images/',
    svg: 'build/svg/',
    fonts: 'build/fonts/',
    htaccess: 'build/',
    contentImg: 'build/img/',
    language: 'build/language/',
    htmlfolder: 'build/html/'
  },

  src: { //Пути откуда брать исходники
    html: 'src/template/*.html', //Синтаксис src/template/*.html говорит gulp что мы хотим взять все файлы с расширением .html
    js: 'src/js/[^_]*.js', //В стилях и скриптах нам понадобятся только main файлы
    css: 'src/css/styles.scss',
    cssVendor: 'src/css/vendor/*.*', //Если мы хотим файлы библиотек отдельно хранить то раскоментить строчку
    img: 'src/css/images/**/*.{jpg,png,gif}', //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
    svg: 'src/svg/**/*.svg',
    fonts: 'src/fonts/**/*.*',
    contentImg: 'src/img/**/*.{jpg,png,gif}',
    htaccess: 'src/.htaccess',
    language: 'src/language/**/*.*',
    htmlfolder: 'src/html/**/*.*',
    indexfiles: 'src/template/{index.php,templateDetails.xml}'
  },

  watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
    html: 'src/template/**/*.html',
    js: 'src/js/**/*.js',
    css: 'src/css/**/*.*',
    img: 'src/css/images/**/*.{jpg,png,gif}',
    svg: 'src/svg/**/*.svg',
    contentImg: 'src/img/**/*.{jpg,png,gif}',
    fonts: 'src/fonts/**/*.*',
    htaccess: 'src/.htaccess',
    language: 'src/language/**/*.*',
    htmlfolder: 'src/html/**/*.*',
    indexfiles: 'src/template/{index.php,templateDetails.xml}'
  },
  sftp: { // Из каких папок будем делать выгрузку на сервер
    index: 'build/{index.html,index.php,templateDetails.xml}',
    js: 'build/js/**/*.js',
    css: 'build/css/**/*.css',
    img: 'build/img/**/*.*',
    svg: 'build/svg/**/*.svg',
    fonts: 'build/fonts/**/*.*',
    htaccess: 'build/.htaccess',
    language: 'build/language/**/*.*',
    htmlfolder: 'build/html/**/*.*',
    indexfiles: 'build/{index.php,templateDetails.xml}'
  },
  cle: './build', //директории которые могут очищаться
  outputDir: './build/' //исходная корневая директория для запуска минисервера
};

var host = 'server170.hosting.reg.ru',
  remotePath = '/var/www/u0516603/data/www/britbob.ru/templates/britbob/',
  remotePathroot = '/var/www/u0516603/data/www/britbob.ru/';

// уведомляем о том, что всё работает
gulp.task('notify', function (done) {
  gulp.src('src/template/index.html')
    .pipe(notify("за сервер 🍺"));
  done();
});

gulp.task('connectik', gulp.series('notify', function (done) {
  connect.server({
    root: [path.outputDir], //корневая директория запуска сервера
    port: 9999, //какой порт будем использовать
    livereload: true, //инициализируем работу LiveReload
  })
  done();
}));


function defaultTask(done) {
  // place code for your default task here
  done();
}

var cleaning = gulp.task('clean', function(cb) {
  rimraf(path.cle, cb);
});


// таск для билдинга html
gulp.task('html:build', function (done) {
  gulp.src(path.src.html) //Выберем файлы по нужному пути
    .pipe(rigger()) //Прогоним через rigger
    .pipe(gulp.dest(path.build.html)) //выгрузим их в папку build
    .pipe(connect.reload()) //И перезагрузим наш сервер для обновлений
  done();
});

// билдим статичные изображения
gulp.task('image:build', function (done) {
  gulp.src(path.src.img) //Выберем наши картинки
    .pipe(imagemin({ //Сожмем их
      progressive: true, //сжатие .jpg
      svgoPlugins: [{
        removeViewBox: false
			}],  //сжатие .svg
      interlaced: true, //сжатие .gif
      optimizationLevel: 3 //степень сжатия от 0 до 7
    }))
    .pipe(gulp.dest(path.build.img)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});



// билдим статичные изображения
gulp.task('svg:build', function (done) {
  gulp.src(path.src.svg) //Выберем наши картинки
    .pipe(gulp.dest(path.build.svg)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});



// билдим динамичные изображения
gulp.task('imagescontent:build', function (done) {
  gulp.src(path.src.contentImg)
    .pipe(imagemin({ //Сожмем их
      progressive: true, //сжатие .jpg
      svgoPlugins: [{
        removeViewBox: false
			}], //сжатие .svg
      interlaced: true, //сжатие .gif
      optimizationLevel: 3 //степень сжатия от 0 до 7
    }))
    .pipe(gulp.dest(path.build.contentImg)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});

// билдинг яваскрипта
gulp.task('js:build', function (done) {
  gulp.src(path.src.js) //Найдем наш main файл
    .pipe(gulp.dest(path.build.js)) //выгрузим готовый файл в build
    .pipe(sourcemaps.init()) //Инициализируем sourcemap
    .pipe(uglify()) //Сожмем наш js
    .pipe(sourcemaps.write()) //Пропишем карты
    .pipe(rename({
      suffix: '.min'
    })) //добавим суффикс .min к выходному файлу
    .pipe(gulp.dest(path.build.js)) //выгрузим готовый файл в build
    .pipe(connect.reload()) //И перезагрузим сервер
  done();
});


// билдинг домашнего css
gulp.task('css:build', function (done) {
  gulp.src(path.src.css) //Выберем наш основной файл стилей
    .pipe(sourcemaps.init()) //инициализируем soucemap
    .pipe(sass().on('error', function () {
    gulp.src(path.src.css)
    .pipe(notify("🤔🤔🤔🤔🤔")) //уведомление об ошибке
    .pipe(sass().on('error', sass.logError )) //Скомпилируем sass
}))
    .pipe(prefixer({
      browsers: ['last 3 version', "> 1%", "ie 8", "ie 7"]
    })) //Добавим вендорные префиксы
    .pipe(gulp.dest(path.build.css)) //выгрузим в build
    .pipe(cssmin()) //Сожмем
    .pipe(sourcemaps.write()) //пропишем sourcemap
    .pipe(rename({
      suffix: '.min'
    })) //добавим суффикс .min к имени выходного файла
    //.pipe(changed(path.build.css))
    .pipe(gulp.dest(path.build.css)) //выгрузим в build минифицированный
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});
// билдинг вендорного css
gulp.task('cssVendor:build', function (done) {
  gulp.src(path.src.cssVendor) // Берем папку vendor
    .pipe(sourcemaps.init()) //инициализируем soucemap
    .pipe(cssmin()) //Сожмем
    .pipe(sourcemaps.write()) //пропишем sourcemap
    .pipe(gulp.dest(path.build.css)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});


// билдим шрифты
gulp.task('fonts:build', function (done) {
  gulp.src(path.src.fonts)
    .pipe(gulp.dest(path.build.fonts)) //выгружаем в build
  done();
});

// билдим htaccess
gulp.task('htaccess:build', function (done) {
  gulp.src(path.src.htaccess)
    .pipe(gulp.dest(path.build.htaccess)) //выгружаем в build
  done();
});

// билдим остальные папки для шаблона joomla
gulp.task('other:build', function (done) {
  gulp.src(path.src.language) //Выберем папку language
    .pipe(gulp.dest(path.build.language)) //выгрузим в build/language
  gulp.src(path.src.htmlfolder) //Выберем папку html
    .pipe(gulp.dest(path.build.htmlfolder)) //выгрузим в build/html
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});

// билдим indexfiles
gulp.task('indexfiles:build', function (done) {
  gulp.src(path.src.indexfiles) //Выберем файлы по нужному пути
    .pipe(gulp.dest(path.build.html)) //выгрузим их в папку build
    .pipe(connect.reload()) //И перезагрузим наш сервер для обновлений
  done();
}); 


// таск для билдинга html
gulp.task('html:build-ftp', function (done) {
  gulp.src(path.src.html) //Выберем файлы по нужному пути
    .pipe(rigger()) //Прогоним через rigger
    .pipe(gulp.dest(path.build.html)) //выгрузим их в папку build
    .pipe(connect.reload()) //И перезагрузим наш сервер для обновлений
  done();
});

// билдим статичные изображения
gulp.task('image:build-ftp', function (done) {
  gulp.src(path.src.img) //Выберем наши картинки
    .pipe(imagemin({ //Сожмем их
      progressive: true, //сжатие .jpg
      svgoPlugins: [{
        removeViewBox: false
      }],  //сжатие .svg
      interlaced: true, //сжатие .gif
      optimizationLevel: 3 //степень сжатия от 0 до 7
    }))
    .pipe(gulp.dest(path.build.img)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});



// билдим статичные изображения
gulp.task('svg:build-ftp', function (done) {
  gulp.src(path.src.svg) //Выберем наши картинки
    .pipe(gulp.dest(path.build.svg)) //выгрузим в build
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});



// билдим динамичные изображения
gulp.task('imagescontent:build-ftp', function (done) {
  gulp.src(path.src.contentImg)
    .pipe(imagemin({ //Сожмем их
      progressive: true, //сжатие .jpg
      svgoPlugins: [{
        removeViewBox: false
      }], //сжатие .svg
      interlaced: true, //сжатие .gif
      optimizationLevel: 3 //степень сжатия от 0 до 7
    }))
    .pipe(gulp.dest(path.build.contentImg)) //выгрузим в build
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'img/'
    }))
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});

// билдинг яваскрипта
gulp.task('js:build-ftp', function (done) {
  gulp.src(path.src.js) //Найдем наш main файл
    .pipe(changed(path.build.js))
    .pipe(gulp.dest(path.build.js)) //выгрузим готовый файл в build
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'js/'
    }))
    //.pipe(sourcemaps.init()) //Инициализируем sourcemap
    .pipe(uglify()) //Сожмем наш js
    //.pipe(sourcemaps.write()) //Пропишем карты
    .pipe(rename({
      suffix: '.min'
    })) //добавим суффикс .min к выходному файлу
    .pipe(changed(path.build.js))
    .pipe(gulp.dest(path.build.js)) //выгрузим готовый файл в build
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'js/'
    }))
    .pipe(connect.reload()) //И перезагрузим сервер
  done();
});


// билдинг домашнего css
gulp.task('css:build-ftp', function (done) {
  gulp.src(path.src.css) //Выберем наш основной файл стилей
    //.pipe(sourcemaps.init()) //инициализируем soucemap
    .pipe(sass().on('error', function () {
    gulp.src(path.src.css)
    .pipe(notify("🤔🤔🤔🤔🤔")) //уведомление об ошибке
    .pipe(sass().on('error', sass.logError )) //Скомпилируем sass
}))
    .pipe(prefixer({
      browsers: ['last 3 version', "> 1%", "ie 8", "ie 7"]
    })) //Добавим вендорные префиксы
    //.pipe(changed(path.build.css))
    .pipe(gulp.dest(path.build.css)) //выгрузим в build
    .pipe(cssmin()) //Сожмем
    //.pipe(sourcemaps.write()) //пропишем sourcemap
    .pipe(rename({
      suffix: '.min'
    })) //добавим суффикс .min к имени выходного файла
    //.pipe(changed(path.build.css))
    .pipe(gulp.dest(path.build.css)) //выгрузим в build минифицированный
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'css/'
    }))
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});



// билдим шрифты
gulp.task('fonts:build-ftp', function (done) {
  gulp.src(path.src.fonts)
    .pipe(gulp.dest(path.build.fonts)) //выгружаем в build
  done();
});

// билдим htaccess
gulp.task('htaccess:build-ftp', function (done) {
  gulp.src(path.src.htaccess)
    .pipe(gulp.dest(path.build.htaccess)) //выгружаем в build
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePathroot
    }))
  done();
});

// билдим остальные папки для шаблона joomla
gulp.task('other:build-ftp', function (done) {
  gulp.src(path.src.language) //Выберем папку language
    .pipe(changed(path.build.language))
    .pipe(gulp.dest(path.build.language)) //выгрузим в build/language
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'language/'
    })) 
  gulp.src(path.src.htmlfolder) //Выберем папку html
    .pipe(changed(path.build.htmlfolder))
    .pipe(gulp.dest(path.build.htmlfolder)) //выгрузим в build/html
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath + 'html/'
    }))
    .pipe(connect.reload()) //перезагрузим сервер
  done();
});

// билдим indexfiles
gulp.task('indexfiles:build-ftp', function (done) {
  gulp.src(path.src.indexfiles) //Выберем файлы по нужному пути
    .pipe(changed(path.build.html))
    .pipe(gulp.dest(path.build.html)) //выгрузим их в папку build
    .pipe(mysftp({
      host: host,
      authFile: 'ftppass.json',
      auth: 'keyMain',
      remotePath: remotePath
    }))
    .pipe(connect.reload()) //И перезагрузим наш сервер для обновлений
  done();
}); 


// билдим все
var building = gulp.parallel('html:build', 'js:build', 'css:build', 'fonts:build', 'htaccess:build', 'image:build', 'imagescontent:build', 'svg:build', 'indexfiles:build');
gulp.task('build', building);


gulp.task('watch-html', function(done) {
  gulp.watch(path.watch.html, gulp.series('html:build'))
  done();
})
gulp.task('watch-imagescontent', function(done) {
  gulp.watch(path.watch.contentImg, gulp.series('imagescontent:build'))
  done();
})
gulp.task('watch-image', function(done) {
  gulp.watch(path.watch.img, gulp.series('image:build'))
  done();
})
gulp.task('watch-svg', function(done) {
  gulp.watch(path.watch.svg, gulp.series('svg:build'))
  done();
})
gulp.task('watch-js', function(done) {
  gulp.watch(path.watch.js, gulp.series('js:build'))
  done();
})
gulp.task('watch-css', function(done) {
  gulp.watch(path.watch.css, gulp.series('css:build'))
  done();
})
gulp.task('watch-fonts', function(done) {
  gulp.watch(path.watch.fonts, gulp.series('fonts:build'))
  done();
})
gulp.task('watch-htaccess', function(done) {
  gulp.watch(path.watch.htaccess, gulp.series('htaccess:build'))
  done();
})
gulp.task('watch-other', function(done) {
  gulp.watch([path.watch.language, path.watch.htmlfolder], gulp.series('other:build'))
  done();
})
gulp.task('watch-indexfiles', function(done) {
  gulp.watch(path.watch.indexfiles, gulp.series('indexfiles:build'))
  done();
})


gulp.task('watch-html-ftp', function(done) {
  gulp.watch(path.watch.html, gulp.series('html:build-ftp'))
  done();
})
gulp.task('watch-imagescontent-ftp', function(done) {
  gulp.watch(path.watch.contentImg, gulp.series('imagescontent:build-ftp'))
  done();
})
gulp.task('watch-image-ftp', function(done) {
  gulp.watch(path.watch.img, gulp.series('image:build-ftp'))
  done();
})
gulp.task('watch-svg-ftp', function(done) {
  gulp.watch(path.watch.svg, gulp.series('svg:build-ftp'))
  done();
})
gulp.task('watch-js-ftp', function(done) {
  gulp.watch(path.watch.js, gulp.series('js:build-ftp'))
  done();
})
gulp.task('watch-css-ftp', function(done) {
  gulp.watch(path.watch.css, gulp.series('css:build-ftp'))
  done();
})
gulp.task('watch-fonts-ftp', function(done) {
  gulp.watch(path.watch.fonts, gulp.series('fonts:build-ftp'))
  done();
})
gulp.task('watch-htaccess-ftp', function(done) {
  gulp.watch(path.watch.htaccess, gulp.series('htaccess:build-ftp'))
  done();
})
gulp.task('watch-other-ftp', function(done) {
  gulp.watch([path.watch.language, path.watch.htmlfolder], gulp.series('other:build-ftp'))
  done();
})
gulp.task('watch-indexfiles-ftp', function(done) {
  gulp.watch(path.watch.indexfiles, gulp.series('indexfiles:build-ftp'))
  done();
})

var watcher = gulp.parallel('watch-html', 'watch-image', 'watch-imagescontent', 'watch-svg', 'watch-js', 'watch-css', 'watch-fonts', 'watch-htaccess', 'watch-other', 'watch-indexfiles');
var watcher2 = gulp.parallel('watch-html-ftp', 'watch-image-ftp', 'watch-imagescontent-ftp', 'watch-svg-ftp', 'watch-js-ftp', 'watch-css-ftp', 'watch-fonts-ftp', 'watch-htaccess-ftp', 'watch-other-ftp', 'watch-indexfiles-ftp');
var ftpall = gulp.series('indexfiles:build-ftp', 'other:build-ftp', 'htaccess:build-ftp', 'css:build-ftp', 'js:build-ftp', 'imagescontent:build-ftp');

gulp.task('watch', watcher);
gulp.task('watch2', watcher2);

gulp.task('mass-ftp', ftpall);



var final = gulp.series('clean', 'build', 'connectik', 'watch');



gulp.task('css:upload', function (done) {
    return gulp.src(path.sftp.css)
        .pipe(mysftp({
            host: host,
            authFile: 'ftppass.json',
            auth: 'keyMain',
            remotePath: remotePath2
        }));
    done();
});

gulp.task('indexfiles:upload', function (done) {
   gulp.src(path.src.indexfiles) //Выберем файлы по нужному пути
    .pipe(gulp.dest(path.build.html)) //выгрузим их в папку build
    .pipe(connect.reload()) //И перезагрузим наш сервер для обновлений
        .pipe(mysftp({
            host: host,
            authFile: 'ftppass.json',
            auth: 'keyMain',
            remotePath: remotePath
        }));
    done();
});


// действия по умолчанию
gulp.task('default', final);

