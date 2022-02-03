<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

namespace App\Ship\Commands;

use Illuminate\Support\Facades\Storage;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class LanguageFormatter
 *
 * @package App\Ship\Commands
 */
class LanguageFormatter extends ConsoleCommand
{
    private const TAB = '    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Format language files.';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:format';

    /**
     * Hold actual process total value.
     *
     * @var int
     */
    protected int $totalProcess = 0;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->processShipLanguages();
        $this->processSectionContainerLanguages();

        if ($this->totalProcess <= 0) {
            $this->info('No find any languages files');
        } else {
            $this->info('Find and process ' . $this->totalProcess . ' language locales');
        }
    }

    /**
     * Encode data.
     *
     * @param   array $data
     *
     * @return  string
     */
    protected function encode(array $data): string
    {
        $data = [
            '<?php',
            '',
            'return ' . $this->render($data, 0) . ';',
            ''
        ];

        return implode(PHP_EOL, $data);
    }

    /**
     * Find ad sort languages locales.
     *
     * @param   string $languagePath
     * @param   null $onSuccessCallback
     */
    protected function findAndSortLocales(string $languagePath, $onSuccessCallback = null): void
    {
        $pathStorage = Storage::build($languagePath);
        $languages   = $pathStorage->directories();
        foreach ($languages as $language) {
            foreach ($pathStorage->files($language) as $langLocaleFile) {
                $langFile = $languagePath . '/' . $langLocaleFile;
                if (is_file($langFile)) {
                    /** @noinspection PhpIncludeInspection */
                    $locales = require_once $langFile;
                    if (is_array($locales)) {
                        ksort($locales, SORT_NATURAL);
                        $pathStorage->put($langLocaleFile, $this->encode($locales));
                        if (is_callable($onSuccessCallback)) {
                            call_user_func($onSuccessCallback, $langLocaleFile);
                        } else {
                            $this->line('Success process file is ' . $langFile);
                        }
                    }
                }
            }
        }
    }

    /**
     * Get index.
     *
     * @param   int $depth
     *
     * @return  string
     */
    protected function getIndent($depth): string
    {
        return str_repeat(self::TAB, $depth);
    }

    /**
     * Find and process section container languages.
     *
     * @return  void
     */
    protected function processSectionContainerLanguages(): void
    {
        foreach (Apiato::getSectionNames() as $sectionName) {
            foreach (Apiato::getSectionContainerNames($sectionName) as $containerName) {
                $path = base_path('app/Containers/' . $sectionName . '/' . $containerName . '/Resources/Languages');
                if (is_dir($path)) {
                    $this->findAndSortLocales($path, function ($langLocaleFile) use ($sectionName, $containerName) {
                        $this->line('Success process of ' . implode(null, [
                            $sectionName,
                            '@',
                            $containerName,
                            '::',
                            $langLocaleFile
                        ]));

                        $this->totalProcess++;
                    });
                }
            }
        }
    }

    /**
     * Find and process ship languages.
     *
     * @return  void
     */
    protected function processShipLanguages(): void
    {
        $path = base_path('app/Ship/Resources/Languages');
        if (is_dir($path)) {
            $this->findAndSortLocales($path, function ($langLocaleFile) {
                $this->line('Success process of ship::' . $langLocaleFile);
                $this->totalProcess++;
            });
        }
    }

    /**
     * Quote wrap.
     *
     * @param   string $var
     *
     * @return  string
     */
    protected function quoteWrap($var): string
    {
        $type = strtolower(gettype($var));

        switch ($type) {
            case 'string':
                return "'" . str_replace("'", "\\'", $var) . "'";

            case 'null':
                return 'null';

            case 'boolean':
                return $var ? 'true' : 'false';

            //TODO: handle other variable types.. ( objects? )
            case 'integer':
            case 'double':
        }

        return $var;
    }

    /**
     * Render action.
     *
     * @param   array $array
     * @param   int $depth
     *
     * @return  string
     */
    protected function render(array $array, $depth = 0): string
    {
        $data   = (array) $array;
        $string = '[' . PHP_EOL;

        $depth++;
        foreach ($data as $key => $val) {
            $string .= $this->getIndent($depth) . $this->quoteWrap($key) . ' => ';
            if (is_array($val) || is_object($val)) {
                $string .= $this->render($val, $depth) . ',' . PHP_EOL;
            } else {
                $string .= $this->quoteWrap($val) . ',' . PHP_EOL;
            }
        }

        $depth--;
        $string .= $this->getIndent($depth) . ']';

        return $string;
    }
}
