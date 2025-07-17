-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 02:08 AM
-- Server version: 8.0.28
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeleton_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_16_215932_create_table_recipes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` json NOT NULL,
  `steps` json NOT NULL,
  `author_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `ingredients`, `steps`, `author_email`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Barbecue Chicken', 'Juicy grilled chicken with homemade barbecue sauce', '[\"4 chicken breasts\", \"2 cups barbecue sauce\", \"1 tsp garlic powder\", \"1 tsp paprika\", \"Salt and pepper to taste\"]', '[\"Season chicken with garlic powder, paprika, salt, and pepper\", \"Preheat grill to medium-high heat\", \"Grill chicken for 6-7 minutes per side\", \"Brush with barbecue sauce in the last 2 minutes\", \"Let rest for 5 minutes before serving\"]', 'chef@example.com', 'barbecue-chicken', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(5, 'Scalloped Potatoes', 'Creamy layered potato dish perfect for any occasion', '[\"3 large potatoes, thinly sliced\", \"2 cups heavy cream\", \"1 cup shredded cheese\", \"2 cloves garlic, minced\", \"Salt and pepper to taste\", \"Fresh scallops (optional)\"]', '[\"Preheat oven to 375°F\", \"Layer half the potatoes in a greased baking dish\", \"Pour half the cream over potatoes\", \"Add remaining potatoes and cream\", \"Top with cheese and bake for 45 minutes\"]', 'foo@bar.com', 'scalloped-potatoes', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(6, 'Chocolate Chip Cookies', 'Classic homemade chocolate chip cookies', '[\"2 cups all-purpose flour\", \"1 cup butter, softened\", \"3/4 cup brown sugar\", \"2 large eggs\", \"2 cups chocolate chips\"]', '[\"Preheat oven to 350°F\", \"Mix butter and sugars until creamy\", \"Add eggs one at a time\", \"Gradually add flour\", \"Fold in chocolate chips\", \"Drop onto baking sheet and bake 10-12 minutes\"]', 'baker@example.com', 'chocolate-chip-cookies', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(7, 'Spaghetti Carbonara', 'Creamy Italian pasta with bacon and cheese', '[\"200g spaghetti\", \"100g pancetta\", \"2 large eggs\", \"1/2 cup grated Parmesan cheese\", \"Salt and pepper to taste\"]', '[\"Cook spaghetti according to package instructions\", \"Fry pancetta until crispy\", \"Mix eggs and Parmesan in a bowl\", \"Drain pasta and toss with pancetta and egg mixture\", \"Serve with extra Parmesan and pepper\"]', 'chef@example.com', 'spaghetti-carbonara', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(8, 'Avocado Toast', 'Healthy and quick breakfast option', '[\"2 slices of whole-grain bread\", \"1 ripe avocado\", \"1 tsp lemon juice\", \"Chili flakes\", \"Salt and pepper to taste\"]', '[\"Toast the bread\", \"Mash the avocado with lemon juice, salt, and pepper\", \"Spread the mixture on toast\", \"Sprinkle with chili flakes and serve\"]', 'chef@example.com', 'avocado-toast', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(9, 'Beef Tacos', 'Mexican style tacos with spiced beef and toppings', '[\"300g ground beef\", \"1 packet taco seasoning\", \"8 taco shells\", \"1 cup shredded lettuce\", \"1 cup diced tomatoes\", \"1 cup shredded cheddar cheese\"]', '[\"Cook beef with taco seasoning\", \"Warm taco shells\", \"Fill tacos with beef, lettuce, tomatoes, and cheese\", \"Serve with salsa or sour cream\"]', 'chef@example.com', 'beef-tacos', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(10, 'Greek Salad', 'Refreshing salad with feta cheese and olives', '[\"2 cucumbers, chopped\", \"4 tomatoes, chopped\", \"1/2 red onion, sliced\", \"1 cup feta cheese\", \"1 cup black olives\", \"2 tbsp olive oil\", \"1 tbsp red wine vinegar\"]', '[\"Combine cucumbers, tomatoes, onion, feta, and olives in a bowl\", \"Drizzle with olive oil and vinegar\", \"Toss gently and serve chilled\"]', 'chef@example.com', 'greek-salad', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(11, 'Pancakes', 'Fluffy pancakes for breakfast', '[\"1.5 cups all-purpose flour\", \"1 cup milk\", \"2 tbsp sugar\", \"1 egg\", \"2 tbsp melted butter\", \"1 tsp baking powder\"]', '[\"Mix all dry ingredients in a bowl\", \"Whisk in milk, egg, and melted butter\", \"Cook on a griddle until bubbles form\", \"Flip and cook until golden brown\", \"Serve with syrup\"]', 'foo@bar.com', 'pancakes', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(12, 'Grilled Cheese Sandwich', 'Crispy bread with melted cheese', '[\"2 slices of bread\", \"2 slices of cheddar cheese\", \"1 tbsp butter\"]', '[\"Butter one side of each bread slice\", \"Place cheese between unbuttered sides\", \"Cook on a skillet until golden brown on both sides\", \"Serve hot\"]', 'foo@bar.com', 'grilled-cheese-sandwich', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(13, 'Tomato Soup', 'Comforting tomato soup perfect for rainy days', '[\"4 large tomatoes, chopped\", \"1 onion, diced\", \"2 cloves garlic, minced\", \"2 cups vegetable broth\", \"Salt and pepper to taste\"]', '[\"Sauté onions and garlic until soft\", \"Add tomatoes and cook for 10 minutes\", \"Add broth and simmer for 20 minutes\", \"Blend until smooth and season to taste\"]', 'foo@bar.com', 'tomato-soup', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(14, 'Caesar Salad', 'Classic Caesar salad with creamy dressing', '[\"1 romaine lettuce\", \"1/2 cup croutons\", \"1/4 cup grated Parmesan\", \"Caesar dressing\", \"Salt and pepper to taste\"]', '[\"Chop lettuce\", \"Toss with dressing, croutons, and Parmesan\", \"Season with salt and pepper and serve\"]', 'foo@bar.com', 'caesar-salad', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(15, 'Baked Salmon', 'Healthy baked salmon with lemon', '[\"2 salmon fillets\", \"1 lemon, sliced\", \"1 tbsp olive oil\", \"Salt and pepper to taste\", \"Fresh dill (optional)\"]', '[\"Preheat oven to 400°F\", \"Place salmon on baking tray, drizzle with olive oil\", \"Top with lemon slices and dill\", \"Bake for 15-20 minutes\", \"Serve hot\"]', 'foo@bar.com', 'baked-salmon', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(16, 'Vegetable Stir Fry', 'Quick and healthy vegetable stir fry', '[\"2 cups mixed vegetables (broccoli, bell peppers, carrots)\", \"2 tbsp soy sauce\", \"1 tbsp olive oil\", \"1 clove garlic, minced\", \"1 tsp sesame seeds\"]', '[\"Heat oil in a wok\", \"Sauté garlic, add vegetables\", \"Add soy sauce and stir-fry for 5-7 minutes\", \"Sprinkle with sesame seeds before serving\"]', 'foo@bar.com', 'vegetable-stir-fry', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(17, 'Mashed Potatoes', 'Creamy mashed potatoes perfect as a side', '[\"4 large potatoes\", \"1/2 cup milk\", \"3 tbsp butter\", \"Salt and pepper to taste\"]', '[\"Boil potatoes until tender\", \"Mash with butter and milk\", \"Season with salt and pepper\", \"Serve warm\"]', 'foo@bar.com', 'mashed-potatoes', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(18, 'Shrimp Scampi', 'Garlicky shrimp with buttery sauce', '[\"200g shrimp, peeled\", \"3 cloves garlic, minced\", \"3 tbsp butter\", \"1/4 cup white wine\", \"2 tbsp lemon juice\", \"Parsley for garnish\"]', '[\"Melt butter in skillet, sauté garlic\", \"Add shrimp and cook until pink\", \"Pour in wine and lemon juice, cook for 3 more minutes\", \"Garnish with parsley and serve\"]', 'baker@example.com', 'shrimp-scampi', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(19, 'Chicken Alfredo Pasta', 'Creamy pasta with grilled chicken', '[\"200g fettuccine\", \"2 chicken breasts\", \"1 cup heavy cream\", \"1/2 cup Parmesan\", \"2 cloves garlic\", \"1 tbsp butter\"]', '[\"Cook fettuccine\", \"Grill chicken and slice\", \"Sauté garlic in butter, add cream and Parmesan\", \"Toss pasta with sauce and chicken\", \"Serve hot\"]', 'baker@example.com', 'chicken-alfredo-pasta', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(20, 'Classic Cheeseburger', 'Grilled beef patty with cheese and toppings', '[\"2 beef patties\", \"2 burger buns\", \"2 cheese slices\", \"Lettuce, tomato, onion\", \"Ketchup and mustard\"]', '[\"Grill patties to desired doneness\", \"Toast buns\", \"Assemble burger with cheese, veggies, and condiments\", \"Serve with fries\"]', 'baker@example.com', 'classic-cheeseburger', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(21, 'Chicken Curry', 'Spicy and flavorful chicken curry', '[\"500g chicken pieces\", \"1 onion, chopped\", \"2 tomatoes, chopped\", \"3 cloves garlic\", \"2 tbsp curry powder\", \"1 cup coconut milk\"]', '[\"Sauté onion and garlic until golden\", \"Add chicken and cook until brown\", \"Add tomatoes and curry powder\", \"Pour coconut milk and simmer for 20 minutes\", \"Serve with rice\"]', 'baker@example.com', 'chicken-curry', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(22, 'French Toast', 'Sweet and soft French toast for breakfast', '[\"4 slices bread\", \"2 eggs\", \"1/4 cup milk\", \"1 tsp cinnamon\", \"Butter for frying\"]', '[\"Whisk eggs, milk, and cinnamon\", \"Dip bread into mixture\", \"Fry in butter until golden brown on both sides\", \"Serve with syrup\"]', 'baker@example.com', 'french-toast', '2025-07-16 19:16:57', '2025-07-16 19:16:57'),
(23, 'Omelette', 'Quick fluffy omelette with vegetables', '[\"3 eggs\", \"1/4 cup diced bell peppers\", \"1/4 cup diced onions\", \"1/4 cup shredded cheese\", \"Salt and pepper to taste\"]', '[\"Beat eggs with salt and pepper\", \"Cook vegetables in pan, pour eggs over\", \"Sprinkle cheese on top\", \"Fold omelette and serve hot\"]', 'baker@example.com', 'omelette', '2025-07-16 19:16:57', '2025-07-16 19:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'chef@example.com', NULL, '$2y$10$BXfFkBlknLLtEqfX4jAgSu4j8Fzn/104xCsYEdJlv5Ng3iV.3xWZC', NULL, '2025-07-16 18:04:15', '2025-07-16 18:04:15'),
(2, 'John Doe', 'foo@bar.com', NULL, '$2y$10$qA8/OL3PluPdyaLU/soMguRvlxEk6hNqFke/FKQkDi/JXV4.jpS.u', NULL, '2025-07-16 18:04:15', '2025-07-16 18:04:15'),
(3, 'Jane Smith', 'baker@example.com', NULL, '$2y$10$kPeIaA2X4bvrDzo.n2oRcu3ZKBaMNWNOUU0XQzZIYIzh/r.1RsqES', NULL, '2025-07-16 18:04:15', '2025-07-16 18:04:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipes_slug_unique` (`slug`),
  ADD KEY `recipes_author_email_index` (`author_email`),
  ADD KEY `recipes_slug_index` (`slug`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `recipes_name_description_fulltext` (`name`,`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
