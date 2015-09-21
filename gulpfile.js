var gulp = require('gulp');
var elixir = require('laravel-elixir');

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {
  mix.less('app.less');
});
