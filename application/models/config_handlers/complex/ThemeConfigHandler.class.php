<?php

  class ThemeConfigHandler extends ConfigHandler {
  
    /**
    * Array of available themes (subfolders of themes folder)
    *
    * @var array
    */
    private $available_themes = array();
    
    /**
    * Constructor
    *
    * @param void
    * @return ThemeConfigHandler
    */
    function __construct() {
      $this->available_themes = get_available_themes();
    } // __construct
    
    /**
    * Render form control
    *
    * @param string $control_name
    * @return string
    */
    function render($control_name) {
      $options = array();
      
      foreach ($this->available_themes as $theme => $theme_name) {
        $option_attributes = $this->getValue() == $theme ? array('selected' => true) : null;
        $options[] = option_tag($theme_name, $theme, $option_attributes);
      } // foreach
      
      return select_box($control_name, $options);
    } // render
  
  } // ThemeConfigHandler
