 <?php
 /**
 * Data URI Function base64
 *
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @license     GNU GPL 3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @version     $Id: dataUri.php 2012-01-12 pierrehs $
 */
 
   /**
   * @desc Data URI Function base64
   * @param string $sFile
   * @return string Returns format: data:[<MIME-type>][;base64],<data>
   */
 function base64DataUri($sFile) {

     // Switch to right MIME-type
     $sExt = strtolower(substr(strrchr($sFile, '.'), 1));
     
     switch($sExt) {
					default:
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
				}
				
      $sBase64 = base64_encode(file_get_contents($sFile));
      return "data:$sMimeType;base64,$sBase64";
   }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Data URI PHP function</title>
<meta name="description" content="Some examples" />
<meta name="keywords" content="data uri, base64, server query optimization" />
</head>
<body>
<!-- Examples -->

<?php $sImage = '/home/brussels/Pictures/my-picture.jpg'; ?>
<?php $sFavicon = '/home/brussels/Desktop/favicon.ico'; ?>

<!-- HTML -->
<h2>With the IMG Tag
<p><img src="<?php echo base64DataUri($sImage); ?>" /></p>

<!-- CSS -->
<h2>With the style sheet</h2>
<style>
.img {background: url('<?php echo base64DataUri($sImage); ?>') no-repeat; width:800px; height:800px}
</style>

<div class="img"></div>

<!-- Icon -->

<h2>With the icon (e.g. favicon.ico)</h2>
<link rel="icon" type="image/x-icon" href="<?php echo base64DataUri($sFavicon); ?>" /> 

</body>
</html>
