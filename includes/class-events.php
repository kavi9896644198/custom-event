<?php

class Plugin_events {

	protected $loader;

	protected $Plugin_events;

	protected $version;

	public function events_dashboard() {

		require_once EVENTS_PATH . '/includes/admin/event-dashboard.php';
		
	}

	public function add_events() {

		require_once EVENTS_PATH . '/includes/admin/add-event.php';
		
	}

	public function event_categories() {

		require_once EVENTS_PATH . '/includes/admin/event-categories.php';
		
	}

	public function event_frontPage() {

		require_once EVENTS_PATH . '/includes/admin/event-front-page.php';
		
	}

	public function event_manageevent() {

		require_once EVENTS_PATH . '/includes/admin/event-manage-event.php';
		
	}

	public function event_tags() {

		require_once EVENTS_PATH . '/includes/admin/event-tags.php';
		
	}

	// public function event_preview_page() {

	// 	require_once EVENTS_PATH . '/includes/admin/event-preview-page.php';
		
	// }

}