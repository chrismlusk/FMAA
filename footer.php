			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?>
					<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//html5blank.com" title="HTML5 Blank">HTML5 Blank</a>.
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

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
