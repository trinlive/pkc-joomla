<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;
defined('_ASTROID') or die('Please install and activate <a href="https://www.astroidframework.com/" target="_blank">Astroid Framework</a> in order to use this template.');

if(file_exists("helper.php")){
    require_once "helper.php"; // Template's Helper
}

$document = Astroid\Framework::getDocument(); // Astroid Document
$document->include('typography');
$document->include('jollyanyoptions');
// Output as HTML5
$this->setHtml5(true);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
   <head>
       <astroid:include type="head-meta" /> <!-- document meta -->
       <jdoc:include type="head" /> <!-- joomla head -->
       <astroid:include type="head-styles" /> <!-- head styles -->
       <astroid:include type="head-scripts" /> <!-- head scripts -->
<!-- Google tag (gtag.js) added 670719 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-B5DGL5ZYTH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-B5DGL5ZYTH');
</script>
<!-- END Google tag -->
<!-- START wpm-mourning -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ribbon = document.querySelector(".wpm-ribbon");

    if (ribbon) {
      ribbon.style.transition = "opacity 2s ease"; // ตั้งค่า transition ล่วงหน้า

      ribbon.addEventListener("click", function () {
        ribbon.style.opacity = "0"; // เริ่ม fade out

        // รอให้ fade out เสร็จ แล้วค่อยซ่อน element
        setTimeout(function () {
          ribbon.style.display = "none";
        }, 2000); // 2000ms = 2 วินาที
      });
    }
  });
</script>
<!-- END wpm-mourning -->
 
</head>
<!-- Start black ribbon -->
<img src="/img/wp-mourning-ribbon.png" class="wpm-ribbon"/> 
<!-- END black ribbon -->
   <body class="<?php echo $document->getBodyClass(); ?>">
   <?php $document->include('document.body'); ?>
   <!-- body and layout -->
   <astroid:include type="body-scripts" /> <!-- body scripts -->
   </body> <!-- document body -->
</html> <!-- document end -->