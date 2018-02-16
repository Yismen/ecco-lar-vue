<?php


class NoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visitRoute('admin.notes.index')
             ->see('Welcome');
        // $response = $this->call('GET', '/admin/users')
        //      ->see('Filter');
    }
}
