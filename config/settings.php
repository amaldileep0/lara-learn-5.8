<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    |
    | Define the application's content manageable settings.
    |
    */

    'fields' => [
		'system-notification-primary' => [
			'type' => 'text',
			'label' => 'System Notification',
			'description' => 'Display a system notification to all logged in users.',
			'default' => ''
		],
		'system-notification-secondary' => [
			'type' => 'text',
			'label' => 'System Notification Secondary Text',
			'description' => 'Optionally add secondary text to the system notification.',
			'default' => ''
		],
	]
];
