
-- Database: `prod-rating`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `ratings` int NOT NULL
);
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL
);

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(11, 'iPhone 8', 'https://images.unsplash.com/photo-1603791239531-1dda55e194a6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8YXBwbGUlMjBpcGhvbmV8ZW58MHx8MHx8&w=1000&q=80', 20000),
(12, 'Samsung Galaxy', 'https://s.yimg.com/uu/api/res/1.2/tb8_.EHY4MxZLHRnk574iA--~B/aD0xNDQwO3c9MjU2MDthcHBpZD15dGFjaHlvbg--/https://media-mbst-pub-ue1.s3.amazonaws.com/creatr-uploaded-images/2022-02/1ac2b2e0-8927-11ec-bb4b-b8d31062c379.cf.jpg', 12000),
(13, 'Redmi 9C', 'https://tripplek.co.ke/wp-content/uploads/2020/10/Xiaomi-Redmi-9C-FT0.jpg', 12000),
(14, 'iPhone x', 'https://images.unsplash.com/photo-1515054562254-30a1b0ebe227?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8aXBob25lJTIweHxlbnwwfHwwfHw%3D&w=1000&q=80', 29000),
(15, 'Samsung Note', 'https://www.mobilehub.co.ke/wp-content/uploads/2022/11/samsung-galaxy-note-10-lite-650x433-2.jpg', 12000),
(16, 'Redmi 12', 'https://i0.wp.com/techweez.com/wp-content/uploads/2022/04/featured.jpg?fit=1280%2C960&ssl=1', 12000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;
