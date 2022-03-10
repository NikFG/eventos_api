<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $usuario = Role::create(['name' => 'usuario', 'guard_name' => 'api']);
        $associado = Role::create(['name' => 'associado', 'guard_name' => 'api']);
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        Role::create(['name' => 'super-admin', 'guard_name' => 'api']);

        $g_usuario = Permission::create(['name' => 'gerenciar_usuario', 'guard_name' => 'api']);


        $v_certificado = Permission::create(['name' => 'visualizar_certificado', 'guard_name' => 'api']);
        $g_certificado = Permission::create(['name' => 'gerenciar_certificado', 'guard_name' => 'api']);


        $e_evento = Permission::create(['name' => 'entrar_evento', 'guard_name' => 'api']);
        $g_evento = Permission::create(['name' => 'gerenciar_evento', 'guard_name' => 'api']);


        $c_instituicao = Permission::create(['name' => 'cadastrar_instituicao', 'guard_name' => 'api']);
        $g_instituicao = Permission::create(['name' => 'gerenciar_instituicao', 'guard_name' => 'api']);


        $usuario->givePermissionTo($g_usuario);
        $usuario->givePermissionTo($v_certificado);
        $usuario->givePermissionTo($e_evento);
        $usuario->givePermissionTo($c_instituicao);

        $associado->givePermissionTo($g_usuario);
        $associado->givePermissionTo($v_certificado);
        $associado->givePermissionTo($e_evento);
        $associado->givePermissionTo($c_instituicao);
        $associado->givePermissionTo($g_certificado);
        $associado->givePermissionTo($g_evento);


        $admin->givePermissionTo($g_usuario);
        $admin->givePermissionTo($v_certificado);
        $admin->givePermissionTo($e_evento);
        $admin->givePermissionTo($c_instituicao);
        $admin->givePermissionTo($g_certificado);
        $admin->givePermissionTo($g_evento);
        $admin->givePermissionTo($g_instituicao);

        $c = new \App\Models\Categoria();
        $c->nome = 'teste';
        $c->save();

        $ti = new \App\Models\TipoImagem();
        $ti->nome = "banner";
        $ti->save();

        $ti = new \App\Models\TipoImagem();
        $ti->nome = "outras";
        $ti->save();

        $ta = new \App\Models\TipoAtividade();
        $ta->nome = "teste";
        $ta->save();

        $te = new \App\Models\TipoEvento();
        $te->nome = "teste";
        $te->save();

        $u = new \App\Models\User();
        $u->nome = "Nikollas Ferreira Gonçalves";
        $u->email = "nikollasferreirag@gmail.com";
        $u->cpf = "123.456.789-01";
        $u->email_verified_at = now();
        $u->password = bcrypt('123456');
        $u->telefone = "(99) 99999-9999";

        $u->save();
        $u->assignRole('admin');
        $u->assignRole('usuario');
        $u->assignRole('associado');
        $u->assignRole('super-admin');

        $i = new \App\Models\Instituicao();
        $i->nome = "teste";
        $i->cnpj = "36.119.137/0001-07";
        $i->endereco = "teste";
        $i->cidade = "Divinópolis";
        $i->logo = "";
        $i->administrador()->associate($u);
        $i->save();
        $u->instituicao_id = $i->id;
        $u->save();

        $u = new \App\Models\User();
        $u->nome = "José da Silva";
        $u->email = "nikollasferreira@hotmail.com";
        $u->cpf = "123.456.789-10";
        $u->email_verified_at = now();
        $u->password = bcrypt('123456');
        $u->telefone = "(99) 99999-9999";

        $u->save();
        $u->assignRole('usuario');

        $u = new \App\Models\User();
        $u->nome = "Maria da Silva";
        $u->email = "a@b.com";
        $u->cpf = "123.456.789-20";
        $u->email_verified_at = now();
        $u->password = bcrypt('123456');
        $u->telefone = "(99) 99999-9999";

        $u->save();
        $u->assignRole('usuario');



        $e = new \App\Models\Evento();
        $e->nome = "teste";
        $e->descricao = "teste";
        $e->expectativa_participantes = 1;
        $e->breve_descricao = "teste";
        $e->categoria_id = 1;
        $e->instituicao_id = $i->id;
        $e->tipo_id = 1;
        $e->banner = "";
    }
}
