<?php
/* Smarty version 5.3.0, created on 2024-05-31 11:34:36
  from 'file:homepage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_665999acae3410_18478031',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '7770290e91a9514c746707d4ef64b92f190eeeab' => 
    array (
      0 => 'homepage.tpl',
      1 => 1717147971,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_665999acae3410_18478031 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub';
$_smarty_tpl->getCompiled()->nocache_hash = '1859475630665999aca88907_74014613';
$_smarty_tpl->configLoad("test.conf", "setup");
?>


<PRE>

    <?php if ($_smarty_tpl->getConfigVariable('bold')) {?><b><?php }?>
                Title: <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getConfigVariable('title'));?>

        <?php if ($_smarty_tpl->getConfigVariable('bold')) {?></b><?php }?>

    The current date and time is <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y-%m-%d %H:%M:%S");?>


    Example of accessing server environment variable SERVER_NAME: <?php echo $_SERVER['SERVER_NAME'];?>


    The value of {$Name} is <b><?php echo '/*%%SmartyNocache:1859475630665999aca88907_74014613%%*/<?php echo $_smarty_tpl->getValue(\'Name\');?>
/*/%%SmartyNocache:1859475630665999aca88907_74014613%%*/';?>
</b>

variable modifier example of {$Name|upper}

<b><?php echo '/*%%SmartyNocache:1859475630665999aca88907_74014613%%*/<?php echo mb_strtoupper((string) $_smarty_tpl->getValue(\'Name\') ?? \'\', \'UTF-8\');?>
/*/%%SmartyNocache:1859475630665999aca88907_74014613%%*/';?>
</b>


An example of a section loop:

    <?php
$__section_outer_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('FirstName')) ? count($_loop) : max(0, (int) $_loop));
$__section_outer_0_total = $__section_outer_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_outer'] = new \Smarty\Variable(array());
if ($__section_outer_0_total !== 0) {
for ($__section_outer_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_outer']->value['index'] = 0; $__section_outer_0_iteration <= $__section_outer_0_total; $__section_outer_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_outer']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_outer']->value['rownum'] = $__section_outer_0_iteration;
?>
        <?php if ((1 & ($_smarty_tpl->getValue('__smarty_section_outer')['index'] ?? null) / 2)) {?>
            <?php echo ($_smarty_tpl->getValue('__smarty_section_outer')['rownum'] ?? null);?>
 . <?php echo $_smarty_tpl->getValue('FirstName')[($_smarty_tpl->getValue('__smarty_section_outer')['index'] ?? null)];?>
 <?php echo $_smarty_tpl->getValue('LastName')[($_smarty_tpl->getValue('__smarty_section_outer')['index'] ?? null)];?>

        <?php } else { ?>
            <?php echo ($_smarty_tpl->getValue('__smarty_section_outer')['rownum'] ?? null);?>
 * <?php echo $_smarty_tpl->getValue('FirstName')[($_smarty_tpl->getValue('__smarty_section_outer')['index'] ?? null)];?>
 <?php echo $_smarty_tpl->getValue('LastName')[($_smarty_tpl->getValue('__smarty_section_outer')['index'] ?? null)];?>

        <?php }?>
        <?php }} else {
 ?>
        none
    <?php
}
?>

    An example of section looped key values:

    <?php
$__section_sec1_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('contacts')) ? count($_loop) : max(0, (int) $_loop));
$__section_sec1_0_total = $__section_sec1_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_sec1'] = new \Smarty\Variable(array());
if ($__section_sec1_0_total !== 0) {
for ($__section_sec1_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_sec1']->value['index'] = 0; $__section_sec1_0_iteration <= $__section_sec1_0_total; $__section_sec1_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_sec1']->value['index']++){
?>
        phone: <?php echo $_smarty_tpl->getValue('contacts')[($_smarty_tpl->getValue('__smarty_section_sec1')['index'] ?? null)]['phone'];?>

        <br>

            fax: <?php echo $_smarty_tpl->getValue('contacts')[($_smarty_tpl->getValue('__smarty_section_sec1')['index'] ?? null)]['fax'];?>

        <br>

            cell: <?php echo $_smarty_tpl->getValue('contacts')[($_smarty_tpl->getValue('__smarty_section_sec1')['index'] ?? null)]['cell'];?>

        <br>
    <?php
}
}
?>
    <p>

        testing strip tags
        <table border=0><tr><td><A HREF="<?php echo $_smarty_tpl->getValue('SCRIPT_NAME');?>
"><font color="red">This is a test </font></A></td></tr></table>

</PRE>

This is an example of the html_select_date function:

<form>
    <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_select_date')->handle(array('start_year'=>1998,'end_year'=>2010), $_smarty_tpl);?>

</form>

This is an example of the html_select_time function:

<form>
    <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_select_time')->handle(array('use_24_hours'=>false), $_smarty_tpl);?>

</form>

This is an example of the html_options function:

<form>
    <select name=states>
        <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_options')->handle(array('values'=>$_smarty_tpl->getValue('option_values'),'selected'=>$_smarty_tpl->getValue('option_selected'),'output'=>$_smarty_tpl->getValue('option_output')), $_smarty_tpl);?>

    </select>
</form>
<?php }
}
