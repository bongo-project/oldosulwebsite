<?php
include('simplepie.inc');


$wgExtensionFunctions[] = 'wfFeedParser';
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'Feed Parser',
	'description' => 'Uses SimplePie to output RSS/atom feeds',
	'author' => 'Jonny Lamb',
	'url' => 'http://jonnylamb.com'
);

function wfFeedParser()
{
	global $wgParser;
	$wgParser->setHook('feed', 'parseFeed');
}

function parseFeed($input, $args)
{
	if (!isset($args['url']) or !isset($input))
	{
		return 0;
	}
	$feed = new SimplePie();
	$feed->feed_url($args['url']);
	$feed->init();

	$feed->handle_content_type();

	if (isset($args['date']))
	{
		$date = $args['date'];
	}
	else
	{
		$date = 'j F Y';
	}

	$o = '';
	if (isset($args['entries']))
	{
		$max = $feed->get_item_quantity($args['entries']);
	}
	else
	{
		$max = $feed->get_item_quantity(5);
	}
	
	for ($i = 0; $i < $max; $i++)
	{
		$item = $feed->get_item($i);

		$itemhtml = $input;
		$itemhtml = str_replace('{PERMALINK}', $item->get_permalink(), $itemhtml);
		$itemhtml = str_replace('{DATE}', $item->get_date($date), $itemhtml);

		if ($args['type'] == 'planet')
		{
			$title = preg_replace('/(.*): (.*)/sU', '\\2', $item->get_title());
			preg_match('/(.*): (.*)/sU', $item->get_title(), $matches);
			$author = $matches[1];
		}
		else
		{
			$title = $item->get_title();
			if ($item->get_author() instanceof Author)
			{
				$author = $item->get_author()->get_name();
			}
		}

		$itemhtml = str_replace('{TITLE}', $title, $itemhtml);
		$itemhtml = str_replace('{AUTHOR}', $author, $itemhtml);

		$o .= $itemhtml;


	}
	return $o;
}

?>
