css:
	lessc -yui-compress  assets/less/www.less public_html/css/www.min.css
	lessc -yui-compress  assets/less/org.less public_html/css/org.min.css
	lessc -yui-compress  assets/less/admin.less public_html/css/admin.min.css

js:
	coffee -j tmp/build/app.js -c assets/coffee/app.coffee

	uglifyjs -nc components/modernizr/modernizr.js > public_html/js/modernizr.min.js

	cat assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		tmp/build/app.js \
		> tmp/build/org.js

	uglifyjs -nc tmp/build/org.js > public_html/js/org.min.js

	cat assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		components/twitter/js/collapse.js \
        components/twitter/js/dropdown.js \
        components/twitter/js/modal.js \
        components/twitter/js/tooltip.js \
        components/twitter/js/popover.js \
		tmp/build/app.js \
		> tmp/build/admin.js
	uglifyjs -nc tmp/build/admin.js > public_html/js/admin.min.js

	cat components/wysihtml5/parser_rules/advanced.js \
		components/wysihtml5/dist/wysihtml5-0.3.0.js \
		> tmp/build/wysihtml5.js
	uglifyjs -nc tmp/build/wysihtml5.js > public_html/js/wysihtml5.min.js

