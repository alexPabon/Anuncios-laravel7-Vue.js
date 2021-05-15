<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\models\Privilege;
use Illuminate\Support\Str;


class UpdateUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

     /**
    * No Authenticate user
    *  @test */
    public function guest_can_not_update_user(){        
        
        // 2.When=>cuando hace un get request a thought
        $response = $this->put(route('user.update',1));
        
        $response->assertRedirect('login');            
    }   

    /**
     * Authenticated user is admin
     * Un usuario administrador, puede actualizar otros perfiles
     * @test
     */
    public function admin_can_update_other_user(){
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

        $usersFactory = factory(User::class)->create([            
                            "name"=> 'nombre',
                            "phone"=> '555',
                            "email"=> 'example_email@gmail.com',                    
                            "privilege_id"=> 1, 
                        ]);
        
        $response = $this->putJson(route('user.update',$usersFactory->id),[            
                        "name"=> 'nombreUpdate',
                        "phone"=> '555444',
                        "email"=> 'example_update_email@gmail.com',                    
                        "privilege_id"=> 2, 
                    ]);                    

        $response->assertJson([            
            "name"=> 'nombreUpdate',
            "phone"=> '555444',
            "email"=> 'example_update_email@gmail.com',                    
            "privilege_id"=> 2, 
        ]);

        $this->assertDatabaseHas('users',[            
            "name"=> 'nombreUpdate',
            "phone"=> '555444',
            "email"=> 'example_update_email@gmail.com',                    
            "privilege_id"=> 2, 
        ]);
    }

    /**
     * Authenticated user
     * Un usuario Authenticado, puede actualizar su perfil
     * @test
     */
    public function authenticated_user_can_update_your_same_profile(){
        // Evitar que laravel maneje las excepciones
        $this->withoutExceptionHandling();
        

        $privilegeInvit = factory(Privilege::class)->create();        

        $privilege = factory(Privilege::class)->create(
            [                
                'label'=>1000,
                'name'=>'administrador'
            ]
        );
        
        // teniendo un usuario autenticado como suscriptor
        $user = factory(User::class)->create();
        $this->actingAs($user);
                
        $response = $this->putJson(route('user.update',$user->id),[            
                        "name"=> 'nombreUpdate',
                        "phone"=> '555444',
                        "email"=> 'example_update_email@gmail.com',                    
                        "privilege_id"=> 2, 
                    ]);                    

        $response->assertJson([            
            "name"=> 'nombreUpdate',
            "phone"=> '555444',
            "email"=> 'example_update_email@gmail.com',                    
            "privilege_id"=> 1, 
        ]);

        $this->assertDatabaseHas('users',[            
            "name"=> 'nombreUpdate',
            "phone"=> '555444',
            "email"=> 'example_update_email@gmail.com',                    
            "privilege_id"=> 1, 
        ]);
    }

     /**
     *______________________________________________________________________
     * Probando las reglas de validacion
     *======================================================================
     * por cada regla de validacion debemos crear un test
     * 
     * 'name'=>'required|min:3|max:255',
     * 'phone'=>'nullable|numeric|max:99999999999',
     * 'email'=>'required|email|max:255|unique:users',
     * 'privilege_id' => 'exists:privileges,id',
     * 
     * @return status 422
     *
    */

    /** ========================== name =============================== 
     * 
     * 'name'=>'required|min:3|max:255',
    */

    /**
     * name
     * required
     * @test */
    public function update_users_required_name(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=> '',                                    
                    ]);      

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'name'
            ]
        ]);
    }

    /**
     * name
     * minimum number of characters
     * min:3
     * @test */
    public function update_users_required_a_minimum_length(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=> 'pp',                                    
                    ]);      

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'name'
            ]
        ]);
    }

    /**
     * name
     * maximum number of characters
     * max:255
     * @test */
    public function update_users_required_a_maximum_length(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);    
        
        $textFaker = Str::random(256);
        
        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=> $textFaker,                                    
                    ]);      
        
                    
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'name'
            ]
        ]);
    }

    /** ========================== phone =============================== 
     * 
     * 'phone'=>'nullable|numeric|max:99999999999',
    */

    /**
     * phone
     * nullable
     * @test */
    public function update_users_nullable_phone(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> '', 
                        "email"=>$user->email,
                    ]);      
        
        // dd($response->content());

        $response->assertStatus(200);
       
    }

    /**
     * phone
     * numeric
     * @test */
    public function update_users_numeric_phone(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> '1a', 
                        "email"=>$user->email,                                   
                    ]);  
                    
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'phone'
            ]
        ]);
    }

    /**
     * phone
     * maximum number of digits
     * max:99999999999'
     * @test */
    public function update_users_maximum_digits_phone(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);           
        
        $numFaker = $this->faker()->numberBetween($min = 111111111111, $max = 999999999999);
        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> $numFaker, 
                        "email"=>$user->email,                                   
                    ]);      
        
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'phone'
            ]
        ]);
    }

    /** ========================== email =============================== 
     * 
     * 'email'=>'required|email|max:255|unique:users',
    */

    /**
     * email
     * required
     * @test */
    public function update_users_required_email(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create(); 
        
        $numFaker = $this->faker()->numberBetween($min = 11111111111, $max = 99999999999);
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create(['phone'=>$numFaker]);
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=>$user->phone, 
                        "email"=>'',
                    ]);      
        
                    
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'email'
            ]
        ]);
       
    }

    /**
     * email
     * email
     * @test */
    public function update_users_required_structureEmail_email(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create(); 
        
        $numFaker = $this->faker()->numberBetween($min = 11111111111, $max = 99999999999);
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create(['phone'=>$numFaker]);
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> $user->phone, 
                        "email"=>'unemail',                                   
                    ]);  
                    
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'email'
            ]
        ]);
    }

    /**
     * email
     * maximum number of characters
     * max:255
     * @test */
    public function update_users_maximum_char_email(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        $numFaker = $this->faker()->numberBetween($min = 11111111111, $max = 99999999999);
        $textFaker = Str::random(255);
        $emailFaker = $this->faker()->email();        
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create(['phone'=>$numFaker]);
        $this->actingAs($user);           
        
        
        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> $user->phone, 
                        "email"=>$textFaker.$emailFaker,                                   
                    ]);      
        
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'email'
            ]
        ]);
    }

    /**
     * email
     * unique
     * unique:users'
     * @test */
    public function update_users_unique_email(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create();                     
        
        $numFaker = $this->faker()->numberBetween($min = 11111111111, $max = 99999999999);                
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create(['phone'=>$numFaker]);
        $this->actingAs($user);           
        
        $userFactory = factory(User::class)->create();
        
        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=> $user->phone, 
                        "email"=>$userFactory->email,                                   
                    ]);      
        
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'email'
            ]
        ]);
    }

      /** ========================== privilege_id =============================== 
     * 
     * 'privilege_id' => 'exists:privileges,id',
    */

    /**
     * privilege_id
     * exists
     * @test */
    public function update_user_exists_privilege_id(){         

        // creando un privilegio
        $privilegeInvit = factory(Privilege::class)->create(); 
        
        $numFaker = $this->faker()->numberBetween($min = 11111111111, $max = 99999999999);
        
        // teniendo un usuario autenticado
        $user = factory(User::class)->create(['phone'=>$numFaker]);
        $this->actingAs($user);    
        

        $response = $this->putJson(route('user.update',$user->id),[
                        "name"=>$user->name,                        
                        "phone"=>$user->phone, 
                        "email"=>$user->email,
                        "privilege_id"=>'2',
                    ]);      
        
                    
        // dd($response->content());

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors'=>[
                'privilege_id'
            ]
        ]);
       
    }

    //  ============================== POLICIES ================================

    /**
     * _________________________________________________________________
     * Comprobano las policies
     * =================================================================
     * -Comprobar que el usuario autenticado, no puede actualizar otro usuario 
     * 
     * 
    */    

    /**
     * Authenticated user
     * @return status 403
     * @test
     */
    public function Authenticated_user_can_not_update_other_user(){        

        $privilegeInvit = factory(Privilege::class)->create();               
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $usersFactory = factory(User::class)->create();
        
        $response = $this->putJson(route('user.update',$usersFactory->id),[
                        "name"=>$user->name,                        
                        "phone"=>'989999', 
                        "email"=>$usersFactory->email,                        
                    ]); 
        
        // dd($response->status());

        $response->assertStatus(403);

    }

}
