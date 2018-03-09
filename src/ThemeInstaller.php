<?php
/*
 * This file is part of the phpdish/theme-installer package.
 *
 * (c) Slince <taosikai@yeah.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPDish\ThemeInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class ThemeInstaller extends LibraryInstaller
{
    /**
     * 模板路径.
     *
     * @var string
     */
    const THEME_PATH = 'app/themes/';

    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $this->filesystem->ensureDirectoryExists(static::THEME_PATH);

        $name = $package->getPrettyName();

        $rootPackage = $this->composer->getPackage()->getConfig();
        if (isset($rootPackage['ignore-theme-vendor']) && true === $rootPackage['ignore-theme-vendor']) {
            list(, $name) = explode('/', $name, 2);
        }

        return  static::THEME_PATH.$name;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($packageType)
    {
        return 'phpdish-theme' === $packageType;
    }
}