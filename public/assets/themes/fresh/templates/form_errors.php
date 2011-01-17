<?php if (isset($error) && ($error instanceof Error)) { ?>
  <!-- Form errors -->
  <?php if (($error instanceof DAOValidationError) || ($error instanceof FormSubmissionErrors)) { ?>
  <div id="formErrors">
    <p><?php echo lang('error form validation') ?></p>
    <ul>
  <?php foreach ($error->getErrors() as $err) { ?>
      <li><?php echo clean($err) ?></li>
  <?php } // foreach ?>
    </ul>
  </div>
  <?php } else { ?>
    <?php flash_error($error->getMessage()) ?>
  <?php } // if ?>
<?php } // if ?>
