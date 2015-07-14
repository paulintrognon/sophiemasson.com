<html>
<head>Crypter</head>
<body>
<?php
$value = array();
if (isset($_POST) AND !empty($_POST['pword']) )
{
	$value=$_POST;
	$value['cryptword'] = md5($value['pword']);
}
?>
<form name="crypter" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<legend>Crypter un mot de passe</legend>
<p><label for="pword"><input type="text" name="pword" id="pword" value="<?php echo $value['pword']; ?>" /></label></p>
<p><label for="cryptword"><input type="text" name="cryptword" id="cryptword" value="<?php echo $value['cryptword']; ?>" /></label></p>
<p><label for="envoi"><input type="submit" name="envoi" id="envoi" value="Envoyer" /></label></p>
</fieldset>
</form>
</body>
</html>