<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [ 'id' => 1, 'menu_name' => 'Espresso', 'menu_image' => 'images/1. Espresso.jpg' , 'menu_description' => '+ Plant Based Oat Milk', 'menu_type' => 'Coffee' ],
            [ 'id' => 2, 'menu_name' => 'Latte', 'menu_image' => 'images/2. Latte.jpg' , 'menu_description' => 'Caramel / Vanilla/ Hazelnut / Banana / Almond', 'menu_type' => 'Coffee' ],
            [ 'id' => 3, 'menu_name' => 'Piccolo', 'menu_image' => 'images/3. Piccolo.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 4, 'menu_name' => 'Cappucino', 'menu_image' => 'images/4. Capuccino.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 5, 'menu_name' => 'Vietnam Drip', 'menu_image' => 'images/5. Vietnam Drip.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 6, 'menu_name' => 'Americano', 'menu_image' => 'images/6. americano.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 7, 'menu_name' => 'Spanish Latte', 'menu_image' => 'images/7. Spanish latte.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 8, 'menu_name' => 'Es Kopi Susu', 'menu_image' => 'images/8. eskopisusu.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 9, 'menu_name' => 'Caramel Macchiato', 'menu_image' => 'images/9. Caramel Macchiato.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 10, 'menu_name' => 'Mocha', 'menu_image' => 'images/11. mocha.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 11, 'menu_name' => 'Dark Hazelnut Latte', 'menu_image' => 'images/10. Dark Hazelnut Latte.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 12, 'menu_name' => 'Long Black', 'menu_image' => 'images/12. Long Black.jpg' , 'menu_description' => NULL, 'menu_type' => 'Coffee' ],
            [ 'id' => 13, 'menu_name' => 'V60 Coffee / Origami Dripper / Kalita Wave', 'menu_image' => 'images/22. v60.jpg' , 'menu_description' => NULL, 'menu_type' => 'Drip Coffee' ],
            [ 'id' => 14, 'menu_name' => 'Japanesse Iced Coffee', 'menu_image' => 'images/21. japaneese.jpg' , 'menu_description' => NULL, 'menu_type' => 'Drip Coffee' ],
            [ 'id' => 15, 'menu_name' => 'Ijen Karamela Anaerom', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Single Origins' ],
            [ 'id' => 16, 'menu_name' => 'Ijen Anaerob Natural', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Single Origins' ],
            [ 'id' => 17, 'menu_name' => 'Aceh Gayo Natural & Wwine', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Single Origins' ],
            [ 'id' => 18, 'menu_name' => 'Brazil Santos Natural', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Single Origins' ],
            [ 'id' => 19, 'menu_name' => 'Affogato', 'menu_image' => 'images/13. affogato.jpg' , 'menu_description' => NULL, 'menu_type' => 'Ice Cream' ],
            [ 'id' => 20, 'menu_name' => 'Matcha Affogato', 'menu_image' => 'images/14. matcha affogato.jpg' , 'menu_description' => NULL, 'menu_type' => 'Ice Cream' ],
            [ 'id' => 21, 'menu_name' => 'Avocado Affogato', 'menu_image' => 'images/15. affogato avocado.jpg' , 'menu_description' => NULL, 'menu_type' => 'Ice Cream' ],
            [ 'id' => 22, 'menu_name' => 'Strawberry Frappe wwith Signature Coffee', 'menu_image' => 'images/16. strawberry frape.jpg' , 'menu_description' => NULL, 'menu_type' => 'Frape' ],
            [ 'id' => 23, 'menu_name' => 'Matcha Frappe', 'menu_image' => 'images/17. matcha frape xx.jpg' , 'menu_description' => NULL, 'menu_type' => 'Frape' ],
            [ 'id' => 24, 'menu_name' => 'Classic Frappe', 'menu_image' => 'images/18. classic frape.jpg' , 'menu_description' => 'Caramel / Vanila / Hazelnut / Banana / Almond / Regal', 'menu_type' => 'Frape' ],
            [ 'id' => 25, 'menu_name' => 'Oreo Frappe', 'menu_image' => 'images/20. oreo frape.jpg' , 'menu_description' => NULL, 'menu_type' => 'Frape' ],
            [ 'id' => 26, 'menu_name' => 'Choco Frappe', 'menu_image' => 'images/19. choco frape.jpg' , 'menu_description' => NULL, 'menu_type' => 'Frape' ],
            [ 'id' => 27, 'menu_name' => 'Korean Strawberry Milk', 'menu_image' => 'images/23. korean strawberry milk.jpg' , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 28, 'menu_name' => 'Matcha Latte', 'menu_image' => 'images/24. matcha latte.jpg' , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 29, 'menu_name' => 'Chocolate Latte', 'menu_image' => 'images/25. chocolate ice.jpg' , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 30, 'menu_name' => 'Orange Passion ', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 31, 'menu_name' => 'Blueberry Breeze ', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 32, 'menu_name' => 'Mango Peach', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 33, 'menu_name' => 'Green Apple Mojito', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 34, 'menu_name' => 'Choco Mint Latte', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 35, 'menu_name' => 'Clasic Milk base', 'menu_image' => NULL , 'menu_description' => 'Caramel / Vanila / Hazelnut / Banana / Almond', 'menu_type' => 'Smoothies & Milk / Mocktails ' ],
            [ 'id' => 36, 'menu_name' => 'Mango Yogurt', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Yogurt' ],
            [ 'id' => 37, 'menu_name' => 'Lychee Yogurt', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Yogurt' ],
            [ 'id' => 38, 'menu_name' => 'Raspberry Yogurt', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Yogurt' ],
            [ 'id' => 39, 'menu_name' => 'Strawberry Yogurt', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Yogurt' ],
            [ 'id' => 40, 'menu_name' => 'Apple Yogurt', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Yogurt' ],
            [ 'id' => 41, 'menu_name' => 'Black Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 42, 'menu_name' => 'Lemon Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 43, 'menu_name' => 'English Breakfast', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 44, 'menu_name' => 'Earl Grey', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 45, 'menu_name' => 'Peach Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 46, 'menu_name' => 'Green Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 47, 'menu_name' => 'Darjeeling', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 48, 'menu_name' => 'Lemon & Ginger Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 49, 'menu_name' => 'Fruit Berry Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 50, 'menu_name' => 'Peppermint Tea', 'menu_image' => NULL , 'menu_description' => NULL, 'menu_type' => 'Tea' ],
            [ 'id' => 51, 'menu_name' => 'Fried Chicken Burger ', 'menu_image' => 'images/1. Fried Chicken Burger.jpg' , 'menu_description' => 'Fried Spicy Chicken With Special Mayo Sauce And Soft Brioche Burger bun', 'menu_type' => 'Burger' ],
[ 'id' => 52, 'menu_name' => 'Beef Cheese Bomba', 'menu_image' => 'images/2. Beef Cheese Bomba.jpg' , 'menu_description' => 'Grilled Juicy Thick Beef With Cheese Slice And Soft Brioche Burger Bun', 'menu_type' => 'Burger' ],
[ 'id' => 53, 'menu_name' => 'Butter Croissant ', 'menu_image' => 'images/3. Butter Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 54, 'menu_name' => 'Pain Aux Raisin ', 'menu_image' => 'images/4. Pain Aux Raisin.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 55, 'menu_name' => 'Double cheese Croissant ', 'menu_image' => 'images/5. Double Cheese Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 56, 'menu_name' => 'Almond Croissant ', 'menu_image' => 'images/6. Almond Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 57, 'menu_name' => 'Hazelnut Carrot Cake', 'menu_image' => 'images/7. Hazelnut Carrot Cake.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 58, 'menu_name' => 'Pistachio Cromboloni ', 'menu_image' => 'images/8. Pistachio Cromboloni.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 59, 'menu_name' => 'Bicolor Pistachio Croissant', 'menu_image' => 'images/9. Bicolor Pistachio Croissants.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 60, 'menu_name' => 'Lemonade Croissant', 'menu_image' => 'images/10. Lemonade Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 61, 'menu_name' => 'Basque Burnt Cheesecake', 'menu_image' => 'images/11. Basque Burnt Cheesecake.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 62, 'menu_name' => 'Pain Au Chocolate', 'menu_image' => 'images/12. Pain Au Chocolat.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 63, 'menu_name' => 'Lotus Biscoff Croissant', 'menu_image' => 'images/13. Lotus Biscoff Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 64, 'menu_name' => 'Choco Crunchy Croissant', 'menu_image' => 'images/14. Choco Crunchy Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 65, 'menu_name' => 'Earl Grey Yuzu Cruffin', 'menu_image' => 'images/15. Earl Grey Yuzu Cruffin.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 66, 'menu_name' => 'Earl Grey Tea Croissant', 'menu_image' => 'images/16. Earl Grey Tea Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 67, 'menu_name' => 'Dirty Soil Croissant', 'menu_image' => 'images/17. Dirty Soil Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 68, 'menu_name' => 'Cookies And Cream Croissant', 'menu_image' => 'images/18. Cookies And Cream Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 69, 'menu_name' => 'Kouign Amann', 'menu_image' => 'images/19. Kouign Amann.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 70, 'menu_name' => 'Cinnamon Roll Croissant', 'menu_image' => 'images/20. Cinnamon Roll Croissant.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 71, 'menu_name' => 'Egg Custard Danish', 'menu_image' => 'images/21. Egg Custard Danish.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 72, 'menu_name' => 'Kue Lapis Keju', 'menu_image' => 'images/22. Kue Lapis Keju.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 73, 'menu_name' => 'Chocolate Croffle', 'menu_image' => 'images/23. Chocolate Croffle.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 74, 'menu_name' => 'Croffle', 'menu_image' => 'images/24. Croffle.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 75, 'menu_name' => 'Milk Toast ', 'menu_image' => 'images/25. Milk Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 76, 'menu_name' => 'Srikaya Toast', 'menu_image' => 'images/26. Srikaya Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 77, 'menu_name' => 'Choco Crunchy Toast', 'menu_image' => 'images/27. Choco Crunchy Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 78, 'menu_name' => 'Cheese Toast', 'menu_image' => 'images/28. Cheese Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 79, 'menu_name' => 'Nutella Toast ', 'menu_image' => 'images/29. Nutella Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 80, 'menu_name' => 'Ovomaltine Toast', 'menu_image' => 'images/30. Ovomaltine Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 81, 'menu_name' => 'Butter Sugar Toast', 'menu_image' => 'images/31. Butter Sugar Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 82, 'menu_name' => 'Peanut Butter Toast', 'menu_image' => 'images/32. Peanut Butter Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 83, 'menu_name' => 'Mix Toast', 'menu_image' => 'images/33. Mix Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ],
[ 'id' => 84, 'menu_name' => 'Tiramisu Toast', 'menu_image' => 'images/34. Tiramisu Toast.jpg' , 'menu_description' => NULL, 'menu_type' => 'Bakery' ]
        ]);
    }
}
