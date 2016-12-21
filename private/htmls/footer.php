<?php
?>
</html>
<?php if (isset($local_db)) { $local_db->close_connection(); } ?>
<?php if (isset($nca_db)) { $nca_db->close_connection(); } ?>
<?php if (isset($fp_db)) { $fp_db->close_connection(); } ?>
