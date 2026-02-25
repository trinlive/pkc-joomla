<div class="container">
    <?php echo $header; ?>
    <div class="content" style="border-bottom-width: 0;border-top-width: 0;">

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=1655298854720629";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <?php echo $content;?>
        <?php echo $sidebar_right;?>
        <div class="clearfix"></div>
    </div>
    <?php echo $footer;?>
</div>
<!-- /container -->

