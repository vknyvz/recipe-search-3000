<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        // Idea from https://wildalaskancompany.com/blog/meet-our-newest-offering-my-new-fave-anytime-food-halibut-burgers 
        // and 
        // Idea from https://wildalaskancompany.com/blog/crispy-fish-cake-eggs-benedict-with-pacific-halibut-and-easy-hollandaise
        $recipes = [
            [
                'name' => 'Classic Burger',
                'description' => 'If you love your mainstays, there’s nothing quite like a good burger done right. And you can achieve that beautifully with our halibut burgers. You know the drill: all the fixins and toasted buns. Add some cheese if you like that kind of party, and maybe a generous schmear of ginger-lime aioli.',
                'author_email' => 'volkan@classicburgers.com',
            ],
            [
                'name' => 'Halibut Bahn Mi Burger',
                'description' => 'Use a toasted baguette for this one and fill it with your halibut burger, cut in thirds or whatever you like, along with quick pickled carrots and daikon, jalapenos, cilantro and cucumber.',
                'author_email' => 'marie@bahnmi.com',
            ],
            [
                'name' => 'Mediterranean Halibut Pita Pockets',
                'description' => 'Break the patty for this one too, and stuff into pita. Add tzatziki, shredded lettuce, cherry tomatoes, kalamata olives and red onion.',
                'author_email' => 'anna@pita.com',
            ],
            [
                'name' => 'Crunchy Salad Featuring Halibut',
                'description' => 'If you want to keep your dinner low-carb, make a salad with mixed greens or napa cabbage, add edamame, shredded carrots, mandarin orange segments and sesame seeds. A miso-ginger or sesame-lime dressing is ideal here.',
                'author_email' => 'sarah@salads.com',
            ],
            [
                'name' => 'Burger Melt',
                'description' => 'You’ve heard of the tuna melt, so think of the halibut melt as its quirky Alaskan cousin. Build an open-faced sammie with tomatoes and a layer of cheese, then dress it up with arugula or caramelized onions to take it up a notch.',
                'author_email' => 'mike@melt.com',
            ],
            [
                'name' => 'Citrus Halibut Burger Stack with Fennel Slaw',
                'description' => 'Throw together a quick salad of fennel, orange (or other citrus) segments, arugula and a lemon vinaigrette. Top it with a halibut burger and some herbed aioli.',
                'author_email' => 'emily@citrus.com',
            ],
            [
                'name' => 'Burger Lettuce Wraps',
                'description' => 'Here’s another low-carb option that, thanks to the halibut burger as star, does not skimp on flavor. I like to use butter lettuce for this one, and a peanut sauce for dipping makes it feel more decadent than it is.',
                'author_email' => 'david@lettucewraps.com',
            ],
            [
                'name' => 'Burger Bowl',
                'description' => 'You know how bowls work: pick a base (such as quinoa, wild rice or cauliflower rice), add some roasted veggies, halibut burger pieces, maybe a soft boiled egg, and top it off with pickled radish, avocado and sesame seeds. You can use any sauce you like, such as green goddess or chimichurri; or maybe something heartier like ranch.',
                'author_email' => 'kate@bowls.com',
            ],
            [
                'name' => 'Burger Benny',
                'description' => 'Who doesn’t love a Benedict? Well, what if you swap the protein for a halibut burger and top it with a poached egg, maybe a few slices of avocado and some hollandaise sauce? You can opt for yogurt for a less caloric sauce, too.',
                'author_email' => 'volkan@salmon.com',
            ],
            [
                'name' => 'Burger Shakshuka',
                'description' => 'Traditional shakshuka is usually made with a homemade tomato sauce, in which eggs are poached. But crumbling a halibut burger into said sauce, as well, makes for an extraordinary breakfast ragout.',
                'author_email' => 'shakshuka@spices.com',
            ],
            [
                'name' => 'Savory Burger Waffles',
                'description' => 'Use a savory waffle as a base, and then add a halibut burger and a fried egg to it. Drizzle it with lemon-tahini sauce or hot honey for that sweet-salty kick.',
                'author_email' => 'waffle@breakfast.com',
            ],
            [
                'name' => 'Gluten-Free Breakfast Burrito',
                'description' => 'Wrap halibut burger chunks with scrambled eggs, sauteed veggies, avocado, salsa verde in a flour or grain-free tortilla. Or maybe even a collard leaf, to keep it super clean.',
                'author_email' => 'burrito@glutenfree.com',
            ],
            [
                'name' => 'Patty and Greens Breakfast Plate',
                'description' => 'In keeping with super clean, why not make a simple plate of sauteed spinach, kale and micro greens, and an egg cooked to your liking alongside a halibut burger. I call it the pro’s protein plate.',
                'author_email' => 'plate@breakfast.com',
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create([
                'name' => $recipe['name'],
                'description' => $recipe['description'],
                'author_email' => $recipe['author_email'],
                'slug' => Str::slug($recipe['name']),
            ]);
        }
    }
}