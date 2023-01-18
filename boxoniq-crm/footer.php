<footer class="footer spad">
        <div class="container">

<div class="row">
    <div class="col-md-12">
        <div><h3 class="footer-heading">Brands</h3><ul class="brand-names"></ul></div>
    </div>
</div>


<br>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="footer-heading">About CityIndia</h3>
                    <p class="text-justify">CityIndia stared in Ranchi, is now India’s one of the leading low price online supermarket in the ecommerce space. The company uses its in-house technology platform to manage a network of over 5,000 partner stores that enable the company to run a fast and lean supply chain – from manufacturers straight to customers in 27+ cities namely Agra, Ahmedabad, Aligarh, Allahabad, Asansol, Bengaluru, Bhiwadi, Chandigarh, Chennai, Delhi, Durgapur, Faridabad, Guwahati, Hapur, HR-NCR, Hyderabad, Indore, Jaipur, Kanpur, Kolkata, Lucknow, Meerut, Modinagar, Moradabad, Mumbai, Panipat, Pune, Rohtak, Sonipat, UP-NCR, Vadodara, and Zirakpur.</p>

                    <p class="text-justify">CityIndia utilizes its efficient supply chain to deliver over 25 million products to customers every month. CityIndia Focuses on as fast as possible delivery maintaining supreme level of hygene and 0 Contact delivery. CityIndia is one of the TOP Startups Founded in 2020. Currently CityIndia Operate its business via Website &amp; Mobile App.</p>
                </div>
            </div>

<br>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: Basant Vihar Colony, Road No.1/B, Harmu, Ranchi, <br> Next to Shivangini Apartment. 834002</li>
                            <li>Phone: +91 7004776271</li>
                            <li>Email: support@cityindia.in</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="<?php echo $site_url; ?>/about.php">About Us</a></li>
                            <li><a href="<?php echo $site_url; ?>/about.php">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="<?php echo $site_url; ?>/delivery-policy.php">Delivery Policy</a></li>
                            <li><a href="<?php echo $site_url; ?>/privacy-policy.php">Privacy Policy</a></li>
                            <li><a href="<?php echo $site_url; ?>/terms-and-conditions.php">Terms & Conditions</a></li>
                            <li><a href="<?php echo $site_url; ?>/cancellation-and-return.php">Cancellation &amp; Refund Policy</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Download Apps</h6>
                        <div class="row">
                            <div class="col-md-6"><img src="https://grofers.com/images/home/google-play_1x-6d4f8e0.png"></div>
                            <div class="col-md-6"><img src="https://grofers.com/images/home/app-store_1x-8362160.png"></div>
                        </div>
                        <br>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> CityIndia | Handcrafted with <i class="fa fa-heart" aria-hidden="true"></i> at <a href="https://cybertizemedia.com" class="footer-list" target="_blank">Cybertize Media</a>
  </p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">

var site_url = "<?php echo $site_url; ?>";

 $(".search-key").focus(function(){

    $("#preloder").fadeIn();


 });

 $(".search-key").focusout(function(){

    $("#preloder").fadeOut("100", function () { $(".search-result-holder").hide(); });
    

 });

        $(".search-key").keyup(function(){

var in_text = "";
var keyword = 'keyword=' + $(".search-key").val();

$.ajax({ /*AJAX */ type: "POST", url: site_url + '/api/get-search.php', dataType: 'json', data: keyword, success: function(search_json) { 

$(".search-result-holder").html(" ");

jQuery(search_json).each(function(i, object){

  if (object.result_type == "item") { in_text = "<span style='font-size: 10px; color: #7d7d7d;'> in " + object.category + "</span>"; } 

  else if( object.result_type == "brand" ) { in_text = "<span style='font-size: 10px; color: #7d7d7d;'> in Brands</span>"; }

  else { in_text = ""; }

$(".search-result-holder").append("<li class='list-group-item' style='border-right-color: #fff !important; border-left-color: #fff !important; border-radius: 0px; border: 1px solid #eaeaea;'> <a style='color: #5f5f5f; font-size:12px; font-weight: 800;' href=' " + object.url + " '>" + object.name + in_text +"<i class='fa fa-arrow-right' style='float: right;' aria-hidden='true'></i></a> </li>");

$(".search-result-holder").show();

});


}  /*AJAX 2*/ }); 

});

    </script>