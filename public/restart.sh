#!/bin/bash

cd ..
composer dump-autoload
cd public
php -S localhost:3001