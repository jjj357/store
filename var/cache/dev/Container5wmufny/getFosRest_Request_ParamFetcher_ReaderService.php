<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_rest.request.param_fetcher.reader' shared service.

include_once $this->targetDirs[3].'\\vendor\\friendsofsymfony\\rest-bundle\\Request\\ParamReaderInterface.php';
include_once $this->targetDirs[3].'\\vendor\\friendsofsymfony\\rest-bundle\\Request\\ParamReader.php';

return $this->services['fos_rest.request.param_fetcher.reader'] = new \FOS\RestBundle\Request\ParamReader(${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'});
