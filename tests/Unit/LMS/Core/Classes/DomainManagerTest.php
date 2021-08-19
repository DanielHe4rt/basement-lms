<?php


namespace Tests\Feature\LMS\Domain\Classes;


use Illuminate\Support\ServiceProvider;
use LMS\Auth\Domain;
use LMS\Core\Classes\DomainManager;
use LMS\Core\Contracts\DomainInterface;
use LMS\Core\Exceptions\DomainNotExistsException;
use Tests\TestCase;

class DomainManagerTest extends TestCase
{

    /**
     * @var DomainManager
     */
    private DomainManager $domainManager;

    public function setUp(): void
    {
        parent::setUp();
        $this->domainManager = DomainManager::instance();
    }


    public function test_must_normalize_classname_string()
    {
        $className = 'LMS\Core\Classes\DomainManager';
        $normalized_classname = $this->domainManager->normalizeClassName($className);
        $this->assertStringStartsWith('\\', $normalized_classname);
        $this->assertEquals('\LMS\Core\Classes\DomainManager', $normalized_classname);
        $this->assertEquals('\LMS\Core\Classes\DomainManager', $normalized_classname);
        $this->assertTrue(class_exists($normalized_classname));
    }

    public function test_must_return_class_name_if_is_object()
    {
        $normalized_classname = $this->domainManager->normalizeClassName($this->domainManager);
        $this->assertStringStartsWith('\\', $normalized_classname);
        $this->assertEquals('\LMS\Core\Classes\DomainManager', $normalized_classname);
        $this->assertTrue(class_exists($normalized_classname));
    }


    public function test_can_normalize_if_class_not_exists()
    {
        $normalized_classname = $this->domainManager->normalizeClassName('\Foo\Bar');
        $this->assertStringStartsWith('\\', $normalized_classname);
        $this->assertNotEquals('\LMS\Core\Classes\DomainManager', $normalized_classname);
        $this->assertFalse(class_exists($normalized_classname));
    }

    public function test_must_get_domain_namespaces_and_path(){
        $namespaces = $this->domainManager->getDomainNamespaces();
        $this->assertIsArray($namespaces);
        foreach ($namespaces as $namespace => $dir){
            $this->assertTrue(class_exists($namespace . '\Domain'));
            $this->assertDirectoryExists($dir);
        }
    }

    public function test_must_get_vendor_and_domain_names(){
        $domains = $this->domainManager->getVendorAndDomainNames();
        $this->assertIsArray($domains);
        $this->assertArrayHasKey('LMS', $domains);
    }


    public function test_must_domain_namespaces_and_correct_extends(){
        $namespaces = $this->domainManager->getDomainNamespaces();
        $this->assertIsArray($namespaces);
        foreach ($namespaces as $namespace => $dir){
            $this->assertTrue(class_exists($namespace . '\Domain'));
            $this->assertTrue(is_subclass_of($namespace . '\Domain', DomainInterface::class));
            $this->assertDirectoryExists($dir);
        }
    }


    public function test_must_load_domain_exists(){
        $obj = $this->domainManager->loadDomain('LMS\Auth','LMS/Auth/Domain.php');
        $this->assertIsObject($obj);
    }

    public function test_must_exception_load_domain_if_class_and_path_not_exists(){
        $this->expectError();
        $this->expectException(DomainNotExistsException::class);
        $this->domainManager->loadDomain('\Foo\Bar','/foo/bar');
    }

    public function test_must_exception_load_domain_if_path_not_exists(){
        $this->expectError();
        $this->expectException(DomainNotExistsException::class);
        $this->domainManager->loadDomain('LMS\Auth','/foo/bar');
    }

    public function test_must_exception_load_domain_if_class_not_exists(){
        $this->expectException(DomainNotExistsException::class);
        $this->domainManager->loadDomain('','LMS/Auth/Domain.php');
    }


    public function test_can_load_domain_if_class_disabled(){
        $class = new Domain(true);
        $obj = $this->domainManager->loadDomain($class,'LMS/Auth/Domain.php');
        $this->assertNull($obj);
    }

    public function test_can_get_providers(){
        $providers = $this->domainManager->getProviders();
        $this->assertIsArray($providers);

        foreach ($providers as $provider){
            $this->assertTrue(is_subclass_of($provider, ServiceProvider::class));
        }
    }

    public function test_can_get_identifier(){
        $identifier = $this->domainManager->getIdentifier(Domain::class);
        $this->assertEquals('LMS.Auth', $identifier);
    }

}
