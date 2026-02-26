<section id="contact" class="contact-section">
    <div class="container contact-container">
        <header class="section-header">
            <h2 class="section-title">Skontaktuj się z Nami</h2>
            <p class="section-subtitle">Masz pytania? Chętnie odpowiemy!</p>
        </header>

        <div class="contact-wrapper">
            <!-- Contact Info Column -->
            <div class="contact-info-column">
                <p class="contact-intro">
                    Jesteśmy do Twojej dyspozycji. Skontaktuj się z nami, aby dowiedzieć się więcej
                    o naszych produktach.
                </p>

                <div class="contact-details">
                    <!-- Address -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                            </svg>
                        </div>
                        <div class="contact-detail-content">
                            <h4>Adres</h4>
                            <p>Chojnice, Pomorskie, Polska</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            </svg>
                        </div>
                        <div class="contact-detail-content">
                            <h4>Email</h4>
                            <p><a href="mailto:kontakt@gchemp.pl">kontakt@gchemp.pl</a></p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="contact-detail-content">
                            <h4>Telefon</h4>
                            <p><a href="tel:+48123456789">+48 123 456 789</a></p>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="contact-detail-item">
                        <div class="contact-detail-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <polyline points="12 6 12 12 16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            </svg>
                        </div>
                        <div class="contact-detail-content">
                            <h4>Godziny Pracy</h4>
                            <p>Pon-Pt: 9:00 - 17:00</p>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2357.8!2d17.5575!3d53.6975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTPCsDQxJzUxLjAiTiAxN8KwMzMnMjcuMCJF!5e0!3m2!1spl!2spl!4v1234567890" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa lokalizacji GCHemp w Chojnicach" aria-label="Mapa Google pokazująca lokalizację GCHemp w Chojnicach">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form Column -->
            <div class="contact-form-column">
                <h3 class="contact-form-title">Wyślij Wiadomość</h3>
                <p class="contact-form-subtitle">Wypełnij formularz, a my odpowiemy najszybciej jak to możliwe.</p>

                <!-- Success/Error Message -->
                <div id="formMessage" class="form-message" role="alert" aria-live="polite">
                    <svg class="form-message-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <polyline points="22 4 12 14.01 9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    </svg>
                    <span id="formMessageText"></span>
                </div>

                <form id="contactForm" class="contact-form" method="POST" action="mailer.php" novalidate="">
                    <!-- Name and Email Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Imię i Nazwisko <span class="required">*</span>
                            </label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Jan Kowalski" required="" aria-required="true" aria-describedby="nameError">
                            <span id="nameError" class="form-error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="jan@example.com" required="" aria-required="true" aria-describedby="emailError">
                            <span id="emailError" class="form-error-message"></span>
                        </div>
                    </div>

                    <!-- Phone and Subject Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Telefon
                            </label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="+48 123 456 789" aria-describedby="phoneError">
                            <span id="phoneError" class="form-error-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">
                                Temat <span class="required">*</span>
                            </label>
                            <input type="text" id="subject" name="subject" class="form-input" placeholder="Pytanie o produkt" required="" aria-required="true" aria-describedby="subjectError">
                            <span id="subjectError" class="form-error-message"></span>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="form-group">
                        <label for="message" class="form-label">
                            Wiadomość <span class="required">*</span>
                        </label>
                        <textarea id="message" name="message" class="form-textarea" placeholder="Twoja wiadomość..." required="" aria-required="true" aria-describedby="messageError"></textarea>
                        <span id="messageError" class="form-error-message"></span>
                    </div>

                    <!-- Privacy Policy Checkbox -->
                    <div class="form-checkbox-group">
                        <input type="checkbox" id="privacy" name="privacy" class="form-checkbox" required="" aria-required="true" aria-describedby="privacyError">
                        <label for="privacy" class="form-checkbox-label">
                            Akceptuję <a href="/polityka-prywatnosci" target="_blank">politykę prywatności</a>
                            i wyrażam zgodę na przetwarzanie moich danych osobowych. <span class="required">*</span>
                        </label>
                    </div>
                    <span id="privacyError" class="form-error-message"></span>

                    <!-- reCAPTCHA -->
                    <div class="recaptcha-container">
                        <div class="g-recaptcha" data-sitekey="6LdSsmIsAAAAACDBCkPci1FSHEU19QrzDnfNIb8Q"><div style="width: 304px; height: 78px;"><div><iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-9mv8z5mrjbc2" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LdSsmIsAAAAACDBCkPci1FSHEU19QrzDnfNIb8Q&amp;co=aHR0cHM6Ly9nY2hlbXAucGw6NDQz&amp;hl=pl&amp;v=P8cyHPrXODVy7ASorEhMUv3P&amp;size=normal&amp;anchor-ms=20000&amp;execute-ms=30000&amp;cb=r6557ldxi969"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></div>
                    </div>
                    <span id="recaptchaError" class="form-error-message"></span>

                    <!-- Submit Button -->
                    <button type="submit" class="form-submit">
                        <span class="submit-text">Wyślij Wiadomość</span>
                        <svg class="form-submit-icon submit-text" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="22" y1="2" x2="11" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polygon>
                        </svg>
                        <div class="spinner"></div>
                    </button>
                    <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position: absolute; left: -9999px; width: 1px; height: 1px;"></form>
            </div>
        </div>
    </div>
</section>
