(function () {
  var lMlPrimary = l2('.menu-list.primary > li');
  var lMlAdditional = l2('.menu-list.additional > li');

  var lMlPrimaryLinks = l2('.menu-list.primary .ml-link');

  var mlPrimaryEndAt = 0;
  var mlAdditionalEndAt = 0;

  var mlPrimaryTimer;
  var mlAdditionalTimer;
  var mlSocialTimer;

  var menuMainItemTimer;

  for (var i = 0; i < lMlPrimary.size(); i++) {
    var eMlLink = lMlPrimary.get(i);

    mlPrimaryEndAt = i * 110;
    eMlLink.style = 'transition-delay: ' + (mlPrimaryEndAt) + 'ms';
  }

  for (var i = 0; i < lMlAdditional.size(); i++) {
    var eMlLink = lMlAdditional.get(i);

    mlAdditionalEndAt = i * 110;
    eMlLink.style = 'transition-delay: ' + (mlAdditionalEndAt) + 'ms';
  }


  var menuMainAnimation = function () {
    var lMenu = l2('.menu');
    var lHamburger = l2('.hamburger');


    if (lMenu.hasClass('active')) {
      clearTimeout(mlPrimaryTimer);
      clearTimeout(mlAdditionalTimer);
      clearTimeout(mlSocialTimer);

      l2('body').removeClass('overlay');

      lMenu.removeClass('active');
      lHamburger.removeClass('close');
      l2('.menu-list').removeClass('active');
      l2('.menu-social').removeClass('active');
      lMlPrimaryLinks.removeClass('active');
      l2('.menu-secondary > div').removeClass('active');
    } else {
      l2('body').addClass('overlay');
      
      lMenu.addClass('active');
      lHamburger.addClass('close');

      mlPrimaryTimer = setTimeout(function () {
        l2('.menu-list.primary').addClass('active');
      }, 250);

      mlAdditionalTimer = setTimeout(function () {
        l2('.menu-list.additional').addClass('active');
      }, 470 + mlPrimaryEndAt);

      mlSocialTimer = setTimeout(function () {
        l2('.menu-social').addClass('active');
      }, 690 + mlPrimaryEndAt + mlAdditionalEndAt);
    }
  };

  var menuSecondaryAnimation = function (element) {
    var menuSecondaryList = ['becoming-a-student', 'current-students', 'academic-department'];

    var tag = l2(element).attr('data-tag');
    var dataMenu = menuSecondaryList.indexOf(tag) + 1;

    lMlPrimaryLinks.removeClass('active');
    l2('.menu-secondary > div').removeClass('active');

    l2(element).addClass('active');
    l2('.menu-secondary [data-menu="' + dataMenu + '"]').addClass('active');
  };



  lMlPrimaryLinks.on('click', function (event) {
    var element = event.target;

    requestAnimationFrame(function () {
      menuSecondaryAnimation(element);
    });
  });

  lMlPrimaryLinks.on('mouseenter', function (event) {
    var element = event.target;

    menuMainItemTimer = setTimeout(function () {
      requestAnimationFrame(function () {
        menuSecondaryAnimation(element);
      });
    }, 300);
  });

  lMlPrimary.on('mouseleave', function (event) {
    clearTimeout(menuMainItemTimer);
  });

  l2('.nl-menu').on('click', function () {
    requestAnimationFrame(menuMainAnimation);
  });

  l2(document).on('scroll', function () {
    if (window.scrollY > 0) {
      l2('header').addClass('shadow');
    } else {
      l2('header').removeClass('shadow');
    }
  });
})();