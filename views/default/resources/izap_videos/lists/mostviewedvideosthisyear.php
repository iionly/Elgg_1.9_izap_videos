<?php

/**
 * Most viewed videos this year
 *
 */

elgg_register_title_button('izap_videos', 'add', 'object', 'izap_videos');

$title = elgg_echo('collection:object:izap_videos:mostviewedthisyear');

elgg_push_collection_breadcrumbs('object', 'izap_videos');
elgg_push_breadcrumb($title);

$start = mktime(0, 0, 0, 1, 1, date("Y"));

$result = elgg_list_entities([
	'type' => 'object',
	'subtype' => IzapVideos::SUBTYPE,
	'metadata_name_value_pairs' => [
		[
			'name' => 'views',
			'value' => 0,
			'operand' => '>',
		],
		[
			'name' => 'last_viewed',
			'value' => $start,
			'operand' => '>=',
		],
	],
	'order_by_metadata' => [
		'name' => 'views',
		'direction' => 'DESC',
		'as' => 'integer',
	],
	'full_view' => false,
	'no_results' => elgg_echo('izap_videos:mostviewedthisyear:nosuccess'),
]);

$body = elgg_view_layout('content', [
	'filter' => '',
	'content' => $result,
	'title' => $title,
	'sidebar' => elgg_view('izap_videos/sidebar', ['page' => 'all']),
]);

// Draw it
echo elgg_view_page($title, $body);
