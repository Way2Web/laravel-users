<?php
	return [
        "message" => "Welcome to the Source Users Manager package",
        
        /**
         * Multiple roles per user
         */
        'multiple' => false,

        /**
         * Set the default role when a user register with the entrance package
         * @string
         */
        'default_role' => 'admin',

        /**
         * Prefix your url (The route would look something like this 'cms/users')
         *
         * @note add a '/' at the end of the prefix
         */
        'prefix' => 'cms/',

        /**
         * Add all the roles that have access to the users table and role table
         */
        'middleware' => ['checklogin', 'sourceOrAdmin'],
	];