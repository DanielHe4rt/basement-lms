<?php

namespace LMS\Core\Classes;

use LMS\Core\Contracts\DomainInterface;
use LMS\Core\Exceptions\DomainNotExistsException;
use LMS\Core\Exceptions\DomainExtendException;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use Illuminate\Support\Str;


class DomainManager {

    use \LMS\Core\Traits\Singleton;

    public array $domains = [];
    public bool $booted = false;
    public bool $registered = false;
    protected array $normalizedMap;
    protected array $pathMap;


    /**
     * @codeCoverageIgnore
     */
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

    public function normalizeClassName($name): string
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
        $dir = __DIR__ . "/../../";
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

    /**
     * Loads a single domain into the manager.
     *
     * @param string|object $namespace Eg: Lms\Auth
     * @param string $path Eg: 'LMS/Auth';
     * @return void|DomainInterface
     * @throws DomainNotExistsException
     * @throws DomainExtendException
     */
    public function loadDomain($namespace, string $path)
    {
        $class = $this->getDomainClassName($namespace);

        // Not a valid domain!
        if (is_string($class) && !class_exists($class)) {
            throw new DomainNotExistsException('Domain ' . $class . ' could not be instantiated.');
        }

        if(realpath($path) === false){
            throw new DomainNotExistsException('Path ' . $path . ' not exists.');
        }

        if(!is_subclass_of($class, DomainInterface::class)){
            throw new DomainExtendException('The domain must extend the abstract class \LMS\Core\Contracts\DomainInterface');
        }


        if(!is_object($class)){
            /**
             * @var DomainInterface $classObj
             */
            $class = new $class();
        }

        $classId = $this->getIdentifier($class);
        /*
         * Check for disabled domains
         */
        if ($class->isDisabled()){
            return;
        }

        $this->domains[$classId] = $class;
        $this->pathMap[$classId] = $path;
        $this->normalizedMap[strtolower($classId)] = $classId;


        return $class;
    }

    /**
     * @param object|string $class
     * @return string|object
     */
    private function getDomainClassName($class)
    {
        if(is_object($class)){
            return $class;
        }

        if(is_string($class)  && !Str::endsWith($class, 'Domain')){
            return $class . '\Domain';
        }


        return $class;
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


    /**
     * @return array
     */
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
