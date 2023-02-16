--
-- Database: `phpsamples`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `name`, `experience`, `major`) VALUES
(1, 'Fernando', 12, 'Computer Science'),
(2, 'Reena', 7, 'Artificial Intelligence'),
(3, 'Robert', 8, 'Statistics'),
(4, 'Abraham', 19, 'Mathematics'),
(5, 'Jonathan', 10, 'Operation Research'),
(6, 'Oliver', 13, 'Computer Science'),
(7, 'David', 12, 'Artificial Intelligence'),
(8, 'Mclane', 13, 'Statistics'),
(9, 'Rosario', 14, 'Mathematics'),
(10, 'Antony', 15, 'Operation Research'),
(11, 'Abel', 16, 'Computer Science'),
(12, 'Jennifer', 17, 'Artificial Intelligence'),
(13, 'Jane Thomas', 12, 'Statistics'),
(14, 'Sara', 19, 'Mathematics'),
(15, 'Sebastian', 20, 'Operation Research'),
(16, 'Sophia', 13, 'Computer Science'),
(17, 'Isabella', 22, 'Digital Systems'),
(18, 'Gabriel', 7, 'Artificial Intelligence'),
(19, 'Grace Lilly', 16, 'Statistics'),
(20, 'victoria', 5, 'Mathematics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);
COMMIT;
