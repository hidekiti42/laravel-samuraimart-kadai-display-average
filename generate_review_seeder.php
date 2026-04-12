<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$reviews = App\Models\Review::all();
$lines = "<?php\nnamespace Database\\Seeders;\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\nclass ReviewSeeder extends Seeder\n{\n    public function run()\n    {\n        DB::statement('TRUNCATE TABLE reviews CASCADE;');\n        DB::table('reviews')->insert([\n";
foreach($reviews as $r) {
    $lines .= "            ['product_id'=>" . $r->product_id . ",'user_id'=>" . $r->user_id . ",'score'=>" . $r->score . ",'title'=>'" . addslashes($r->title) . "','content'=>'" . addslashes($r->content) . "','created_at'=>'" . $r->created_at . "','updated_at'=>'" . $r->updated_at . "'],\n";
}
$lines .= "        ]);\n    }\n}";
file_put_contents('database/seeders/ReviewSeeder.php', $lines);
echo "Done!\n";
