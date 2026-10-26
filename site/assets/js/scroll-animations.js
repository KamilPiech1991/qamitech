/*
 * Animacje przy przewijaniu (GSAP + ScrollTrigger z vendor.js motywu).
 *
 * Treść jest w HTML widoczna od razu — skrypt ukrywa tylko elementy, które w chwili startu
 * leżą jeszcze pod ekranem, więc nic, co użytkownik już widzi, nie znika ani nie „mruga”.
 * Przy włączonym „ogranicz ruch” w systemie animacji nie ma.
 */
(function () {
  'use strict';

  function init() {
    var gsap = window.gsap;
    var ScrollTrigger = window.ScrollTrigger;
    if (!gsap || !ScrollTrigger) return;
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    gsap.registerPlugin(ScrollTrigger);

    var used = [];

    function isUsed(el) {
      for (var i = 0; i < used.length; i++) {
        if (used[i] === el || used[i].contains(el) || el.contains(used[i])) return true;
      }
      return false;
    }

    // Elementy pasujące do selektora, jeszcze nieanimowane i leżące poniżej ekranu.
    function pick(selector, root) {
      var limit = window.innerHeight;
      var list = [];
      (root || document).querySelectorAll(selector).forEach(function (el) {
        if (isUsed(el) || el.closest('.header, .swiper, .menu-overlay')) return;
        var rect = el.getBoundingClientRect();
        if (rect.height === 0 || rect.top < limit) return;
        list.push(el);
      });
      used = used.concat(list);
      return list;
    }

    // Wjazd grupami: elementy, które pojawiają się razem, wjeżdżają po kolei.
    function batch(elements, from, stagger, start) {
      if (!elements.length) return;
      gsap.set(elements, from);
      ScrollTrigger.batch(elements, {
        start: start || 'top 88%',
        once: true,
        onEnter: function (group) {
          gsap.to(group, {
            opacity: 1, x: 0, y: 0, scale: 1,
            duration: 0.9,
            ease: 'power3.out',
            stagger: stagger,
            overwrite: true,
            clearProps: 'transform,opacity'
          });
        }
      });
    }

    // Liczniki („128 zadowolonych klientów” itd.) odliczają od zera.
    pick('.qamitech-number span.h1').forEach(function (el) {
      var target = parseInt(el.textContent.replace(/\D/g, ''), 10);
      if (!target) return;
      var counter = { value: 0 };
      el.textContent = '0';
      gsap.to(counter, {
        value: target,
        duration: 2,
        ease: 'power2.out',
        scrollTrigger: { trigger: el, start: 'top 90%', once: true },
        onUpdate: function () { el.textContent = Math.round(counter.value); }
      });
    });

    // Karty i kafelki: wjazd od dołu z lekkim powiększeniem.
    batch(pick([
      '.figure-project',
      '.high-level-card',
      '.contact-us-wrap',
      '.rank-math-list-item',
      '.section-content .row.g-3 > [class*="col-"]',
      '.q-tabs',
      '.case-frame',
      '.case-card',
      '.case-cta__box'
    ].join(',')), { opacity: 0, y: 60, scale: 0.96 }, 0.12);

    // Drobne elementy podstron realizacji: fakty i „chipsy” technologii wskakują kolejno.
    batch(pick('.case-facts__item, .case-chips li, .case-points li'), { opacity: 0, y: 16 }, 0.05);

    // Slider usług jako całość (pojedynczych slajdów nie ruszamy — przesuwa je Swiper).
    batch(pick('.js-slider-projects__slider'), { opacity: 0, y: 80 }, 0);

    // Nagłówki sekcji.
    batch(pick('main h2, main h3, main h4, main h5'), { opacity: 0, y: 40 }, 0.1);

    // Akapity i listy w treści.
    batch(pick('main .content p, main .content li, main .content blockquote'), { opacity: 0, y: 24 }, 0.06);

    // Przyciski.
    batch(pick('main .section-content__wrapper-button, main .button'), { opacity: 0, y: 20, scale: 0.92 }, 0.1);

    // Stopka: logo, potem kolumny z linkami. Start, gdy tylko element wejdzie na ekran —
    // dół stopki nigdy nie dojedzie wyżej niż do krawędzi ekranu.
    var footer = document.getElementById('page-footer');
    if (footer) {
      batch(pick('.widget-logo', footer), { opacity: 0, x: -40 }, 0, 'top bottom');
      batch(pick('.widget', footer), { opacity: 0, y: 30 }, 0.08, 'top bottom');
    }

    // Obrazki doczytują się leniwie i zmieniają wysokość strony — przelicz pozycje.
    var refreshTimer;
    function refreshSoon() {
      clearTimeout(refreshTimer);
      refreshTimer = setTimeout(function () { ScrollTrigger.refresh(); }, 200);
    }
    window.addEventListener('load', refreshSoon);
    document.querySelectorAll('img[loading="lazy"]').forEach(function (img) {
      if (!img.complete) img.addEventListener('load', refreshSoon, { once: true });
    });
  }

  if (window.__themeLateInit) init();
  else document.addEventListener('theme:loaded', init);
})();
