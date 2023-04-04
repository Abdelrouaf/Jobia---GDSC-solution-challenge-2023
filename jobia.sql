-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 01:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobia`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_number` int(100) NOT NULL,
  `sender_image` varchar(100) NOT NULL,
  `sender_job_type` varchar(100) NOT NULL,
  `sender_age` int(100) NOT NULL,
  `sender_state` varchar(100) NOT NULL,
  `sender_country` varchar(100) NOT NULL,
  `sender_experience` int(100) NOT NULL,
  `sender_cv` varchar(100) NOT NULL,
  `sender_details` varchar(100) NOT NULL,
  `details` varchar(535) NOT NULL,
  `realtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `user_email`, `sender_id`, `sender_name`, `sender_email`, `sender_number`, `sender_image`, `sender_job_type`, `sender_age`, `sender_state`, `sender_country`, `sender_experience`, `sender_cv`, `sender_details`, `details`, `realtime`) VALUES
(12, 4, 'none@gmail.com', 17, 'Amr', 'Amr@gmail.com', 136489527, '642c06869eee0photo_2023-04-04_12-50-59.jpg', 'Photographer', 25, 'Alexandria', 'Egypt', 4, 'OS(Abdelraouf Halaby).pdf', 'sv v s', 'I can help you', '2023-04-04 00:07:49'),
(13, 13, 'meen@gmail.com', 37, 'Momen', 'Momen@gmail.com', 147896523, '642c07b7746cbphoto_2023-04-04_12-50-59.jpg', 'Security Guard', 22, 'Cairo', 'Egypt', 3, 'Assignment2_SoftwareEnginnering(Abdelroauf Halaby).pdf', 'brave', 'hello', '2023-04-04 00:16:50'),
(14, 10, 'Mohaned@gmail.com', 38, 'Ibrahim', 'Ibrahim@gmail.com', 124578963, '642c0801e13eephoto_2023-04-04_12-51-06.jpg', 'Photographer', 20, 'Damanhour', 'Egypt', 2, 'DataStracture Cheat Sheet.pdf', 'record quality pictures of events, people, pets, places or objects. ability to use camera hardware a', 'hello', '2023-04-04 00:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `salary` int(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `benefits` varchar(100) NOT NULL,
  `requirements` varchar(100) NOT NULL,
  `qualifications` varchar(100) NOT NULL,
  `skills` varchar(100) NOT NULL,
  `realtime` datetime NOT NULL,
  `about` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `user_id`, `user_email`, `title`, `details`, `company`, `city`, `country`, `salary`, `image`, `job_type`, `benefits`, `requirements`, `qualifications`, `skills`, `realtime`, `about`) VALUES
(1, 2, 'user@gmail.com', 'Delivery', 'We are looking for a reliable company driver to assist the company with all transport-related duties', 'Amazon', 'Cairo', 'Egypt', 70, 'amazon.jpg', ' part-time', 'Paid time off', 'must have a car or motorcycle, age : +18 ,language : Arabic, English, experience : +1 years', 'total work : 1 years (Required)', 'on time delivery', '2023-03-25 00:00:00', 'Amazon is built on the concept of a virtuous cycle focused on the customer. The idea was constructed'),
(2, 6, 'abdelroauf2.halaby@gmail.com', 'Restaurant Job', 'We are looking for a reliable company Restaurant Job to assist the company with all transport-relate', 'McDonalds', ' Alexandria', 'Egypt', 80, 'mac.jpg', ' Contract Job', 'Learn New Skills', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-22 00:00:00', 'McDonald’s Corporation is an American-based multinational fast food chain founded in 1940 as a resta'),
(3, 4, 'none@gmail.com', 'Photographer', 'We are looking for a reliable company Photographer to assist the company with all transport-related ', 'GQ Magazine', ' London', 'England', 120, 'GQ.jpg', ' Temporary Job', 'Gives You an Intellectual Challenge', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-13 00:00:00', 'GQ is known for its relative sophistication among men’s style and culture magazines. In addition to '),
(4, 11, 'kfc@gmail.com', 'Junior Accountant', 'We are looking for a reliable company Junior Accountant to assist the company with all transport-rel', 'KFC', ' Dubai', 'Emirates', 75, 'kfc.jpg', ' Contract Job', 'Hone Your Skills and Learn New Ones', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-12 00:00:00', 'As of December 31, 2018, there were 22,621 KFC locations in 145 countries and territories around the'),
(5, 7, 'Ahmed@gmail.com', 'Driver', 'We are looking for a reliable company driver to assist the company with all transport-related duties', 'Uber', 'Damanhour', 'Egypt', 60, 'Uber.jpg', 'part-time', 'Chance to Meet New People', 'must have a car or motorcycle, age : +18 ,language : Arabic, English, experience : +1 years', 'total work : 1 years (Required)', 'on time delivery', '2023-03-07 00:00:00', 'Uber Technologies, Inc. is an on-demand technology platform that offers multi-modal people transport'),
(6, 8, 'Mohamed@gmail.com', 'Waiter', 'We are looking for a reliable company Waiter to assist the company with all transport-related duties', 'Starbucks', ' Alexandria', 'Egypt', 55, 'starbucks.jpg', ' Contract Job', 'Allows You to Gain Access to a Work Community', 'age : +18 ,language : Arabic, English, experience : +1 years', 'total work : 1 years (Required)', 'on time', '2023-03-07 00:00:00', 'Behind every cup of coffee is a story. Enjoy some of our favorites along with all the latest news fr'),
(7, 10, 'Mohaned@gmail.com', 'HR Manager', 'We are looking for a reliable company HR Manager to assist the company with all transport-related du', 'Nike', 'Laakdal', 'Belgium', 230, 'nike.jpg', ' full-time', 'Helps You Understand Yourself and the World Better', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-22 00:00:00', 'The mission of Nike Inc. is to drive product innovation for athletes everywhere.Countless ideas are '),
(8, 13, 'meen@gmail.com', 'Security Guard', 'We are looking for a reliable company Security Guard to assist the company with all transport-relate', 'Paypal', 'Singapore', 'Singapore', 60, 'paypal.jpg', 'part-time', 'Ensures Work-Life Balance', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-25 00:00:00', 'PayPal lets you pay for things online with a bank account instead of a credit card and keeps your pa'),
(9, 16, 'whyMe@gmail.com', 'Sales Associate', 'We are looking for a reliable company Sales Associate to assist the company with all transport-relat', 'Zara', 'Chicago', 'USA', 250, 'zara.jpg', ' Contract Job', 'Gives Your Life a Greater Meaning and Purpose', 'age : +25 ,language : Arabic, English, experience : +2 years', 'total work : 2 years (Required)', 'on time', '2023-03-25 00:00:00', 'Zara is a Spanish fast-fashion retailer founded in 1975 by Amancio Ortega and Rosalía Mera. It is pa'),
(13, 16, 'whyMe@gmail.com', 'Delivery', 'We are looking for a reliable company driver to assist the company with all transport-related duties', 'Zara', 'Cairo', 'Egypt', 60, 'zara.jpg', ' part-time', 'Health Benefits of Being Employed', 'must have a car or motorcycle, age : +18 ,language : Arabic, English, experience : +3 years', 'total work : 3 years (Required)', 'on time delivery', '2023-03-25 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 6, 'Mohamed', 'Mohamed@gmail.com', 1324566789, 'nooooooooooooooooo'),
(2, 2, 'user', 'user@gmail.com', 1234567890, 'lol'),
(3, 2, 'no one', 'NoOne@gmail.com', 123456789, 'hehe'),
(4, 2, 'no one', 'NoOne@gmail.com', 123456789, 'ok'),
(5, 2, 'no one', 'NoOne@gmail.com', 123456789, 'test'),
(6, 2, 'no one', 'NoOne@gmail.com', 123456789, 'testtttttt'),
(7, 2, 'last time', 'LastTime@gmail.com', 2147483647, 'weeeeeee'),
(8, 2, 'last time', 'LastTime@gmail.com', 2147483647, 'shitt'),
(9, 0, 'no one', 'NoOne@gmail.com', 123456789, 'none'),
(10, 0, 'Nour', 'Nour@gmail.com', 147859632, 'dbc '),
(11, 0, 'Nour', 'Nour@gmail.com', 123987456, 'bedvrge'),
(12, 0, 'Amr', 'Amr@gmail.com', 12574963, 'dc  b'),
(13, 17, 'Amr', 'Amr@gmail.com', 124785963, 'beddbd'),
(14, 0, 'dnbn ft', 'user5284@gmail.com', 2147483647, 'gsewfvsw'),
(15, 28, 'Yassin', 'Yassin@gmail.com', 123456789, 'hello guys'),
(16, 39, 'Omar', 'Omar@gmail.com', 123456987, 'help me');

-- --------------------------------------------------------

--
-- Table structure for table `need_job`
--

CREATE TABLE `need_job` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_job_type` varchar(100) NOT NULL,
  `user_cv` varchar(535) NOT NULL,
  `user_details` varchar(100) NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_description` varchar(100) NOT NULL,
  `user_age` int(100) NOT NULL,
  `user_experience` int(100) NOT NULL,
  `realtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `need_job`
--

INSERT INTO `need_job` (`id`, `user_id`, `user_name`, `user_email`, `user_image`, `user_job_type`, `user_cv`, `user_details`, `user_state`, `user_country`, `user_description`, `user_age`, `user_experience`, `realtime`) VALUES
(40, 18, 'Nour', 'Nour@gmail.com', '642c06e926bd8photo_2023-04-04_12-51-05.jpg', 'Photographer', '', 'hhfbd', 'Alexandria', 'Egypt', 'any help please?!\r\n', 0, 0, '2023-04-03 23:47:00'),
(41, 17, 'Amr', 'Amr@gmail.com', '642c06869eee0photo_2023-04-04_12-50-59.jpg', 'Photographer', '', 'sv v s', 'Alexandria', 'Egypt', ' any job as part time ', 0, 0, '2023-04-03 23:47:59'),
(42, 12, 'abdelroauf', 'Abdelroauf2@gmail.com', '642c04e29b4ecphoto_2023-04-04_12-50-55.jpg', 'Junior Accountant', '', 'nothing\r\n', 'Damanhour', 'Egypt', 'job with salary 90$', 0, 0, '2023-04-03 23:50:33'),
(44, 38, 'Ibrahim', 'Ibrahim@gmail.com', '642c0801e13eephoto_2023-04-04_12-51-06.jpg', 'Photographer', '', 'record quality pictures of events, people, pets, places or objects. ability to use camera hardware a', 'Damanhour', 'Egypt', 'help me ', 0, 0, '2023-04-04 00:32:04'),
(45, 39, 'omar', 'Omar@gmail.com', '642c08b0e2df3photo_2023-04-04_12-51-10.jpg', 'Driver', '', 'none', 'Damanhour', 'Egypt', 'can anyone help me?', 0, 0, '2023-04-04 00:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_feedback` varchar(100) NOT NULL,
  `stars` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `user_name`, `user_image`, `user_feedback`, `stars`) VALUES
(4, 36, 'Ismail', '642c070f063fcphoto_2023-04-04_12-51-01.jpg', 'amazing', 5),
(5, 39, 'omar', '642c08b0e2df3photo_2023-04-04_12-51-10.jpg', 'fantastic', 4),
(6, 17, 'Amr', '642c06869eee0photo_2023-04-04_12-50-59.jpg', 'wow', 5);

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `id` int(100) NOT NULL,
  `posted_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_job_type` varchar(100) NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_description` varchar(100) NOT NULL,
  `realtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`id`, `posted_id`, `user_id`, `user_name`, `user_image`, `user_job_type`, `user_state`, `user_country`, `user_description`, `realtime`) VALUES
(7, 42, 36, 'abdelroauf', '642c04e29b4ecphoto_2023-04-04_12-50-55.jpg', 'Junior Accountant', 'Damanhour', 'Egypt', 'job with salary 90$', '2023-04-03 23:50:33'),
(8, 45, 39, 'omar', '642c08b0e2df3photo_2023-04-04_12-51-10.jpg', 'Driver', 'Damanhour', 'Egypt', 'can anyone help me?', '2023-04-04 00:44:04'),
(9, 42, 8, 'abdelroauf', '642c04e29b4ecphoto_2023-04-04_12-50-55.jpg', 'Junior Accountant', 'Damanhour', 'Egypt', 'job with salary 90$', '2023-04-03 23:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `save_job`
--

CREATE TABLE `save_job` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `posted_id` int(100) NOT NULL,
  `company_id` int(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_image` varchar(100) NOT NULL,
  `realtime` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `salary` int(100) NOT NULL,
  `job_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `save_job`
--

INSERT INTO `save_job` (`id`, `user_id`, `posted_id`, `company_id`, `company_name`, `company_image`, `realtime`, `title`, `city`, `country`, `salary`, `job_type`) VALUES
(6, 0, 4, 3, 'GQ Magazine', 'GQ.jpg', '2023-03-13 00:00:00', 'Photographer', ' London', 'England', 120, ' Temporary Job'),
(7, 0, 13, 8, 'Paypal', 'paypal.jpg', '2023-03-25 00:00:00', 'Security Guard', 'Singapore', 'Singapore', 60, 'part-time'),
(15, 6, 4, 3, 'GQ Magazine', 'GQ.jpg', '2023-03-13 00:00:00', 'Photographer', ' London', 'England', 120, ' Temporary Job'),
(16, 6, 2, 1, 'Amazon', 'amazon.jpg', '2023-03-25 00:00:00', 'Delivery', 'Cairo', 'Egypt', 70, ' part-time'),
(17, 7, 6, 2, 'McDonalds', 'mac.jpg', '2023-03-22 00:00:00', 'Restaurant Job', ' Alexandria', 'Egypt', 80, ' Contract Job'),
(18, 17, 8, 6, 'Starbucks', 'starbucks.jpg', '2023-03-07 00:00:00', 'Waiter', ' Alexandria', 'Egypt', 55, ' Contract Job'),
(20, 17, 6, 2, 'McDonalds', 'mac.jpg', '2023-03-22 00:00:00', 'Restaurant Job', ' Alexandria', 'Egypt', 80, ' Contract Job'),
(21, 9, 10, 7, 'Nike', 'nike.jpg', '2023-03-22 00:00:00', 'HR Manager', 'Laakdal', 'Belgium', 230, ' full-time'),
(22, 37, 13, 8, 'Paypal', 'paypal.jpg', '2023-03-25 00:00:00', 'Security Guard', 'Singapore', 'Singapore', 60, 'part-time'),
(23, 39, 6, 2, 'McDonalds', 'mac.jpg', '2023-03-22 00:00:00', 'Restaurant Job', ' Alexandria', 'Egypt', 80, ' Contract Job'),
(24, 39, 8, 6, 'Starbucks', 'starbucks.jpg', '2023-03-07 00:00:00', 'Waiter', ' Alexandria', 'Egypt', 55, ' Contract Job');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `user_email`, `message`) VALUES
(1, 'user@gmail.com', 'problem'),
(2, 'Yassin@gmail.com', 'i don\'t know'),
(3, 'Omar@gmail.com', 'I don\'t know');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `image` varchar(200) DEFAULT 'default user.jpg',
  `age` int(100) NOT NULL,
  `dob` date NOT NULL,
  `experience` int(100) NOT NULL,
  `cv` varchar(535) NOT NULL,
  `details` varchar(100) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `country`, `state`, `image`, `age`, `dob`, `experience`, `cv`, `details`, `job_type`, `gender`, `user_type`) VALUES
(1, 'abdelroauf', 'abdelroauf.halaby@gmail.com', 100254862, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c02f33f3d6photo_2023-04-04_12-50-47.jpg', 20, '2002-05-06', 0, '', 'none', '', 'Male', 'admin'),
(2, 'user', 'user@gmail.com', 123456789, 'abcd@ABCD1234', 'Egypt', 'Alexandria', '642c0354951e2photo_2023-04-04_12-50-55.jpg', 28, '1993-03-24', 3, '', 'none', 'Junior Accountant', 'Male', 'user'),
(3, 'user', 'user2@gmail.com', 1552002574, 'abc@ABC1234', 'Bahrain', 'Damanhour', '642c03c7d914bphoto_2023-04-04_12-51-05.jpg', 50, '0000-00-00', 0, '', 'bgf', 'Driver', 'Female', 'user'),
(4, 'none', 'none@gmail.com', 123456789, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c0398e46ffphoto_2023-04-04_12-50-49.jpg', 52, '0000-00-00', 0, '', 'gbdvx', 'Waiter', 'Female', 'user'),
(5, 'none', 'none2@gmail.com', 215747275, 'abc@ABC1234', 'Anguilla', 'Damanhour', '642c03ee6465fphoto_2023-04-04_12-51-10.jpg', 22, '2023-03-11', 0, '', 'dbv', 'Photographer', 'Male', 'user'),
(6, 'abdelroauf', 'abdelroauf2.halaby@gmail.com', 2147483647, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c041024350photo_2023-04-04_12-51-06.jpg', 20, '2002-05-06', 0, '', 'none', 'Restaurant Job', 'Male', 'user'),
(7, 'Ahmed', 'Ahmed@gmail.com', 123456789, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c04388e744photo_2023-04-04_12-50-59.jpg', 22, '2000-06-07', 0, '', 'none', 'Delivery', 'Male', 'user'),
(8, 'Mohamed', 'Mohamed@gmail.com', 1324566789, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c0481e16a5photo_2023-04-04_12-51-01.jpg', 20, '2002-05-06', 0, '', 'no', 'Security Guard', 'Male', 'user'),
(9, 'abdelroauf', 'Abdelroauf@gmail.com', 2147483647, 'abc@ABC1234', 'Egypt', 'Damanhour', '642c049e2a755photo_2023-04-04_12-50-57.jpg', 20, '2002-05-06', 0, '', 'nooo', 'Sales Associate', 'Male', 'user'),
(10, 'Mohaned', 'Mohaned@gmail.com', 123456891, 'abc@ABC12345', 'Egypt', 'Damanhour', '642c04bc41ee6photo_2023-04-04_12-51-10.jpg', 20, '2002-05-06', 0, '', 'lol', 'HR Manager', 'Male', 'user'),
(11, 'kfc', 'kfc@gmail.com', 123456789, 'abc@ABC12345', 'Mexico', 'Chiapas', '642b475b52a5bkfc.jpg', 60, '1953-10-22', 0, '', 'hehe', 'Delivery', 'Male', 'user'),
(12, 'abdelroauf', 'Abdelroauf2@gmail.com', 1154812462, 'abc@ABC1234', 'Egypt', 'Damanhour', '642c04e29b4ecphoto_2023-04-04_12-50-55.jpg', 20, '2002-05-06', 0, '', 'nothing\r\n', 'Junior Accountant', 'Male', 'user'),
(13, 'meeen', 'meen@gmail.com', 198745263, 'abc@ABC12345', 'Bahrain', 'Bahrian', '642c0519ac37bphoto_2023-04-04_12-51-03.jpg', 30, '1993-08-02', 0, '', 'nothing', 'Delivery', 'Female', 'user'),
(16, 'whyMe', 'whyMe@gmail.com', 258963147, 'abc@ABC12345', 'Egypt', 'Alexandria', '642c053d696bbphoto_2023-04-04_12-50-47.jpg', 30, '1992-04-30', 1, 'CV1.pdf', 'fs', 'Photographer', 'Male', 'user'),
(17, 'Amr', 'Amr@gmail.com', 136489527, 'abc@ABC12345', 'Egypt', 'Alexandria', '642c06869eee0photo_2023-04-04_12-50-59.jpg', 25, '1997-04-18', 4, 'CV2.pdf', 'sv v s', 'Photographer', 'Male', 'user'),
(18, 'Nour', 'Nour@gmail.com', 147859632, 'abc@ABC1234', 'Egypt', 'Alexandria', '642c06e926bd8photo_2023-04-04_12-51-05.jpg', 25, '1997-10-30', 2, '', 'hhfbd', 'Photographer', 'Male', 'user'),
(36, 'Ismail', 'Ismail@gmail.com', 123456789, 'abc@ABC123', 'Egypt', 'Alexandria', '642c070f063fcphoto_2023-04-04_12-51-01.jpg', 34, '1980-08-04', 1, 'CV3.pdf', 'worked as waiter for one year', 'Waiter', 'Male', 'user'),
(37, 'Momen', 'Momen@gmail.com', 147896523, 'abc@ABC123', 'Egypt', 'Cairo', '642c07b7746cbphoto_2023-04-04_12-50-59.jpg', 22, '2000-05-04', 3, 'CV1.pdf', 'brave', 'Security Guard', 'Male', 'user'),
(38, 'Ibrahim', 'Ibrahim@gmail.com', 124578963, 'abc@ABC1234', 'Egypt', 'Damanhour', '642c0801e13eephoto_2023-04-04_12-51-06.jpg', 20, '2002-05-06', 2, 'CV4.pdf', 'record quality pictures of events, people, pets, placeas or objects. ability to use camera hardware ', 'Photographer', 'Male', 'user'),
(39, 'omar', 'Omar@gmail.com', 123965478, 'abc@ABC123', 'Egypt', 'Damanhour', '642c08b0e2df3photo_2023-04-04_12-51-10.jpg', 20, '2002-05-06', 2, '642c0822d7497CV4.pdf', 'none', 'Driver', 'Male', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `need_job`
--
ALTER TABLE `need_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_job`
--
ALTER TABLE `save_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `need_job`
--
ALTER TABLE `need_job`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `save_job`
--
ALTER TABLE `save_job`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
