-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2018 at 11:59 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OFS`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_contact`
--

CREATE TABLE `admin_contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_contact`
--

INSERT INTO `admin_contact` (`contact_id`, `name`, `message`) VALUES
(9, 'Michelle Luong', 'This is a test message to see whether this message will connect to the database testing here.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_name`) VALUES
('Breads and Bakery'),
('Dairy, Cheese, and Eggs'),
('Deli'),
('Frozen'),
('Meat and Seafood'),
('Meat Substitutes'),
('Produce'),
('Soups, Stocks, and Broths');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `username`, `password`, `email`, `user_type`) VALUES
(2, 'admin', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'admin@gmail.com', 'Admin'),
(3, 'imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'imichelle97@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `phone_number` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `zipcode` varchar(128) DEFAULT NULL,
  `card_type` varchar(128) DEFAULT NULL,
  `card_number` varchar(128) DEFAULT NULL,
  `cvc` varchar(128) DEFAULT NULL,
  `expiration_date` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`customer_id`, `first_name`, `last_name`, `username`, `phone_number`, `address`, `city`, `state`, `zipcode`, `card_type`, `card_number`, `cvc`, `expiration_date`) VALUES
(13, 'Michelle', 'Luong', 'imichelle97', '', '7190 Rosencrans Way', 'San Jose', 'CA', '95139', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(128) DEFAULT NULL,
  `item_name` varchar(128) DEFAULT NULL,
  `item_desc` varchar(128) DEFAULT NULL,
  `item_price` varchar(128) DEFAULT NULL,
  `item_weight` varchar(128) DEFAULT NULL,
  `item_weight_unit` varchar(4) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_category`, `item_name`, `item_desc`, `item_price`, `item_weight`, `item_weight_unit`, `inventory`, `image`) VALUES
(1, 'Produce', 'Organic Bananas', 'Minimum 5 ct.', '1.55', '1.70', 'lbs', 50, 'images/OrganicBananas.jpg'),
(2, 'Produce', 'Organic Baby Carrots', 'Grown in the US', '1.69', '1.00', 'lbs', 50, 'images/OrganicBabyCarrots.jpg'),
(3, 'Produce', 'Organic Strawberries', 'Grown in the US', '4.49', '1.00', 'lbs', 50, 'images/OrganicStrawberries.jpg'),
(4, 'Produce', 'Organic Gala Apple', 'Grown in Washington or Chile', '4.89', '3.00', 'lbs', 50, 'images/OrganicGalaApple.jpg'),
(5, 'Produce', 'Organic Blueberries', 'Grown in US & Mexico', '3.99', '0.38', 'lbs', 50, 'images/OrganicBlueberries.jpg'),
(6, 'Produce', 'Organic Baby Spinich', 'Triple-washed', '4.99', '1.00', 'lbs', 50, 'images/OrganicBabySpinach.jpg'),
(7, 'Produce', 'Organic Raspberries', 'Grown in the US & Mexico', '4.99', '0.38', 'lbs', 50, 'images/OrganicRaspberries.jpg'),
(8, 'Produce', 'Organic Gold Potatoes', 'Grown in the US', '5.99', '5.00', 'lbs', 50, 'images/OrganicGoldPotatoes.jpg'),
(9, 'Produce', 'Yellow Onion Organic', 'Grown in the US', '4.99', '3.00', 'lbs', 50, 'images/YellowOnionOrganic.jpg'),
(10, 'Produce', 'Organic White Mushrooms', 'Grown in the US', '3.49', '0.62', 'lbs', 50, 'images/OrganicWhiteMushrooms.jpg'),
(11, 'Produce', 'Organic Whole Milk', 'Vitamin D', '5.49', '8.00', 'lbs', 50, 'images/OrganicWholeMilk.jpg'),
(12, 'Produce', 'Organic Zucchini Squash', 'Grown in United States or Mexico', '3.00', '1.50', 'lbs', 50, 'images/OrganicZucchiniSquash.jpg'),
(13, 'Breads and Bakery', 'Organic Bread', '21 Whole Grains', '4.99', '1.69', 'lbs', 50, 'images/21WholeGrains.jpg'),
(14, 'Breads and Bakery', 'Organic Bread', 'White Bread', '5.99', '1.50', 'lbs', 50, 'images/WhiteBread.jpg'),
(15, 'Breads and Bakery', 'Organic Bread', 'Whole Wheat', '5.99', '1.56', 'lbs', 50, 'images/WholeWheat.jpg'),
(16, 'Breads and Bakery', 'Organic Bread', 'Sourdough Bread', '4.99', '1.50', 'lbs', 50, 'images/SourdoughBread.jpg'),
(17, 'Breads and Bakery', 'English Muffins', 'Whole Grain', '0.37', '0.06', 'lbs', 50, 'images/EnglishMuffins.jpg'),
(18, 'Dairy, Cheese, and Eggs', 'Large Brown Eggs', 'Organic Free-Range Brown Eggs', '5.79', '1.50', 'lbs', 50, 'images/LargeBrownEggs.jpg'),
(19, 'Dairy, Cheese, and Eggs', 'Whole Milk', 'Organic', '5.49', '8.00', 'lbs', 50, 'images/WholeMilk.jpg'),
(20, 'Dairy, Cheese, and Eggs', 'Clarified Butter Oil', 'Organic Ghee', '9.36', '0.81', 'lbs', 50, 'images/ClarifiedButterOil.jpg'),
(21, 'Dairy, Cheese, and Eggs', 'Heavy Whipping Cream', 'Ultra Pasteurized', '4.29', '1.00', 'lbs', 0, 'images/HeavyWhippingCream.jpg'),
(22, 'Dairy, Cheese, and Eggs', 'String Cheese', 'Mozzarella', '4.99', '0.38', 'lbs', 0, 'images/StringCheese.jpg'),
(23, 'Dairy, Cheese, and Eggs', 'Butter', 'Organic, Salted', '4.79', '1.00', 'lbs', 50, 'images/Butter.jpg'),
(24, 'Deli', 'Organic Pepperoni', 'Uncured Slices', '5.50', '0.31', 'lbs', 50, 'images/OrganicPepperoni.jpg'),
(25, 'Deli', 'Organic Ham', 'Uncured Black Forest Ham', '7.99', '0.38', 'lbs', 50, 'images/OrganicHam.jpg'),
(26, 'Deli', 'Organic Chicken Breast', 'Oven Roasted', '7.99', '0.38', 'lbs', 50, 'images/OrganicChickenBreast.jpg'),
(27, 'Deli', 'Beef Hot Dogs', 'Organic Uncured 100% Grassfed', '7.66', '0.75', 'lbs', 50, 'images/BeefHotDogs.jpg'),
(28, 'Deli', 'Smoked Turkey Breast', 'Organic Sliced Smoked Turkey Breast', '6.64', '0.38', 'lbs', 50, 'images/SmokedTurkeyBreast.jpg'),
(29, 'Deli', 'Slow Cooked Ham', 'Organic Uncured', '5.89', '0.38', 'lbs', 50, 'images/SlowCookedHam.jpg'),
(30, 'Deli', 'Genoa Salami', 'Organic Uncured', '6.99', '0.25', 'lbs', 50, 'images/GenoaSalami.jpg'),
(31, 'Frozen', 'Riced Cauliflower', 'Organic', '1.99', '0.75', 'lbs', 50, 'images/RicedCauliflower.jpg'),
(32, 'Frozen', 'Sweet Yellow Corn', 'Organic', '1.99', '1.00', 'lbs', 0, 'images/SweetYellowCorn.jpg'),
(33, 'Frozen', 'Butternut Squash', 'Organic', '2.99', '1.00', 'lbs', 0, 'images/ButternutSquash.jpg'),
(34, 'Frozen', 'Mixed Vegetables', 'Organic, Unsalted', '2.29', '1.00', 'lbs', 50, 'images/MixedVegetables.jpg'),
(35, 'Frozen', 'Brown Rice', 'Organic Whole Grain', '2.99', '1.25', 'lbs', 50, 'images/BrownRice.jpg'),
(36, 'Frozen', 'Three Pepper Blend', 'Organic, Frozen', '2.99', '1.00', 'lbs', 50, 'images/ThreePepperBlend.jpg'),
(37, 'Frozen', 'Green Peas', 'Organic, Unsalted', '2.29', '1.00', 'lbs', 50, 'images/GreenPeas.jpg'),
(38, 'Frozen', 'Blueberries', 'Organic, Frozen', '8.99', '2.00', 'lbs', 50, 'images/Blueberries.jpg'),
(39, 'Frozen', 'Macaroni & Cheese', 'Organic, Frozen', '3.79', '0.56', 'lbs', 0, 'images/Macaroni&Cheese.jpg'),
(40, 'Frozen', 'White Rice', 'Thai Jasmine Rice', '2.99', '1.25', 'lbs', 50, 'images/WhiteRice.jpg'),
(41, 'Frozen', 'Mixed Mushrooms', 'Organic', '3.99', '0.62', 'lbs', 0, 'images/MixedMushrooms.jpg'),
(42, 'Meat and Seafood', 'Chicken Breast', 'Boneless & Skinless', '10.26', '1.00', 'lbs', 0, 'images/ChickenBreast.jpg'),
(43, 'Meat and Seafood', 'Ground Chicken', 'Organic', '5.55', '1.00', 'lbs', 50, 'images/GroundChicken.jpg'),
(44, 'Meat and Seafood', 'Whole Chicken', 'All Natural', '13.76', '5.00', 'lbs', 0, 'images/WholeChicken.jpg'),
(45, 'Meat and Seafood', 'Sunday Bacon', 'Organic Uncured', '7.99', '0.50', 'lbs', 50, 'images/SundayBacon.jpg'),
(46, 'Meat and Seafood', 'Stirloin Steaks', '100% Grass-Fed', '12.34', '0.62', 'lbs', 50, 'images/StirloinSteaks.jpg'),
(47, 'Meat and Seafood', 'Pork Chops', 'Center Cut Boneless', '7.65', '0.50', 'lbs', 50, 'images/PorkChops.jpg'),
(48, 'Meat and Seafood', 'Ground Beef', '100% Grass-Fed', '8.63', '1.00', 'lbs', 50, 'images/GroundBeef.jpg'),
(49, 'Meat and Seafood', 'Stew Meat', 'Organic, 100% Grass-Fed', '13.55', '1.00', '', 50, 'images/StewMeat.jpg'),
(50, 'Meat Substitutes', 'Tofu', 'Organic Extra Firm', '2.49', '0.75', 'lbs', 50, 'images/Tofu.jpg'),
(51, 'Meat Substitutes', 'Tempeh', 'Original Soy', '2.59', '0.50', 'lbs', 50, 'images/Tempeh.jpg'),
(52, 'Meat Substitutes', 'Soyrizo', 'Organic Soyrizo Meatless Soy Chorizo', '3.79', '0.75', 'lbs', 50, 'images/Soyrizo.jpg'),
(53, 'Soups, Stocks, and Broths', 'Red Pepper & Tomato Soup', 'Organic', '3.99', '2.00', 'lbs', 50, 'images/RoastedRedPepper&TomatoSoup.jpg'),
(54, 'Soups, Stocks, and Broths', 'Chicken Broth', 'Organic', '2.29', '2.00', 'lbs', 0, 'images/ChickenBroth.jpg'),
(55, 'Soups, Stocks, and Broths', 'Chicken Stock', 'Organic', '2.99', '2.00', 'lbs', 50, 'images/ChickenStock.jpg'),
(56, 'Soups, Stocks, and Broths', 'Vegetable Broth', 'Low-Sodium', '2.99', '2.00', 'lbs', 50, 'images/VegetableBroth.jpg'),
(57, 'Soups, Stocks, and Broths', 'Vegetable Soup', 'Organic', '2.59', '0.91', 'lbs', 50, 'images/HeartyGardenVegetableSoup.jpg'),
(58, 'Soups, Stocks, and Broths', 'Chicken Noodle Soup', 'Free Range Chicken', '2.38', '0.91', 'lbs', 50, 'images/ChickenNoodleSoup.jpg'),
(59, 'Soups, Stocks, and Broths', 'Chili', 'Medium with Vegetabes', '3.00', '0.92', 'lbs', 50, 'images/Chili.jpg'),
(60, 'Soups, Stocks, and Broths', 'Bone Broth', 'Chicken, Tumeric, Ginger', '1.52', '0.52', 'lbs', 50, 'images/BoneBroth.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `username`, `item_id`, `quantity`) VALUES
(17, 3, 'imichelle97', 1, 3),
(18, 3, 'imichelle97', 1, 3),
(19, 3, 'imichelle97', 2, 1),
(20, 3, 'imichelle97', 2, 2),
(21, 3, 'imichelle97', 3, 2),
(22, 3, 'imichelle97', 6, 1),
(23, 3, 'imichelle97', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_contact`
--
ALTER TABLE `admin_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_category` (`item_category`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_contact`
--
ALTER TABLE `admin_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category`) REFERENCES `category` (`category_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
