<section class="section section-content contact-us">
    <div class="container">
        <div class="contact-us-wrap element-3" data-arts-theme-text="light">
            <div class="section-content__content content arts-split-text">
                <h2 class="h3">
                    Masz pytania? <br />Skontaktuj się z nami!
                </h2>
            </div>
            <div class="section-content__content content mt-5">
                <div class="main-form">
                    <form class="form form-contact form-dark js-ajax-form" action="forms/form-contact.php" method="POST"
                        data-message-success="Dziękujemy za wiadomość! Wkrótce otrzymasz odpowiedź."
                        data-message-error="Coś poszło nie tak :( Napisz bezpośrednio na <a href='hello@qamitech.pl'>hello@qamitech.pl</a>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="input-float js-input-float">
                                    <input class="input-float__input" type="text" name="visitor_name"
                                        required="required" data-msg="Wpisz imię" />
                                    <span class="input-float__label">Imię</span>
                                    <span class="form__error"></span>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="input-float js-input-float">
                                    <input class="input-float__input" type="text" name="visitor_surname"
                                        required="required" data-msg="Wpisz nazwisko" />
                                    <span class="input-float__label">Nazwisko</span>
                                    <span class="form__error"></span>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="input-float js-input-float">
                                    <input class="input-float__input" type="email" name="visitor_email"
                                        required="required" data-msg="Wpisz adres e-mail" />
                                    <span class="input-float__label">E-mail</span>
                                    <span class="form__error"></span>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="input-float js-input-float">
                                    <input class="input-float__input" type="text" name="visitor_phone"
                                        required="required" data-msg="Wpisz numer telefonu" />
                                    <span class="input-float__label">Telefon</span>
                                    <span class="form__error"></span>
                                </label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="input-float js-input-float">
                                    <textarea class="input-float__input input-float__input_textarea" name="visitor_msg"
                                        rows="4"></textarea>
                                    <span class="input-float__label">Wiadomość</span>
                                    <span class="form__error"></span>
                                </label>
                            </div>
                        </div>

                        <label for="check-form">
                        <input type="checkbox" id="check-form">
                            Oświadczam, że zapoznałem/am się z regulaminem strony oraz polityką prywatności RODO.
                        </label>
                        <div class="text-center text-md-end mt-5 mt-md-0">
                            <input type="submit" class="button btn-light" value="Wyslij wiadomość">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>