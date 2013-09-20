css:
	lessc -yui-compress  app/assets/less/www.less public_html/css/www.min.css
	lessc -yui-compress  app/assets/less/org.less public_html/css/org.min.css
	lessc -yui-compress  app/assets/less/admin.less public_html/css/admin.min.css

js:
	rm -Rf public_html/js/* tmp/build/*
	# == [ COMPILE ] ==================================================
	coffee -j tmp/build/app.js -c app/assets/coffee/app.coffee
	coffee -j tmp/build/app.admin.js -c app/assets/coffee/admin.coffee

	# == [ ORG ] ======================================================
	cat app/assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		tmp/build/app.js \
		> tmp/build/org.js

	uglifyjs -nc tmp/build/org.js > public_html/js/org.min.js

	# == [ ADMIN ] ====================================================
	cat app/assets/js/jquery.validate.js \
		components/twitter/js/transition.js \
		components/twitter/js/alert.js \
		components/twitter/js/button.js \
		components/twitter/js/collapse.js \
        components/twitter/js/dropdown.js \
        components/twitter/js/modal.js \
        components/twitter/js/tooltip.js \
        components/twitter/js/popover.js \
        app/assets/js/bootstrap-wysihtml5-0.0.2.fork.js \
        components/growl/javascripts/jquery.growl.js \
        components/bootstrap-switch/static/js/bootstrap-switch.js \
		tmp/build/app.js \
		tmp/build/app.admin.js \
		> tmp/build/admin.js

	uglifyjs -nc tmp/build/admin.js > public_html/js/admin.min.js

	# == [ wysihtml5 ] ================================================
	cp components/wysihtml5/dist/wysihtml5-0.3.0.min.js public_html/js/wysihtml5-0.3.0.min.js

	# == [ MODERNIZR ] ================================================
	cp app/assets/js/modernizr.custom.min.js public_html/js/modernizr.custom.min.js


