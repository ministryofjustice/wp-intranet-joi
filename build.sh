#!/bin/bash
set -e

###
# Build Script
# Use this script to build theme assets,
# and perform any other build-time tasks.
##

# Clean up the working directory (useful when building from local dev files)
if [ -d ".git" ]
then
	git clean -xdf
fi

# Add composer auth file
if [ ! -z $COMPOSER_USER ] && [ ! -z $COMPOSER_PASS ]
then
	cat <<- EOF >> auth.json
		{
			"http-basic": {
				"composer.wp.dsd.io": {
					"username": "$COMPOSER_USER",
					"password": "$COMPOSER_PASS"
				}
			}
		}
	EOF
fi

# Install PHP dependencies (WordPress, plugins, etc.)
composer install

# Remove composer auth.json
rm -f auth.json
