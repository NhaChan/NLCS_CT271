<footer class=" text-white" style="background-color: #2b5875;">
        <div class=" p-3 " height="500px">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-6 col-lg-6 col-xl-4">
                    <p>JOINT STOCK COMPANY LAPTOPSTORE</p>
                    <p><i class="fa fa-address-book"></i> Address: Ninh Kieu district - Can Tho city</p>
                    <p><i class="fa fa-phone "></i> Phone: 0123456789</p>
                    <p><i class="fa fa-envelope "></i> Email: chanb2014731@student.ctu.edu.vn</p>
                    <p><i class="fa fa-link "></i> Http://laptopstore.com.vn</p>
                    <p><i class="fa fa-code "></i> Business code: #000</p>
                </div>
                <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                    <p>Home</p>
                    <p>Introduce</p>
                    <p>Field of activity</p>
                    <p>News &amp;&amp; Event</p>
                </div>
                <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                    <p>Photo library</p>
                    <p>Video library</p>
                    <p>Recruit</p>
                    <p>Contact</p>
                    <p>Sitemap</p>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2">
                    <p>Connect With Us</p>
                    <i class="fa-brands fa-facebook"></i> <a style="text-decoration: none;" href="">Facebook</a><br>
                    <i class="fa-brands fa-instagram"></i> <a style="text-decoration: none;" href="">Intagram</a> <br>
                    <i class="fa-brands fa-github"></i> <a style="text-decoration: none;" href="">GitHub</a> <br>
                    <i class="fa-brands fa-square-twitter"></i> <a style="text-decoration: none;" href="">Twitter</a>
                    <br>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="">Copyright @ 2023</div>
                    <div class=""><i class="ti-rss"></i> The user is accessing: 100</div>
                    <div class=""><i class="ti-receipt"></i> Total active users: 1.000.000</div>
                </div>
                <div class="col-md-6">
                    <h5>NHẬP THÔNG TIN KHUYẾN MÃI</h5>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text bg-danger text-white" id="basic-addon2">Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        // nav: true
                    },
                    600: {
                        items: 3,
                        // nav: false
                    },
                    1000: {
                        items: 5,
                        // nav: true,
                        loop: false,
                        margin: 20
                    }
                },
                
                navText: ['<i class="fs-3 text-body-tertiary fa-solid fa-chevron-left"></i>', '<i class="fs-3 text-body-tertiary fa-solid fa-chevron-right"></i>']
            })
        })
    </script>
</body>

</html>