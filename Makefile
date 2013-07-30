css:
	lessc -yui-compress  assets/less/www.less public_html/css/www.min.css
	lessc -yui-compress  assets/less/org.less public_html/css/org.min.css

js:
	coffee -j tmp/build/app.js -c assets/coffee/app.coffee

	uglifyjs -nc components/modernizr/modernizr.js > public_html/js/modernizr.min.js

	cat components/jquery/jquery.validate.js \
		components/bootstrap/js/transition.js \
		components/bootstrap/js/alert.js \
		components/bootstrap/js/button.js \
		tmp/build/app.js \
		> tmp/build/org.js
	uglifyjs -nc tmp/build/org.js > public_html/js/org.min.js
