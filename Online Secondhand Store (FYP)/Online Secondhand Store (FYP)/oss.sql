-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2024 at 09:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('jfdhf', 'hames@gmail.com', '1234'),
('alim', 'alex@gmail.com', '123'),
('Joshs', 'josh@gmail.com', '123'),
('Ajay', 'ajun@gmail.com', '123'),
('Jasan', 'jason@gmail.com', 'why'),
('FFF', 'fff@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` int(11) NOT NULL,
  `Order_ID` int(9) NOT NULL,
  `Customer_ID` varchar(255) NOT NULL,
  `Product_id` varchar(255) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Price` int(100) NOT NULL,
  `Total` varchar(255) NOT NULL,
  `Is_Purchased` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Order_ID`, `Customer_ID`, `Product_id`, `Quantity`, `Price`, `Total`, `Is_Purchased`) VALUES
(69, 1, '8', '6', 1, 40, '40', 1),
(70, 2, '8', '6', 1, 40, '40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`) VALUES
(1, 'Comics'),
(2, 'Novels'),
(3, 'Science Fiction'),
(6, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'CHONG WEN JIE', 'chongwenjie848@gmail.com', 'nice', 'gg'),
(0, 'CHONG WEN JIE', 'limchunhong123@gmail.com', 'nice', 'ff');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(9) NOT NULL,
  `Customer_Name` varchar(30) NOT NULL,
  `Customer_Address` varchar(70) NOT NULL,
  `Customer_Email` varchar(60) NOT NULL,
  `Customer_Password` varchar(60) NOT NULL,
  `Customer_Phone_No` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Name`, `Customer_Address`, `Customer_Email`, `Customer_Password`, `Customer_Phone_No`) VALUES
(1, 'Lim Chun Hong', '261,jalan gambir 8/2,taman bandar', 'limchunjhong123@gmail.com', '1234qwer', '0183560621'),
(8, 'Teo Li Sheng', '18 jalan kemuliaan 29', '1211206156@student.mmu.edu.my', '1234wasd', '0167561890'),
(9, 'Alexander', '8 Taman Test, 19 Jalan Test 83000 Test test , Selangor', 'alex@gmail.com', '1234a', '01111154321');

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `Order_ID` int(9) NOT NULL,
  `Order_Date` date NOT NULL DEFAULT current_timestamp(),
  `Payment_ID` varchar(50) DEFAULT NULL,
  `Amount` decimal(7,2) NOT NULL,
  `Customer_ID` int(9) NOT NULL,
  `Order_Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`Order_ID`, `Order_Date`, `Payment_ID`, `Amount`, `Customer_ID`, `Order_Status`) VALUES
(1, '2024-02-12', '5AY779385M138810N', 40.00, 8, 'Paid'),
(2, '2024-02-12', '64A3820502837072N', 40.00, 8, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(9) NOT NULL,
  `Product_Name` varchar(60) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `ProductCategory_ID` int(11) DEFAULT NULL,
  `Product_Description` varchar(1000) DEFAULT NULL,
  `Product_Price` int(10) DEFAULT NULL,
  `Product_Stock` int(10) DEFAULT NULL,
  `product_isDelete` int(1) NOT NULL DEFAULT 1,
  `Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `image`, `ProductCategory_ID`, `Product_Description`, `Product_Price`, `Product_Stock`, `product_isDelete`, `Status`) VALUES
(1, 'Jujutsu Kaisen', 'comic 1.jpg', 1, '\"Jujutsu Kaisen\" by Gege Akutami: Join Yuji Itadori in a world of curses and sorcery as he navigates the dangerous path of exorcism in order to protect humanity from sinister supernatural threats.', 20, 5, 0, 1),
(2, 'Seven Deadly Sin', 'comic 2.jpg', 1, '\"Seven Deadly Sins\" by Nakaba Suzuki: Embark on an epic quest alongside the Seven Deadly Sins, a band of legendary knights, as they strive to overthrow a corrupt kingdom and save the realm from chaos.', 40, 5, 1, 1),
(3, 'Attack On Titan', 'comic 3.jpg', 1, '\"Attack on Titan\" by Hajime Isayama: Witness the gripping struggle for survival against colossal humanoid creatures known as Titans in a world where humanity fights for its existence within towering walls.', 40, 5, 0, 1),
(4, '86 -Eighty Six-', 'novel 1.jpg', 2, '\"86 -Eighty Six- \" by Asato Asato: Follow the story of the marginalized 86ers as they pilot unmanned combat drones in a war against oppressive forces, revealing the harsh realities of discrimination and conflict.', 40, 5, 0, 1),
(5, 'Overlord', 'novel 2.jpg', 2, '\"Overlord\" by Kugane Maruyama: Immerse yourself in the virtual reality MMORPG world of Yggdrasil as Momonga, trapped in the form of his skeletal avatar, seeks to uncover the mysteries of the new, transformed game reality. ', 40, 2, 0, 1),
(6, 'Sword Art Online', 'novel 3.jpg', 2, '\"Sword Art Online\" by Reki Kawahara: Dive into the immersive and perilous world of virtual reality gaming where Kirito, along with other players, must fight to survive after being trapped in a deadly game where dying in-game means dying in reality.', 40, 4, 0, 1),
(7, 'Dune', 'sf 1.jpg', 3, 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides, heir to a noble family tasked with ruling an inhospitable world where the only thing of value is the “spice” melange, a drug capable of extending life and enhancing consciousness.', 40, 4, 0, 1),
(8, 'Neuromancer', 'sf 2.jpg', 3, '\"Neuromancer\" by William Gibson: Enter a cyberpunk universe where hackers, AIs, and corporate espionage converge as Case, a washed-up computer cowboy, dives into a perilous quest in the vast expanse of the digital matrix.', 40, 3, 0, 1),
(9, 'Foundation', 'sf 3.jpg', 3, '\"Foundation\" by Isaac Asimov: Witness the sweeping saga of Hari Seldons plan to preserve knowledge and guide humanity through the impending collapse of a galactic empire using the science of psychohistory.', 40, 4, 0, 1),
(11, 'The Price of Salt', 'thepriceofsalt.jpg', 2, 'Secondhand Novel', 20, 10, 0, 1),
(12, 'Trading Price Action Reversals', 'test3.jpg', 2, 'Secondhand Novel', 20, 10, 0, 1),
(29, 'Dewata raya', 'dewataraya.jpeg', 2, 'secondhand Novel', 15, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Customer_ID` int(9) NOT NULL,
  `Product_ID` int(9) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone_No` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Customer_ID`, `Product_ID`, `Email`, `Phone_No`) VALUES
(8, 29, '1211206156@student.mmu.edu.my', '0167561890');

-- --------------------------------------------------------

--
-- Table structure for table `savepayment`
--

CREATE TABLE `savepayment` (
  `Payment_ID` varchar(255) NOT NULL,
  `Payee_Name` varchar(255) NOT NULL,
  `Payee_Email` varchar(255) NOT NULL,
  `Payee_ShippingAddress` varchar(255) NOT NULL,
  `Payment_Status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savepayment`
--

INSERT INTO `savepayment` (`Payment_ID`, `Payee_Name`, `Payee_Email`, `Payee_ShippingAddress`, `Payment_Status`) VALUES
('5AY779385M138810N', 'John', 'sb-sphaj28521109@personal.example.com', 'Level 01, No 1, First Avenue Bandar Utama47800Petaling JayaSelangorMY', 'Paid'),
('64A3820502837072N', 'John', 'sb-sphaj28521109@personal.example.com', 'Level 01, No 1, First Avenue Bandar Utama47800Petaling JayaSelangorMY', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(4) NOT NULL,
  `Staff_Name` varchar(60) NOT NULL,
  `Staff_Address` varchar(300) NOT NULL,
  `Staff_Email` varchar(100) NOT NULL,
  `Staff_Phone_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Staff_Name`, `Staff_Address`, `Staff_Email`, `Staff_Phone_No`) VALUES
(1, 'Chong Wen Jie', '261,Jalan Gambir 8/2, Taman Bandar Baru Bukit Gambir, 84800, Tangkak, Johor.', 'chongwenjie848@gmail.com', 183560621);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `username` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`username`, `email`, `password`) VALUES
('Ajun', 'ajun@gmail.com', '$2y$10$EVclDVCKeVBNuGRZNOx.9eQG29INhJ27pWHhjFKBi7pjLBrDBIAFq'),
('Jasan', 'jason@gmail.com', '1234'),
('FFF', 'fff@gmail.com', '43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `c_order`
--
ALTER TABLE `c_order`
  MODIFY `Order_ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
