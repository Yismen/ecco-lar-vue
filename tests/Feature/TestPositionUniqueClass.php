<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestPositionUniqueClass extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTheNameIsTotallyNew()
    {
        // Tests
        // if the name does not exists in the db
        // return true
        // the name exists in the db
        // return true if
        // the row found for this name contains the same department as the one passed
        // there is no record containing the same department passed
        // return false if
        // there is another record with the same name, different department, and different record
        $this->assertTrue(true);
    }
}
