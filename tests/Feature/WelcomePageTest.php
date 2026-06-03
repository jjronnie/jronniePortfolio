<?php

it('renders the custom portfolio landing page', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Jjuuko Ronald')
        ->assertSee('Service')
        ->assertSee('About Me')
        ->assertSee('Projects');
});

it('renders the contact page with form', function () {
    $this->get('/contact')
        ->assertSuccessful()
        ->assertSee('Get in Touch')
        ->assertSee('Send a Message')
        ->assertSee('ronaldjjuuko7@gmail.com');
});
