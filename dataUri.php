 <?php

/**
 * Data URI base64 PHP function.
 * 
 * @author        Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright     (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license       Lesser General Public License (LGPL) <http://www.gnu.org/copyleft/lesser.html>
 * @link          http://github.com/pH-7
 * @param         string $sFile The path of your file to encode.
 * @return        string The encoded data in base64: data:[<MIME-type>][;base64],<data>
 */
function base64DataUri($sFile)
{                   

    // Switch to right MIME-type
    $sExt = strtolower(substr(strrchr($sFile, '.'), 1));
     
    switch($sExt)
    {
		case 'gif':
		case 'jpg':
		case 'png':
			$sMimeType = 'image/'. $sExt;
		break;
		
		case 'ico':
			$sMimeType = 'image/x-icon';
		break;
		
		case 'eot':
			$sMimeType = 'application/vnd.ms-fontobject';
		break;
		
		case 'otf':
		case 'ttf':
		case 'woff':
			$sMimeType = 'application/octet-stream';
		break;
		
		default:
		    exit('Invalid extension file!');
	}

    $sBase64 = base64_encode(file_get_contents($sFile));
    return "data:$sMimeType;base64,$sBase64";
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Data URI base64 PHP function</title>
<meta name="description" content="Some examples" />
<meta name="keywords" content="data uri, base64, server query optimization" />
</head>
<body>
<!-- Examples -->

<?php $sImage = '/home/brussels/Pictures/my-picture.jpg'; ?>
<?php $sFavicon = '/home/brussels/Desktop/favicon.ico'; ?>
<?php $sUrlPhpLogo = 'http://static.php.net/www.php.net/images/php.gif'; ?>

<!-- HTML -->
<h2>With the IMG Tag</h2>
<p><img src="<?php echo base64DataUri($sImage); ?>" alt="Image" title="Image encoded in base64" /></p>

<!-- URL -->
<h2>With a URL address</h2>
<p><a href="http://php.net"><img src="<?php echo base64DataUri($sUrlPhpLogo); ?>" alt="PHP logo" title="PHP website" width="120" height="67" /></a></p>

<!-- CSS -->
<h2>With the style sheet</h2>
<style>
.img {background: url('<?php echo base64DataUri($sImage); ?>') no-repeat; width:800px; height:800px; }
</style>

<div class="img"></div>

<!-- Icon -->
<h2>With the icon (e.g. favicon.ico)</h2>
<link rel="icon" type="image/x-icon" href="<?php echo base64DataUri($sFavicon); ?>" /> 

</body>
</html>
