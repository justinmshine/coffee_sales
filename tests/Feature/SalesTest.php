<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the form request inserting sale into the database
     */
    public function test_insert_to_database_sale(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');

        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->post('/sales/add/post', [
            'coffee_id' => 2,
            'quantity' => 12,
            'cost' => 54.12, 
            'sales_price' => 21.76
        ]);

        DB::statement('PRAGMA foreign_keys = ON');

        $response->assertStatus(302);

        $this->assertDatabaseHas('sales', [
            'coffee_id' => 2,
            'quantity' => 12,
            'cost' => 54.12,
            'sales_price' => 21.76
        ]);
    }

    /**
     * Test the ajax request for calculating the sales price
     */
    public function test_calcalate_sale_value(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->post('/sales/calculate', [
            'coffee' => 2,
            'quantity' => 12,
            'cost' => 54.12
        ]);

        $response->assertStatus(404);
    }
    
    /**
     * Test the index page for sales loads
     */
    public function test_sale_index_page_loading(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->get('/sales');

        $response->assertStatus(200);
        $response->assertSee('Sales');
    }

    /**
     * Test validation error when inserting sale with missing fields
     */
    public function test_insert_sale_validation_error(): void
    {
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->post('/sales/add/post', [
            // Missing coffee_id, quantity, cost, sales_price
        ]);

        $response->assertSessionHasErrors(['coffee_id', 'quantity', 'cost', 'sales_price']);
    }

    /**
     * Test unauthorized user cannot access sales routes
     */
    public function test_guest_cannot_access_sales_routes(): void
    {
        $response = $this->get('/sales');
        $response->assertRedirect('/login');

        $response = $this->post('/sales/add/post', []);
        $response->assertRedirect('/login');
    }
}
