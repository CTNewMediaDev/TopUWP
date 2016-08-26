<?php
/**
 * 采集play.google.com规则
 */

require_once '../../config.inc.php';

//check isAmdin
isAdmin();


include 'template/crawlrule.tpl.php';
?>