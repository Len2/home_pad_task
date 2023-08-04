<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomerServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function it_can_find_customer_by_id()
    {
        $customer = User::factory()->create([
            'role_name' => 'customer',
        ]);

        $customerService = new CustomerService();
        $foundCustomer = $customerService->findCustomerById($customer->id);

        $this->assertInstanceOf(\stdClass::class, $foundCustomer);
        $this->assertEquals($customer->id, $foundCustomer->id);
        $this->assertEquals('customer', $foundCustomer->role_name);
    }

    public function it_returns_null_when_customer_not_found()
    {
        $nonExistentCustomerId = 999;
        $customerService = new CustomerService();
        $foundCustomer = $customerService->findCustomerById($nonExistentCustomerId);
        $this->assertNull($foundCustomer);
    }
}
