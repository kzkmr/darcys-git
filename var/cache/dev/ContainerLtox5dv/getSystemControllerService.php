<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Eccube\Controller\Admin\Setting\System\SystemController' shared autowired service.

include_once $this->targetDirs[3].'/src/Eccube/Controller/Admin/Setting/System/SystemController.php';

return $this->services['Eccube\\Controller\\Admin\\Setting\\System\\SystemController'] = new \Eccube\Controller\Admin\Setting\System\SystemController(${($_ = isset($this->services['Eccube\\Service\\SystemService']) ? $this->services['Eccube\\Service\\SystemService'] : $this->load('getSystemServiceService.php')) && false ?: '_'});
