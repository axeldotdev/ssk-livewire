<?php

use App\Models\User;

it('can get a token', function () {
    $user = User::factory()->withCurrentCompany()->create([
        'email' => 'axlecharpentier0@icloud.com',
    ]);

    $response = $this->postJson('/api/tokens/create', [
        'email' => $user->email,
        'password' => 'W544AW&t',
    ]);

    $response
        ->assertStatus(200)
        ->assertJsonStructure(['token']);

    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'name' => str($user->firstname . ' ' . $user->lastname)->slug()->__toString()
            . '_' . now()->format('Y-m-d H:i:s'),
    ]);
});
