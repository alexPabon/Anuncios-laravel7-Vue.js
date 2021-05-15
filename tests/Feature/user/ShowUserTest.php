<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\ResponseTrait;
use Tests\TestCase;

use App\User;
use App\models\Privilege;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    /**
    * No Authenticate user
    *  @test */
    public function guest_can_not_see_users(){        

        // 2.When=>cuando hace un get request a thought
        $response = $this->get(route('user.show',1));
                
        $response->assertRedirect('login');            
    }
    
    /**
     * Authenticated user
     * is admin user
     * @test
     */
    public function a_admin_can_see_other_user(){

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
        
        $response = $this->get(route('user.show',$usersFactory->id));

        // dd($response->assertJson([]));

        $response->assertJson([                          
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
        ]);
    }

     /**
     * Authenticated user
     * is invited user
     * @test
     */
    public function a_authenticated_user_can_see_your_same_profile(){

        $privilegeInvit = factory(Privilege::class)->create();                        
        
        $user = factory(User::class)->create();
        $this->actingAs($user);        
        
        $response = $this->get(route('user.show',$user->id));

        // dd($response->assertJson([]));

        $response->assertJson([                          
            "id"=> $user->id,
            "name"=> $user->name,
            "phone"=> $user->phone,
            "email"=> $user->email,                    
            "privilege_id"=> "$user->privilege_id",                    
            "privilege"=>[                
                "name"=> $privilegeInvit->name,                        
            ]                         
        ]);
    }


    //  ============================== POLICIES ================================

    /**
     * _________________________________________________________________
     * Comprobano las policies
     * =================================================================
     * -Comprobar que el usuario autenticado como invitado, no puede ver otro usuario
     * -Comprobar que el usuario autenticado como adminstrador, puede ver otro usuario
     * 
     * 
    */    

    /**
     * Authenticated user invited
     * @return status 403
     * @test
     */
    public function Authenticated_user_can_not_see_other_user(){

        $privilegeInvit = factory(Privilege::class)->create();               
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->get(route('user.show',$usersFactory->id));        

        $response->assertStatus(403);

    }

    /**
     * Authenticated user Admin
     * @return status 200
     * @test
     */
    public function admin_see_other_user(){

        $privilegeInvit = factory(Privilege::class)->create([
            'id'=>2,
            'label'=>1000,
            'name'=>'administrador'
        ]);               
        
        $user = factory(User::class)->create(['privilege_id'=>2]);
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->get(route('user.show',$usersFactory->id));        

        $response->assertStatus(200);

    }
}
