<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_api_doc.describers.swagger_php.default' shared service.

include_once $this->targetDirs[3].'\\vendor\\nelmio\\api-doc-bundle\\Describer\\ModelRegistryAwareInterface.php';
include_once $this->targetDirs[3].'\\vendor\\nelmio\\api-doc-bundle\\Describer\\ModelRegistryAwareTrait.php';
include_once $this->targetDirs[3].'\\vendor\\nelmio\\api-doc-bundle\\Describer\\SwaggerPhpDescriber.php';

return $this->services['nelmio_api_doc.describers.swagger_php.default'] = new \Nelmio\ApiDocBundle\Describer\SwaggerPhpDescriber(${($_ = isset($this->services['nelmio_api_doc.routes.default']) ? $this->services['nelmio_api_doc.routes.default'] : $this->load('getNelmioApiDoc_Routes_DefaultService.php')) && false ?: '_'}, ${($_ = isset($this->services['nelmio_api_doc.controller_reflector']) ? $this->services['nelmio_api_doc.controller_reflector'] : $this->load('getNelmioApiDoc_ControllerReflectorService.php')) && false ?: '_'}, ${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'}, ${($_ = isset($this->services['logger']) ? $this->services['logger'] : $this->getLoggerService()) && false ?: '_'});
