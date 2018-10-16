<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'maker.auto_command.make_user' shared service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\console\\Command\\Command.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Command\\MakerCommand.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\MakerInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Maker\\AbstractMaker.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Maker\\MakeUser.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Security\\UserClassBuilder.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Security\\SecurityConfigUpdater.php';

$a = ${($_ = isset($this->services['maker.file_manager']) ? $this->services['maker.file_manager'] : $this->load('getMaker_FileManagerService.php')) && false ?: '_'};

$this->services['maker.auto_command.make_user'] = $instance = new \Symfony\Bundle\MakerBundle\Command\MakerCommand(new \Symfony\Bundle\MakerBundle\Maker\MakeUser($a, new \Symfony\Bundle\MakerBundle\Security\UserClassBuilder(), new \Symfony\Bundle\MakerBundle\Security\SecurityConfigUpdater()), $a, ${($_ = isset($this->services['maker.generator']) ? $this->services['maker.generator'] : $this->load('getMaker_GeneratorService.php')) && false ?: '_'});

$instance->setName('make:user');

return $instance;
