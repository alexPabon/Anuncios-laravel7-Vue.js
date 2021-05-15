<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\models\Privilege;

class IndexUserTest extends TestCase
{
    use RefreshDatabase;
   
    /**
    * No Authenticate user
    *  @test */
    public function guest_users_can_not_see_users(){        

        // 2.When=>cuando hace un get request a thought
        $response = $this->get(route('user.index'));
                
        $response->assertRedirect('login');            
    }    


    /**
     * Authenticated user
     * is admin user
     * @test
     */
    public function a_admin_can_see_the_users(){

        $privilegeInvit = factory(Privilege::class)->create();
        $privilege = factory(Privilege::class)->create(
            [                
                'label'=>1000,
                'name'=>'administrador'
            ]
        );        
        
        $user = factory(User::class)->create(['privilege_id'=>2]);
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->get(route('user.index'));

        // dd($response->assertJson(['data']));

        $response->assertJson([            
            "data"=>[
                [],
                [
                    "id"=> $usersFactory->id,
                    "name"=> $usersFactory->name,
                    "phone"=> $usersFactory->phone,
                    "email"=> $usersFactory->email,                    
                    "privilege_id"=> "$usersFactory->privilege_id",                    
                    "privilege"=>[
                        "id"=> $privilegeInvit->id,
                        "label"=> $privilegeInvit->label,
                        "name"=> $privilegeInvit->name,                        
                    ]
                ]
            ]
        ]);

    }

    
    //  ============================== POLICIES ================================

    /**
     * _________________________________________________________________
     * Comprobano las policies
     * =================================================================
     * -Comprobar que el usuario autenticado como invitado, no puede ver otros usuarios
     * -Comprobar que el usuario autenticado como adminstrador, puede ver los otros usuarios
     * 
     * 
    */    

    /**
     * Authenticated user invited
     * @return status 403
     * @test
     */
    public function Authenticated_user_can_not_see_other_users(){

        $privilegeInvit = factory(Privilege::class)->create();               
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->get(route('user.index'));        

        $response->assertStatus(403);

    }

    /**
     * Authenticated user Admin
     * @return status 200
     * @test
     */
    public function Authenticated_user_Admin_see_other_users(){

        $privilegeInvit = factory(Privilege::class)->create([
            'id'=>2,
            'label'=>1000,
            'name'=>'administrador'
        ]);               
        
        $user = factory(User::class)->create(['privilege_id'=>2]);
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->get(route('user.index'));        

        $response->assertStatus(200);

    }

}
