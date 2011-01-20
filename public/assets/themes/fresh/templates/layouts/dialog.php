<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
  <head>
    <title><?php echo get_page_title() ?></title>
<?php echo stylesheet_tag('dialog.css') ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<?php echo add_javascript_to_page('login.js') ?> 
<?php echo meta_tag('content-type', 'text/html; charset=utf-8', true) ?> 
<link rel="Shortcut Icon" href="<?php echo ROOT_URL ?>/favicon.ico?086" type="image/x-icon" />
<?php echo render_page_head() ?>
  </head>
  <body>
    <div style="margin: 150px auto; width: 414px; 1text-align: center;">
      <img src="public/files/logo.png" style="margin: 0 auto 10px;" />
      <div id="dialog">
        <h1><?php echo get_page_title() ?></h1>
        <?php foreach (array('success', 'error') as $message_type): if (!is_null(flash_get($message_type))): ?>
        <div class="flash-message" id="<?php echo $message_type ?>">
          <p><?php echo clean(flash_get($message_type)) ?></p>
          <div class="hide-flash">x</div>
          <div class="clear"></div>
        </div>
        <?php endif; endforeach; ?>
        <?php echo $content_for_layout ?>
      </div>
    </div>
  </body>
</html>
