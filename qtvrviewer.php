<?php
/*
Plugin Name: QTVR Viewer
Plugin URI: http://www.devalvr.com/paginas/productos/qtvrviewer.html
Description: This plugin inserts a player into the article to view a QTVR file (a panoramic picture in .mov format) 
Version: 1.5.3
Author: Armando Saenz
Author URI: http://www.devalvr.com/
*/

// Pre-2.6 compatibility
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

//{qtvr demo.mov 500 420 devalvr() qt() selection() preview()}	  

function writecode($text)
{
	$str='<script type="text/javascript"> ';
	$str.='if(typeof(writecode)!="function") {';
	$str.='document.write("<script type=\'text/javascript\' src=\''.WP_PLUGIN_URL.'/qtvr-viewer/detectvr.js\'></scr"+"ipt>");';
	$str.='}</script>';

	$codes=Array();
	$numcodes = preg_match_all('/<code>(.*?)<\/code>/i', $text, $matches );
	for( $n=0; $n < $numcodes; $n++ )
	{
		$codes[$n]=$matches[1][$n];
		$text = str_replace($matches[0][$n],"[%{[CODE".$n."]}%]",$text);
	}
	
	$search = Array('/\{qtvr(.*?)}/i','/\{ qtvr(.*?)}/i');
	for( $se=0; $se < 2; $se++ )
	{
		$numplugs = preg_match_all( $search[$se], $text, $matches );
		for( $n=0; $n < $numplugs; $n++ )
		{
			$params=explode(' ', trim($matches[1][$n]));
			$nparams=count($params);
			
			$filename=$params[0];
			$filename = (strpos($filename, 'http://')!==false)?$filename:WP_CONTENT_URL.'/'.$filename;
			
			if($nparams>1 && $params[1]) $width=(int)$params[1];
			else $width=300;
			if($nparams>2 && $params[2]) $height=(int)$params[2];
			else $height=200;

			$preview='play';
			$str.='<script type="text/javascript"> ';
			$devalparams = preg_match_all( '/devalvr\((.*?)\)/', $matches[1][$n], $matchesdeval );
			if($devalparams>0)
			{
				$viewerparams=comillado($matchesdeval[1][0]);
				$str.='viewerparameters("devalvr","bgcolor","#1f1f1f",'.$viewerparams.');';
			}
			else $str.='viewerparameters("devalvr","bgcolor","#1f1f1f");';
			$qtparams = preg_match_all( '/qt\((.*?)\)/', $matches[1][$n], $matchesqt );
			if($qtparams>0)
			{
				$viewerparams=comillado($matchesqt[1][0]);
				$str.='viewerparameters("qt",'.$viewerparams.');';
			}
			$previewimage = preg_match_all( '/preview\((.*?)\)/', $matches[1][$n], $matchespreview );
			if($previewimage>0)
			{
				$preview=comillado($matchespreview[1][0]);
				if($preview!="") $preview=WP_CONTENT_URL.'/'.$preview;
				else $preview="";
			}
			$str.='detectvr_script_folder="'.WP_PLUGIN_URL.'/qtvr-viewer/";';
			$str.='writecode("'.$filename.'","'.$filename.'","","","","'.$width.'","'.$height.'","'.$preview.'");';
			$selparams = preg_match_all( '/selection\((.*?)\)/', $matches[1][$n], $matchessel );
			if($selparams>0)
			{
				$selparams=explode(',', trim($matchessel[1][0]));
				$str.='document.write("'.$selparams[0].'");';
				$str.='ShowViewerSelection("horizontal,reload,'.$matchessel[1][0].'");';
			}
			$str.='</script>';
			
			if(!is_single() && !is_page() && !is_home()) $str='';
			$text = str_replace( $matches[0][$n], $str,$text);
			$str='';
		}
	}	
	for( $n=0; $n < $numcodes; $n++ )
	{
		$text = str_replace("[%{[CODE".$n."]}%]",$codes[$n],$text);
	}
	return $text;
} 

function comillado($text)
{
	$text=str_replace('&#8216;','\'',$text);
	$text=str_replace('&#8217;','\'',$text);
	$text=str_replace('&#8219;','\'',$text);
	$text=str_replace('&#8242;','\'',$text);
	$text=str_replace('&#8245;','\'',$text);
	$text=str_replace('&#8220;','"',$text);
	$text=str_replace('&#8221;','"',$text);
	$text=str_replace('&#8223;','"',$text);
	$text=str_replace('&#8243;','"',$text);
	$text=str_replace('&#8246;','"',$text);
	return($text);
}

add_filter('the_content','writecode');
	  
	  
?>