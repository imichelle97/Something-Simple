-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2018 at 07:52 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(0, 'admin', 'root');

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
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `user_type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `email`, `user_type`) VALUES
('admin', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'admin@gmail.com', 'Admin'),
('imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'imichelle97@gmail.com', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `phone_number` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `state` varchar(128) NOT NULL,
  `zipcode` varchar(128) NOT NULL,
  `card_type` varchar(128) NOT NULL,
  `card_number` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`customer_id`, `first_name`, `last_name`, `username`, `phone_number`, `address`, `city`, `state`, `zipcode`, `card_type`, `card_number`) VALUES
(0, 'Michelle', 'Luong', 'imichelle97', '4088077560', '7190 Rosencrans Way', 'San Jose', 'CA', '95139', 'Discover', '1111-2222-3333-4444');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `delivery_time_planned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delivery_time_actual` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_box`
--

CREATE TABLE `delivery_box` (
  `delivery_box_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(128) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_desc` varchar(128) DEFAULT NULL,
  `item_price` double(11,2) NOT NULL,
  `item_weight` double(11,2) NOT NULL,
  `item_weight_unit` varchar(4) NOT NULL,
  `inventory` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_category`, `item_name`, `item_desc`, `item_price`, `item_weight`, `item_weight_unit`, `inventory`, `image`) VALUES
(1, 'Produce', 'Organic Bananas (min 5 ct.)', '', 1.55, 1.70, 'lbs', 0, 'images/OrganicBananas.jpg'),
(2, 'Produce', 'Organic Baby Carrots', '- Grown in the United States ', 1.69, 1.00, 'lbs', 0, 'images/OrganicBabyCarrots.jpg'),
(3, 'Produce', 'Organic Strawberries', '- Grown in the United States or Mexico', 4.49, 1.00, 'lbs', 0, 'images/OrganicStrawberries.jpg'),
(4, 'Produce', 'Organic Gala Apple', '- Grown in Washington or Chile', 4.89, 3.00, 'lbs', 0, 'images/OrganicGalaApple.jpg'),
(5, 'Produce', 'Organic Blueberries', '- Grown in United States, Mexico, Peru, Chile, Argentina and Canada', 3.99, 0.38, 'lbs', 0, 'images/OrganicBlueberries.jpg'),
(6, 'Produce', 'Organic Baby Spinich', '- Triple-washed', 4.99, 1.00, 'lbs', 0, 'images/OrganicBabySpinach.jpg'),
(7, 'Produce', 'Organic Raspberries', '- Grown in the United States, Mexico, or Chile', 4.99, 0.38, 'lbs', 0, 'images/OrganicRaspberries.jpg'),
(8, 'Produce', 'Organic Gold Potatoes', NULL, 5.99, 5.00, 'lbs', 0, 'images/OrganicGoldPotatoes.jpg'),
(9, 'Produce', 'Yellow Onion Organic', NULL, 4.99, 3.00, 'lbs', 0, 'images/YellowOnionOrganic.jpg'),
(10, 'Produce', 'Organic White Mushrooms', NULL, 3.49, 0.62, 'lbs', 0, 'images/OrganicWhiteMushrooms.jpg'),
(11, 'Produce', 'Organic Whole Milk', '- Vitamin D', 5.49, 8.00, 'lbs', 0, 'images/OrganicWholeMilk.jpg'),
(12, 'Produce', 'Organic Zucchini Squash', '- Grown in United States or Mexico', 3.00, 1.50, 'lbs', 0, 'images/OrganicZucchiniSquash.jpg'),
(13, 'Breads and Bakery', 'Organic Bread', '21 Whole Grains', 4.99, 1.69, 'lbs', 0, 'images/21WholeGrains.jpg'),
(14, 'Breads and Bakery', 'Organic Bread', 'White Bread', 5.99, 1.50, 'lbs', 0, 'images/WhiteBread.jpg'),
(15, 'Breads and Bakery', 'Organic Bread', 'Whole Wheat', 5.99, 1.56, 'lbs', 0, 'images/WholeWheat.jpg'),
(16, 'Breads and Bakery', 'Organic Bread', 'Sourdough Bread', 4.99, 1.50, 'lbs', 0, 'images/SourdoughBread.jpg'),
(17, 'Breads and Bakery', 'English Muffins', 'Whole Grain', 0.37, 0.06, 'lbs', 0, 'images/EnglishMuffins.jpg'),
(18, 'Dairy, Cheese, and Eggs', 'Large Brown Eggs', 'Organic Free-Range Brown Eggs', 5.79, 1.50, 'lbs', 0, 'images/LargeBrownEggs.jpg'),
(19, 'Dairy, Cheese, and Eggs', 'Whole Milk', 'Organic', 5.49, 8.00, 'lbs', 0, 'images/WholeMilk.jpg'),
(20, 'Dairy, Cheese, and Eggs', 'Clarified Butter Oil', 'Organic Ghee', 9.36, 0.81, 'lbs', 0, 'images/ClarifiedButterOil.jpg'),
(21, 'Dairy, Cheese, and Eggs', 'Heavy Whipping Cream', 'Ultra Pasteurized', 4.29, 1.00, 'lbs', 0, 'images/HeavyWhippingCream.jpg'),
(22, 'Dairy, Cheese, and Eggs', 'String Cheese', 'Mozzarella', 4.99, 0.38, 'lbs', 0, 'images/StringCheese.jpg'),
(23, 'Dairy, Cheese, and Eggs', 'Butter', 'Organic, Salted', 4.79, 1.00, 'lbs', 0, 'images/Butter.jpg'),
(24, 'Deli', 'Organic Pepperoni', 'Uncured Slices', 5.50, 0.31, 'lbs', 0, 'images/OrganicPepperoni.jpg'),
(25, 'Deli', 'Organic Ham', 'Uncured Black Forest Ham', 7.99, 0.38, 'lbs', 0, 'images/OrganicHam.jpg'),
(26, 'Deli', 'Organic Chicken Breast', 'Oven Roasted', 7.99, 0.38, 'lbs', 0, 'images/OrganicChickenBreast.jpg'),
(27, 'Deli', 'Beef Hot Dogs', 'Organic Uncured 100% Grassfed', 7.66, 0.75, 'lbs', 0, 'images/BeefHotDogs.jpg'),
(28, 'Deli', 'Smoked Turkey Breast', 'Organic Sliced Smoked Turkey Breast', 6.64, 0.38, 'lbs', 0, 'images/SmokedTurkeyBreast.jpg'),
(29, 'Deli', 'Slow Cooked Ham', 'Organic Uncured', 5.89, 0.38, 'lbs', 0, 'images/SlowCookedHam.jpg'),
(30, 'Deli', 'Genoa Salami', 'Organic Uncured', 6.99, 0.25, 'lbs', 0, 'images/GenoaSalami.jpg'),
(31, 'Frozen', 'Riced Cauliflower', 'Organic', 1.99, 0.75, 'lbs', 0, 'images/RicedCauliflower.jpg'),
(32, 'Frozen', 'Sweet Yellow Corn', 'Organic', 1.99, 1.00, 'lbs', 0, 'images/SweetYellowCorn.jpg'),
(33, 'Frozen', 'Butternut Squash', 'Organic', 2.99, 1.00, 'lbs', 0, 'images/ButternutSquash.jpg'),
(34, 'Frozen', 'Mixed Vegetables', 'Organic, Unsalted', 2.29, 1.00, 'lbs', 0, 'images/MixedVegetables.jpg'),
(35, 'Frozen', 'Brown Rice', 'Organic Whole Grain', 2.99, 1.25, 'lbs', 0, 'images/BrownRice.jpg'),
(36, 'Frozen', 'Three Pepper Blend', 'Organic, Frozen', 2.99, 1.00, 'lbs', 0, 'images/ThreePepperBlend.jpg'),
(37, 'Frozen', 'Green Peas', 'Organic, Unsalted', 2.29, 1.00, 'lbs', 0, 'images/GreenPeas.jpg'),
(38, 'Frozen', 'Blueberries', 'Organic, Frozen', 8.99, 2.00, 'lbs', 0, 'images/Blueberries.jpg'),
(39, 'Frozen', 'Macaroni & Cheese', 'Organic, Frozen', 3.79, 0.56, 'lbs', 0, 'images/Macaroni&Cheese.jpg'),
(40, 'Frozen', 'White Rice', 'Thai Jasmine Rice', 2.99, 1.25, 'lbs', 0, 'images/WhiteRice.jpg'),
(41, 'Frozen', 'Mixed Mushrooms', 'Organic', 3.99, 0.62, 'lbs', 0, 'images/MixedMushrooms.jpg'),
(42, 'Meat and Seafood', 'Chicken Breast', 'Boneless & Skinless', 10.26, 1.00, 'lbs', 0, 'images/ChickenBreast.jpg'),
(43, 'Meat and Seafood', 'Ground Chicken', 'Organic', 5.55, 1.00, 'lbs', 0, 'images/GroundChicken.jpg'),
(44, 'Meat and Seafood', 'Whole Chicken', 'Organic Whole Chicken with Giblets, Free Range, All Natural', 13.76, 5.00, 'lbs', 0, 'images/WholeChicken.jpg'),
(45, 'Meat and Seafood', 'Sunday Bacon', 'Organic Uncured', 7.99, 0.50, 'lbs', 0, 'images/SundayBacon.jpg'),
(46, 'Meat and Seafood', 'Stirloin Steaks', '100% Grass-Fed', 12.34, 0.62, 'lbs', 0, 'images/StirloinSteaks.jpg'),
(47, 'Meat and Seafood', 'Pork Chops', 'Center Cut Boneless', 7.65, 0.50, 'lbs', 0, 'images/PorkChops.jpg'),
(48, 'Meat and Seafood', 'Ground Beef', '100% Grass-Fed', 8.63, 1.00, 'lbs', 0, 'images/GroundBeef.jpg'),
(49, 'Meat and Seafood', 'Stew Meat', 'Organic, 100% Grass-Fed', 13.55, 1.00, '', 0, 'images/StewMeat.jpg'),
(50, 'Meat Substitutes', 'Tofu', 'Organic Extra Firm', 2.49, 0.75, 'lbs', 0, 'images/Tofu.jpg'),
(51, 'Meat Substitutes', 'Tempeh', 'Original Soy', 2.59, 0.50, 'lbs', 0, 'images/Tempeh.jpg'),
(52, 'Meat Substitutes', 'Soyrizo', 'Organic Soyrizo Meatless Soy Chorizo', 3.79, 0.75, 'lbs', 0, 'images/Soyrizo.jpg'),
(53, 'Soups, Stocks, and Broths', 'Roasted Red Pepper & Tomato Soup', 'Organic', 3.99, 2.00, 'lbs', 0, 'images/RoastedRedPepper&TomatoSoup.jpg'),
(54, 'Soups, Stocks, and Broths', 'Chicken Broth', 'Organic', 2.29, 2.00, 'lbs', 0, 'images/ChickenBroth.jpg'),
(55, 'Soups, Stocks, and Broths', 'Chicken Stock', 'Organic', 2.99, 2.00, 'lbs', 0, 'images/ChickenStock.jpg'),
(56, 'Soups, Stocks, and Broths', 'Vegetable Broth', 'Low-Sodium', 2.99, 2.00, 'lbs', 0, 'images/VegetableBroth.jpg'),
(57, 'Soups, Stocks, and Broths', 'Hearty Garden Vegetable Soup', 'Organic', 2.59, 0.91, 'lbs', 0, 'images/HeartyGardenVegetableSoup.jpg'),
(58, 'Soups, Stocks, and Broths', 'Chicken Noodle Soup', 'Free Range Chicken', 2.38, 0.91, 'lbs', 0, 'images/ChickenNoodleSoup.jpg'),
(59, 'Soups, Stocks, and Broths', 'Chili', 'Medium with Vegetabes', 3.00, 0.92, 'lbs', 0, 'images/Chili.jpg'),
(60, 'Soups, Stocks, and Broths', 'Bone Broth', 'Chicken, Tumeric, Ginger', 1.52, 0.52, 'lbs', 0, 'images/BoneBroth.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items_in_box`
--

CREATE TABLE `items_in_box` (
  `id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_weight` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_summary`
--

CREATE TABLE `order_item_summary` (
  `order_item_id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item_summary`
--

INSERT INTO `order_item_summary` (`order_item_id`, `placed_order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 13, 1, 4.99);

-- --------------------------------------------------------

--
-- Table structure for table `placed_order`
--

CREATE TABLE `placed_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `time_placed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delivery_address` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_order`
--

INSERT INTO `placed_order` (`order_id`, `customer_id`, `time_placed`, `delivery_address`) VALUES
(1, 0, '2018-10-28 06:14:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `placed_order_id` (`placed_order_id`);

--
-- Indexes for table `delivery_box`
--
ALTER TABLE `delivery_box`
  ADD PRIMARY KEY (`delivery_box_id`),
  ADD KEY `delivery_id` (`delivery_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_category` (`item_category`);

--
-- Indexes for table `items_in_box`
--
ALTER TABLE `items_in_box`
  ADD PRIMARY KEY (`id`),
  ADD KEY `box_id` (`box_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indexes for table `order_item_summary`
--
ALTER TABLE `order_item_summary`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `placed_order_id` (`placed_order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD CONSTRAINT `customer_profile_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_order` (`order_id`);

--
-- Constraints for table `delivery_box`
--
ALTER TABLE `delivery_box`
  ADD CONSTRAINT `delivery_box_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category`) REFERENCES `category` (`category_name`);

--
-- Constraints for table `items_in_box`
--
ALTER TABLE `items_in_box`
  ADD CONSTRAINT `items_in_box_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `delivery_box` (`delivery_box_id`),
  ADD CONSTRAINT `items_in_box_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `order_item_summary`
--
ALTER TABLE `order_item_summary`
  ADD CONSTRAINT `order_item_summary_ibfk_1` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_order` (`order_id`),
  ADD CONSTRAINT `order_item_summary_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_profile` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
