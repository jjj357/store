<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'serializer.mapping.class_metadata_factory' shared service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Factory\\ClassMetadataFactoryInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Factory\\ClassResolverTrait.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Factory\\ClassMetadataFactory.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Loader\\LoaderInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Loader\\LoaderChain.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\serializer\\Mapping\\Loader\\AnnotationLoader.php';

return $this->services['serializer.mapping.class_metadata_factory'] = new \Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory(new \Symfony\Component\Serializer\Mapping\Loader\LoaderChain(array(0 => new \Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader(${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'}))), NULL);
