<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Sepatu Sneakers',
            'description' => 'Nyaman dan stylish',
            'price' => 350000
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Sepatu Sneakers',
                'description' => 'Nyaman dan stylish',
                'price' => 350000,
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Sepatu Sneakers',
        ]);
    }

    /** @test */
    public function it_can_list_products()
    {
        Product::factory()->create([
            'name' => 'Produk A',
            'price' => 100000
        ]);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Produk A',
            ]);
    }

    /** @test */
    public function it_validates_product_creation()
    {
        $response = $this->postJson('/api/products', [
            'name' => '', // error: required
            'price' => 'bukan angka' // error: numeric
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price']);
    }
}
