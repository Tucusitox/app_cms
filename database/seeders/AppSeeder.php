<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Post;
use App\Models\Rol;
use App\Models\RolsXPermission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INSERSION EN TABLA "permissions"
        Permission::insert([
            ['permission_name' => 'Lectura'],
            ['permission_name' => 'Escritura'],
            ['permission_name' => 'Borrado lógico'],
            ['permission_name' => 'Borrado físico'],
            ['permission_name' => 'Copia de seguridad'],
        ]);
        // INSERSION EN TABLA "rols"
        Rol::insert([
            ['rol_name' => 'Administrador'],
            ['rol_name' => 'Publicador'],
            ['rol_name' => 'Visitante'],
        ]);
        // INSERSION EN TABLA "rols_x_permissions"
        RolsXPermission::insert([
            // ADMINISTRADOR
            ['fk_rol' => 1, 'fk_permission' => 1,],
            ['fk_rol' => 1, 'fk_permission' => 2,],
            ['fk_rol' => 1, 'fk_permission' => 3,],
            ['fk_rol' => 1, 'fk_permission' => 4,],
            ['fk_rol' => 1, 'fk_permission' => 5,],
            // PUBLICADOR
            ['fk_rol' => 2, 'fk_permission' => 1,],
            ['fk_rol' => 2, 'fk_permission' => 2,],
            ['fk_rol' => 2, 'fk_permission' => 3,],
            // VISITANTE
            ['fk_rol' => 3, 'fk_permission' => 1,],
        ]);
        // INSERSION EN TABLA "users"
        User::insert([
            [
                'fk_rol' => 1,
                'user_name' => 'Tucusitox',
                'email' => 'jdmorianperez@gmail.com',
                'password' => Hash::make('Morian.-12345'),
                'email_verified' => 'true',
                'user_token' => Str::random(50),
                'user_status' => 'activo',
            ],
            [
                'fk_rol' => 1,
                'user_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified' => 'true',
                'user_token' => Str::random(50),
                'user_status' => 'activo',
            ],
            [
                'fk_rol' => 2,
                'user_name' => 'Apolo',
                'email' => 'example@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified' => 'true',
                'user_token' => Str::random(50),
                'user_status' => 'activo',
            ],
            [
                'fk_rol' => 3,
                'user_name' => 'Katherine',
                'email' => 'example2@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified' => 'true',
                'user_token' => Str::random(50),
                'user_status' => 'activo',
            ],
        ]);
        // INSERSION EN TABLA "posts"
        Post::insert([
            [
                'fk_user' => 1,
                'post_code' => strtoupper(Str::random(6)),
                'post_img' => 'img/imgPosts/noticia1.jpg',
                'post_tittle' => 'Resumen de una Noticia Actual',
                'post_body' => '<p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; &nbsp; En el contexto de las &uacute;ltimas semanas, uno de los temas m&aacute;s relevantes ha sido el avance de las negociaciones sobre el cambio </span><strong><span data-testid="youchat-text">clim&aacute;tico</span></strong><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text"> en la conferencia COP29, que se est&aacute; llevando a cabo en<strong> Dub&aacute;i</strong>. Los l&iacute;deres mundiales se han reunido para discutir estrategias que permitan mitigar los efectos del calentamiento global y alcanzar los objetivos establecidos en el Acuerdo de Par&iacute;s. </span></p>
                            <p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; Este a&ntilde;o, la atenci&oacute;n se ha centrado en la necesidad urgente de implementar medidas m&aacute;s efectivas para reducir las emisiones de <em>gases</em> de efecto invernadero, ya que los recientes informes cient&iacute;ficos han se&ntilde;alado que el tiempo para actuar se est&aacute; agotando. En este sentido, pa&iacute;se<em>s como Estados Unidos y China han comenzado a mostrar un mayor compromiso, proponiendo iniciativas que incluyen inversiones</em> significativas en energ&iacute;as renovables y tecnolog&iacute;as limpias. Sin embargo, las discusiones no han estado exentas de tensiones, ya que algunos pa&iacute;ses en desarrollo han expresado su preocupaci&oacute;n por la falta de financiamiento adecuado para implementar estas soluciones. </span></p>
                            <ol style="list-style-type: lower-alpha;">
                            <li><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">A medida que avanza la conferencia, la comunidad internacional espera que se logren acuerdos concretos que no solo aborden las causas del cambio clim&aacute;tico, sino que tambi&eacute;n promuevan un desarrollo sostenible que beneficie a todas las naciones.</span></li>
                            </ol>',
                'post_date' => now()->setTimezone('America/Caracas'),
            ],
            [
                'fk_user' => 3,
                'post_code' => strtoupper(Str::random(6)),
                'post_img' => 'img/imgPosts/noticia2.jpg',
                'post_tittle' => 'Resumen de una Noticia Actual',
                'post_body' => '<p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; &nbsp; En el contexto de las &uacute;ltimas semanas, uno de los temas m&aacute;s relevantes ha sido el avance de las negociaciones sobre el cambio </span><strong><span data-testid="youchat-text">clim&aacute;tico</span></strong><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text"> en la conferencia COP29, que se est&aacute; llevando a cabo en<strong> Dub&aacute;i</strong>. Los l&iacute;deres mundiales se han reunido para discutir estrategias que permitan mitigar los efectos del calentamiento global y alcanzar los objetivos establecidos en el Acuerdo de Par&iacute;s. </span></p>
                            <p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; Este a&ntilde;o, la atenci&oacute;n se ha centrado en la necesidad urgente de implementar medidas m&aacute;s efectivas para reducir las emisiones de <em>gases</em> de efecto invernadero, ya que los recientes informes cient&iacute;ficos han se&ntilde;alado que el tiempo para actuar se est&aacute; agotando. En este sentido, pa&iacute;se<em>s como Estados Unidos y China han comenzado a mostrar un mayor compromiso, proponiendo iniciativas que incluyen inversiones</em> significativas en energ&iacute;as renovables y tecnolog&iacute;as limpias. Sin embargo, las discusiones no han estado exentas de tensiones, ya que algunos pa&iacute;ses en desarrollo han expresado su preocupaci&oacute;n por la falta de financiamiento adecuado para implementar estas soluciones. </span></p>
                            <ol style="list-style-type: lower-alpha;">
                            <li><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">A medida que avanza la conferencia, la comunidad internacional espera que se logren acuerdos concretos que no solo aborden las causas del cambio clim&aacute;tico, sino que tambi&eacute;n promuevan un desarrollo sostenible que beneficie a todas las naciones.</span></li>
                            </ol>',
                'post_date' => '2024-08-01',
            ],
            [
                'fk_user' => 3,
                'post_code' => strtoupper(Str::random(6)),
                'post_img' => 'img/imgPosts/noticia3.jpg',
                'post_tittle' => 'Resumen de una Noticia Actual',
                'post_body' => '<p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; &nbsp; En el contexto de las &uacute;ltimas semanas, uno de los temas m&aacute;s relevantes ha sido el avance de las negociaciones sobre el cambio </span><strong><span data-testid="youchat-text">clim&aacute;tico</span></strong><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text"> en la conferencia COP29, que se est&aacute; llevando a cabo en<strong> Dub&aacute;i</strong>. Los l&iacute;deres mundiales se han reunido para discutir estrategias que permitan mitigar los efectos del calentamiento global y alcanzar los objetivos establecidos en el Acuerdo de Par&iacute;s. </span></p>
                            <p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; Este a&ntilde;o, la atenci&oacute;n se ha centrado en la necesidad urgente de implementar medidas m&aacute;s efectivas para reducir las emisiones de <em>gases</em> de efecto invernadero, ya que los recientes informes cient&iacute;ficos han se&ntilde;alado que el tiempo para actuar se est&aacute; agotando. En este sentido, pa&iacute;se<em>s como Estados Unidos y China han comenzado a mostrar un mayor compromiso, proponiendo iniciativas que incluyen inversiones</em> significativas en energ&iacute;as renovables y tecnolog&iacute;as limpias. Sin embargo, las discusiones no han estado exentas de tensiones, ya que algunos pa&iacute;ses en desarrollo han expresado su preocupaci&oacute;n por la falta de financiamiento adecuado para implementar estas soluciones. </span></p>
                            <ol style="list-style-type: lower-alpha;">
                            <li><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">A medida que avanza la conferencia, la comunidad internacional espera que se logren acuerdos concretos que no solo aborden las causas del cambio clim&aacute;tico, sino que tambi&eacute;n promuevan un desarrollo sostenible que beneficie a todas las naciones.</span></li>
                            </ol>',
                'post_date' => '2024-11-21',
            ],
            [
                'fk_user' => 3,
                'post_code' => strtoupper(Str::random(6)),
                'post_img' => 'img/imgPosts/noticia4.jpg',
                'post_tittle' => 'Resumen de una Noticia Actual',
                'post_body' => '<p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; &nbsp; En el contexto de las &uacute;ltimas semanas, uno de los temas m&aacute;s relevantes ha sido el avance de las negociaciones sobre el cambio </span><strong><span data-testid="youchat-text">clim&aacute;tico</span></strong><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text"> en la conferencia COP29, que se est&aacute; llevando a cabo en<strong> Dub&aacute;i</strong>. Los l&iacute;deres mundiales se han reunido para discutir estrategias que permitan mitigar los efectos del calentamiento global y alcanzar los objetivos establecidos en el Acuerdo de Par&iacute;s. </span></p>
                            <p><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">&nbsp; &nbsp; &nbsp; Este a&ntilde;o, la atenci&oacute;n se ha centrado en la necesidad urgente de implementar medidas m&aacute;s efectivas para reducir las emisiones de <em>gases</em> de efecto invernadero, ya que los recientes informes cient&iacute;ficos han se&ntilde;alado que el tiempo para actuar se est&aacute; agotando. En este sentido, pa&iacute;se<em>s como Estados Unidos y China han comenzado a mostrar un mayor compromiso, proponiendo iniciativas que incluyen inversiones</em> significativas en energ&iacute;as renovables y tecnolog&iacute;as limpias. Sin embargo, las discusiones no han estado exentas de tensiones, ya que algunos pa&iacute;ses en desarrollo han expresado su preocupaci&oacute;n por la falta de financiamiento adecuado para implementar estas soluciones. </span></p>
                            <ol style="list-style-type: lower-alpha;">
                            <li><span class="AnswerParser_TextContainer__z_Iiv" data-testid="youchat-text">A medida que avanza la conferencia, la comunidad internacional espera que se logren acuerdos concretos que no solo aborden las causas del cambio clim&aacute;tico, sino que tambi&eacute;n promuevan un desarrollo sostenible que beneficie a todas las naciones.</span></li>
                            </ol>',
                'post_date' => '2024-10-11',
            ],
        ]);
    }
}
