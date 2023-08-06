<?php

$config = '';

/* Allow Webzash to authenticate with other third party systems */

Configure::write('Webzash.ThirdPartyLogin', FALSE);			/* TRUE / FALSE */
Configure::write('Webzash.ThirdPartyLoginSystem', '');			/* e.g. : 'Joomla' or 'JoomlalAuto' */

