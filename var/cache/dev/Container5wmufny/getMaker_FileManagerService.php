<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'maker.file_manager' shared service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\FileManager.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Util\\AutoloaderUtil.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\maker-bundle\\src\\Util\\ComposerAutoloaderFinder.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\filesystem\\Filesystem.php';

return $this->services['maker.file_manager'] = new \Symfony\Bundle\MakerBundle\FileManager(${($_ = isset($this->services['filesystem']) ? $this->services['filesystem'] : $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem()) && false ?: '_'}, new \Symfony\Bundle\MakerBundle\Util\AutoloaderUtil(new \Symfony\Bundle\MakerBundle\Util\ComposerAutoloaderFinder()), $this->targetDirs[3]);