<?php

namespace Apiato\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * Class AbstractCodeStyle
 *
 * @package Apiato\Test
 */
class AbstractCodeStyle extends TestCase
{
    /**
     * Hold package name.
     *
     * @var string
     */
    protected string $packageName = 'ERP system';

    /**
     * Hold package license.
     *
     * @var string
     */
    protected string $packageLicense = 'MIT';

    /**
     * Hold package copyright.
     *
     * @var string
     */
    protected string $packageCopyright = 'Copyright (C) zemlechist.ru, All rights reserved.';

    /**
     * Hold package link.
     *
     * @var string
     */
    protected string $packageLink = 'https://zemlechist.ru';

    /**
     * Hold package author.
     *
     * @var string
     */
    protected string $packageAuthor = '';

    /**
     * Hold package description.
     *
     * @var array
     */
    protected array $packageDesc      = [
        'This file is part of the ERM system package.',
        'For the full copyright and license information, please view the LICENSE',
        'file that was distributed with this source code. Привет',
    ];

    /**
     * Hold line end.
     *
     * @var string
     */
    protected string $le = "\n";

    /**
     * Hold replace map.
     *
     * @var array
     */
    protected array $replace = [];

    /**
     * Ignore list for
     *
     * @var array
     */
    protected array $excludePaths = [
        '.git',
        '.idea',
        'bin',
        'bower_components',
        'build',
        'fonts',
        'fixtures',
        'logs',
        'node_modules',
        'resources',
        'vendor',
        'temp',
        'tmp',
    ];

    /**
     * Valid header for PHP files
     *
     * @var array
     */
    protected array $validHeaderPHP = [
        '<?php',
        '/**',
        ' * _PACKAGE_',
        ' *',
        ' * _DESCRIPTION_PHP_',
        ' *',
        ' * @license    _LICENSE_',
        ' * @copyright  _COPYRIGHTS_',
        ' * @link       _LINK_',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->replace = [
            '_LINK_'            => $this->packageLink,
            '_COPYRIGHTS_'      => $this->packageCopyright,
            '_PACKAGE_'         => $this->packageName,
            '_LICENSE_'         => $this->packageLicense,
            '_AUTHOR_'          => $this->packageAuthor,
            '_DESCRIPTION_PHP_' => implode($this->le . ' * ', $this->packageDesc),
        ];
    }

    /**
     * Test copyright headers of PHP files.
     */
    public function testHeadersPHP(): void
    {
        $valid = $this->prepareTemplate(implode($this->le, $this->validHeaderPHP));

        $finder = new Finder();
        $finder
            ->files()
            ->in($this->getProjectRoot())
            ->exclude($this->excludePaths)
            ->name('*.php');

        foreach ($finder as $file) {
            $content = $this->openFile($file->getPathname());
            $this->assertStringContainsString($valid, $content, 'File gas no valid header: ' . $file);
        }

        $this->assertTrue(true);
    }

    /**
     * Try to find cyrillic symbols in the code.
     */
    public function testCyrillic(): void
    {
        $finder = new Finder();

        $finder
            ->files()
            ->in($this->getProjectRoot())
            ->exclude($this->excludePaths)
            ->exclude('tests')
            ->notPath(basename(__FILE__))
            ->ignoreDotFiles(false);

        foreach ($finder as $file) {
            $content = $this->openFile($file->getPathname());
            if (preg_match('#[А-Яа-яЁё]#ius', (string) $content)) {
                $this->fail('File contains cyrillic symbols: ' . $file);
            } else {
                $this->assertTrue(true);
            }
        }

        $this->assertTrue(true);
    }


    /**
     * Get project root path.
     *
     * @return string
     */
    protected function getProjectRoot(): string
    {
        return realpath('.');
    }

    /**
     * Render copyrights
     *
     * @param string $text
     *
     * @return string
     */
    protected function prepareTemplate($text): string
    {
        foreach ($this->replace as $const => $value) {
            $text = str_replace($const, $value, $text);
        }

        return $text;
    }

    /**
     * Open file.
     *
     * @param $path
     *
     * @return bool|string|null
     */
    private function openFile($path)
    {
        $contents = null;

        if ($realPath = realpath($path)) {
            $fileSize = filesize($realPath);

            if ($fileSize > 0) {
                $handle = fopen($realPath, 'rb');
                $contents = fread($handle, $fileSize);
                fclose($handle);
            }
        }

        return $contents;
    }
}