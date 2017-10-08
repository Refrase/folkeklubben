The project is using Webpack for hot-reloading and compiling the Vue frontend layer.
The webpack-dev-server is additionally configured to proxy to the MAMP server responsible for serving the html from the php-files - as well as data from the WordPress JSON API for the Vue-files to fetch with vue-resource.

Environment inspired by:
https://codeburst.io/using-vue-js-components-in-php-applications-e5bfde8763bc and
https://deliciousbrains.com/creating-a-wordpress-theme-using-the-rest-api-and-vue-js/

Running development environment:
- npm run dev + start MAMP servers
- configure Apache (through MAMP) to use port 3000 and visit localhost:3000 (which is the port webpack-dev-server is set to proxy to)

Preparing for production:
- npm run build
- uncomment code under '// PROD' and comment out code under '// DEV' in functions.php
