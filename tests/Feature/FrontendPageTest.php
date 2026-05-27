<?php

use App\Models\User;

beforeEach(function () {
    $this->seed();
    $this->user = User::factory()->create();
});

it('loads the home page', function () {
    $this->get('/')->assertSuccessful();
});

it('loads the services page', function () {
    $this->get('/services')->assertSuccessful();
});

it('loads the projects page', function () {
    $this->get('/projects')->assertSuccessful();
});

it('redirects /work to /projects', function () {
    $this->get('/work')->assertRedirect('/projects');
});

it('redirects /register to /', function () {
    $this->get('/register')->assertRedirect('/');
});
