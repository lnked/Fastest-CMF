<?php
/* Smarty version 3.1.31-dev/40, created on 2016-11-05 18:14:10
  from "/Users/edik/web/fastest.dev/apps/app/views/backend/base.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/40',
  'unifunc' => 'content_581e2172361b92_40861283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8abeee281251e43d12fae789df982d67f0323318' => 
    array (
      0 => '/Users/edik/web/fastest.dev/apps/app/views/backend/base.tpl',
      1 => 1478369550,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581e2172361b92_40861283 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>


    <?php if ($_smarty_tpl->tpl_vars['_csrf_token']->value) {?>
    <meta content="<?php echo $_smarty_tpl->tpl_vars['_csrf_param']->value;?>
" name="csrf-param">
    <meta content="<?php echo $_smarty_tpl->tpl_vars['_csrf_token']->value;?>
" name="csrf-token">
    <?php }?>
    
</head>
<body>
    <header>
        <h1>HEADER 1</h1>
    </header>
    
    <div><?php echo $_SESSION['authenticity_token'];?>
</div>

    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>10</li>
    </ul>
    <footer>
        xxx asd yy
    </footer>
</body>
</html><?php }
}
