<?php
/**
 * Beagle - modified from MonoBook
 * by: Joe Shaw (joeshaw@novell.com)
 * license: TBD, probably GPL 
*/

if( !defined( 'MEDIAWIKI' ) )
	die();

require_once('includes/SkinTemplate.php');

class SkinBeagle extends SkinTemplate {
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'beagle';
		$this->stylename = 'beagle';
		$this->template  = 'BeagleTemplate';
	}
}
	
class BeagleTemplate extends QuickTemplate {
	function execute() {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
  <head>
    <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
    <?php $this->html('headlinks') ?>
    <title><?php $this->text('pagetitle') ?></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css" />
    <link rel="stylesheet" type="text/css" media="print" href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
    <?php if($this->data['jsvarurl'  ]) { ?><script type="text/javascript" src="<?php $this->text('jsvarurl'  ) ?>"></script><?php } ?>
    <script type="text/javascript" src="<?php                                   $this->text('stylepath' ) ?>/common/wikibits.js"></script>
    <?php if($this->data['usercss'   ]) { ?><style type="text/css"><?php              $this->html('usercss'   ) ?></style><?php    } ?>
    <?php if($this->data['userjs'    ]) { ?><script type="text/javascript" src="<?php $this->text('userjs'    ) ?>"></script><?php } ?>
    <?php if($this->data['userjsprev']) { ?><script type="text/javascript"><?php      $this->html('userjsprev') ?></script><?php   } ?>
  </head>
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>>

<div id="header">
	<h1>Beagle</h1>
</div>

<hr class="clear spacing invisible" />

<ul id="nav-top">
	<?php foreach($this->data['sidebar'] as $bar => $cont) { ?>
		<div class="portlet" id="p-<?php echo htmlspecialchars($bar) ?>'>
		<?php foreach($cont as $key => $val) { ?>
		<li id="<?php echo htmlspecialchars($val['id']) ?>"><a href="<?php echo htmlspecialchars($val['href']) ?>"><?php echo htmlspecialchars($val['text'])?></a></li>
		<?php } ?>
		</div>
	<?php } ?>
	<li class="cheat"></li>
</ul>

<div id="content">
<div id="content-body">			
	<div id="articleBody">
		<a name="top" id="contentTop"></a>
		<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
		<!-- <h2 class="articleTitle"><?php $this->text('title') ?></h2> -->
		<div id="articleContent">
			<div id="contentSub"><?php $this->html('subtitle') ?></div>
			<?php if($this->data['undelete']) { ?><div id="contentSub"><?php     $this->html('undelete') ?></div><?php } ?>
			<?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
				<?php $this->html('bodytext') ?>
				<?php if($this->data['catlinks']) { ?><div id="categoryLinks"><?php       $this->html('catlinks') ?></div><?php } ?>

		</div>
	</div>

</div> <!-- content-body close -->

<hr class="clear invisible" />

<div id="article-info">
	<?php if($this->data['lastmod'   ]) { ?>
		<?php $this->html('lastmod') ?>
	<?php } ?>
	<?php if($this->data['viewcount' ]) { ?>
		<?php $this->html('viewcount') ?>
	<?php } ?>
</div>

</div> <!-- content close -->

<hr class="clear dotted spacing" />

<ul class="nav-bottom">
	<?php foreach($this->data['personal_urls'] as $key => $item) { ?>
		<li id="userPages-<?php echo htmlspecialchars($key) ?>"><a href="<?php echo htmlspecialchars($item['href']) ?>"<?php if(!empty($item['class'])) { ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php echo htmlspecialchars($item['text']) ?></a></li>
	<?php } ?>
</ul>

<ul class="nav-bottom">
	<?php foreach($this->data['content_actions'] as $key => $action) { ?>
		<li id="articleActions=<?php echo htmlspecialchars($key) ?>"><a href="<?php echo htmlspecialchars($action['class']) ?>"<a href="<?php echo htmlspecialchars($action['href']) ?>"><?php echo htmlspecialchars($action['text']) ?></a></li>
	<?php } ?>
</ul>

<div class="searchForm">
	<form id="searchForm" class="searchForm" name="searchForm" action="<?php $this->text('searchaction') ?>">
		<input id="searchInput" class="searchInput" name="search" type="text" <?php if($this->haveMsg('accesskey-search')) {?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php } if( isset( $this->data['search'] ) ) {?> value="<?php $this->text('search') ?>"<?php } ?> />&nbsp;<input id="searchGoButton" class="searchButton" type='submit' name="go" value="<?php $this->msg('go') ?>" />&nbsp;<input id="searchButton" class="searchButton" type='submit' name="fulltext" value="<?php $this->msg('search') ?>" />
	</form>
</div>

<ul class="nav-bottom">
	<?php if($this->data['notspecialpage']) { foreach( array( 'whatlinkshere', 'recentchanges', 'upload', 'specialpages' ) as $special ) { ?>
		<li id="articleInfo-<?php echo $special?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']) ?>"><?php echo $this->msg($special) ?></a></li>
	<?php } } ?>
</ul>            		   

<div class="poweredby">
	<?php if($this->data['poweredbyico']) { ?>
		<span id="footer-poweredbyico"><?php $this->html('poweredbyico') ?></span>
	<?php } ?>
</div>

<div>
	<hr class="clear dotted spacing" />
	Copyright &copy; 2004-2005
</div>

<!-- END CUSTOMIZED STUFF -->

    <?php $this->html('reporttime') ?>
  </body>
</html>
<?php
	}
}

?>
