<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 * '/getViewPreDelete/(?P<task_id>[0-9]+)/(?P<task_name>[a-zA-Z]+)' => 'application#getViewPreDelete',
 */
$routes = array(
	'/test' => 'test#index',
	'/'				=>  'application#getAllTasks',
	'/getAllTasks'  =>	'application#getAllTasks',
	'/getinsertform'	=>  'application#getViewInsertForm',
	'/createTask'		=>  'application#createTask',
	'/getViewPreDelete/:id' => 'application#getViewPreDelete',
	'/deleteTask/:id' => 'application#deleteTask',
	'/getupdateform/:id' => 'application#getViewUpdateForm',
	'/getupdateform/updateTask' => 'application#updateTask',
	'/getsearchform'	=>  'application#getViewSearchForm',
	'/getsearchresults'	=>  'application#getSearchResults',
);
