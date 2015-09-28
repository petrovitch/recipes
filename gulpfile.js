var gulp = require('gulp');
var elixir = require('laravel-elixir');

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function (mix) {
    /**
     * Compile less files into a single css file
     */
    mix.message("less");
    mix.less('app.less');

    /**
     * One of the most common uses of Gulp is to automate unit tests. We’ll follow the
     * TDD (Test Driven Development) process here and let Gulp automatically run our tests.
     */
    //mix.message("phpUnit");
    //mix.phpUnit();
    //
    //mix.message("phpSpec");
    //mix.phpSpec();

    /**
     * This will automatically monitor your controllers for changes (and route annotations),
     * and re-generate the cached routes file. The same is true for events.
     */
    //mix.message("routes");
    //mix.routes();
    //
    //mix.message("events");
    //mix.events();
});
