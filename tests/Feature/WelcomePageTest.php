<?php

it('renders the custom portfolio landing page', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('JJUUKO RONALD')
        ->assertSee('Connect With Me')
        ->assertSee('Selected Work')
        ->assertSee('Design Process')
        ->assertSee('Laravel Development');
});
