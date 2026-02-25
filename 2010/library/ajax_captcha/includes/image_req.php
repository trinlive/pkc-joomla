<?php

// Echo the image - timestamp appended to prevent caching
echo '<a href="javascript:void(0);" onclick="refreshus(); return false;" title="Click to refresh image"><img src="../images/image.php?' . time() . '" width="132" height="46" border="0" alt="Captcha image" /></a>';

?>