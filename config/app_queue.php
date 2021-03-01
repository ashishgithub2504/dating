<?php
/**
 * This file configures default behavior for all workers
 *
 * To modify these parameters, copy this file into your own CakePHP APP/Config directory.
 */

return [
	'Queue' => [
		// seconds to sleep() when no executable job is found
		'sleeptime' => 20,

		// probability in percent of a old job cleanup happening
		'gcprob' => 10,

		// time (in seconds) after which a job is requeued if the worker doesn't report back
		'defaultworkertimeout' => 1800,

		// number of retries if a job fails or times out.
		'defaultworkerretries' => 3,

		// seconds of running time after which the worker will terminate (0 = unlimited)
		'workermaxruntime' => 120,

		// seconds of running time after which the PHP process will terminate, null uses workermaxruntime * 100
		'workertimeout' => 120 * 100,

		// minimum time (in seconds) which a task remains in the database before being cleaned up.
		'cleanuptimeout' => 2592000, // 30 days

		// instruct a Workerprocess quit when there are no more tasks for it to execute (true = exit, false = keep running)
		'exitwhennothingtodo' => false,

		// false for DB, or deprecated string pid file path directory (by default goes to the app/tmp/queue folder)
		'pidfilepath' => false, // Deprecated: TMP . 'queue' . DS,

		// determine whether logging is enabled
		'log' => true,

		// set default Mailer class
		'mailerClass' => 'Cake\Mailer\Email',

		// set default datasource connection
		'connection' => null,

		// enable Search. requires friendsofcake/search
		'isSearchEnabled' => true,

		// enable Search. requires frontend assets
		'isStatisticEnabled' => false,
	],
];
