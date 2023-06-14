<div>
    {{-- Be like water. --}}
    <footer id="footer" class="shock-footer scheme-1 primary">
        <div class="footer-content focus-trigger">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="footer-item">
                            <!-- Brand -->
                            <a href="/" class="footer-brand floating-item">
                                <!-- <div class="site-title">Site Title</div> -->
                                <img src="{{ asset('/img/identitas/'.$identitas->logo) }}" alt="Shock Theme" class="logo" />
                                <span class="logo-after-text">SHOCK</span>
                            </a>
                            <!-- Text -->
                            <div class="footer-text">
                                <p>{{ $identitas->about }}</p>
                            </div>
                        </div>
                        <div class="footer-item">
                            <h6 class="title">Contact Us</h6>
                            <!-- Links list -->
                            <ul class="nav-list list-unstyled">
                                <li class="nav-item">
                                    <a href="tel:{{ $identitas->phone }}" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/call-sharp.svg') }}" alt="Icon name"
                                            data-shock-icon="32" />
                                        <span class="text">{{ $identitas->phone }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="mailto:{{ $identitas->email }}" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/mail-sharp.svg') }}" alt="Icon name"
                                            data-shock-icon="32" />
                                        <span class="text">{{ $identitas->email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="footer-item">
                            <h6 class="title">Quick Links</h6>
                            <!-- Links list -->
                            <ul class="nav-list list-unstyled">
                                <li class="nav-item">
                                    <a href="#your-link" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/chevron-forward-sharp.svg') }}"
                                            alt="Icon name" data-shock-icon="32" />
                                        <span class="text">Who We Are</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#your-link" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/chevron-forward-sharp.svg') }}"
                                            alt="Icon name" data-shock-icon="32" />
                                        <span class="text">Social Projects</span>
                                        <span class="badge flex ms-1 primary primary-hover">
                                            <span class="badge-text white white-hover">New</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#your-link" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/chevron-forward-sharp.svg') }}"
                                            alt="Icon name" data-shock-icon="32" />
                                        <span class="text">Our Services</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#your-link" class="nav-link has-icon">
                                        <img class="image-icon" src="{{ asset('public_assets/assets/svg/chevron-forward-sharp.svg') }}"
                                            alt="Icon name" data-shock-icon="32" />
                                        <span class="text">Privacy Police</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-item">
                            <!-- Button -->
                            <a href="#your-link" class="button outline gray primary-hover">
                                <span class="hover-rotate">
                                    <span class="button-text white white-hover">Get in Touch</span>
                                    <i class="fa-solid fa-arrow-right button-icon white white-hover"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="footer-item">
                            <h6 class="title">Popular Searches</h6>
                            <!-- Tag Cloud -->
                            <div class="tag-cloud">
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Environment</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover floating-item-smooth">
                                        <span class="badge-text gray white-hover">Events</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Technology</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Web</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Mobile</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Design</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Branding</span>
                                    </span>
                                </a>
                                <a href="#your-link" class="link">
                                    <span class="badge outline gray-50 primary-hover">
                                        <span class="badge-text gray white-hover">Development</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="footer-item">
                            <h6 class="title">Follow Us</h6>
                            <!-- Icon list -->
                            <div class="list-wrapper">
                                <ul class="icon-h-list">
                                    <li class="ms-0 item">
                                        <a href="{{ $identitas->faceook }}" class="link gray primary-hover hover-rotate"><i
                                                class="icon fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ $identitas->twitter }}" class="link gray primary-hover hover-rotate"><i
                                                class="icon fab fa-twitter"></i></a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ $identitas->instagram }}" class="link gray primary-hover hover-rotate"><i
                                                class="fa-brands fa-instagram"></i>
                                    </li>
                                    <li class="item">
                                        <a href="{{ $identitas->tiktok }}" class="link gray primary-hover hover-rotate"><i
                                                class="fa-brands fa-tiktok"></i>
                                    </li>
                                    <li class="item">
                                        <a href="{{ $identitas->youtube }}" class="link gray primary-hover hover-rotate"><i
                                                class="fa-brands fa-youtube"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <div class="text">© 2023 - All rights reserved. The <a href="https://codings.dev?redirect=shock-html"
                    class="link gray primary-hover"><u>Shock Theme</u></a> is developed and maintained by <a
                    href="https://codings.dev?ref=shock-html" class="link gray primary-hover"><u>Codings Group</u></a>.
            </div>
        </div>
    </footer>
</div>
