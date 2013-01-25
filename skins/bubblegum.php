<?php
/**
 * Bubblegum skin
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
class SkinBubblegum extends SkinTemplate {
        function initPage( &$out ) {
                SkinTemplate::initPage( $out );
                $this->skinname  = 'bubblegum';
                $this->stylename = 'bubblegum';
                $this->template  = 'bubblegumTemplate';
        }
}

/**
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class bubblegumTemplate extends QuickTemplate {
        /**
         * @access private
         */
        function execute() {
                // Suppress warnings to prevent notices about missing indexes in $this->data
                wfSuppressWarnings();

?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
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
    <style type="text/css" media="screen">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/style.css"; @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/widgets.css"; /*]]>*/</style>
    <style type="text/css" media="print">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/print.css"; /*]]>*/</style>
    <?php if($this->data['jsvarurl'  ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl'  ) ?>"></script><?php } ?>
    <script type="<?php $this->text('jsmimetype') ?>" src="<?php                                   $this->text('stylepath' ) ?>/common/wikibits.js"></script>
    <?php if($this->data['usercss'   ]) { ?><style type="text/css"><?php              $this->html('usercss'   ) ?></style><?php    } ?>
    <?php if($this->data['userjs'    ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs'    ) ?>"></script><?php } ?>
    <?php if($this->data['userjsprev']) { ?><script type="<?php $this->text('jsmimetype') ?>"><?php      $this->html('userjsprev') ?></script><?php   } ?>
    <?php if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
  </head>
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['body_onload'    ]) { ?>onload="<?php     $this->text('body_onload')     ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>>
	<div id="bg">
		<!-- Header image -->
		<a href="/Welcome_to_Bongo!" class="noborder"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/bongo-small.png" alt="Bongo logo" class="logo" /></a>
		<img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/bongo-small-bw.png" alt="Bongo logo (print)" class="printlogo" />

		<!-- Navigation bar -->
		<div id="header" style="margin-bottom: 1em; background-color: #d1e8ff; border: 1px solid #729fcf;">
			<div id="padder" style="text-align: center;">
				<table style="border: 0px none; margin: auto; text-align: center;">
				<tr>
					<td class="navitem"><a href="/Welcome_to_Bongo!"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/go-home.png" alt=""><br />Home</a></td>
					<td class="navitem"><a href="/Installation"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/go-down.png" alt=""><br />Installation</a></td>
					<td class="navitem"><a href="/FAQ"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/help-faq.png" alt=""><br />FAQ</a></td>
					<td class="navitem"><a href="/Documentation"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/help-contents.png" alt=""><br />Documentation</a></td>
					<td class="navitem"><a href="/Getting_Involved"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/applications-accessories.png" alt=""><br />Get Involved</a></td>
					<td class="navitem"><a href="/Team"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/applications-development.png" alt=""><br />Team</a></td>
				</tr>
				</table>
			</div>
		</div>

		<!-- Main content -->
		<div id="content">
		<div id="mcontent">

		<!-- Userbar -->
		<div id="actions">
			<?php foreach($this->data['content_actions'] as $key => $action) {
			?><a href="<?php echo htmlspecialchars($action['href']) ?>" <?php if($action['class']) { ?>class="<?php echo htmlspecialchars($action['class']) ?>"<?php } ?>><?php echo htmlspecialchars($action['text']) ?></a> &middot; <?php } ?>
		</div>

		<!-- Content -->
		<h1><?php $this->text('title') ?></h1>
		<div id="contentSub"><?php $this->html('subtitle') ?></div>
		
		<div id="cnt">
			<?php $this->html('bodytext') ?>
			<?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
		</div>
	
		<div id="userbar">
			<?php foreach($this->data['personal_urls'] as $key => $item)  {
				?><a href="<?php
			        echo htmlspecialchars($item['href']) ?>"<?php
			        if(!empty($item['class'])) { ?> class="<?php
			        echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
			        echo htmlspecialchars($item['text']) ?></a> &middot; <?php
			} ?>
		</div>
		
		</div>
		</div>
	</div>
		
	<div id="footer">
		<?php if($this->data['lastmod'   ]) { ?><?php    $this->html('lastmod')    ?><?php } ?>
          <?php if($this->data['viewcount' ]) { ?><?php  $this->html('viewcount')  ?> <br /><br /><?php } ?>
Hosted by <a href="http://osuosl.org/">OSL</a> and <a href="https://www.gna.org">GNA!</a>. Copyright &copy; 2007 Bongo Project, All rights reserved. <br />The text and associated diagrams on this page are available under the terms of the <a  href="http://www.gnu.org/licenses/fdl.txt">GNU Free Documentation License</a>.<br />Icons used on this website are from <a href="http://tango-project.org">The Tango Project</a> and GNOME icon theme.<br />

		<p class="buttons"><a href="http://validator.w3.org/check?uri=referer" class="noborder"><img src="http://mediati.org/neu-style/valid-xhtml.png"  alt="Valid XHTML 1.1!" height="15" width="80" /></a>&nbsp;<a href="http://jigsaw.w3.org/css-validator/check/referer" class="noborder"><img src="http://mediati.org/neu-style/valid-css.png" alt="Valid CSS!" height="15" width="80" /></a></p>
	</div>
</body>
</html>
<?php
        wfRestoreWarnings();
        }
}
?>
