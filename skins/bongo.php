<?php
/**
 * Bongo Skin
 *
 *
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class SkinBongo extends SkinTemplate {
	/** Using bongo. */
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'bongo';
		$this->stylename = 'bongo';
		$this->template  = 'bongoTemplate';
	}
}

/**
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class bongoTemplate extends QuickTemplate {
	/**
	 * @access private
	 */
	function execute() {
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
  <head>
    <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
    <?php $this->html('headlinks') ?>
    <title><?php $this->text('pagetitle') ?></title>
    <?php if(!$this->data['loggedin']) { ?>
      <style type="text/css">
        <!--
        .editsection { display: none; }
        -->
      </style>
 <?php } ?>
    <style type="text/css" media="screen">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css"; /*]]>*/</style>
    <?php if($this->data['jsvarurl'  ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl'  ) ?>"></script><?php } ?>
    <script type="<?php $this->text('jsmimetype') ?>" src="<?php                                   $this->text('stylepath' ) ?>/common/wikibits.js"></script>
    <?php if($this->data['usercss'   ]) { ?><style type="text/css"><?php              $this->html('usercss'   ) ?></style><?php    } ?>
    <?php if($this->data['userjs'    ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs'    ) ?>"></script><?php } ?>
    <?php if($this->data['userjsprev']) { ?><script type="<?php $this->text('jsmimetype') ?>"><?php      $this->html('userjsprev') ?></script><?php   } ?>
    <?php if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-309838-13']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
  </head>
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['body_onload'    ]) { ?>onload="<?php     $this->text('body_onload')     ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>>
	<div class="wrap">
			<div id="header">
				<!-- Navigation -->
				<div id="navi">
					<div class="left">
					<ul>
						<li><a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>">Home</a></li>
	<!--					<li>|</li>
						<li><a href="https://gna.org/projects/bongo/">GNA!</a></li>-->
					<!--	<li>|</li> -->
					<!--	<li><a href="http://forum.bongo-project.org">Forums</a></li> -->
						<li>|</li>
						<li><a href="http://planet.bongo-project.org">Blogs</a></li>
						<li>|</li>
						<li><a href="http://developers.bongo-project.org">Developers</a></li>
					</ul>
					</div>
					<div class="right">
						<form name="searchform" action="<?php $this->text('searchaction') ?>" id="searchform">
					      Search: <input id="searchInput" class="search" size="20" name="search" type="text"
					        <?php if($this->haveMsg('accesskey-search')) {
					          ?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php }
					        if( isset( $this->data['search'] ) ) {
					          ?> value="<?php $this->text('search') ?>"<?php } ?> />
					    </form>
					</div>
				</div>
				<!-- /Navigation -->
				<div id="logo">
					<a <?php
						?>href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>" <?php
						?>title="<?php $this->msg('mainpage') ?>"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/bongo.png" alt="Bongo Project" /></a>
				</div>
				<div id="categories">
					<h1><?php $this->text('title') ?></h1>
				</div>
			</div>
		</div>
	
	
	<div class="wrap">
		<div id="container">
			<div class="subnav">
				<script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>
				<?php foreach ($this->data['sidebar'] as $bar => $cont) { ?>
				<div class='portlet' id='p-<?php echo Sanitizer::escapeId($bar) ?>'>
					<div class='pBody'>
						<ul>
							<li style="list-style-image: url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/icons/go-home.png);"><a href="/Main_Page">Main 
Page</a></li>
								<li style="list-style-image: url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/icons/emblem-photos-1.png);"><a href="/Tour">Tour</a></li>
								<li style="list-style-image: 
url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') 
?>/icons/package-x-generic.png);"><a href="/Installation">Install</a></li><li 
style="list-style-image: url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') 
?>/icons/applications-accessories.png);"><a href="/Getting_Involved">Getting 
Involved</a></li><li style="list-style-image: 
url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') 
?>/icons/x-office-document.png);"><a 
href="/Documentation">Documentation</a></li><li style="list-style-image: url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/icons/x-office-address-book.png);"><a href="/Guides">Guides</a></li><li style="list-style-image:
url(<?php $this->text('stylepath') ?>/<?php $this->text('stylename')
?>/icons/applications-development.png);"><a
href="/Team">Team</a></li>

						</ul>
					</div>
				</div>
				<?php } ?>
				<div class="subnav-cat"><?php $this->msg('personaltools') ?></div>
				  <div class="subnav-ptools">
				    <ul>
				    <?php foreach($this->data['personal_urls'] as $key => $item)  {
				       ?><li id="pt-<?php echo htmlspecialchars($key) ?>"><a href="<?php
				       echo htmlspecialchars($item['href']) ?>"<?php
				       if(!empty($item['class'])) { ?> class="<?php
				       echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
				       echo htmlspecialchars($item['text']) ?></a></li><?php
				    } ?>
				    <li><a href="/Special:Recentchanges">Recent Changes</a> (<a href="/Special:Recentchanges&feed=rss">RSS</a>)</li>
				    <li><a href="/Special:Newpages">New Pages</a> (<a href="/Special:Newpages&feed=rss">RSS</a>)</li>
				    </ul>
				  </div>
			</div>
			<div class="content">
				<a name="top" id="contentTop"></a>
				<div id="contentSub"><?php $this->html('subtitle') ?></div>
				<?php if($this->data['undelete']) { ?><div id="contentSub"><?php     $this->html('undelete') ?></div><?php } ?>
			    <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
				<!-- start content -->
			    <?php $this->html('bodytext') ?>
			    <?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
			    <!-- end content -->
			</div>
		</div>
	</div>
	<?php if($this->data['loggedin']==1) { ?>
	<div class="wrap">
		<div id="wiki-tools">
			  <ul>
				<li class="ca-views"><?php $this->msg('views') ?><li><?php foreach($this->data['content_actions'] as $key => $action) {
			       ?><li id="ca-<?php echo htmlspecialchars($key) ?>"<?php if($action['class']) { ?>class="<?php echo htmlspecialchars($action['class']) ?>"<?php } ?>><a href="<?php echo htmlspecialchars($action['href']) ?>"><?php echo htmlspecialchars($action['text']) ?></a></li><?php } ?>
			  </ul>
		</div>
	</div>
	<?php } ?>
	<div class="wrap">
		<div id="footer">
			<div class="left">
				<ul>
					<li>Hosted by <a href="http://osuosl.org/">OSL</a> and <a href="https://www.gna.org">GNA!</a></li>
					<li>|</li>
					<li></li>
				</ul>
			</div>
			<div class="right">
				<ul>
					<li><a href="/Bongo:Disclaimer">Disclaimer</a></li>
				</ul>
			</div>
		</div>
		<div class="copyright">Copyright &copy; 2007 Bongo Project, All rights reserved. <br />
		Icons used on this website are from <a href="http://tango-project.org">The Tango Project</a>.<br />
				<span class="valid"> <a href="http://validator.w3.org/check?uri=http://<?php echo $_SERVER['HTTP_HOST'] ?>">XHTML</a></span> <span class="valid"> <a 
href="http://jigsaw.w3.org/css-validator/validator?uri=http://<?php echo $_SERVER['HTTP_HOST'] ?>">CSS</a></span>
		</div>
	</div>
	
</body>
</html>
<?php
	wfRestoreWarnings();
	}
}
?>
