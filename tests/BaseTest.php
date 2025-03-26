<?php


namespace Tests;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BaseTest extends TestCase
{
    protected ?User $user= null;

    protected string $user_password= 'secret';
    protected bool $user_active= false;

    use DatabaseTransactions;

    protected array $connectionsToTransact = [
        "pgsql",
    ];

    public function setUp():void
    {
        parent::setUp();
        $this->user= User::factory()->create([
            'id'=> -8,
            'email'=> 'test@test.com',
            'password'=> bcrypt($this->user_password)
        ]);

    }

}
