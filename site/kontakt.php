<?php 
   $page  = 'kontakt';
   $title = 'Kontakt - Qamitech Piaseczno | Obsługa IT i strony www';
   $description = 'Skontaktuj się z Qamitech. Biuro w Starej Iwicznej k. Piaseczna. Obsługujemy firmy z Piaseczna, Warszawy, Konstancina i okolic. Tel: 501 784 882';
   $h1 = 'Kontakt';
   $hero_cta = ['Napisz wiadomość', '#formContact'];
   ?>
<!-- PAGE HEADER -->
<?php require_once( 'include/header.php' ); ?>

<?php include( 'part/hero-page.php' ); ?>

<section class="section section-content py-medium bg-dark-1" data-arts-theme-text="light">
   <div class="container">
      <div class="section-content__content content js-arts-split-text arts-split-text pb-small"
         data-arts-os-animation="true" data-arts-os-animation-name="animateText"
         data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
         data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
         <h3 class="h1">Jak nas znaleźć</h3>
      </div>
      <div class="row contact-icons">
         <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex">
               <div class="col-6">
                  <div class="section-content__content content" data-arts-os-animation="true"
                     data-arts-os-animation-name="animateJump">
                     <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="110" height="110" rx="20" fill="#1F1F1F" />
                        <path d="M55 75C44 75 35 66 35 55C35 44 44 35 55 35C66 35 75 44 75 55C75 66 66 75 55 75Z"
                           fill="#4C4C4C" />
                        <path d="M55 75C44 75 35 66 35 55C35 44 44 35 55 35C66 35 75 44 75 55C75 66 66 75 55 75Z"
                           stroke="white" stroke-width="2" />
                        <path
                           d="M64.8 57.0002H55C53.8 57.0002 53 56.2002 53 55.0002V45.2002C53 44.0002 53.8 43.2002 55 43.2002C56.2 43.2002 57 44.0002 57 45.2002V53.0002H64.8C66 53.0002 66.8 53.8002 66.8 55.0002C66.8 56.2002 66 57.0002 64.8 57.0002Z"
                           stroke="white" stroke-width="2" />
                     </svg>
                  </div>
               </div>
               <div class="col-6">
                  <div class="section-content__content content js-arts-split-text arts-split-text"
                     data-arts-os-animation="true" data-arts-os-animation-name="animateText"
                     data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
                     data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
                     <h3>Email</h3>
                     <small>kontakt@qamitech.pl</small>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex">
               <div class="col-6">
                  <div class="section-content__content content" data-arts-os-animation="true"
                     data-arts-os-animation-name="animateJump">
                     <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="110" height="110" rx="20" fill="#1F1F1F" />
                        <path
                           d="M74.966 72.2405C74.7846 70.598 73.8779 69.3206 72.427 68.4082L65.8982 64.5759C63.9033 63.4809 61.3643 63.8459 59.7321 65.3058L59.0067 66.0358C55.561 63.8459 52.1152 60.3786 49.9389 56.9113L50.6644 56.1813C52.2966 54.7214 52.6593 52.1665 51.5711 50.1591L47.7627 43.5894C47.0373 42.1295 45.5864 41.2171 43.9542 41.0346C42.5034 40.8521 40.8712 41.3996 39.783 42.4945L37.6068 44.6844C35.0678 47.2393 34.3424 50.7066 35.6119 53.8089C37.4254 58.0062 40.5085 64.2109 46.1305 69.8681C51.7525 75.5253 57.9186 78.8101 62.0898 80.4525C63.1779 80.8175 64.266 81 65.1728 81C67.3491 81 69.5253 80.0875 71.1575 78.4451L73.3338 76.2552C74.6033 75.3428 75.1474 73.7004 74.966 72.2405Z"
                           fill="#5B5B5B" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M62.9806 53.0185C61.9898 52.0277 60.4547 51.6605 59.3393 52.0323C58.408 52.3427 57.4013 51.8394 57.0909 50.9081C56.7805 49.9767 57.2838 48.9701 58.2151 48.6596C60.74 47.818 63.654 48.6642 65.4944 50.5047C67.3349 52.3451 68.1811 55.2592 67.3395 57.784C67.029 58.7153 66.0224 59.2186 65.091 58.9082C64.1597 58.5978 63.6564 57.5911 63.9668 56.6598C64.3386 55.5444 63.9714 54.0093 62.9806 53.0185Z"
                           fill="#5B5B5B" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M67.6203 48.3805C64.343 45.1033 59.5795 43.9501 55.3112 45.0992C54.3335 45.3625 53.3275 44.7833 53.0643 43.8056C52.8011 42.8279 53.3803 41.8219 54.3579 41.5587C59.8532 40.0792 65.9798 41.5547 70.213 45.7878C74.4461 50.021 75.9216 56.1476 74.4421 61.6428C74.1789 62.6205 73.1729 63.1997 72.1952 62.9365C71.2175 62.6733 70.6383 61.6673 70.9015 60.6896C72.0507 56.4213 70.8975 51.6578 67.6203 48.3805Z"
                           fill="#5B5B5B" />
                        <path
                           d="M74.966 72.2405C74.7846 70.598 73.8779 69.3206 72.427 68.4082L65.8982 64.5759C63.9033 63.4809 61.3643 63.8459 59.7321 65.3058L59.0067 66.0358C55.561 63.8459 52.1152 60.3786 49.9389 56.9113L50.6644 56.1813C52.2966 54.7214 52.6593 52.1665 51.5711 50.1591L47.7627 43.5894C47.0373 42.1295 45.5864 41.2171 43.9542 41.0346C42.5034 40.8521 40.8712 41.3996 39.783 42.4945L37.6068 44.6844C35.0678 47.2393 34.3424 50.7066 35.6119 53.8089C37.4254 58.0062 40.5085 64.2109 46.1305 69.8681C51.7525 75.5253 57.9186 78.8101 62.0898 80.4525C63.1779 80.8175 64.266 81 65.1728 81C67.3491 81 69.5253 80.0875 71.1575 78.4451L73.3338 76.2552C74.6033 75.3428 75.1474 73.7004 74.966 72.2405Z"
                           stroke="white" stroke-width="2" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M62.9806 53.0185C61.9898 52.0277 60.4547 51.6605 59.3393 52.0323C58.408 52.3427 57.4013 51.8394 57.0909 50.9081C56.7805 49.9767 57.2838 48.9701 58.2151 48.6596C60.74 47.818 63.654 48.6642 65.4944 50.5047C67.3349 52.3451 68.1811 55.2592 67.3395 57.784C67.029 58.7153 66.0224 59.2186 65.091 58.9082C64.1597 58.5978 63.6564 57.5911 63.9668 56.6598C64.3386 55.5444 63.9714 54.0093 62.9806 53.0185Z"
                           stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                           stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M67.6203 48.3805C64.343 45.1033 59.5795 43.9501 55.3112 45.0992C54.3335 45.3625 53.3275 44.7833 53.0643 43.8056C52.8011 42.8279 53.3803 41.8219 54.3579 41.5587C59.8532 40.0792 65.9798 41.5547 70.213 45.7878C74.4461 50.021 75.9216 56.1476 74.4421 61.6428C74.1789 62.6205 73.1729 63.1997 72.1952 62.9365C71.2175 62.6733 70.6383 61.6673 70.9015 60.6896C72.0507 56.4213 70.8975 51.6578 67.6203 48.3805Z"
                           stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                           stroke-linejoin="round" />
                     </svg>
                  </div>
               </div>
               <div class="col-6">
                  <div class="section-content__content content js-arts-split-text arts-split-text"
                     data-arts-os-animation="true" data-arts-os-animation-name="animateText"
                     data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
                     data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
                     <h3>Telefon</h3>
                     <small>
                        501 784 882
                     </small>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex">
               <div class="col-6">
                  <div class="section-content__content content" data-arts-os-animation="true"
                     data-arts-os-animation-name="animateJump">
                     <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="110" height="110" rx="20" fill="#1F1F1F" />
                        <path
                           d="M68.7735 40.2601C64.5483 36.4663 58.9889 34.4578 53.2071 35.1273C44.312 35.7968 36.9736 42.2685 35.417 50.5256C34.3051 55.8815 35.417 61.2374 38.7526 65.7006L50.0938 81.5452C50.9833 83.1074 52.9847 84 54.9861 84C56.9875 84 58.9889 83.1073 60.1008 81.322L71.442 65.4775C73.8881 62.13 75 58.3363 75 54.3193C75 48.9634 72.7762 43.8307 68.7735 40.2601Z"
                           fill="#4C4C4C" />
                        <path
                           d="M68.7735 40.2601C64.5483 36.4663 58.9889 34.4578 53.2071 35.1273C44.312 35.7968 36.9736 42.2685 35.417 50.5256C34.3051 55.8815 35.417 61.2374 38.7526 65.7006L50.0938 81.5452C50.9833 83.1074 52.9847 84 54.9861 84C56.9875 84 58.9889 83.1073 60.1008 81.322L71.442 65.4775C73.8881 62.13 75 58.3363 75 54.3193C75 48.9634 72.7762 43.8307 68.7735 40.2601Z"
                           stroke="white" stroke-width="2" />
                        <path
                           d="M55 62C59.4183 62 63 58.6421 63 54.5C63 50.3579 59.4183 47 55 47C50.5817 47 47 50.3579 47 54.5C47 58.6421 50.5817 62 55 62Z"
                           stroke="white" stroke-width="2" />
                     </svg>
                  </div>
               </div>
               <div class="col-6">
                  <section class="section section-content">
                     <div class="section-content__content content js-arts-split-text arts-split-text"
                        data-arts-os-animation="true" data-arts-os-animation-name="animateText"
                        data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}"
                        data-arts-split-text="lines" data-arts-split-text-set="lines"
                        data-arts-split-text-overflow-wrap="lines">
                        <h3>Adres</h3>
                        <small>
                           ul. Cicha 3, <br />
                           05-500 Stara Iwiczna
                        </small>
                     </div>
                  </section>
               </div>
            </div>
         </div>
         <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex">
               <div class="col-6">
                  <div class="section-content__content content" data-arts-os-animation="true"
                     data-arts-os-animation-name="animateJump">
                     <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="110" height="110" rx="20" fill="#1F1F1F" />
                        <path d="M55 75C44 75 35 66 35 55C35 44 44 35 55 35C66 35 75 44 75 55C75 66 66 75 55 75Z"
                           fill="#4C4C4C" />
                        <path d="M55 75C44 75 35 66 35 55C35 44 44 35 55 35C66 35 75 44 75 55C75 66 66 75 55 75Z"
                           stroke="white" stroke-width="2" />
                        <path
                           d="M64.8 57.0002H55C53.8 57.0002 53 56.2002 53 55.0002V45.2002C53 44.0002 53.8 43.2002 55 43.2002C56.2 43.2002 57 44.0002 57 45.2002V53.0002H64.8C66 53.0002 66.8 53.8002 66.8 55.0002C66.8 56.2002 66 57.0002 64.8 57.0002Z"
                           stroke="white" stroke-width="2" />
                     </svg>
                  </div>
               </div>
               <div class="col-6">
                  <div class="section-content__content content js-arts-split-text arts-split-text"
                     data-arts-os-animation="true" data-arts-os-animation-name="animateText"
                     data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
                     data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
                     <h3>Godziny</h3>
                     <small>Pn-Pt 09:00 - 17:00</small>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="section section-content">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1268951.1085011633!2d17.939791701658365!3d51.59719011650259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47192fe18e4b3b2b%3A0x8522dfce97b81fff!2sQamiTech%20-%20Obs%C5%82uga%20Informatyczna%20dla%20Firm!5e0!3m2!1spl!2spl!4v1673341319078!5m2!1spl!2spl" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<style>
  iframe {
   filter: grayscale(100%);
  }
</style>
<section class="section section-content pt-medium">
   <div class="container">
      <div class="row">
         <div class="offset-md-6 col-md-6">
            <div class="section-content__content content js-arts-split-text arts-split-text pb-medium"
               data-arts-os-animation="true" data-arts-os-animation-name="animateText"
               data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
               data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
               <h2 class="h1">
                  Skonta<span class="underline-text">ktuj się z nami.</span>
               </h2>
               <p>
               Zapraszamy do kontaktu poprzez formularz kontaktowy lub bezpośrednio: telefonicznie lub mailowo.
               </p>
            </div>
         </div>
      </div>
      <div class="section contact-us-wrap element-5" data-arts-theme-text="light">
         <div class="section-content__content content js-arts-split-text arts-split-text" data-arts-os-animation="true"
            data-arts-os-animation-name="animateText"
            data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" data-arts-split-text="lines"
            data-arts-split-text-set="lines" data-arts-split-text-overflow-wrap="lines">
            <h2 class="h3 col-md-6">
               Formularz kontaktowy
            </h2>
         </div>
         <div class="section-content__content content mt-5" data-arts-os-animation="true"
            data-arts-os-animation-name="animateJump"
            data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}">
            <div class="main-form">
               <form class="form form-contact form-dark js-ajax-form" id="formContact" action="forms/form-contact.php"
                  method="POST" data-message-success="Dziękujemy za wiadomość! Wkrótce otrzymasz odpowiedź."
                  data-message-error="Coś poszło nie tak :( Napisz bezpośrednio na <a href='mailto:kontakt@qamitech.pl'>kontakt@qamitech.pl</a> lub zadzwoń: 501 784 882">
                  <div class="row">
                     <div class="col-md-6 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">Imię i nazwisko</span>
                           <input class="input-float__input" type="text" name="visitor_name" required="required" autocomplete="name"
                              data-msg="Wypełnij to pole" />
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-md-6 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">Telefon</span>
                           <input class="input-float__input" type="tel" name="visitor_phone" required="required" autocomplete="tel"
                              data-msg="Wypełnij to pole" />
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-md-6 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">E-mail</span>
                           <input class="input-float__input" type="email" name="visitor_email" required="required" autocomplete="email"
                              data-msg="Podaj poprawny adres e-mail" />
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-md-6 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">Nazwa firmy (opcjonalnie)</span>
                           <input class="input-float__input" type="text" name="visitor_company" autocomplete="organization" />
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-12 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">Temat kontaktu</span>
                           <select name="visitor_topic">
                              <option value="Outsourcing IT / stała obsługa informatyczna">Outsourcing IT / stała obsługa informatyczna</option>
                              <option value="Serwis komputerowy">Serwis komputerowy</option>
                              <option value="Sieci LAN / Wi-Fi">Sieci LAN / Wi-Fi</option>
                              <option value="Strona internetowa lub sklep">Strona internetowa lub sklep</option>
                              <option value="Kampania Google Ads">Kampania Google Ads</option>
                              <option value="Pozycjonowanie SEO / AEO / GEO">Pozycjonowanie SEO / AEO / GEO</option>
                              <option value="Szkolenie AI / marketing / IT">Szkolenie AI / marketing / IT</option>
                              <option value="Branding">Branding</option>
                              <option value="Pomoc informatyczna w domu">Pomoc informatyczna w domu</option>
                              <option value="Inny temat">Inny temat</option>
                           </select>
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-12 mb-5">
                        <label class="input-float js-input-float">
                           <span class="input-label">Wiadomość</span>
                           <textarea class="input-float__input input-float__input_textarea" name="visitor_msg" rows="5" required="required"
                              data-msg="Opisz krótko, w czym możemy pomóc"></textarea>
                           <span class="form__error"></span>
                        </label>
                     </div>
                     <div class="col-12 mb-5">
                        <label class="input-float js-input-float">
                           <input class="input-float__input" id="check" type="checkbox" name="visitor_consent" value="1" required="required"
                              data-msg="Zaznacz zgodę" />
                           <label for="check" class="check-label">
                              Oświadczam, że zapoznałem/am się z <a href="regulamin.php">regulaminem strony</a> oraz <a href="polityka-prywatnosci.php">polityką prywatności RODO</a>.
                           </label>
                           <span class="form__error"></span>
                        </label>
                     </div>

                  </div>

                  <div class="text-center text-md-end mt-5 mt-md-0">
                     <button class="button btn-dark"><span class="button__label button__label-normal"><span
                              class="button__title">Wyślij wiadomość</span></span></span><span
                           class="button__label button__label-hover"><span class="button__title">Wyślij
                              wiadomość</span></span></span>
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="section section-content py-xlarge mt-minus-xlarge mb-minus-xlarge bg-dark-1">
</section>

</main>
<!-- PAGE FOOTER -->
<?php require_once( 'include/footer.php' ); ?>