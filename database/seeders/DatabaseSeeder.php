<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'name' => 'Приорбанк',
                'description' => 'Приорбанк описание',
                'slug' => 'priorbank',
            ],
            [
                'name' => 'Альфа-банк',
                'description' => 'Альфа-банк описание',
                'slug' => 'alfa-bank',
            ],
            [
                'name' => 'Белгазпромбанк',
                'description' => 'Белгазпромбанк описание',
                'slug' => 'belgazprombank',
            ],
            [
                'name' => 'БСБ банк',
                'description' => 'БСБ банк описание',
                'slug' => 'bsb',
            ],
            [
                'name' => 'Беларусбанк',
                'description' => 'Беларусбанк описание',
                'slug' => 'belarusbank',
            ],
        ];

        $currencies = [
            [
                'name' => 'Доллар',
                'slug' => 'dollar',
                'short_name' => '$',
                'background' => '#FF0000',
            ],
            [
                'name' => 'Евро',
                'slug' => 'euro',
                'short_name' => '€',
                'background' => '#0000FF',
            ],
            [
                'name' => 'Российский рубль',
                'slug' => 'rub',
                'short_name' => '₽',
                'background' => '#008000',
            ],
            [
                'name' => 'Злотый',
                'slug' => 'zloty',
                'short_name' => 'zł',
                'background' => '#FFD700',
            ],
            [
                'name' => 'Юань',
                'slug' => 'yan',
                'short_name' => '¥',
                'background' => '#FFC0CB',
            ],
            [
                'name' => 'Гривна',
                'slug' => 'grivna',
                'short_name' => '₴',
                'background' => '#20B2AA',
            ],
            [
                'name' => 'Фунт',
                'slug' => 'funt',
                'short_name' => '£',
                'background' => '#808000',
            ],
            [
                'name' => 'Франк',
                'slug' => 'frank',
                'short_name' => '₣',
                'background' => '#800000',
            ],
            [
                'name' => 'Иен',
                'slug' => 'yen',
                'short_name' => '¥',
                'background' => '#FFFF00',
            ],
            [
                'name' => 'Тугрик',
                'slug' => 'tugrick',
                'short_name' => '₮',
                'background' => '#808080',
            ],
        ];

        $bank_currencies = $this->generateArrayPrices(10, $currencies);

        DB::table('banks')->insert($banks);
        DB::table('currencies')->insert($currencies);
        DB::table('banks_currencies')->insert($bank_currencies);
    }

    public function generateArrayPrices(int $row, array $currencies): array
    {
        $result = [];

        for ($i = 0; $i <= $row; $i++) {
            foreach ($currencies as $key => $currency) {
                switch ($currency['slug']) {
                    case 'dollar':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 1;
                        $tmp['price'] = $this->random_float(2.0, 3.0);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'euro':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 2;
                        $tmp['price'] = $this->random_float(3.0, 4.0);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'rub':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 3;
                        $tmp['price'] = $this->random_float(0.03, 0.04);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'zloty':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 4;
                        $tmp['price'] = $this->random_float(6, 7);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'yan':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 5;
                        $tmp['price'] = $this->random_float(3, 4);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'grivna':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 6;
                        $tmp['price'] = $this->random_float(6, 10);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'funt':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 7;
                        $tmp['price'] = $this->random_float(3, 4);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'frank':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 8;
                        $tmp['price'] = $this->random_float(6, 10);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'yen':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 9;
                        $tmp['price'] = $this->random_float(3, 4);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                    case 'tugrick':
                        $tmp['bank_id'] = $key + 1;
                        $tmp['currency_id'] = 10;
                        $tmp['price'] = $this->random_float(0, 1);
                        $tmp['created_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $tmp['updated_at'] = date('Y-m-d H:i:s', strtotime("-$key day"));
                        $result[] = $tmp;
                        break;
                }
            }
        }

        return $result;
    }

    public function random_float($min, $max): float
    {
        return random_int($min, $max - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX );
    }
}
