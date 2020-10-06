<?php

use \RalfHortt\Assets\Script;
use \RalfHortt\Assets\Style;

$assetsDistPath = get_template_directory_uri() . '/dist';
$moduleName = 'hello-world-module';

// Load modules assets if module is used
(new Script($moduleName . '-script', $assetsDistPath . '/js/modules/' . $moduleName . '.min.js', ['jquery'], true, true))->register();
(new Style($moduleName . '-style', $assetsDistPath . '/css/modules/' . $moduleName . '.min.css'))->register();
