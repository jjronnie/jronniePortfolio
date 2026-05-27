<?php

it('renders the custom portfolio landing page', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Jjuuko Ronald')
        ->assertSee('Service')
        ->assertSee('About Me')
        ->assertSee('Get in Touch');
});
