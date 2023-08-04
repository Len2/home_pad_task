<?php
namespace Tests\Unit;

use App\Models\User;
use App\Services\PackageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageServiceTest extends TestCase
{
use RefreshDatabase, WithFaker;

public function testGetPackages()
{
    $this->seed();
    $packageService = new PackageService();

    $packages = $packageService->getPackages();
    $this->assertNotEmpty($packages);
}

public function testFindPackageById()
{
    $this->seed();
    $packageService = new PackageService();

    $packageId = 1;
    $package = $packageService->findPackageById($packageId);
    $this->assertNotNull($package);
    $this->assertEquals($packageId, $package->id);
}

    public function test_create_package_with_unauthorized_user()
    {
        $user = User::factory()->create(['role_name' => 'some_other_role']);
        $this->actingAs($user);
        $requestData = [
            'name' => 'Test Package',
            'limit' => 5,
        ];
        $response = $this->postJson('/api/packages/create', $requestData);
        $response->assertStatus(403);
        $response->assertJson(['errors' => "You don't have permission to create package"]);
    }

    public function test_create_package_with_valid_data()
    {
        $user = User::factory()->create(['role_name' => 'sales']);
        $this->actingAs($user);
        $requestData = [
            'name' => 'Test Package',
            'limit' => 5,
        ];
        $response = $this->postJson('/api/packages/create', $requestData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('packages', $requestData);
    }



}
