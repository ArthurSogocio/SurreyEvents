-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2018 at 05:24 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surreyevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Arts'),
(2, 'Business'),
(3, 'Community Hosted'),
(4, 'Festivals'),
(5, 'Heritage'),
(6, 'Kids and Family'),
(7, 'Parks and Environment'),
(8, 'Public Meetings and Open Houses'),
(9, 'Recreation and Sport'),
(10, 'Seniors'),
(11, 'Youth');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `category_id`, `address`, `town_id`, `description`, `start_date`, `end_date`, `img_url`, `website_url`) VALUES
(1, 'SASSY Awards', 11, 'Surrey City Hall, 13450 104 Ave', 1, 'Celebrate youth ages 15 to 21 who are making a difference in Surrey and White Rock.', '2018-05-17 00:00:00', '2018-05-17 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SassyAwards2017.jpg', 'https://www.surrey.ca/culture-recreation/26053.aspx'),
(2, 'Cloverdale Pickle Ball Tournament 2018', 9, 'Cloverdale Recreation Centre, 6188 176 St', 2, 'Join us at the 3rd Annual Pickle Ball Tournament at Cloverdale Recreation Centre.', '2018-03-31 00:00:00', '2018-03-31 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/PickleBall1.jpg', 'https://www.surrey.ca/culture-recreation/26127.aspx'),
(3, 'Park Play Palooza at Hazelgrove Park', 6, 'Hazelgrove Park, 7080 190 St', 2, 'Park Play kicks off the summer with Palooza at Hazelgrove Park.', '2018-06-23 00:00:00', '2018-06-23 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/webpage_image2018.jpg', 'https://www.surrey.ca/culture-recreation/26246.aspx'),
(4, 'TRI Surrey 2018', 9, 'Guildford Recreation Centre, 15105 105 Ave', 0, 'Join us for Surrey\'s second annual spring triathlon and accomplish your fitness goals!', '2018-03-25 00:00:00', '2018-03-25 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/TriSurreySwimmer.jpg', 'https://www.surrey.ca/culture-recreation/25340.aspx'),
(5, 'Environmental Extravaganza - Week 5', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-05-13 00:00:00', '2018-05-19 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Extravaganza%20rainy%20colourful%20walk.jpg', 'https://www.surrey.ca/culture-recreation/22496.aspx'),
(6, 'Public Art Bus Tour', 1, 'Surrey City Hall, 13450 104 Ave', 1, 'Discover dynamic public art on a bus tour around Surrey, Vancouver, and North Vancouver!', '2018-06-26 00:00:00', '2018-06-26 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/NebulaGarden.jpg', 'https://www.surrey.ca/culture-recreation/26162.aspx'),
(7, 'Environmental Extravaganza - Week 6', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-05-20 00:00:00', '2018-05-26 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Girl%20with%20Fish.jpg', 'https://www.surrey.ca/culture-recreation/22497.aspx'),
(8, '48th Annual Happiness Dance', 3, 'Kennedy Hall, 8870 120 St', 3, 'Enjoy a fun evening out at this fundraiser for The Centre for Child Development.', '2018-03-24 00:00:00', '2018-03-24 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SquareDancers.png', 'https://www.surrey.ca/culture-recreation/26131.aspx'),
(9, 'From Berlin to Hollywood', 1, 'Studio Theatre at Surrey Arts Centre, 13750 88 Avenue', 3, 'Indulge your cravings for good company, great music, and delicious treats | Surrey Arts Centre', '2018-04-19 00:00:00', '2018-04-19 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/BergmannPianoDuoEP.jpg', 'https://www.surrey.ca/culture-recreation/24161.aspx'),
(10, 'Artists Conversation with Jim Bizzocchi and Ben Bogart', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Join artists Jim Bizzocchi and Ben Bogart for a conversation about their digital work on exhibit.', '2018-06-02 00:00:00', '2018-06-02 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/ArtistsConversationWeb.jpg', 'https://www.surrey.ca/culture-recreation/26219.aspx'),
(11, 'Social Innovation Summit', 2, 'Surrey City Hall, 13450 104 Ave', 3, 'Transform our times by engaging in the Surrey Social Innovation Summit.', '2018-09-05 00:00:00', '2018-09-06 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SocialInnovationSummitAttendees.jpg', 'https://www.surrey.ca/community/19760.aspx'),
(12, 'Bicycle Trek for Life & Breath', 3, 'Hazelmere Campground, 18843 8 Ave', 4, 'Challenge yourself during the Bicycle Trek for Life & Breath, a 200-km ride in the Fraser Valley.', '2018-09-08 00:00:00', '2018-09-09 00:00:00', '', 'https://www.surrey.ca/culture-recreation/26263.aspx'),
(13, 'Multi-Cultural Training Tour', 3, '', 5, 'Take a tour of a Muslim mosque, Sikh temple, Hindu temple and Buddhist temple. Event includes lunch.', '2018-04-07 00:00:00', '2018-04-07 00:00:00', '', 'https://www.surrey.ca/culture-recreation/26300.aspx'),
(14, 'Arbor Day Celebration', 6, '', 5, 'Join us as we celebrate Surrey?s 14th annual Arbor Day?a day to celebrate trees!', '2018-04-21 00:00:00', '2018-04-21 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArborDayFamilyPlanting.jpg', 'https://www.surrey.ca/culture-recreation/26358.aspx'),
(15, 'Teen Art Drop-In', 1, 'City Centre Library, 10350 University Dr', 1, 'Get creative this Spring Break at our free Art Drop-In. No skills required. All teens welcome.', '2018-03-21 00:00:00', '2018-03-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ComArt_ArtDropIn_Clay.jpg', 'https://www.surrey.ca/culture-recreation/26302.aspx'),
(16, 'Active Aging Resource Fair ', 2, 'Guildford Recreation Centre, 15105 105 Ave', 6, 'Join us for the second annual Active Aging Resource Fair!', '2018-03-24 00:00:00', '2018-03-24 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/resource%20fair%202.png', 'https://www.surrey.ca/culture-recreation/25794.aspx'),
(17, 'Newton Talks April 2018', 3, 'Greek Corner, 7218 King George Blvd', 5, 'Join the Newton BIA for a discussion facilitated by Melanie Gaboriault with the Surrey LRT Project.', '2018-04-12 00:00:00', '2018-04-12 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/NewtonTalksApril.png', 'https://www.surrey.ca/culture-recreation/25986.aspx'),
(18, 'Environmental Extravaganza - Week 2', 7, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-04-22 00:00:00', '2018-04-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArborDay16_GroupWithTree.jpg', 'https://www.surrey.ca/culture-recreation/22493.aspx'),
(19, 'Clean Sweep Week 2018', 6, '', 0, 'Help beautify your community by organizing a litter cleanup during Surrey\'s annual Clean Sweep Week!', '2018-04-21 00:00:00', '2018-04-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Webimage_CS2017_SterlingTalent_1.jpg', 'https://www.surrey.ca/culture-recreation/22011.aspx'),
(20, 'Environmental Extravaganza - Week 8', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-06-03 00:00:00', '2018-06-09 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/BeachHeroSeaStar.jpg', 'https://www.surrey.ca/culture-recreation/22500.aspx'),
(21, 'Environmental Extravaganza - Week 4', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-05-06 00:00:00', '2018-05-12 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/OwlProwl%20owl%20and%20audience.jpg', 'https://www.surrey.ca/culture-recreation/22495.aspx'),
(22, 'BC Construction and Home Show', 3, 'Cloverdale Fairgrounds Agriplex Bldg, 6050 176 St', 2, 'Learn about the latest trends & innovations in the Metro Vancouver construction and housing markets. ', '2018-06-09 00:00:00', '2018-06-10 00:00:00', '', 'https://www.surrey.ca/culture-recreation/25974.aspx'),
(23, 'Easter Activities', 6, '', 0, 'Hop on over to a facility in Surrey for some Easter-themed events!', '2018-03-24 00:00:00', '2018-04-02 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Easter.jpg', 'https://www.surrey.ca/culture-recreation/26088.aspx'),
(24, 'Adjacentlands: Conversation on Contemporary Art', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Learn about the changing nature of Canadian art and celebrate the launch of a new publication!', '2018-04-25 00:00:00', '2018-04-25 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/AdjacentlandsWeb.jpg', 'https://www.surrey.ca/culture-recreation/26152.aspx'),
(25, 'Seedy Saturday', 5, 'Stewart Farm House, 13723 Crescent Rd', 4, 'Get a great start on this year?s garden at the Stewart Farm?s annual seed and plant sale.', '2018-04-07 00:00:00', '2018-04-07 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20Seedy%20Saturday.jpg', 'https://www.surrey.ca/culture-recreation/2889.aspx'),
(26, 'Guildford Recreation Centre\'s Spring Open House', 6, 'Guildford Recreation Centre, 15105 105 Ave', 0, 'Meet staff and people in your community while learning about fun recreation programs in Guildford!', '2018-04-04 00:00:00', '2018-04-04 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/GuildfordRecreationStaff.jpg', 'https://www.surrey.ca/culture-recreation/26087.aspx'),
(27, 'Tami Neilson', 1, 'Centre Stage at Surrey City Hall, 13450 104 Ave', 3, 'Due to circumstances beyond the artist?s control, this concert has been cancelled.', '2018-04-15 00:00:00', '2018-04-15 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TamiNeilsonEP.jpg', 'https://www.surrey.ca/culture-recreation/24160.aspx'),
(28, 'Pre-teen Dances', 6, '', 0, 'Meet your friends at one of Surrey\'s fun pre-teen dances!', '2018-03-16 00:00:00', '2018-06-15 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/PreTeenDance.jpg', 'https://www.surrey.ca/culture-recreation/20955.aspx'),
(29, 'Lifeguard Information Sessions', 9, '', 0, 'Join us for a free information session and learn how to become a lifeguard or instructor in Surrey. ', '2018-03-19 00:00:00', '2018-06-25 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/LifeguardInfoSession.jpg', 'https://www.surrey.ca/culture-recreation/24132.aspx'),
(30, 'Vaisakhi Day Parade', 1, 'Gurdwara Sahib Dasmesh Darbar, 12885 85 Ave', 5, 'Come to the annual Vaisakhi Parade featuring cultural floats, performers and free food & drink from local residents and businesses.', '2018-04-21 00:00:00', '2018-04-21 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/VaisakhiParade.jpg', 'https://www.surrey.ca/culture-recreation/15046.aspx'),
(31, 'Mother\'s Day at The Glades Garden', 6, 'The Glades, 561 172 St', 0, 'Celebrate Mother\'s Day in the stunning woodland garden of The Glades.', '2018-05-13 00:00:00', '2018-05-13 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/MothersDayTheGlades2016.jpg', 'https://www.surrey.ca/culture-recreation/8566.aspx'),
(32, 'Environmental Extravaganza - Week 3', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-04-29 00:00:00', '2018-05-05 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Salmon%20Sendoff%20girl%20visible%20fish.jpg', 'https://www.surrey.ca/culture-recreation/22494.aspx'),
(33, 'The Art of Dance: An International Dance Day Celebration', 3, 'Studio Theatre at Surrey Arts Centre, 13750 88 Avenue', 3, 'Witness spectacular dance performances plus original artworks | Studio Theatre at Surrey Arts Centre', '2018-04-29 00:00:00', '2018-04-29 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/InternationalDayofDance.png', 'https://www.surrey.ca/culture-recreation/26154.aspx'),
(34, 'Neighbourhood Tree Parties', 6, '', 0, 'Drop-in to plant shade trees, improve tree wells, enjoy tree-themed activities and free pizza!', '2018-04-04 00:00:00', '2018-04-25 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Website%20resize.jpg', 'https://www.surrey.ca/culture-recreation/22573.aspx'),
(35, 'Kala-Sikh Art Exhibition', 3, 'Surrey City Hall, 13450 104 Ave', 1, 'Join in on the opening night of Sikh Heritage Month at the Kala-Sikh Art Exhibition.', '2018-04-01 00:00:00', '2018-04-01 00:00:00', '', 'https://www.surrey.ca/culture-recreation/26347.aspx'),
(36, 'National Lifejacket Day', 6, 'Newton Recreation Centre, 13730 72 Ave', 5, 'Be safe in and around the water at Newton Recreation Centre\'s National Lifejacket Day event. ', '2018-05-17 00:00:00', '2018-05-17 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/LifejacketDay.jpg', 'https://www.surrey.ca/culture-recreation/26109.aspx'),
(37, 'Birding Walks', 6, '', 0, 'Join a local naturalist for a series of free monthly walks to discover Surrey\'s birds!', '2017-09-16 00:00:00', '2018-05-19 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/chickadeesonbranch.jpg', 'https://www.surrey.ca/culture-recreation/24773.aspx'),
(38, 'Family Nights in Cloverdale', 6, 'Cloverdale Recreation Centre, 6188 176 St', 2, 'Enjoy a free, fun night with your family in Cloverdale!', '2018-03-16 00:00:00', '2018-06-15 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/FamilyMakingCrafts.jpg', 'https://www.surrey.ca/culture-recreation/23500.aspx'),
(39, 'Newton Family Easter Party', 6, 'Newton Seniors Centre, 13775 70 Ave', 5, 'A fun, free family event including an Easter egg hunt, face painting, crafts, games and more!', '2018-03-24 00:00:00', '2018-03-24 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/EasterEggs.jpg', 'https://www.surrey.ca/culture-recreation/26218.aspx'),
(40, 'Exhibition Tour of Flow', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Enjoy a free tour of the artwork in the exhibit Flow featuring work from our permanent collection.', '2018-05-05 00:00:00', '2018-05-05 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/ExhibitionTour_web.jpg', 'https://www.surrey.ca/culture-recreation/26181.aspx'),
(41, 'Party for the Planet', 4, 'City Hall Plaza', 3, 'Join us in Surrey City Hall Plaza for Party for the Planet, B.C.\'s largest Earth Day celebration!', '2018-04-14 00:00:00', '2018-04-14 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SamNuge_991x557.jpg', 'https://www.surrey.ca/culture-recreation/11076.aspx'),
(42, 'Purely Local Spring Market 2018', 3, 'Kwomais Point Park, 1367 128 St', 4, 'Check out this one-day market featuring locally made food, home decor and baby clothing and toys.', '2018-04-07 00:00:00', '2018-04-07 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/PurelyLocalMarket2018.jpg', 'https://www.surrey.ca/culture-recreation/26187.aspx'),
(43, 'Time Machine Travelers', 5, 'Historic Stewart Farm, 13723 Crescent Rd', 4, 'Sign up the kids for a unique Spring Break Day Camp they will not soon forget.', '2018-03-20 00:00:00', '2018-03-23 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20at%20Spring%20Break.jpg', 'https://www.surrey.ca/culture-recreation/10681.aspx'),
(44, 'Cloverdale Town Centre Plan Open House', 8, 'Cloverdale Rodeo & Exhibition Association - Shannon Hall, 6050 176 St', 2, 'Join us on June 14 to share your feedback on the draft updates to the Cloverdale Town Centre Plan', '2018-06-14 00:00:00', '2018-06-14 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Surrey_Open_House%20_Event.jpg', 'https://www.surrey.ca/city-government/26329.aspx'),
(45, 'Glades Garden Open Houses', 6, 'The Glades, 561 172 St', 4, 'Visit this stunning 15-acre woodland garden during select openings this spring.', '2018-05-13 00:00:00', '2018-07-04 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/TheGladesRidgeViewpointScarletBlackDSC_1320.jpg', 'https://www.surrey.ca/culture-recreation/10664.aspx'),
(46, '16th Annual Early Years Festival', 6, 'Chuck Bailey Recreation Centre, 13458 107a Ave', 3, 'Spend a fun afternoon with your kids (babies to age 6) at the Early Years Festival!', '2018-04-07 00:00:00', '2018-04-07 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/EarlyYearsFestival2018.jpg', 'https://www.surrey.ca/culture-recreation/25512.aspx'),
(47, 'Surrey Animal Resource Centre Scent-Topia', 6, '', 2, 'An Amazing Scent Race - handlers and their dogs race around Surrey to sniff out hidden target odours', '2018-04-14 00:00:00', '2018-04-14 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SURREY%20EVENTS%20IMAGE.jpg', 'https://www.surrey.ca/culture-recreation/26244.aspx'),
(48, 'Get Growing at Darts Hill', 6, 'Darts Hill Garden Park, 1660 168 St', 4, 'Learn how to get growing at Darts Hill Garden\'s spring open house.', '2018-04-28 00:00:00', '2018-04-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/DartsHillSpring2015ScarletBlack_webpagefeature.jpg', 'https://www.surrey.ca/culture-recreation/26269.aspx'),
(49, 'Surrey Art Teachers Association Exhibition Reception', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Celebrate the opening of the exhibition Praxis by the Surrey Art Teachers Association.', '2018-05-17 00:00:00', '2018-05-17 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TeachersOpeningWeb.jpg', 'https://www.surrey.ca/culture-recreation/26182.aspx'),
(50, 'Discovery Days at the Surrey Nature Centre', 6, 'Surrey Nature Centre, 14225 Green Timbers Way', 3, 'Take part in numerous festivities taking place during Discovery Days at the Surrey Centre.', '2018-05-04 00:00:00', '2018-05-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Nature%20Play%20-%20preschool%20girl.jpg', 'https://www.surrey.ca/culture-recreation/24109.aspx'),
(51, 'Environmental Extravaganza - Week 7', 6, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-05-27 00:00:00', '2018-06-02 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SundayMorningBirding.jpg', 'https://www.surrey.ca/culture-recreation/22499.aspx'),
(52, 'Artist Talk and Spring Opening Reception ', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Celebrate the opening of our spring exhibitions!', '2018-04-14 00:00:00', '2018-04-14 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/OpeningReceptionWeb.jpg', 'https://www.surrey.ca/culture-recreation/26117.aspx'),
(53, 'Celebrate the Arts', 10, 'Guildford Recreation Centre, 15105 105 Ave', 6, 'Celebrate the arts with this free event that brings youth and seniors together!', '2018-03-29 00:00:00', '2018-03-29 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/TeenWithSenior.jpg', 'https://www.surrey.ca/community/26031.aspx'),
(54, 'Park Play', 7, '', 0, 'Join us this summer in a park near you for free and fun activities!', '2018-07-03 00:00:00', '2018-08-23 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/webpageparkplayresize.jpg', 'https://www.surrey.ca/culture-recreation/1818.aspx'),
(55, 'Guided Nature Walks', 7, '', 0, 'Get to know one of Surrey\'s nature parks by joining a free guided walk!', '2018-01-20 00:00:00', '2018-06-16 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Guided%20nature%20walk.jpg', 'https://www.surrey.ca/culture-recreation/20580.aspx'),
(56, 'School\'s Out Activities', 1, 'Various', 0, 'Keep your kids busy with fun activities during their next Pro D Day on May 4, 2018.', '2018-05-04 00:00:00', '2018-05-04 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SchoolsOutActivties.jpg', 'https://www.surrey.ca/culture-recreation/17827.aspx'),
(57, 'Artist Talk and Demonstration with Alex McLeod', 1, 'Surrey Art Gallery, 13750 88 Avenue', 3, 'Join UrbanScreen artist Alex McLeod at to learn how he creates his fantastical virtual worlds.', '2018-04-27 00:00:00', '2018-04-27 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/McLeod_preview_2_web.jpg', 'https://www.surrey.ca/culture-recreation/25671.aspx'),
(58, 'Clayton Community Farmer\'s Market', 3, 'Clayton Heights Secondary School, 7003 188 St', 0, 'Shop local at the new Clayton Community Farmer\'s Market happening on alternating Sundays in 2018.', '2018-05-13 00:00:00', '2018-09-16 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ClaytonHeightsFarmersMarket.jpg', 'https://www.surrey.ca/culture-recreation/25875.aspx'),
(59, 'Clayton Community Garden Build Day', 6, 'Clayton Dog Off-Leash Park, 7011 188 St', 2, 'Assemble garden beds, spread bark mulch, and paint signs. Plus snacks, music and kids\' actvities.', '2018-04-28 00:00:00', '2018-04-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Clayton%20Community%20Garden%20Build%20Day%20Event.jpg', 'https://www.surrey.ca/culture-recreation/26251.aspx'),
(60, 'Regular Council Public Hearing Meeting', 8, 'City Hall Council Chambers', 0, 'Attend the next Surrey Public Hearing meeting and hear or speak to public hearing items.', '2018-04-09 00:00:00', '2018-04-09 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/CityHallCouncilChambers.jpg', 'https://www.surrey.ca/city-government/14886.aspx'),
(61, 'Spring Fling', 6, 'Surrey Nature Centre', 3, 'Bring the family to play and discover nature at this free event at the Surrey Nature Centre!', '2018-03-21 00:00:00', '2018-03-21 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/WildWednesday%20-%20girl%20and%20NG%20with%20bug%20jars.jpg', 'https://www.surrey.ca/culture-recreation/10739.aspx'),
(62, 'Mad Hatter\'s Strawberry Tea and Tour', 1, 'Surrey Art Gallery, 13750 88 Avenue', 0, 'Join members of Surrey Art Gallery Association for an exhibition tour and strawberry shortcake!', '2018-06-28 00:00:00', '2018-06-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/RedBerriesAndFriend_web.jpg', 'https://www.surrey.ca/culture-recreation/13448.aspx'),
(63, 'Spring Community Dance', 6, 'Clayton Community Hall, 18513 70 Ave', 2, 'Bring your dance moves and groove to 50\'s music at Clayton Community Hall! ', '2018-04-07 00:00:00', '2018-04-07 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/SpringCommunityDance.jpg', 'https://www.surrey.ca/culture-recreation/26330.aspx'),
(64, 'Old Fashioned Easter', 5, 'Historic Stewart Farm, 13723 Crescent Rd', 4, 'After your Easter egg hunt at home, make your way to the Farm to continue the fun.', '2018-03-31 00:00:00', '2018-03-31 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Easter%20Event%20Image.jpg', 'https://www.surrey.ca/culture-recreation/22375.aspx'),
(65, 'Surrey International Children\'s Festival', 1, 'Bear Creek Park / Surrey Arts Centre, 13750 88 Ave', 0, 'Get artsy at Surrey International Children?s Festival! ', '2018-05-24 00:00:00', '2018-05-27 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/KidsPuppetShow.jpg', 'https://www.surrey.ca/culture-recreation/8863.aspx'),
(66, 'My Funny Valentine', 1, 'Centre Stage at Surrey City Hall, 13450 104 Ave', 3, 'One actor portrays seven characters on the fringes of a murder | Centre Stage at Surrey City Hall', '2018-06-28 00:00:00', '2018-06-28 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/MyFunnyValentineEP.jpg', 'https://www.surrey.ca/culture-recreation/24163.aspx'),
(67, 'The Fish Eyes Trilogy', 1, 'Main Stage at Surrey Arts Centre, 13750 88 Avenue', 3, 'High school. Sometimes you\'re forced to navigate rocky terrain | Surrey Arts Centre', '2018-08-18 00:00:00', '2018-08-18 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TheFishEyesTrilogySurreyCivicTheatres.jpg', 'https://www.surrey.ca/culture-recreation/24164.aspx'),
(68, 'Spring Break Drop In', 5, 'Historic Stewart Farm, 13723 Crescent Rd', 4, 'Bring the kids for free activities, a nature walk and endless photo opps.', '2018-03-27 00:00:00', '2018-03-29 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20Spring%20Break%20Drop%20In.jpg', 'https://www.surrey.ca/culture-recreation/26186.aspx'),
(69, 'Environmental Extravaganza - Week 1', 7, '', 0, 'Explore and learn about nature with these free programs and events!', '2018-04-15 00:00:00', '2018-04-21 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/TrailWalkSunnysideAcres.jpg', 'https://www.surrey.ca/culture-recreation/22492.aspx'),
(70, 'Coastal Flood Adaptation Strategy Open House', 7, '', 4, 'Learn about Surrey\'s Coastal Flood Adaptation Strategy at the next CFAS Open House 10 April, 2018.', '2018-04-10 00:00:00', '2018-04-10 00:00:00', 'https://www.surrey.ca/images/cos-master/pageImages/CFSA%20Open%20House,%20new%20image.jpg', 'https://www.surrey.ca/city-government/26286.aspx');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `sharing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `username`, `name`, `email`, `password_hash`, `is_admin`, `sharing`) VALUES
(1, 'tes', 'tes', 'tes@tes', '$2y$10$g9fTKbi0t1Mts9nOvAsAfOrXAEKS1taVXCG7Knm4H3GVGaCW7YYIK', 0, 0),
(2, 'ges', 'ges', 'ges@ges', '$2y$10$OB2wCR14zHmWhgQ3L62/b.iXt/1lHVAihB5hoh3bn4ws56agA8.pi', 0, 0),
(3, 'fas', 'fas', 'fas@fas', '$2y$10$KWUhLLuxZ6UnMDDsB/H8T.VCBV/bOBgmiAMBTymgWw/KAlHP3qoVi', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `original_datatable`
--

CREATE TABLE `original_datatable` (
  `GUID` varchar(36) NOT NULL,
  `Event Title` varchar(73) DEFAULT NULL,
  `Teaser Text` varchar(131) DEFAULT NULL,
  `Event Image` varchar(110) DEFAULT NULL,
  `Event URL` varchar(51) DEFAULT NULL,
  `Event Location` varchar(69) DEFAULT NULL,
  `Event Location URL` varchar(50) DEFAULT NULL,
  `Start Date` varchar(10) DEFAULT NULL,
  `Start Time` varchar(5) DEFAULT NULL,
  `Start Time Zone` varchar(14) DEFAULT NULL,
  `End Date` varchar(11) DEFAULT NULL,
  `End Time` varchar(5) DEFAULT NULL,
  `End Time Zone` varchar(14) DEFAULT NULL,
  `Categories__001` varchar(31) DEFAULT NULL,
  `Categories__002` varchar(31) DEFAULT NULL,
  `Categories__003` varchar(21) DEFAULT NULL,
  `Categories__004` varchar(20) DEFAULT NULL,
  `Categories__005` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `original_datatable`
--

INSERT INTO `original_datatable` (`GUID`, `Event Title`, `Teaser Text`, `Event Image`, `Event URL`, `Event Location`, `Event Location URL`, `Start Date`, `Start Time`, `Start Time Zone`, `End Date`, `End Time`, `End Time Zone`, `Categories__001`, `Categories__002`, `Categories__003`, `Categories__004`, `Categories__005`) VALUES
('029d0200-d42f-420b-89e3-1a109ccb8693', 'SASSY Awards', 'Celebrate youth ages 15 to 21 who are making a difference in Surrey and White Rock.', 'https://www.surrey.ca/images/cos-master/pageImages/SassyAwards2017.jpg', 'https://www.surrey.ca/culture-recreation/26053.aspx', 'Surrey City Hall, 13450 104 Ave', '', '17/05/2018', '20:00', 'Canada/Pacific', '17/05/2018', '22:00', 'Canada/Pacific', 'Youth', 'City Centre', '', '', ''),
('03b4ad74-a766-42ef-96e9-700cd9199208', 'Cloverdale Pickle Ball Tournament 2018', 'Join us at the 3rd Annual Pickle Ball Tournament at Cloverdale Recreation Centre.', 'https://www.surrey.ca/images/cos-master/pageImages/PickleBall1.jpg', 'https://www.surrey.ca/culture-recreation/26127.aspx', 'Cloverdale Recreation Centre, 6188 176 St', '', '31/03/2018', '9:00', 'Canada/Pacific', '31/03/2018', '14:00', 'Canada/Pacific', 'Recreation and Sport', 'Seniors', 'Youth', 'Cloverdale', ''),
('085fe08a-1d90-4834-b258-51598509fa34', 'Thursday Artist Talk: Eve Lees, \"How to Use the News to Promote Your Art\"', 'Catch the media\'s attention about your art!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/EveLeesWeb.jpg', 'https://www.surrey.ca/culture-recreation/26153.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '3/05/2018', '19:30', 'Canada/Pacific', '3/05/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('0949f349-221c-42af-b34e-ea8cb878a033', 'Thursday Artist Talk: Emilie Mae, \"Palette Knife Adventures\"', 'Learn how an abstract expressionist painter translates her personal experiences into art!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/EmilieMaeWeb.jpg', 'https://www.surrey.ca/culture-recreation/26155.aspx', 'Surrey Art Gallery, 13750 88 Avenue', '', '7/06/2018', '19:30', 'Canada/Pacific', '7/06/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('0b965593-454a-409e-848c-c81517d35b8b', 'Park Play Palooza at Hazelgrove Park', 'Park Play kicks off the summer with Palooza at Hazelgrove Park.', 'https://www.surrey.ca/images/cos-master/pageImages/webpage_image2018.jpg', 'https://www.surrey.ca/culture-recreation/26246.aspx', 'Hazelgrove Park, 7080 190 St', '', '23/06/2018', '11:00', 'Canada/Pacific', '23/06/2018', '14:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Youth', 'Cloverdale', ''),
('0cf7b61e-f8fc-415c-ae3a-61a9a497f357', 'TRI Surrey 2018', 'Join us for Surrey\'s second annual spring triathlon and accomplish your fitness goals!', 'https://www.surrey.ca/images/cos-master/pageImages/TriSurreySwimmer.jpg', 'https://www.surrey.ca/culture-recreation/25340.aspx', 'Guildford Recreation Centre, 15105 105 Ave', '', '25/03/2018', '11:00', 'Canada/Pacific', '25/03/2018', '15:00', 'Canada/Pacific', 'Recreation and Sport', 'Youth', '', '', ''),
('0d3e3958-c7d0-4706-bf02-a3cc730ceb8d', 'Environmental Extravaganza - Week 5', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/Extravaganza%20rainy%20colourful%20walk.jpg', 'https://www.surrey.ca/culture-recreation/22496.aspx', '', '', '13/05/2018', '0:00', 'Canada/Pacific', '19/05/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('10a9dd59-d281-4f02-bd9c-7e9fa9aaec71', 'Public Art Bus Tour', 'Discover dynamic public art on a bus tour around Surrey, Vancouver, and North Vancouver!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/NebulaGarden.jpg', 'https://www.surrey.ca/culture-recreation/26162.aspx', 'Surrey City Hall, 13450 104 Ave', 'http://www.surrey.ca/city-government/14172.aspx', '26/06/2018', '9:00', 'Canada/Pacific', '26/06/2018', '15:00', 'Canada/Pacific', 'Arts', 'City Centre', '', '', ''),
('21fbf376-782a-4952-bc93-c62bf0cbe94c', 'Environmental Extravaganza - Week 6', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/Girl%20with%20Fish.jpg', 'https://www.surrey.ca/culture-recreation/22497.aspx', '', '', '20/05/2018', '0:00', 'Canada/Pacific', '26/05/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('23dbaec3-c332-4be8-9a54-dbb17bdba4b6', '48th Annual Happiness Dance', 'Enjoy a fun evening out at this fundraiser for The Centre for Child Development.', 'https://www.surrey.ca/images/cos-master/pageImages/SquareDancers.png', 'https://www.surrey.ca/culture-recreation/26131.aspx', 'Kennedy Hall, 8870 120 St', '', '24/03/2018', '19:00', 'Canada/Pacific', '24/03/2018', '22:00', 'Canada/Pacific', 'Community Hosted', 'Whalley', '', '', ''),
('25ea1f02-7454-4bfd-a407-ecef9fa6c1ee', 'From Berlin to Hollywood', 'Indulge your cravings for good company, great music, and delicious treats | Surrey Arts Centre', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/BergmannPianoDuoEP.jpg', 'https://www.surrey.ca/culture-recreation/24161.aspx', 'Studio Theatre at Surrey Arts Centre, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1681.aspx', '19/04/2018', '0:00', 'Canada/Pacific', '19/04/2018', '0:00', 'Canada/Pacific', 'Arts', 'Seniors', 'Whalley', '', ''),
('265931ad-18c4-4b5c-a372-1c158df9bb31', 'Artists Conversation with Jim Bizzocchi and Ben Bogart', 'Join artists Jim Bizzocchi and Ben Bogart for a conversation about their digital work on exhibit.', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/ArtistsConversationWeb.jpg', 'https://www.surrey.ca/culture-recreation/26219.aspx', 'Surrey Art Gallery, 13750 88 Avenue', '', '2/06/2018', '14:30', 'Canada/Pacific', '2/06/2018', '16:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('2884b3d5-3e8b-4b66-9ad5-947be22c2d16', 'Social Innovation Summit', 'Transform our times by engaging in the Surrey Social Innovation Summit.', 'https://www.surrey.ca/images/cos-master/pageImages/SocialInnovationSummitAttendees.jpg', 'https://www.surrey.ca/community/19760.aspx', 'Surrey City Hall, 13450 104 Ave', '', '5/09/2018', '12:00', 'Canada/Pacific', '6/09/2018', '14:45', 'Canada/Pacific', 'Business', 'Public Meetings and Open Houses', 'Whalley', '', ''),
('2a41a03a-45a6-430b-82df-e9c3a3089278', 'Bicycle Trek for Life & Breath', 'Challenge yourself during the Bicycle Trek for Life & Breath, a 200-km ride in the Fraser Valley.', '', 'https://www.surrey.ca/culture-recreation/26263.aspx', 'Hazelmere Campground, 18843 8 Ave', '', '8/09/2018', '8:00', 'Canada/Pacific', '9/09/2018', '20:00', 'Canada/Pacific', 'Community Hosted', 'South Surrey', '', '', ''),
('2b6c59ca-3d56-4c5e-82a4-40f219768ac3', 'Multi-Cultural Training Tour', 'Take a tour of a Muslim mosque, Sikh temple, Hindu temple and Buddhist temple. Event includes lunch.', '', 'https://www.surrey.ca/culture-recreation/26300.aspx', '', '', '7/04/2018', '10:00', 'Canada/Pacific', '7/04/2018', '15:00', 'Canada/Pacific', 'Community Hosted', 'Newton', '', '', ''),
('2da50179-d182-4381-8dd7-f094d57a27c3', 'Arbor Day Celebration', 'Join us as we celebrate Surrey?s 14th annual Arbor Day?a day to celebrate trees!', 'https://www.surrey.ca/images/cos-master/pageImages/ArborDayFamilyPlanting.jpg', 'https://www.surrey.ca/culture-recreation/26358.aspx', '', 'http://www.surrey.ca/culture-recreation/2028.aspx', '21/04/2018', '10:00', 'Canada/Pacific', '21/04/2018', '13:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Newton', '', ''),
('2fad53ff-77bd-4df1-8f88-9045eee2b6b5', 'Teen Art Drop-In', 'Get creative this Spring Break at our free Art Drop-In. No skills required. All teens welcome.', 'https://www.surrey.ca/images/cos-master/pageImages/ComArt_ArtDropIn_Clay.jpg', 'https://www.surrey.ca/culture-recreation/26302.aspx', 'City Centre Library, 10350 University Dr', '', '21/03/2018', '15:30', 'Canada/Pacific', '28/03/2018', '17:30', 'Canada/Pacific', 'Arts', 'Library', 'Youth', 'City Centre', ''),
('385a05a1-7a36-485d-8693-4b23fa74972a', 'Active Aging Resource Fair ', 'Join us for the second annual Active Aging Resource Fair!', 'https://www.surrey.ca/images/cos-master/pageImages/resource%20fair%202.png', 'https://www.surrey.ca/culture-recreation/25794.aspx', 'Guildford Recreation Centre, 15105 105 Ave', 'http://www.surrey.ca/culture-recreation/1876.aspx', '24/03/2018', '9:00', 'Canada/Pacific', '24/03/2018', '15:00', 'Canada/Pacific', 'Business', 'Seniors', 'Guildford', '', ''),
('3b10adbd-be87-43f9-bfe0-9839f2501581', 'Newton Talks April 2018', 'Join the Newton BIA for a discussion facilitated by Melanie Gaboriault with the Surrey LRT Project.', 'https://www.surrey.ca/images/cos-master/pageImages/NewtonTalksApril.png', 'https://www.surrey.ca/culture-recreation/25986.aspx', 'Greek Corner, 7218 King George Blvd', '', '12/04/2018', '12:00', 'Canada/Pacific', '12/04/2018', '13:00', 'Canada/Pacific', 'Community Hosted', 'Newton', '', '', ''),
('3fbb2f30-6105-42a3-b8ef-b6265c91d37d', 'Environmental Extravaganza - Week 2', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/ArborDay16_GroupWithTree.jpg', 'https://www.surrey.ca/culture-recreation/22493.aspx', '', '', '22/04/2018', '0:00', 'Canada/Pacific', '28/04/2018', '12:00', 'Canada/Pacific', 'Parks and Environment', '', '', '', ''),
('4149e3df-8b23-4840-bf29-b0e99461e7b5', 'Clean Sweep Week 2018', 'Help beautify your community by organizing a litter cleanup during Surrey\'s annual Clean Sweep Week!', 'https://www.surrey.ca/images/cos-master/pageImages/Webimage_CS2017_SterlingTalent_1.jpg', 'https://www.surrey.ca/culture-recreation/22011.aspx', '', '', '21/04/2018', '0:00', 'Canada/Pacific', '28/04/2018', '0:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('44e2ae7a-1c25-4017-b22e-db95f93c5c72', 'Environmental Extravaganza - Week 8', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/BeachHeroSeaStar.jpg', 'https://www.surrey.ca/culture-recreation/22500.aspx', '', '', '3/06/2018', '0:00', 'Canada/Pacific', '9/06/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('458abb5c-96ef-4aa5-a420-33ca8b17e970', 'Environmental Extravaganza - Week 4', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/OwlProwl%20owl%20and%20audience.jpg', 'https://www.surrey.ca/culture-recreation/22495.aspx', '', '', '6/05/2018', '0:00', 'Canada/Pacific', '12/05/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('470351d7-8a0a-4521-9afd-614f8526288b', 'BC Construction and Home Show', 'Learn about the latest trends & innovations in the Metro Vancouver construction and housing markets. ', '', 'https://www.surrey.ca/culture-recreation/25974.aspx', 'Cloverdale Fairgrounds Agriplex Bldg, 6050 176 St', '', '9/06/2018', '10:00', 'Canada/Pacific', '10/06/2018', '19:00', 'Canada/Pacific', 'Community Hosted', 'Cloverdale', '', '', ''),
('474d9576-645e-4bad-ac18-0651712eb33e', 'Easter Activities', 'Hop on over to a facility in Surrey for some Easter-themed events!', 'https://www.surrey.ca/images/cos-master/pageImages/Easter.jpg', 'https://www.surrey.ca/culture-recreation/26088.aspx', '', '', '24/03/2018', '16:01', 'Canada/Pacific', '2/04/2018', '16:02', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Youth', '', ''),
('49addaa4-e15c-4d4c-98bd-0ce5fa84858e', 'Adjacentlands: Conversation on Contemporary Art', 'Learn about the changing nature of Canadian art and celebrate the launch of a new publication!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/AdjacentlandsWeb.jpg', 'https://www.surrey.ca/culture-recreation/26152.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '25/04/2018', '18:30', 'Canada/Pacific', '25/04/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('4d23d07d-4d39-497e-8ea2-5e3dd34fc784', 'Seedy Saturday', 'Get a great start on this year?s garden at the Stewart Farm?s annual seed and plant sale.', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20Seedy%20Saturday.jpg', 'https://www.surrey.ca/culture-recreation/2889.aspx', 'Stewart Farm House, 13723 Crescent Rd', 'http://www.surrey.ca/culture-recreation/2875.aspx', '7/04/2018', '11:00', 'Canada/Pacific', '7/04/2018', '15:00', 'Canada/Pacific', 'Heritage', 'Kids and Family', 'South Surrey', '', ''),
('567763f3-0e8f-4d85-b50a-3a19e903a0c6', 'Guildford Recreation Centre\'s Spring Open House', 'Meet staff and people in your community while learning about fun recreation programs in Guildford!', 'https://www.surrey.ca/images/cos-master/pageImages/GuildfordRecreationStaff.jpg', 'https://www.surrey.ca/culture-recreation/26087.aspx', 'Guildford Recreation Centre, 15105 105 Ave', '', '4/04/2018', '17:00', 'Canada/Pacific', '4/04/2018', '20:00', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Youth', 'Guildford', ''),
('574649ed-5ff8-45eb-8011-f024f0599fd2', 'Tami Neilson', 'Due to circumstances beyond the artist?s control, this concert has been cancelled.', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TamiNeilsonEP.jpg', 'https://www.surrey.ca/culture-recreation/24160.aspx', 'Centre Stage at Surrey City Hall, 13450 104 Ave', 'http://www.surrey.ca/culture-recreation/1681.aspx', '15/04/2018', '0:00', 'Canada/Pacific', '15/04/2018', '0:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('5d06d327-579f-4a0f-b36e-62ce5faf9df3', 'Pre-teen Dances', 'Meet your friends at one of Surrey\'s fun pre-teen dances!', 'https://www.surrey.ca/images/cos-master/pageImages/PreTeenDance.jpg', 'https://www.surrey.ca/culture-recreation/20955.aspx', '', '', '16/03/2018', '19:00', 'Canada/Pacific', '15/06/2018', '21:30', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', '', '', ''),
('621653ac-94c4-4e02-9e60-50f6a46039e9', 'Lifeguard Information Sessions', 'Join us for a free information session and learn how to become a lifeguard or instructor in Surrey. ', 'https://www.surrey.ca/images/cos-master/pageImages/LifeguardInfoSession.jpg', 'https://www.surrey.ca/culture-recreation/24132.aspx', '', '', '19/03/2018', '18:00', 'Canada/Pacific', '25/06/2018', '19:00', 'Canada/Pacific', 'Recreation and Sport', 'Youth', '', '', ''),
('63a143af-7fb4-4b9c-9286-3de5383e06f0', 'Vaisakhi Day Parade', 'Come to the annual Vaisakhi Parade featuring cultural floats, performers and free food & drink from local residents and businesses.', 'https://www.surrey.ca/images/cos-master/pageImages/VaisakhiParade.jpg', 'https://www.surrey.ca/culture-recreation/15046.aspx', 'Gurdwara Sahib Dasmesh Darbar, 12885 85 Ave', '', '21/04/2018', '9:00', 'Canada/Pacific', '21/04/2018', '18:00', 'Canada/Pacific', 'Arts', 'Business', 'Festivals', 'Kids and Family', 'Newton'),
('65ee6737-bb87-4966-9a9d-c05cf7b2c6ca', 'Mother\'s Day at The Glades Garden', 'Celebrate Mother\'s Day in the stunning woodland garden of The Glades.', 'https://www.surrey.ca/images/cos-master/pageImages/MothersDayTheGlades2016.jpg', 'https://www.surrey.ca/culture-recreation/8566.aspx', 'The Glades, 561 172 St', 'http://www.surrey.ca/culture-recreation/12205.aspx', '13/05/2018', '10:00', 'Canada/Pacific', '13/05/2018', '16:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Seniors', 'Youth', 'South Surrey'),
('6d6f55ff-fb0b-43e8-be09-dc43129fde5a', 'Thursday Artist Talk: Elizabeth Carefoot, \"The Art of the Altered Book\"', 'Learn how about making an old or unwanted book into a work of visual art!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/ElizabethCarefootWeb.jpg', 'https://www.surrey.ca/culture-recreation/26116.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '5/04/2018', '19:30', 'Canada/Pacific', '5/04/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('6e904815-646f-491a-99b1-9227318e1c31', 'Environmental Extravaganza - Week 3', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/Salmon%20Sendoff%20girl%20visible%20fish.jpg', 'https://www.surrey.ca/culture-recreation/22494.aspx', '', '', '29/04/2018', '0:00', 'Canada/Pacific', '5/05/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('71fc617b-5459-4002-8ef6-3ac59d5af049', 'The Art of Dance: An International Dance Day Celebration', 'Witness spectacular dance performances plus original artworks | Studio Theatre at Surrey Arts Centre', 'https://www.surrey.ca/images/cos-master/pageImages/InternationalDayofDance.png', 'https://www.surrey.ca/culture-recreation/26154.aspx', 'Studio Theatre at Surrey Arts Centre, 13750 88 Avenue', 'www.surrey.ca/culture-recreation/1619.aspx', '29/04/2018', '19:00', 'Canada/Pacific', '29/04/2018', '20:00', 'Canada/Pacific', 'Community Hosted', 'Whalley', '', '', ''),
('75fee723-21be-4902-a86c-e567d264420a', 'Neighbourhood Tree Parties', 'Drop-in to plant shade trees, improve tree wells, enjoy tree-themed activities and free pizza!', 'https://www.surrey.ca/images/cos-master/pageImages/Website%20resize.jpg', 'https://www.surrey.ca/culture-recreation/22573.aspx', '', '', '4/04/2018', '17:00', 'Canada/Pacific', '25/04/2018', '19:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Youth', '', ''),
('792de3c3-ffc0-4f26-9399-fa2648945079', 'Kala-Sikh Art Exhibition', 'Join in on the opening night of Sikh Heritage Month at the Kala-Sikh Art Exhibition.', '', 'https://www.surrey.ca/culture-recreation/26347.aspx', 'Surrey City Hall, 13450 104 Ave', '', '1/04/2018', '17:00', 'Canada/Pacific', '1/04/2018', '21:00', 'Canada/Pacific', 'Community Hosted', 'City Centre', '', '', ''),
('7acc009a-3c99-4947-af52-8078394c33fe', 'National Lifejacket Day', 'Be safe in and around the water at Newton Recreation Centre\'s National Lifejacket Day event. ', 'https://www.surrey.ca/images/cos-master/pageImages/LifejacketDay.jpg', 'https://www.surrey.ca/culture-recreation/26109.aspx', 'Newton Recreation Centre, 13730 72 Ave', '', '17/05/2018', '13:00', 'Canada/Pacific', '17/05/2018', '21:00', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Seniors', 'Youth', 'Newton'),
('7d221117-257e-46ff-8d84-0a1ceebb7d52', 'Birding Walks', 'Join a local naturalist for a series of free monthly walks to discover Surrey\'s birds!', 'https://www.surrey.ca/images/cos-master/pageImages/chickadeesonbranch.jpg', 'https://www.surrey.ca/culture-recreation/24773.aspx', '', '', '16/09/2017', '9:00', 'Canada/Pacific', '19/05/2018', '11:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Seniors', 'Youth', ''),
('7d714418-a0ce-4426-a56e-c4559334fe11', 'Family Nights in Cloverdale', 'Enjoy a free, fun night with your family in Cloverdale!', 'https://www.surrey.ca/images/cos-master/pageImages/FamilyMakingCrafts.jpg', 'https://www.surrey.ca/culture-recreation/23500.aspx', 'Cloverdale Recreation Centre, 6188 176 St', '', '16/03/2018', '17:30', 'Canada/Pacific', '15/06/2018', '19:30', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Cloverdale', '', ''),
('7e3813fe-4eed-421f-9eaa-20d9b3870ccd', 'Newton Family Easter Party', 'A fun, free family event including an Easter egg hunt, face painting, crafts, games and more!', 'https://www.surrey.ca/images/cos-master/pageImages/EasterEggs.jpg', 'https://www.surrey.ca/culture-recreation/26218.aspx', 'Newton Seniors Centre, 13775 70 Ave', '', '24/03/2018', '10:00', 'Canada/Pacific', '24/03/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Newton', '', '', ''),
('80a08ae0-08d6-493f-8ff3-29a38717fc06', 'Exhibition Tour of Flow', 'Enjoy a free tour of the artwork in the exhibit Flow featuring work from our permanent collection.', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/ExhibitionTour_web.jpg', 'https://www.surrey.ca/culture-recreation/26181.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '5/05/2018', '14:30', 'Canada/Pacific', '5/05/2018', '16:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('80fe55ea-0e93-43ac-bb75-d094f4ba31d6', 'Party for the Planet', 'Join us in Surrey City Hall Plaza for Party for the Planet, B.C.\'s largest Earth Day celebration!', 'https://www.surrey.ca/images/cos-master/pageImages/SamNuge_991x557.jpg', 'https://www.surrey.ca/culture-recreation/11076.aspx', 'City Hall Plaza', '', '14/04/2018', '10:00', 'Canada/Pacific', '14/04/2018', '18:00', 'Canada/Pacific', 'Festivals', 'Kids and Family', 'Parks and Environment', 'Whalley', ''),
('876cf4d7-72cf-49e6-bc65-ef18ced1cd23', 'Purely Local Spring Market 2018', 'Check out this one-day market featuring locally made food, home decor and baby clothing and toys.', 'https://www.surrey.ca/images/cos-master/pageImages/PurelyLocalMarket2018.jpg', 'https://www.surrey.ca/culture-recreation/26187.aspx', 'Kwomais Point Park, 1367 128 St', '', '7/04/2018', '10:00', 'Canada/Pacific', '7/04/2018', '15:00', 'Canada/Pacific', 'Community Hosted', 'South Surrey', '', '', ''),
('8f570d38-c608-4f6d-a150-db03ac92f6dd', 'Time Machine Travelers', 'Sign up the kids for a unique Spring Break Day Camp they will not soon forget.', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20at%20Spring%20Break.jpg', 'https://www.surrey.ca/culture-recreation/10681.aspx', 'Historic Stewart Farm, 13723 Crescent Rd', 'http://www.surrey.ca/culture-recreation/2875.aspx', '20/03/2018', '9:00', 'Canada/Pacific', '23/03/2018', '15:00', 'Canada/Pacific', 'Heritage', 'Kids and Family', 'South Surrey', '', ''),
('9442e77c-1b93-4d47-bb97-ec066accc18e', 'Cloverdale Town Centre Plan Open House', 'Join us on June 14 to share your feedback on the draft updates to the Cloverdale Town Centre Plan', 'https://www.surrey.ca/images/cos-master/pageImages/Surrey_Open_House%20_Event.jpg', 'https://www.surrey.ca/city-government/26329.aspx', 'Cloverdale Rodeo & Exhibition Association - Shannon Hall, 6050 176 St', 'http://cloverdalerodeo.com/contact-us/', '14/06/2018', '17:30', 'Canada/Pacific', '14/06/2018', '20:00', 'Canada/Pacific', 'Public Meetings and Open Houses', 'Cloverdale', '', '', ''),
('9872f214-dc31-4bd0-9601-aa3cc0a46fab', 'Glades Garden Open Houses', 'Visit this stunning 15-acre woodland garden during select openings this spring.', 'https://www.surrey.ca/images/cos-master/pageImages/TheGladesRidgeViewpointScarletBlackDSC_1320.jpg', 'https://www.surrey.ca/culture-recreation/10664.aspx', 'The Glades, 561 172 St', 'http://www.surrey.ca/culture-recreation/12205.aspx', '13/05/2018', '10:00', 'Canada/Pacific', '4/07/2018', '20:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Seniors', 'South Surrey', ''),
('9f8c2794-3043-4f83-8712-b9579deb5811', '\"Perk up, pianist!\"', 'Comical and heartfelt musings of a musician\'s search for love | Centre Stage at Surrey City Hall', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/PerkUpPianistEP.jpg', 'https://www.surrey.ca/culture-recreation/24162.aspx', 'Centre Stage at Surrey City Hall, 13450 104 Ave', 'http://www.surrey.ca/culture-recreation/1681.aspx', '12/05/2018', '0:00', 'Canada/Pacific', '12/05/2018', '0:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('a0c8f4e5-47c0-426b-b747-ff96bfa00742', '16th Annual Early Years Festival', 'Spend a fun afternoon with your kids (babies to age 6) at the Early Years Festival!', 'https://www.surrey.ca/images/cos-master/pageImages/EarlyYearsFestival2018.jpg', 'https://www.surrey.ca/culture-recreation/25512.aspx', 'Chuck Bailey Recreation Centre, 13458 107a Ave', '', '7/04/2018', '10:00', 'Canada/Pacific', '7/04/2018', '15:00', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Whalley', '', ''),
('a20ff1b0-52f8-4081-92d7-8b32d440d529', 'Surrey Animal Resource Centre Scent-Topia', 'An Amazing Scent Race - handlers and their dogs race around Surrey to sniff out hidden target odours', 'https://www.surrey.ca/images/cos-master/pageImages/SURREY%20EVENTS%20IMAGE.jpg', 'https://www.surrey.ca/culture-recreation/26244.aspx', '', '', '14/04/2018', '9:00', 'Canada/Pacific', '14/04/2018', '17:00', 'Canada/Pacific', 'Kids and Family', 'Cloverdale', '', '', ''),
('a81dec2e-58a5-4395-84de-369d6660152e', 'Get Growing at Darts Hill', 'Learn how to get growing at Darts Hill Garden\'s spring open house.', 'https://www.surrey.ca/images/cos-master/pageImages/DartsHillSpring2015ScarletBlack_webpagefeature.jpg', 'https://www.surrey.ca/culture-recreation/26269.aspx', 'Darts Hill Garden Park, 1660 168 St', 'http://www.surrey.ca/culture-recreation/2228.aspx', '28/04/2018', '11:00', 'Canada/Pacific', '28/04/2018', '15:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'South Surrey', '', ''),
('a8b7acf6-d8a5-4e33-9dc4-4ac09dc71f4c', 'Surrey Art Teachers Association Exhibition Reception', 'Celebrate the opening of the exhibition Praxis by the Surrey Art Teachers Association.', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TeachersOpeningWeb.jpg', 'https://www.surrey.ca/culture-recreation/26182.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '17/05/2018', '18:00', 'Canada/Pacific', '17/05/2018', '19:30', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('ab14116d-0374-4a52-9fab-24b256e6f0f0', 'Discovery Days at the Surrey Nature Centre', 'Take part in numerous festivities taking place during Discovery Days at the Surrey Centre.', 'https://www.surrey.ca/images/cos-master/pageImages/Nature%20Play%20-%20preschool%20girl.jpg', 'https://www.surrey.ca/culture-recreation/24109.aspx', 'Surrey Nature Centre, 14225 Green Timbers Way', 'http://www.surrey.ca/culture-recreation/2311.aspx', '4/05/2018', '10:00', 'Canada/Pacific', '28/05/2018', '14:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Whalley', '', ''),
('ae4f455a-9463-45c5-97f3-55708b3a89bb', 'Environmental Extravaganza - Week 7', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/SundayMorningBirding.jpg', 'https://www.surrey.ca/culture-recreation/22499.aspx', '', '', '27/05/2018', '0:00', 'Canada/Pacific', '2/06/2018', '12:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', '', '', ''),
('b11a4318-c77d-488e-b67d-a1c30cc80478', 'Artist Talk and Spring Opening Reception ', 'Celebrate the opening of our spring exhibitions!', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/OpeningReceptionWeb.jpg', 'https://www.surrey.ca/culture-recreation/26117.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1619.aspx', '14/04/2018', '18:30', 'Canada/Pacific', '14/04/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('b6931bc3-f9d2-4591-9655-9608e38951eb', 'Celebrate the Arts', 'Celebrate the arts with this free event that brings youth and seniors together!', 'https://www.surrey.ca/images/cos-master/pageImages/TeenWithSenior.jpg', 'https://www.surrey.ca/community/26031.aspx', 'Guildford Recreation Centre, 15105 105 Ave', '', '29/03/2018', '14:00', 'Canada/Pacific', '29/03/2018', '16:00', 'Canada/Pacific', 'Seniors', 'Youth', 'Guildford', '', ''),
('b98db63e-9035-468b-aa1f-77382de3a222', 'Park Play', 'Join us this summer in a park near you for free and fun activities!', 'https://www.surrey.ca/images/cos-master/pageImages/webpageparkplayresize.jpg', 'https://www.surrey.ca/culture-recreation/1818.aspx', '', '', '3/07/2018', '10:00', 'Canada/Pacific', '23/08/2018', '17:00', 'Canada/Pacific', 'Parks and Environment', 'Recreation and Sport', '', '', ''),
('b9f18261-ca17-4b42-ae54-30da91ca9a94', 'Guided Nature Walks', 'Get to know one of Surrey\'s nature parks by joining a free guided walk!', 'https://www.surrey.ca/images/cos-master/pageImages/Guided%20nature%20walk.jpg', 'https://www.surrey.ca/culture-recreation/20580.aspx', '', '', '20/01/2018', '0:00', 'Canada/Pacific', '16/06/2018', '23:59', 'Canada/Pacific', 'Parks and Environment', '', '', '', ''),
('ba6bb39e-feca-4a82-bd0e-c4510741bab7', 'School\'s Out Activities', 'Keep your kids busy with fun activities during their next Pro D Day on May 4, 2018.', 'https://www.surrey.ca/images/cos-master/pageImages/SchoolsOutActivties.jpg', 'https://www.surrey.ca/culture-recreation/17827.aspx', 'Various', '', '4/05/2018', '9:00', 'Canada/Pacific', '4/05/2018', '15:00', 'Canada/Pacific', 'Arts', 'Heritage', 'Kids and Family', 'Recreation and Sport', ''),
('bee511f7-c6af-466f-913a-0722731f8b42', 'Artist Talk and Demonstration with Alex McLeod', 'Join UrbanScreen artist Alex McLeod at to learn how he creates his fantastical virtual worlds.', 'https://www.surrey.ca/images/cos-master/pageImages/McLeod_preview_2_web.jpg', 'https://www.surrey.ca/culture-recreation/25671.aspx', 'Surrey Art Gallery, 13750 88 Avenue', '', '27/04/2018', '19:00', 'Canada/Pacific', '27/04/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('bfcc2d9d-caf7-4a1a-889b-e1126f33af09', 'Clayton Community Farmer\'s Market', 'Shop local at the new Clayton Community Farmer\'s Market happening on alternating Sundays in 2018.', 'https://www.surrey.ca/images/cos-master/pageImages/ClaytonHeightsFarmersMarket.jpg', 'https://www.surrey.ca/culture-recreation/25875.aspx', 'Clayton Heights Secondary School, 7003 188 St', '', '13/05/2018', '10:00', 'Canada/Pacific', '16/09/2018', '15:00', 'Canada/Pacific', 'Community Hosted', 'Cloverdale', '', '', ''),
('c878901f-00f1-4fde-95f6-3b790de13455', 'Clayton Community Garden Build Day', 'Assemble garden beds, spread bark mulch, and paint signs. Plus snacks, music and kids\' actvities.', 'https://www.surrey.ca/images/cos-master/pageImages/Clayton%20Community%20Garden%20Build%20Day%20Event.jpg', 'https://www.surrey.ca/culture-recreation/26251.aspx', 'Clayton Dog Off-Leash Park, 7011 188 St', '', '28/04/2018', '10:00', 'Canada/Pacific', '28/04/2018', '15:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Seniors', 'Youth', 'Cloverdale'),
('c9e73c2b-6f7b-4ce8-81ba-f34348d60a9a', 'Regular Council Public Hearing Meeting', 'Attend the next Surrey Public Hearing meeting and hear or speak to public hearing items.', 'https://www.surrey.ca/images/cos-master/pageImages/CityHallCouncilChambers.jpg', 'https://www.surrey.ca/city-government/14886.aspx', 'City Hall Council Chambers', '', '9/04/2018', '19:00', 'Canada/Pacific', '9/04/2018', '19:00', 'Canada/Pacific', 'Public Meetings and Open Houses', '', '', '', ''),
('cbae6207-570a-46d8-a37d-a81b4e5e0c40', 'Spring Fling', 'Bring the family to play and discover nature at this free event at the Surrey Nature Centre!', 'https://www.surrey.ca/images/cos-master/pageImages/WildWednesday%20-%20girl%20and%20NG%20with%20bug%20jars.jpg', 'https://www.surrey.ca/culture-recreation/10739.aspx', 'Surrey Nature Centre', 'http://www.surrey.ca/culture-recreation/2311.aspx', '21/03/2018', '10:00', 'Canada/Pacific', '21/03/2018', '14:00', 'Canada/Pacific', 'Kids and Family', 'Parks and Environment', 'Whalley', '', ''),
('cc336dfa-bd60-4561-a470-cd82e0eecdce', 'Mad Hatter\'s Strawberry Tea and Tour', 'Join members of Surrey Art Gallery Association for an exhibition tour and strawberry shortcake!', 'https://www.surrey.ca/images/cos-master/pageImages/RedBerriesAndFriend_web.jpg', 'https://www.surrey.ca/culture-recreation/13448.aspx', 'Surrey Art Gallery, 13750 88 Avenue', 'http://www.surrey.ca/culture-recration/1621.aspx', '28/06/2018', '19:00', 'Canada/Pacific', '28/06/2018', '21:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('d86b8c37-e585-4726-8ecf-b0fb9d978e9c', 'Spring Community Dance', 'Bring your dance moves and groove to 50\'s music at Clayton Community Hall! ', 'https://www.surrey.ca/images/cos-master/pageImages/SpringCommunityDance.jpg', 'https://www.surrey.ca/culture-recreation/26330.aspx', 'Clayton Community Hall, 18513 70 Ave', '', '7/04/2018', '18:00', 'Canada/Pacific', '7/04/2018', '20:00', 'Canada/Pacific', 'Kids and Family', 'Recreation and Sport', 'Seniors', 'Youth', 'Cloverdale'),
('d90a2256-7743-430c-bddb-cb6438513243', 'Old Fashioned Easter', 'After your Easter egg hunt at home, make your way to the Farm to continue the fun.', 'https://www.surrey.ca/images/cos-master/pageImages/Easter%20Event%20Image.jpg', 'https://www.surrey.ca/culture-recreation/22375.aspx', 'Historic Stewart Farm, 13723 Crescent Rd', '', '31/03/2018', '11:00', 'Canada/Pacific', '31/03/2018', '15:00', 'Canada/Pacific', 'Heritage', 'Kids and Family', 'South Surrey', '', ''),
('dd5ffbb7-e35b-453b-a6af-72688e67c6a8', 'Surrey International Children\'s Festival', 'Get artsy at Surrey International Children?s Festival! ', 'https://www.surrey.ca/images/cos-master/pageImages/KidsPuppetShow.jpg', 'https://www.surrey.ca/culture-recreation/8863.aspx', 'Bear Creek Park / Surrey Arts Centre, 13750 88 Ave', '', '24/05/2018', '0:00', 'Canada/Pacific', '27/05/2018', '0:00', 'Canada/Pacific', 'Arts', 'Festivals', 'Kids and Family', 'Whalley', ''),
('e230aa9c-1807-4282-8463-d3da8b47f7f8', 'My Funny Valentine', 'One actor portrays seven characters on the fringes of a murder | Centre Stage at Surrey City Hall', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/MyFunnyValentineEP.jpg', 'https://www.surrey.ca/culture-recreation/24163.aspx', 'Centre Stage at Surrey City Hall, 13450 104 Ave', 'http://www.surrey.ca/culture-recreation/1681.aspx', '28/06/2018', '0:00', 'Canada/Pacific', '28/06/2018', '0:00', 'Canada/Pacific', 'Arts', 'Whalley', '', '', ''),
('eb6a62f2-cc09-4a8d-9e77-83164156deae', 'The Fish Eyes Trilogy', 'High school. Sometimes you\'re forced to navigate rocky terrain | Surrey Arts Centre', 'https://www.surrey.ca/images/cos-master/pageImages/ArtsCentre/TheFishEyesTrilogySurreyCivicTheatres.jpg', 'https://www.surrey.ca/culture-recreation/24164.aspx', 'Main Stage at Surrey Arts Centre, 13750 88 Avenue', 'http://www.surrey.ca/culture-recreation/1681.aspx', '18/08/2018', '0:00', 'Canada/Pacific', '18/08/2018', '0:00', 'Canada/Pacific', 'Arts', 'Youth', 'Whalley', '', ''),
('f94885e1-327c-4dc5-b394-65d0b538f1f5', 'Spring Break Drop In', 'Bring the kids for free activities, a nature walk and endless photo opps.', 'https://www.surrey.ca/images/cos-master/pageImages/Stewart%20Farm%20Spring%20Break%20Drop%20In.jpg', 'https://www.surrey.ca/culture-recreation/26186.aspx', 'Historic Stewart Farm, 13723 Crescent Rd', '', '27/03/2018', '12:00', 'Canada/Pacific', '29/03/2018', '15:00', 'Canada/Pacific', 'Heritage', 'Kids and Family', 'South Surrey', '', ''),
('fa36cd61-3466-4bf3-b4e5-26a6620c83a7', 'Environmental Extravaganza - Week 1', 'Explore and learn about nature with these free programs and events!', 'https://www.surrey.ca/images/cos-master/pageImages/TrailWalkSunnysideAcres.jpg', 'https://www.surrey.ca/culture-recreation/22492.aspx', '', '', '15/04/2018', '0:00', 'Canada/Pacific', '21/04/2018', '12:00', 'Canada/Pacific', 'Parks and Environment', '', '', '', ''),
('ff6260c1-87d6-4ae0-85cb-ec3cc04071ea', 'Coastal Flood Adaptation Strategy Open House', 'Learn about Surrey\'s Coastal Flood Adaptation Strategy at the next CFAS Open House 10 April, 2018.', 'https://www.surrey.ca/images/cos-master/pageImages/CFSA%20Open%20House,%20new%20image.jpg', 'https://www.surrey.ca/city-government/26286.aspx', '', '', '10/04/2018', '17:00', 'Canada/Pacific', '10/04/2018', '20:00', 'Canada/Pacific', 'Parks and Environment', 'Public Meetings and Open Houses', 'South Surrey', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repeating_events`
--

CREATE TABLE `repeating_events` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `next_event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` int(11) NOT NULL,
  `town_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `town_name`) VALUES
(1, 'City Centre'),
(2, 'Cloverdale'),
(3, 'Whalley'),
(4, 'South Surrey'),
(5, 'Newton'),
(6, 'Guildford');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_id` (`event_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `original_datatable`
--
ALTER TABLE `original_datatable`
  ADD PRIMARY KEY (`GUID`),
  ADD UNIQUE KEY `GUID` (`GUID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeating_events`
--
ALTER TABLE `repeating_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repeating_events`
--
ALTER TABLE `repeating_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
