<?php

test('registration screen redirects to home', function () {
    $response = $this->get('/register');

    $response->assertRedirect('/');
});

test('new users cannot register via post', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/');
});
