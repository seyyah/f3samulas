<?php

// Use the Fat-Free Framework
require_once 'lib/F3.php';

F3::set('RELEASE',FALSE);

// Use custom 404 page
F3::set('E404','layout.htm');

// Path to our Fat-Free import files
F3::set('IMPORTS','inc/');

// Path to our CAPTCHA font file
F3::set('FONTS','fonts/');

// Path to our templates
F3::set('GUI','gui/');

F3::mset(
	array(
		'site'=>'Kullanıcı Veritabanı'
	)
);

// Common inline Javascript
F3::set('extlink','window.open(this.href); return false;');

// Define our main menu; this appears in all our pages
F3::set('menu',
	array_merge(
		array(
			'Ana sayfa'=>'/'
		),
		// Toggle login/logout menu option
		F3::get('SESSION.user')?
			array(
				'Kaydı Güncelle'=>'/update',
				'Hakkında'=>'/about',
				'Çıkış'=>'/logout'
			):
			array(
				'Yeni Kayıt'=>'/new',
				'Kaydı Güncelle'=>'/login'
			)
	)
);

F3::route('GET /',':home');

// Minify CSS; and cache page for 60 minutes
F3::route('GET /min',':minified',3600);

F3::route('GET /about',':about',3600);

// This is where we display the login page
F3::route('GET /login',':login',3600);
	// This route is called when user submits login credentials
	F3::route('POST /login',':auth');

// Logout
F3::route('GET /logout',':logout');

// RSS feed
F3::route('GET /rss',':rss');

// Generate CAPTCHA image
F3::route('GET /captcha',':captcha');

// Execute application
F3::run();

function render() {
	// layout.htm is located in the directory pointed to by the Fat-Free
	// GUI global variable
	echo F3::serve('layout.htm');
}

?>
