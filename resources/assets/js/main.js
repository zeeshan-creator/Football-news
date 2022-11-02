/**
 * Main
 */


'use strict';

let menu, animate;


$(document).ready(function () {

  $('#summernote').summernote(
    {
      placeholder: 'Description',
      tabsize: 2,
      height: 300
    }
  );

  // Remove alert after 3sec of page load 
  setTimeout(function () {
    $(".dismiss-3").slideUp(800);
  }, 3000);

  $('.dropify').dropify();


  $('.DataTable').DataTable({
    order: [[0, 'desc']],
  });

  // === Set old image in Dropify preview ===
  (function () {
    let oldImage = $('.custom-dropify #oldImage').val();
    let imageSrc = "/images/" + oldImage;

    $(".custom-dropify .dropify-preview").css("display", "block")
    $(".custom-dropify .dropify-wrapper .dropify-clear").css("display", "block")

    $(".custom-dropify .dropify-render").html(`<img src='${imageSrc}' >`);

    $(".custom-dropify .dropify-wrapper input").removeAttr("required")

    $(document).on('click', '.custom-dropify .dropify-clear', function (e) {

      $(".custom-dropify .dropify-wrapper .dropify-clear").css("display", "none")
      $(".custom-dropify .dropify-preview").css("display", "none")

      $(".custom-dropify .dropify-wrapper input").attr("required")

      $(".custom-dropify #oldImage").removeAttr("value")

    });

    $(document).on('click', '.custom-dropify .dropify-wrapper input', function (e) {


      $(".custom-dropify .dropify-wrapper input").attr("required")

      $(".custom-dropify #oldImage").removeAttr("value")
      $(".custom-dropify .dropify-preview").css("display", "none")

    });

  })();
});


(function () {
  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Display menu toggle (layout-menu-toggle) on hover with delay
  let delay = function (elem, callback) {
    let timeout = null;
    elem.onmouseenter = function () {
      // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {
      // Clear any timers set to timeout
      document.querySelector('.layout-menu-toggle').classList.remove('d-block');
      clearTimeout(timeout);
    };
  };
  if (document.getElementById('layout-menu')) {
    delay(document.getElementById('layout-menu'), function () {
      // not for small screen
      if (!Helpers.isSmallScreen()) {
        document.querySelector('.layout-menu-toggle').classList.add('d-block');
      }
    });
  }

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  window.Helpers.setCollapsed(true, false);
})();





