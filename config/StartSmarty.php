<?php
use Smarty\Smarty;

class StartSmarty extends Smarty{
    public function __construct(){
        parent::__construct();

        $this->setTemplateDir(__DIR__.'/../Smarty/templates/');
        $this->setCompileDir(__DIR__.'/../Smarty/templates_c/');
        $this->setConfigDir(__DIR__.'/../Smarty/configs/');
        $this->setCacheDir(__DIR__.'/../Smarty/cache/');

        $this->setEscapeHtml(true);

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
   }
}
?>