<?php

namespace Codelight\GDPR\Components\DoNotSell;

class DoNotSell {

	public function __construct() {
		 add_filter( 'gdpr/admin/tabs', array( $this, 'registerAdminTab' ), 36 );
	}

	public function registerAdminTab( $tabs ) {
		 $tabs['do-not-sell'] = gdpr()->make( AdminTabDoNotSell::class );
		return $tabs;
	}
}
