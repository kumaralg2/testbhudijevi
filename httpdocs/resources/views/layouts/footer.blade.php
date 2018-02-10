<footer class="footer">
    <div class="container">
        <div class="row">
              <div class="col-md-9">                 
                  <ul class="list-inline">
                        <li><a href="{{ URL::to('/about-us') }}" title="About Us">About Us</a></li>
                        <li><a href="{{URL::to('/terms-of-use')}}" title="Terms of Use">Terms of Use</a></li>
                        <li><a href="{{URL::to('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a></li>						
                        <li><a href="{{URL::to('/faq')}}" title="FAQ's">FAQ's</a></li>
                        <li><a href="{{URL::to('/contact_us')}}" title="Contact Us">Contact Us</a></li>
                  </ul>
                  <p>Copyright © <?php echo date("Y"); ?> BuddhiJeevi.com</p>
              </div>
            <div class="col-md-3 text-center">
                <ul class="list-inline">
                    <li><a href=""><img src="{{asset('assets/images/fb-icon.png')}}"></a></li>
                    <li><a href=""><img src="{{asset('assets/images/in-icon.png')}}"></a></li>
                    <li><a href=""><img src="{{asset('assets/images/twitter-icon.png')}}"></a></li>
                    <li><a href=""><img src="{{asset('assets/images/gplus-icon.png')}}"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div style='display:none'>
    <div id='forgetpassword'>
        <div class="ts_sign_wrapper" id="login_panel">
            <div class="ts_panel_form">
                <form name="ts_login_form" id="forgot_pass" method="post" action="#">
                    <h2>Forgot your password ? </h2>
                    <div class="fields">
                        <label for="emailAdd">Email Address *</label>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="email" id="emailAdd" placeholder="Email Address*" value="{{Request::cookie('email')}}"  />
                    </div>
            </div>
            <p id="LoadingImag_forgotpass"></p>
            <p style="color:brown" id="Message_forgotpass"></p>
            <div class="fields submit">
            <input type="submit" name="submit" id="submit" value="Send Me Password Reset Link">
            </div>
            </form>
        </div>
    </div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92785313-1', 'auto');
  ga('send', 'pageview');

</script>