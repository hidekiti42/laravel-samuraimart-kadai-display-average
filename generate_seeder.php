<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$products = App\Models\Product::all();
$lines = "<?php\nnamespace Database\\Seeders;\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\nclass ProductSeeder extends Seeder\n{\n    public function run()\n    {\n        DB::statement('SET FOREIGN_KEY_CHECKS=0;');\n        DB::table('products')->truncate();\n        DB::statement('SET FOREIGN_KEY_CHECKS=1;');\n        DB::table('products')->insert([\n";
foreach($products as $p) {
    $lines .= "            ['name'=>'" . addslashes($p->name) . "','description'=>'" . addslashes($p->description) . "','price'=>" . $p->price . ",'category_id'=>" . $p->category_id . ",'image'=>'" . $p->image . "','recommend_flag'=>" . $p->recommend_flag . ",'carriage_flag'=>" . $p->carriage_flag . ",'created_at'=>'" . $p->created_at . "','updated_at'=>'" . $p->updated_at . "'],\n";
}
$lines .= "        ]);\n    }\n}";
file_put_contents('database/seeders/ProductSeeder.php', $lines);
echo "Done!\n";
