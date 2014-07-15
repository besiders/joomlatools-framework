<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

defined('KOOWA') or die; ?>

<!DOCTYPE html>
<html class="koowa-html" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?= @url(); ?>" />
    <title><?= @title() ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta content="chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style src="media://koowa/com_koowa/css/bootstrap.css" type="text/css" />

    <? if (JFactory::getLanguage()->isRTL()) : ?>
        <style src="media://jui/css/bootstrap-rtl.css" type="text/css" />
    <? endif; ?>

    <script type="text/javascript">
    // Add a "joomla_modal" class to the HTML element if we are rendering inside a Squeezebox modal
    if (window.parent && window.parent != window) {
        document.documentElement.className += " inside_modal";
    }
    if (window.parent.SqueezeBox && window.parent.SqueezeBox.isOpen) {
        document.documentElement.className += " joomla_modal";
    }
    if (navigator.userAgent.match(/Trident|MSIE/)) {
        document.documentElement.className += " old-ie-html";
    }
    </script>
    <ktml:title>
    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

</head>
<body class="koowa koowa_template ">

<!--[if lte IE 8 ]>
<div class="old-ie">
<![endif]-->

<div class="koowa_template_container">
    <div class="koowa_messages">
        <ktml:messages>
    </div>
    <ktml:content>
</div>

<!--[if lte IE 8 ]>
</div>
<![endif]-->

</body>
</html>