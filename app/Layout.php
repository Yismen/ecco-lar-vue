<?php

namespace App;
/**
* Control the curren layout
*/
class Layout
{
	private $site = 'site';
	private $app = 'app';

	/**
	 * Allows to access a property of the class
	 * @param  strill $property the name of the property to be accessed.
	 * @return string         the value of the property
	 */
	public function getProperty($property)
	{
		return $this->$property;
	}

	/**
	 * returns current value of site property. Allows for override optionally.
	 * @param  string $site new name of the site's layout. can be null o be overridden.
	 * @return string       site's name
	 */
	public function site($site = null)
	{
		if ($site) {
			$this->site = $site;
		}

		return $this->site;
	}

	/**
	 * returns current value of app property. Allows for override optionally.
	 * @param  string $app new name of the app's layout. can be null o be overridden.
	 * @return string       app's name
	 */
	public function app($app = null)
	{
		if ($app) {
			$this->app = $app;
		}

		return $this->app;
	}

	
	
}