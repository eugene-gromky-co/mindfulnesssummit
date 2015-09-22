jQuery('.popmake').on('popmakeInit', function(){

	//('console' in window) && ('log' in window.console) && window.console.log('fix ok');
	
	var $ = jQuery;
	
	var login = $('.popmake-login-form');
	var registration = $('.popmake-registration-form');
	var registration_form = $('form', registration);
	var login_form = $('form', login);
	var recovery = $('.popmake-recovery-form');

	// we want to be able to parse query_string
	var _get_param = function(p){
			var qs = document.location.search.substring(1).split('&');
			var _p = p+'=';
			var _p_len = _p.length;
			for (var i = 0; i < qs.length; i++)
				if (qs[i].substring(0, _p_len) == _p)
					return decodeURIComponent(qs[i].substring(_p_len));
		};

	// check if 'login' form should appear first
	var pop = _get_param('pop');
	switch (pop)
	{
		case 'login':
			recovery.hide();
			registration.hide();
			login.show();
			break;
		case 'reg':
			// same as default
		default:
			recovery.hide();
			login.hide()
			registration.show();
	}
	
	// prefill email address if any
	var email = _get_param('email');
	if (email) {
		login.find('[name=log]').val(email);
		registration.find('[name=user_email],[name=user_login]').val(email);
	};
	
	// hide some form elements, change labels for others
	registration.find('.registration-username label').text('Email');
	registration.find('.registration-email').hide();
	registration.find('.registration-password').hide();
	registration.find('.registration-confirm label').text('Password');
	login.find('.login-username label').text('Email');
	
	// fix titles
	var popmake_title = $('.popmake-title');
	var reg_title = 
		popmake_title.clone()
			.text('Register')
			.insertBefore( $('.popmake-registration-form>:first') )
		;
	var login_title =
		popmake_title.clone()
			.text('Log in')
			.insertBefore( $('.popmake-login-form>:first') )
		;
	var recovery_title =
		popmake_title.clone()
			.text('Password reset')
			.insertBefore( $('.popmake-recovery-form>:first') )
		;
	popmake_title.remove();
	
	// paragraph text (registration form)
	var paragraph_text =
			email
			? 'Please register below to view this content'
			: 'Welcome please register below to view this content'
	;
	$('<p>')
		.text(paragraph_text)
		.insertAfter(reg_title);

	// do not show the form if user is already registered one
	document.cookie.match('(?:^|;)\s*mindsummitreg=1\s*(?:;|$)') &&
		$('.popmake').popmake('close');
	
	// cheating with hidden elements: certain fields are filled
	// just before sending them to server
	var _old_serializer = $.fn.serializeObject;
	$.fn.serializeObject = function(){
		this.each(function(){
			var id = this.id || (('getAttribute' in this) && this.getAttribute('id'))
			if (id == 'ajax-registration-form') {
				this.user_email.value = this.user_login.value;
				this.user_pass.value = this.user_pass2.value;
			}
		});
		var o = _old_serializer.call(this);
		o.popmake_reg = 1;
		return o;
	};
	
});

