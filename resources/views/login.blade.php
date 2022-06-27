@extends('layouts.index')

{{-- {{dd(session()->all())}} --}}

<div class="login">
  <div class="wrap">
      <!-- TOGGLE -->
      <div id="toggle-wrap">
          <div id="toggle-terms">
              <div id="cross">
                  <span></span>
                  <span></span>
              </div>
          </div>
      </div>

      <div class="content">
          <!-- LOGO -->
          <div class="logo">
              <a href="#"><img src="https://res.cloudinary.com/dpcloudinary/image/upload/v1506186248/logo.png" alt=""></a>
          </div>
          <!-- SLIDESHOW -->
          <div id="slideshow">
              <div class="one">
                  <h2><span>Almacen</span></h2>
                  <p>Gestiona los almacenas a nivel Nacional</p>
              </div>
              <div class="two">
                  <h2><span>Articulos</span></h2>
                  <p>Ingreso de Articulos nuevos y usados</p>
              </div>
              <div class="three">
                  <h2><span>Traspasos</span></h2>
                  <p>Transferencia de Articulos entre los diferentes almacenes</p>
              </div>
              {{-- <div class="four">
                  <h2><span>SHARING</span></h2>
                  <p>Share your works and knowledge with the community on the public showcase section</p>
              </div> --}}
          </div>
      </div>
      <!-- LOGIN FORM -->
      <div class="user">
          <div class="form-wrap">
              <!-- TABS -->
            <div class="tabs">
                  <h3 class="login-tab"><a class="log-in active" href="#login-tab-content"><span>Ingresar<span></a></h3>
            </div>
              <!-- TABS CONTENT -->
            <div class="tabs-content">
                  <!-- TABS CONTENT LOGIN -->
              <div id="login-tab-content" class="active">
                <form class="login-form" action="/check" method="post" name="login" id="login">
                  @csrf
                  <input type="text" name="usuario" class="input" id="user_login" autocomplete="off" placeholder="Usuario">
                  <input type="password" name="clave" class="input" id="user_pass" autocomplete="off" placeholder="Clave">
                  <button type="Submit" name="Submit" class="btn btn-success"> Ingresar</button>
                </form>
                {{-- <div class="help-action">
                  <p><i class="fa fa-arrow-left" aria-hidden="true"></i><a class="forgot" href="#">Olvidaste la Clave?</a></p>
                </div> --}}
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script >/* LOGIN - MAIN.JS - dp 2017 */

// LOGIN TABS
$(function() {
var tab = $('.tabs h3 a');
tab.on('click', function(event) {
event.preventDefault();
tab.removeClass('active');
$(this).addClass('active');
tab_content = $(this).attr('href');
$('div[id$="tab-content"]').removeClass('active');
$(tab_content).addClass('active');
});
});

// SLIDESHOW
$(function() {
$('#slideshow > div:gt(0)').hide();
setInterval(function() {
$('#slideshow > div:first')
.fadeOut(1000)
.next()
.fadeIn(1000)
.end()
.appendTo('#slideshow');
}, 3850);
});

// CUSTOM JQUERY FUNCTION FOR SWAPPING CLASSES
(function($) {
'use strict';
$.fn.swapClass = function(remove, add) {
this.removeClass(remove).addClass(add);
return this;
};
}(jQuery));

// SHOW/HIDE PANEL ROUTINE (needs better methods)
// I'll optimize when time permits.
$(function() {
$('.agree,.forgot, #toggle-terms, .log-in, .sign-up').on('click', function(event) {
event.preventDefault();
var terms = $('.terms'),
recovery = $('.recovery'),
close = $('#toggle-terms'),
arrow = $('.tabs-content .fa');
if ($(this).hasClass('agree') || $(this).hasClass('log-in') || ($(this).is('#toggle-terms')) && terms.hasClass('open')) {
if (terms.hasClass('open')) {
terms.swapClass('open', 'closed');
close.swapClass('open', 'closed');
arrow.swapClass('active', 'inactive');
} else {
if ($(this).hasClass('log-in')) {
return;
}
terms.swapClass('closed', 'open').scrollTop(0);
close.swapClass('closed', 'open');
arrow.swapClass('inactive', 'active');
}
}
else if ($(this).hasClass('forgot') || $(this).hasClass('sign-up') || $(this).is('#toggle-terms')) {
if (recovery.hasClass('open')) {
recovery.swapClass('open', 'closed');
close.swapClass('open', 'closed');
arrow.swapClass('active', 'inactive');
} else {
if ($(this).hasClass('sign-up')) {
return;
}
recovery.swapClass('closed', 'open');
close.swapClass('closed', 'open');
arrow.swapClass('inactive', 'active');
}
}
});
});

// DISPLAY MSSG
$(function() {
$('.recovery .button').on('click', function(event) {
event.preventDefault();
$('.recovery .mssg').addClass('animate');
setTimeout(function() {
$('.recovery').swapClass('open', 'closed');
$('#toggle-terms').swapClass('open', 'closed');
$('.tabs-content .fa').swapClass('active', 'inactive');
$('.recovery .mssg').removeClass('animate');
}, 2500);
});
});

// DISABLE SUBMIT FOR DEMO
      $(function() {
      $('.button').on('click', function(event) {
      $(this).stop();
      event.preventDefault();
      return false;
      });
      });
      //# sourceURL=pen.js
      </script>
      
  