<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        {{-- <div class="subscribe-area"> --}}
        {{-- <div class="row align-items-center"> --}}
        {{-- <div class="col-lg-5 col-md-12"> --}}
        {{-- <div class="subscribe-content"> --}}
        {{-- <h2>Join Our Newsletter</h2> --}}
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div class="col-lg-7 col-md-12"> --}}
        {{-- <div class="subscribe-form"> --}}
        {{-- <form class="newsletter-form" data-toggle="validator"> --}}
        {{-- <input type="email" class="input-newsletter" placeholder="Enter your email address" name="EMAIL" required autocomplete="off"> --}}

        {{-- <button type="submit">Subscribe Now <i class="flaticon-right-chevron"></i></button> --}}
        {{-- <div id="validator-newsletter" class="form-result"></div> --}}
        {{-- </form> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="#"><img src="{{ asset('logo-footer.png') }}" alt="image" width="142" height="47"></a>

                        <p>
                            Born and developed in Bangladesh, our company takes up the challenge of modernizing
                            insurance, making it easier for you and listening to you attentively.
                        </p>
                    </div>

                    <ul class="social">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Quick Links</h3>

                    <ul class="footer-quick-links">
                        <li><a href="">Home</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="">About Us</a></li>
                        {{-- <li><a href="">Latest News</a></li> --}}
                        {{-- <li><a href="">Insurance</a></li> --}}
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        {{-- <li><a href="">Our Events</a></li> --}}
                        <li><a href="{{ route('terms-and-condition') }}">Terms & Conditions</a></li>
                        {{-- <li><a href="">Our Packages</a></li> --}}
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-sm-3 offset-md-3">
                <div class="single-footer-widget">
                    <h3>Contact Info</h3>

                    <ul class="footer-contact-info">
                        <li><span>Address:</span> 2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh
                        </li>
                        <li><span>Email Us:</span> <a href="mailto:info@instasure.xyz">info@instasure.xyz</a></li>
                        <li><span>Call Us:</span> <a href="tel:+0880960-6252525">+880960-6252525</a></li>
                        {{-- <li><span>Fax:</span> <a href="#">+1-212-9876543</a></li> --}}
                        {{-- <li><a href="https://goo.gl/maps/1xz4L8TGSdkBhVmb7" target="_blank">View Location on GoogleMap</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <p><i class="far fa-copyright"></i> {{ date('Y') }} Instasure.</p>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6">
                    <ul>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-and-condition') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
