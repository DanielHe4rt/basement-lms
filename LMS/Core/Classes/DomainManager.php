<?php

namespace LMS\Core\Classes;

use LMS\Core\Contracts\DomainInterface;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Log;


class DomainManager {

    use \LMS\Core\Traits\Singleton;

    const DIRECTORIES = [
        __DIR__ . "/../../"
    ];

    public array $domains = [];
    public bool $booted = false;
    public bool $registered = false;
    protected array $normalizedMap;
    protected array $pathMap;


    protected function init()
    {
        $this->loadDomains();
    }

    public function loadDomains(): array
    {
        /**
         * Locate all domains and binds them to the container
         */
        foreach ($this->getDomainNamespaces() as $namespace => $path) {
            $this->loadDomain($namespace, $path);
        }

        return $this->domains;
    }

    /**
     * Returns a flat array of vendor domain namespaces and their paths
     *
     * @return array
     */
    public function getDomainNamespaces(): array
    {
        $classNames = [];

        foreach ($this->getVendorAndDomainNames() as $vendorName => $vendorList) {
            foreach ($vendorList as $domainName => $domainPath) {
                $namespace = '\\'.$vendorName.'\\'.$domainName;
                $namespace = $this->normalizeClassName($namespace);
                $classNames[$namespace] = $domainPath;
            }
        }

        return $classNames;
    }

    private function normalizeClassName($name): string
    {
        if (is_object($name)) {
            $name = get_class($name);
        }

        return '\\'.ltrim($name, '\\');
    }

    /**
     * Returns a 2 dimensional array of vendors and their domains.
     *
     * @return array
     */
    public function getVendorAndDomainNames(): array
    {
        foreach (self::DIRECTORIES as $dir){
            $domains = [];
            $dirPath = realpath($dir);
            if (!File::isDirectory($dirPath)) {
                return $domains;
            }


            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
            );
            $it->setMaxDepth(1);
            $it->rewind();

            while ($it->valid()) {
                if ($it->isFile() && (strtolower($it->getFilename()) == "domain.php")) {
                    $filePath = dirname($it->getPathname());
                    $domainName = basename($filePath);
                    $vendorName = basename(dirname($filePath));
                    $domains[$vendorName][$domainName] = $filePath;
                }

                $it->next();
            }

            return $domains;
        }

    }

    /**
     * Loads a single domain into the manager.
     *
     * @param string $namespace Eg: Lms\Auth
     * @param string $path Eg: 'LMS/Auth';
     * @return void|DomainInterface
     */
    public function loadDomain(string $namespace, string $path)
    {
        $className = $namespace . '\Domain';

        try {
            // Not a valid domain!
            if (!class_exists($className)) {
                return;
            }

            /**
             * @var DomainInterface $classObj
             */
            $classObj = new $className();
        } catch (\Throwable $e) {
            Log::error('Domain ' . $className . ' could not be instantiated.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return;
        }

        $classId = $this->getIdentifier($classObj);

        /*
         * Check for disabled domains
         */
        if ($classObj->isDisabled()){
            return;
        }

        $this->domains[$classId] = $classObj;
        $this->pathMap[$classId] = $path;
        $this->normalizedMap[strtolower($classId)] = $classId;


        return $classObj;
    }

    /**
     * Resolves a domain identifier
     *
     * @param mixed Domain class name or object
     * @return string Identifier in format of Domain
     */
    public function getIdentifier($namespace): string
    {
        $namespace = $this->normalizeClassName($namespace);
        if (strpos($namespace, '\\') === null) {
            return $namespace;
        }

        $parts = explode('\\', $namespace);
        $slice = array_slice($parts, 1, 2);
        return implode('.', $slice);
    }



    public function getProviders(): array
    {

        $providers = [];
        /** @var DomainInterface $domainObj **/
        foreach ($this->domains as $domainObj) {
            $providers =  array_merge($providers, $domainObj->registerProvider());
        }

        return $providers;
    }

}
