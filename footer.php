      <!-- Footer -->
      <footer class="flex-container">
         <div class="flex-item footer-slot">
            <div class="inner-wrap">

               <div class="footer-logo"></div>
               <ul class="footer-links">
                  <li><a href="#">About us</a></li>
                  <li><a href="#">Advertise</a></li>
                  <li><a href="#">Contact us</a></li>
                  <!-- <li><a href="#">Bracket</a></li> -->
                  <!-- <li><a href="#">Friends</a></li> -->
                  <li><a href="#">Customer Service</a></li>
                  <!-- <li><a href="#">News</a></li> -->
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Terms</a></li>
                  <li><a href="#">User agreement</a></li>
               </ul>
               <div class="copyright">
                  <span class="caps">&copy; 2011-<?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</span>
                  <span>FriendshipMadness.com is designed and developed by <a href="#" target="_blank">Chris Lusk</a>.</span>
               </div>

            </div>
         </div>
      </footer>
      <!-- /footer -->

      <section id="conferences" class="clearfix">
        <div class="">
          <figure class="league-logo big-8 compact"></figure>
          <figure class="league-logo catholic-7 compact"></figure>
          <figure class="league-logo cma"></figure>
          <figure class="league-logo the-daily inverse"></figure>
          <figure class="league-logo norman"></figure>
          <figure class="league-logo okc"></figure>
          <figure class="league-logo pack-10 compact"></figure>
          <figure class="league-logo the-urb inverse"></figure>
        </div>
      </section>

   </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php wp_footer(); ?>

<!-- Twitter widget -->
<script>
window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));
</script>

<!-- analytics -->
<script>
(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
ga('send', 'pageview');
</script>

</body>
</html>
