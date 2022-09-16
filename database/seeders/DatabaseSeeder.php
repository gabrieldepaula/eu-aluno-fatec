<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $fatecs = [
            'Fatec Araçatuba - Prof. Fernando Amaral de Almeida Prado',
            'Fatec Praia Grande',
            'Fatec Baixada Santista - Rubens Lara',
            'Fatec Bebedouro - Jorge Caram Sabbag',
            'Fatec Barretos',
            'Fatec Bauru',
            'Fatec Jahu',
            'Fatec Lins - Prof. Antonio Seabra',
            'Fatec Americana - Ministro Ralph Biasi',
            'Fatec Araras - Antonio Brambilla',
            'Fatec Bragança Paulista - Jornalista Omair Fagundes de Oliveira',
            'Fatec Campinas',
            'Fatec Indaiatuba - Dr. Archimedes Lammoglia',
            'Fatec Itapira - Ogari de Castro Pacheco',
            'Fatec Itatiba - Maria Eunice Amadeo de Almeida',
            'Fatec Jundiaí - Deputado Ary Fossen',
            'Fatec Mococa',
            'Fatec Mogi Mirim - Arthur de Azevedo',
            'Fatec Piracicaba - Deputado Roque Trevisan',
            'Fatec Sumaré',
            'Fatec Araraquara - Prof. José Arana Varela',
            'Fatec Matão - Luiz Marchesan',
            'Fatec São Carlos',
            'Fatec Taquaritinga',
            'Fatec Franca - Dr. Thomaz Novelino',
            'Fatec Capão Bonito',
            'Fatec Assis',
            'Fatec Garça - Deputado Julio Julinho Marcondes de Moura',
            'Fatec Marília - Estudante Rafael Almeida Camarinha',
            'Fatec Ourinhos',
            'Fatec Pompeia - Shunji Nishimura',
            'Fatec Barueri - Padre Danilo José de Oliveira Ohl',
            'Fatec Carapicuíba',
            'Fatec Cotia',
            'Fatec Diadema - Luigi Papaiz',
            'Fatec Ferraz de Vasconcelos — Ferraz de Vasconcelos',
            'Fatec Franco da Rocha - Giuliano Cecchettini',
            'Fatec Guarulhos',
            'Fatec Itaquaquecetuba',
            'Fatec Mauá',
            'Fatec Mogi das Cruzes',
            'Fatec Osasco - Prefeito Hirant Sanazar',
            'Fatec Santana de Parnaíba',
            'Fatec Santo André',
            'Fatec São Bernardo do Campo - Adib Moisés Dib',
            'Fatec São Caetano do Sul - Antonio Russo',
            'Fatec Ipiranga - Pastor Enéas Tognini',
            'Fatec Itaquera - Prof. Miguel Reale',
            'Fatec São Paulo',
            'Fatec Sebrae',
            'Fatec Tatuapé - Victor Civita',
            'Fatec Zona Leste',
            'Fatec Zona Sul - Dom Paulo Evaristo Arns',
            'Fatec Adamantina',
            'Fatec Presidente Prudente',
            'Fatec Registro',
            'Fatec Jaboticabal - Nilo de Stéfani',
            'Fatec Ribeirão Preto',
            'Fatec Sertãozinho - Deputado Waldyr Alceu Trigo',
            'Fatec Catanduva',
            'Fatec Jales - Professor José Camargo',
            'Fatec São José do Rio Preto',
            'Fatec Cruzeiro - Prof. Waldomiro May',
            'Fatec Guaratinguetá - Prof. João Mod',
            'Fatec Jacareí - Professor Francisco de Moura',
            'Fatec Pindamonhangaba',
            'Fatec São José dos Campos - Prof. Jessen Vidal',
            'Fatec São Sebastião - São Sebastião',
            'Fatec Taubaté',
            'Fatec Botucatu',
            'Fatec Itapetininga - Prof. Antonio Belizandro Barbosa Rezende',
            'Fatec Itu - Dom Amaury Castanho',
            'Fatec de São Roque',
            'Fatec Sorocaba - José Crespo Gonzales',
            'Fatec Tatuí - Prof. Wilson Roberto Ribeiro de Camargo',
        ];

        foreach($fatecs as $fatec) {
            DB::table('colleges')->insert([
                'name' => $fatec,
                'created_at' => now(),
            ]);
        }

        DB::table('students')->insert([
            'name' => 'Gabriel Leite',
            'email' => 'gabriel.leite7@fatec.sp.gov.br',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'active' => true,
            'created_at' => now(),
        ]);
    }
}
