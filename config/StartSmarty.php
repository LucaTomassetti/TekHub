<?php
use Smarty\Smarty;

class StartSmarty{
    public static function configuration(){

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__.'/../Smarty/templates/');
        $smarty->setCompileDir(__DIR__.'/../Smarty/templates_c/');
        $smarty->setConfigDir(__DIR__.'/../Smarty/configs/');
        $smarty->setCacheDir(__DIR__.'/../Smarty/cache/');

        $smarty->setEscapeHtml(true);

        return $smarty;
   }
}
?>