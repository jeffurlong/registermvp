css:
	lessc -yui-compress  assets/less/www.less public_html/css/www.min.css
	lessc -yui-compress  assets/less/org.less public_html/css/org.min.css
	lessc -yui-compress  assets/less/admin.less public_html/css/admin.min.css

js:
	# == [ COMPILE ] ==================================================
	coffee -j tmp/build/app.js -c assets/coffee/app.coffee
	coffee -j tmp/build/app.admin.js -c assets/coffee/admin.coffee


	# == [ ORG ] ======================================================
	cat assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		tmp/build/app.js \
		> tmp/build/org.js

	uglifyjs -nc tmp/build/org.js > public_html/js/org.min.js

	# == [ ADMIN ] ====================================================
	cat assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		components/twitter/js/collapse.js \
        components/twitter/js/dropdown.js \
        components/twitter/js/modal.js \
        components/twitter/js/tooltip.js \
        components/twitter/js/popover.js \
        assets/js/bootstrap-wysihtml5-0.0.2.fork.js \
        components/growl/javascripts/jquery.growl.js \
        components/bootstrap-switch/static/js/bootstrap-switch.js \
		tmp/build/app.js \
		tmp/build/app.admin.js \
		> tmp/build/admin.js

	uglifyjs -nc tmp/build/admin.js > public_html/js/admin.min.js

	# == [ MODERNIZR ] ================================================
	uglifyjs -nc components/modernizr/modernizr.js > public_html/js/modernizr.min.js


