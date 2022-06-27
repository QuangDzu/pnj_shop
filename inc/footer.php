</div>


<div class="footer">
    <div class="wrapper">
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>Thông tin</h4>
                <ul>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Dịch vụ khách hàng</a></li>
                    <li><a href="#"><span>Tìm kiếm</span></a></li>
                    <li><a href="#">Đơn hàng và trả hàng</a></li>
                    <li><a href="#"><span>Contact Us</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Tại sao mua từ chúng tôi</h4>
                <ul>
                    <li><a href="about.php">Về chúng tôi</a></li>
                    <li><a href="faq.php">Dịch vụ khách hàng</a></li>
                    <li><a href="#">Chính sách bảo hành</a></li>
                    <li><a href="contact.php"><span>Site Map</span></a></li>
                    <li><a href="preview.php"><span>Cụm từ tìm kiếm</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Tài khoản</h4>
                <ul>
                    <li><a href="contact.php">Đăng nhập</a></li>
                    <li><a href="cart.php">Giỏ hàng</a></li>
                    <li><a href="favoriteslist.php">Sản phẩm yêu thích</a></li>
                    <li><a href="orderdetails.php">Theo dõi đơn hàng</a></li>
                    <li><a href="faq.php">Trợ giúp</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Contact</h4>
                <ul>
                    <li><span>090 909 0909</span></li>
                    <li><span>090 909 0909</span></li>
                </ul>
                <div class="social-icons">
                    <h4>Theo dõi chúng tôi</h4>
                    <ul>
                        <li class="facebook"><a href="#" target="_blank"> </a></li>
                        <li class="twitter"><a href="#" target="_blank"> </a></li>
                        <li class="googleplus"><a href="#" target="_blank"> </a></li>
                        <li class="contact"><a href="#" target="_blank"> </a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copy_right">
            <p>Cửa hàng trang sức hàng đầu Việt Nam &amp; All rights Reseverd </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        /*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function() {
        SyntaxHighlighter.all();
    });
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
</body>

</html>