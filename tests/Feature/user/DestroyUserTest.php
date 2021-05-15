<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\models\Privilege;

class DestroyUserTest extends TestCase
{
    use RefreshDatabase;

      /**
    * No Authenticate user
    *  @test */
    public function guest_can_not_delete_user(){        
        
        // 2.When=>cuando hace un get request a thought
        $response = $this->delete(route('user.update',1));
        
        $response->assertRedirect('login');            
    }   

    /**
     * Authenticated user is admin
     * Un usuario administrador, puede eliminar otros perfiles
     * @test
     */
    public function admin_can_delete_other_user(){
        // Evitar que laravel maneje las excepciones
        $this->withoutExceptionHandling();
        

        $privilegeInvit = factory(Privilege::class)->create();        

        $privilege = factory(Privilege::class)->create(
            [                
                'label'=>1000,
                'name'=>'administrador'
            ]
        );
        
        // teniendo un usuario autenticado como administrador
        $user = factory(User::class)->create(['privilege_id'=>2]);
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->deleteJson(route('user.update',$usersFactory->id));                    

        $response->assertJson(['success'=>'Eliminado correcto']);

        $this->assertDatabaseMissing('users',[$usersFactory]);
    }

    /**
     * Authenticated user
     * Un usuario Authenticado, puede eliminar su perfil
     * @test
     */
    public function authenticated_user_can_delete_your_same_profile(){
        // Evitar que laravel maneje las excepciones
        $this->withoutExceptionHandling();
        
        $privilegeInvit = factory(Privilege::class)->create();                
        
        // teniendo un usuario autenticado como suscriptor
        $user = factory(User::class)->create();
        $this->actingAs($user);
                
        $response = $this->deleteJson(route('user.update',$user->id));                    

        $response->assertJson(['success'=>'Eliminado correcto']);

        $this->assertDatabaseMissing('users',[$user]);
    }

     //  ============================== POLICIES ================================

    /**
     * _________________________________________________________________
     * Comprobano las policies
     * =================================================================
     * -Comprobar que el usuario autenticado, no puede eliminar otro usuario 
     * 
     * 
    */    

    /**
     * Authenticated user
     * @return status 403
     * @test
     */
    public function Authenticated_user_can_not_delete_other_user(){

        $privilegeInvit = factory(Privilege::class)->create();               
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->deleteJson(route('user.update',$usersFactory->id)); 
        
        // dd($response->status());

        $response->assertStatus(403);

    }
}
