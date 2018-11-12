-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2018 at 08:54 AM
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
  `username` varchar(128) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `email`, `user_type`) VALUES
('admin', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'admin@gmail.com', 'Admin'),
('imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'imichelle97@gmail.com', 'user');

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
(6, 'Michelle', 'Luong', 'imichelle97', '408-807-7560', '7190 Rosencrans Way', 'San Jose', 'CA', '95139', 'Visa', '1111-1111-1111-1111', '123', '2018-11-12');

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
(1, 'Produce', 'Bananas', 'min 5 ct.', '1.55', '1.70', 'lbs', 50, 'images/OrganicBananas.jpg'),
(2, 'Produce', 'Baby Carrots', 'Grown in the United States ', '1.69', '1.00', 'lbs', 50, 'images/OrganicBabyCarrots.jpg'),
(3, 'Produce', 'Strawberries', 'Grown in the United States or Mexico', '4.49', '1.00', 'lbs', 50, 'images/OrganicStrawberries.jpg'),
(4, 'Produce', 'Gala Apple', 'Grown in Washington or Chile', '4.89', '3.00', 'lbs', 50, 'images/OrganicGalaApple.jpg'),
(5, 'Produce', 'Blueberries', 'Grown in United States, Mexico, Peru, Chile, Argentina and Canada', '3.99', '0.38', 'lbs', 50, 'images/OrganicBlueberries.jpg'),
(6, 'Produce', 'Baby Spinich', 'Triple-washed', '4.99', '1.00', 'lbs', 50, 'images/OrganicBabySpinach.jpg'),
(7, 'Produce', 'Raspberries', 'Grown in the United States, Mexico, or Chile', '4.99', '0.38', 'lbs', 50, 'images/OrganicRaspberries.jpg'),
(8, 'Produce', 'Gold Potatoes', NULL, '5.99', '5.00', 'lbs', 50, 'images/OrganicGoldPotatoes.jpg'),
(9, 'Produce', 'Yellow Onion', NULL, '4.99', '3.00', 'lbs', 0, 'images/YellowOnionOrganic.jpg'),
(10, 'Produce', 'White Mushrooms', NULL, '3.49', '0.62', 'lbs', 0, 'images/OrganicWhiteMushrooms.jpg'),
(11, 'Produce', 'Whole Milk', 'Vitamin D', '5.49', '8.00', 'lbs', 50, 'images/OrganicWholeMilk.jpg'),
(12, 'Produce', 'Zucchini Squash', 'Grown in United States or Mexico', '3.00', '1.50', 'lbs', 0, 'images/OrganicZucchiniSquash.jpg'),
(13, 'Breads and Bakery', 'Bread', '21 Whole Grains', '4.99', '1.69', 'lbs', 0, 'images/21WholeGrains.jpg'),
(14, 'Breads and Bakery', 'Bread', 'White Bread', '5.99', '1.50', 'lbs', 0, 'images/WhiteBread.jpg'),
(15, 'Breads and Bakery', 'Bread', 'Whole Wheat', '5.99', '1.56', 'lbs', 0, 'images/WholeWheat.jpg'),
(16, 'Breads and Bakery', 'Bread', 'Sourdough Bread', '4.99', '1.50', 'lbs', 0, 'images/SourdoughBread.jpg'),
(17, 'Breads and Bakery', 'English Muffins', 'Whole Grain', '0.37', '0.06', 'lbs', 0, 'images/EnglishMuffins.jpg'),
(18, 'Dairy, Cheese, and Eggs', 'Large Brown Eggs', ' Free-Range Brown Eggs', '5.79', '1.50', 'lbs', 0, 'images/LargeBrownEggs.jpg'),
(19, 'Dairy, Cheese, and Eggs', 'Whole Milk', 'Organic', '5.49', '8.00', 'lbs', 0, 'images/WholeMilk.jpg'),
(20, 'Dairy, Cheese, and Eggs', 'Clarified Butter Oil', 'Ghee', '9.36', '0.81', 'lbs', 0, 'images/ClarifiedButterOil.jpg'),
(21, 'Dairy, Cheese, and Eggs', 'Heavy Whipping Cream', 'Ultra Pasteurized', '4.29', '1.00', 'lbs', 0, 'images/HeavyWhippingCream.jpg'),
(22, 'Dairy, Cheese, and Eggs', 'String Cheese', 'Mozzarella', '4.99', '0.38', 'lbs', 0, 'images/StringCheese.jpg'),
(23, 'Dairy, Cheese, and Eggs', 'Butter', 'Salted', '4.79', '1.00', 'lbs', 0, 'images/Butter.jpg'),
(24, 'Deli', 'Pepperoni', 'Uncured Slices', '5.50', '0.31', 'lbs', 0, 'images/OrganicPepperoni.jpg'),
(25, 'Deli', 'Ham', 'Uncured Black Forest Ham', '7.99', '0.38', 'lbs', 0, 'images/OrganicHam.jpg'),
(26, 'Deli', 'Chicken Breast', 'Oven Roasted', '7.99', '0.38', 'lbs', 0, 'images/OrganicChickenBreast.jpg'),
(27, 'Deli', 'Beef Hot Dogs', 'Uncured 100% Grassfed', '7.66', '0.75', 'lbs', 0, 'images/BeefHotDogs.jpg'),
(28, 'Deli', 'Smoked Turkey Breast', 'Sliced Smoked Turkey Breast', '6.64', '0.38', 'lbs', 0, 'images/SmokedTurkeyBreast.jpg'),
(29, 'Deli', 'Slow Cooked Ham', 'Uncured', '5.89', '0.38', 'lbs', 0, 'images/SlowCookedHam.jpg'),
(30, 'Deli', 'Genoa Salami', 'Uncured', '6.99', '0.25', 'lbs', 0, 'images/GenoaSalami.jpg'),
(31, 'Frozen', 'Riced Cauliflower', 'Organic', '1.99', '0.75', 'lbs', 0, 'images/RicedCauliflower.jpg'),
(32, 'Frozen', 'Sweet Yellow Corn', 'Organic', '1.99', '1.00', 'lbs', 0, 'images/SweetYellowCorn.jpg'),
(33, 'Frozen', 'Butternut Squash', 'Organic', '2.99', '1.00', 'lbs', 0, 'images/ButternutSquash.jpg'),
(34, 'Frozen', 'Mixed Vegetables', 'Organic, Unsalted', '2.29', '1.00', 'lbs', 0, 'images/MixedVegetables.jpg'),
(35, 'Frozen', 'Brown Rice', 'Whole Grain', '2.99', '1.25', 'lbs', 0, 'images/BrownRice.jpg'),
(36, 'Frozen', 'Three Pepper Blend', 'Frozen', '2.99', '1.00', 'lbs', 0, 'images/ThreePepperBlend.jpg'),
(37, 'Frozen', 'Green Peas', 'Unsalted', '2.29', '1.00', 'lbs', 0, 'images/GreenPeas.jpg'),
(38, 'Frozen', 'Blueberries', 'Frozen', '8.99', '2.00', 'lbs', 0, 'images/Blueberries.jpg'),
(39, 'Frozen', 'Macaroni & Cheese', 'Frozen', '3.79', '0.56', 'lbs', 0, 'images/Macaroni&Cheese.jpg'),
(40, 'Frozen', 'White Rice', 'Thai Jasmine Rice', '2.99', '1.25', 'lbs', 0, 'images/WhiteRice.jpg'),
(41, 'Frozen', 'Mixed Mushrooms', 'Organic', '3.99', '0.62', 'lbs', 0, 'images/MixedMushrooms.jpg'),
(42, 'Meat and Seafood', 'Chicken Breast', 'Boneless & Skinless', '10.26', '1.00', 'lbs', 0, 'images/ChickenBreast.jpg'),
(43, 'Meat and Seafood', 'Ground Chicken', 'Organic', '5.55', '1.00', 'lbs', 0, 'images/GroundChicken.jpg'),
(44, 'Meat and Seafood', 'Whole Chicken', 'Whole Chicken with Giblets, Free Range, All Natural', '13.76', '5.00', 'lbs', 0, 'images/WholeChicken.jpg'),
(45, 'Meat and Seafood', 'Sunday Bacon', 'Uncured', '7.99', '0.50', 'lbs', 0, 'images/SundayBacon.jpg'),
(46, 'Meat and Seafood', 'Stirloin Steaks', '100% Grass-Fed', '12.34', '0.62', 'lbs', 0, 'images/StirloinSteaks.jpg'),
(47, 'Meat and Seafood', 'Pork Chops', 'Center Cut Boneless', '7.65', '0.50', 'lbs', 0, 'images/PorkChops.jpg'),
(48, 'Meat and Seafood', 'Ground Beef', '100% Grass-Fed', '8.63', '1.00', 'lbs', 0, 'images/GroundBeef.jpg'),
(49, 'Meat and Seafood', 'Stew Meat', '100% Grass-Fed', '13.55', '1.00', '', 0, 'images/StewMeat.jpg'),
(50, 'Meat Substitutes', 'Tofu', 'Extra Firm', '2.49', '0.75', 'lbs', 0, 'images/Tofu.jpg'),
(51, 'Meat Substitutes', 'Tempeh', 'Original Soy', '2.59', '0.50', 'lbs', 0, 'images/Tempeh.jpg'),
(52, 'Meat Substitutes', 'Soyrizo', 'Soyrizo Meatless Soy Chorizo', '3.79', '0.75', 'lbs', 0, 'images/Soyrizo.jpg'),
(53, 'Soups, Stocks, and Broths', 'Roasted Red Pepper & Tomato Soup', 'Organic', '3.99', '2.00', 'lbs', 0, 'images/RoastedRedPepper&TomatoSoup.jpg'),
(54, 'Soups, Stocks, and Broths', 'Chicken Broth', 'Organic', '2.29', '2.00', 'lbs', 0, 'images/ChickenBroth.jpg'),
(55, 'Soups, Stocks, and Broths', 'Chicken Stock', 'Organic', '2.99', '2.00', 'lbs', 0, 'images/ChickenStock.jpg'),
(56, 'Soups, Stocks, and Broths', 'Vegetable Broth', 'Low-Sodium', '2.99', '2.00', 'lbs', 0, 'images/VegetableBroth.jpg'),
(57, 'Soups, Stocks, and Broths', 'Hearty Garden Vegetable Soup', 'Organic', '2.59', '0.91', 'lbs', 0, 'images/HeartyGardenVegetableSoup.jpg'),
(58, 'Soups, Stocks, and Broths', 'Chicken Noodle Soup', 'Free Range Chicken', '2.38', '0.91', 'lbs', 0, 'images/ChickenNoodleSoup.jpg'),
(59, 'Soups, Stocks, and Broths', 'Chili', 'Medium with Vegetabes', '3.00', '0.92', 'lbs', 0, 'images/Chili.jpg'),
(60, 'Soups, Stocks, and Broths', 'Bone Broth', 'Chicken, Tumeric, Ginger', '1.52', '0.52', 'lbs', 0, 'images/BoneBroth.jpg');

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
(1, 6, 'imichelle97', 1, 2),
(2, 6, 'imichelle97', 3, 2),
(3, 6, 'imichelle97', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

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
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
