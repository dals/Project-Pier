<?php trace(__FILE__,'begin') ?>
<?php set_page_title(lang('login')) ?>
<?php trace(__FILE__,'get_url') ?>
<form action="<?php echo get_url('access', 'login') ?>" method="post">

<?php trace(__FILE__,'form_errors') ?>
<?php tpl_display(get_template_path('form_errors')) ?>

<div class="container">
  <?php $installation_welcome_logo = config_option('installation_welcome_logo', ''); if ('' != trim($installation_welcome_logo)): ?>
  <div><?php echo $installation_welcome_logo ?></div>
  <?php endif ?>
  <div class="left">
    <div id="loginUsernameDiv">
      <label for="loginUsername"><?php echo lang('username') ?>:</label>
      <?php echo text_field('login[username]', array_var($login_data, 'username'), array('id' => 'loginUsername', 'class' => 'medium', 'tabindex' => 1)) ?>
    </div>
    <div id="loginOptionsLink">
      <a href="javascript:void(0)">
        <?php echo lang('options'); ?>&nbsp;<span>&raquo;</span>
      </a>
    </div>
  </div>
  <div class="right">
    <div id="loginPasswordDiv">
      <label for="loginPassword"><?php echo lang('password') ?>:</label>
      <?php echo password_field('login[password]', null, array('id' => 'loginPassword', 'class' => 'medium', 'tabindex' => 2)) ?>
    </div>
    <div id="loginSubmit"><?php echo submit_button(lang('login'), null, array('tabindex' => 3) ) ?></div>
  </div>
  <div class="left">
    <div id="options1" class="hidden">
      <ul>
        <li>
          <?php echo checkbox_field('login[remember]', (array_var($login_data, 'remember') == 'checked'), array('id' => 'loginRememberMe')) ?>
          <label style="display: inline" class="checkbox" for="loginRememberMe"><?php echo lang('remember me no duration') ?></label>
        </li>
       <li>
          <label for="loginLanguage"><?php echo lang('language'); ?></label>
          <select name="loginLanguage" id="loginLanguage">
            <option value="de_de">Deutsch</option>
            <option selected="selected" value="en_us">English (U.S.)</option>
            <option value="es_es">Español</option>
            <option value="fr_fr">Français</option>
            <option value="nl_nl">Nederlands</option>
          </select>
        </li>
      </ul>
    </div>
  </div>
  <div class="right">
    <div id="options2" class="hidden">
      <ul>
        <li id="loginForgotPassword">
          <a href="<?php echo get_url('access', 'forgot_password') ?>"><?php echo lang('forgot password') ?></a>
        </li>  
        <li>
          <label for="loginTheme"><?php echo lang('theme'); ?></label>
          <select name="loginTheme" id="loginTheme">
            <?php foreach (get_available_themes() as $theme => $theme_name): ?>
            <option <?php if (get_theme_name() == $theme) echo 'selected="selected"' ?> value="<?php echo $theme ?>"><?php echo $theme_name ?></option>
            <?php endforeach ?>
          </select>
        </li>
      </ul>
    </div>
  </div>
  <div style="clear:both"></div>
  <?php $installation_welcome_text = config_option('installation_welcome_text'); if ('' != trim($installation_welcome_text)): ?>
  <div id="welcome_text"><?php echo $installation_welcome_text ?></div>
  <?php endif ?>
</div>

  <?php if (isset($login_data) && is_array($login_data) && count($login_data)) { ?>
    <?php   foreach ($login_data as $k => $v) { ?>
      <?php     if (str_starts_with($k, 'ref_')) { ?>
      <input type="hidden" name="login[<?php echo $k ?>]" value="<?php echo clean($login_data[$k]) ?>" />
      <?php     } // if ?>
    <?php   } // foreach ?>
  <?php } // if ?>
</form>

<?php trace(__FILE__,'end') ?>
