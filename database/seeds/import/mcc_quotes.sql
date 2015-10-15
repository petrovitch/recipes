# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42-log)
# Database: blog
# Generation Time: 2015-10-15 19:22:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table mcc_quotes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mcc_quotes`;

CREATE TABLE `mcc_quotes` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `quote` varchar(255) DEFAULT NULL,
  `author` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mcc_quotes` WRITE;
/*!40000 ALTER TABLE `mcc_quotes` DISABLE KEYS */;

INSERT INTO `mcc_quotes` (`id`, `quote`, `author`, `created_at`, `updated_at`)
VALUES
	(126,'Chess for me is not a game, but an art. Yes, and I take upon myself all those responsibilities which an art imposes on its adherents.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(127,'Chess is not only knowledge and logic.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(128,'I believe that true beauty of chess is more than enough to satisfy all possible demands.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(136,'Whoever sees no other aim in the game than that of giving checkmate to one\'s opponent will never become a good Chess player.','Max Euwe','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(140,'I may play some exhibition games so I don\'t want to quit the game of chess completely. I just decided and it\'s a firm decision not to play competitive chess anymore.','Garry Kasparov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(152,'It\'s quite difficult for me to imagine my life without chess.','Garry Kasparov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(157,'The human element, the human flaw and the human nobility - those are the reasons that chess matches are won or lost.','Viktor Korchnoi','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(158,'Chess is life.','Bobby Fischer','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(161,'I also follow chess on the Internet, where Kasparov\'s site is very interesting.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(165,'I try to help developing junior chess. When I lived in USSR, I got a lot of free help from very good coaches - now I am trying to repay that debt.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(166,'In my country, at that time, being a champion of chess was like being a King. At that time I was a King - and when you are King you feel a lot of responsibility, but there is nobody there to help you.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(168,'Nowadays the dynamic element is more important in chess - players more often sacrifice material to obtain dynamic compensation.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(169,'Nowadays there is more dynamism in chess, modern players like to take the initiative. Usually they are poor defenders though.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(170,'Nowadays young people have great choice of occupations, hobbies, etc, so chess is experiencing difficulties because of the high competition. Now it\'s hard to make living in chess, so our profession does attract young people.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(171,'On the other hand, chess is a mass sport now and for chess organisers shorter time control is obviously more attractive. But I think that this control does not suit World Championship matches.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(173,'The place of chess in the society is closely related to the attitude of young people towards our game.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(174,'The Soviet Union was an exception, but even there chess players were not rich. Only Fischer changed that.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(176,'We can compare classical chess and rapid chess with theatre and cinema - some actors don\'t like the latter and prefer to work in the theatre.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(179,'Chess is ruthless: you\'ve got to be prepared to kill people.','Nigel Short','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(183,'Chess is intellectual gymnastics.','Wilhelm Steinitz','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(184,'Chess is not for timid souls.','Wilhelm Steinitz','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(185,'Chess is so inspiring that I do not believe a good player is capable of having an evil thought during the game.','Wilhelm Steinitz','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2847,'Combination is a soul of chess.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2848,'During a chess competition a chessmaster should be a combination of a beast of prey and a monk.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2856,'Chess first of all teaches you to be objective.','Alexander Alekhine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3074,'My dad sacrificed many things in life for me. He abandoned a very promising and lucrative career of an army officer just so that he could continue helping me with my chess and accompanying me to tournaments.','Alexandra Kosteniuk','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4467,'Chess is my life, but my life is not chess.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4472,'I am thinking about chess in schools in particular. In the USA more than 3200 children competed in an event.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4477,'I still love to play chess. So I do not even spend a minute on the possibility to step back.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4478,'In Kansas I have a chess school.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4481,'No, no, it is obvious that the ECU should act as a close alliance for the benefit of chess.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4483,'People knew about 110 years of chess history. Nowadays, nobody is able to tell you the name of the world champion of 2000.','Anatoly Karpov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11483,'Bobby Fischer has an enormous knowledge of chess and his familiarity with the chess literature of the USSR is immense.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11488,'I was probably the best in chess for about 6 years - sometime before 1965 and 1971. Kasparov was the best for much longer!','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11495,'The place of chess in the society is closely related to the attitude of young people towards our game.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11496,'The Soviet Chess Federation, of course, did not care about the players, for the communists chess was only an instrument.','Boris Spassky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14348,'In life, as in chess, forethought wins.','Charles Buxton','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22062,'Seem to be telling this, but really telling that. Three-dimensional writing, like three-dimensional chess. Nabokov was the other master of that. You could learn something from Nabokov on every page he ever wrote.','Donald E. Westlake','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22774,'It was not until I got my first job, at the University of Washington in Seattle, and began playing chess with Don Gordon, a brilliant young theorist, that I learned economic theory.','Douglass North','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(26089,'My freshman year of high school I joined the chess and math clubs.','Eric Allin Cornell','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(27600,'Litigation is the pursuit of practical ends, not a game of chess.','Felix Frankfurter','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(30203,'I learned that fighting on the chess board could also have an impact on the political climate in the country.','Garry Kasparov','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(37744,'It was said of old Sarah, Duchess of Marlborough, that she never puts dots over her I s, to save ink.','Horace Walpole','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(37999,'The Chess-board must be placed with a white square at the right-hand corner.','Howard Staunton','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(38000,'The game of Chess is played by two persons, each having at command a little army of sixteen men, upon a board divided into sixty-four squares.','Howard Staunton','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(55112,'Far be it from me to force anyone into either chess or dressage, but if you choose to do so yourself, in my opinion there is only one way: follow the rules.','Lars von Trier','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(59281,'I am still a victim of chess. It has all the beauty of art - and much more. It cannot be commercialized. Chess is much purer than art in its social position.','Marcel Duchamp','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(62617,'I see myself more as an ambassador of the game. And I hope to bring chess to a higher level in the United States. Making bigger tournaments, more interesting events. Making it a respectable profession for young people to be able to pursue in the future.','Maurice Ashley','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(62788,'Chess is a sport. The main object in the game of chess remains the achievement of victory.','Max Euwe','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(62789,'Poor Capablanca! Thou wert a brilliant technician, but no philosopher. Thou wert not capable of believing that in chess, another style could be victorious than the absolutely correct one.','Max Euwe','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(67267,'People are governed with the head; kindness of heart is little use in chess.','Nicolas Chamfort','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(71422,'Never having played Chess before, it was most interesting to be playing the game with no pieces in front of me. But I still knew how to stroke my hair when I won.','Peter Mayhew','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(73272,'There was one point in high school actually when I was on the chess team, marching band, model United Nations and debate club all at the same time. And I would spend time with the computer club after school. And I had just quit pottery club, which I was i','Rainn Wilson','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(73851,'Chess is as elaborate a waste of human intelligence as you can find outside an advertising agency.','Raymond Chandler','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(73852,'Chess is the most elaborate waste of human intelligence outside of an advertising agency.','Raymond Chandler','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(74479,'Personally, I rather look forward to a computer program winning the world chess championship. Humanity needs a lesson in humility.','Richard Dawkins','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(77063,'The ability to get ahead in an organization is simply another talent, like the ability to play chess, paint pictures, do coronary bypass operations or pick pockets.','Robert Shea','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(82126,'Leonard Chess passed, and that was the end of the Chess label for that time.','Solomon Burke','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(82289,'I feel as if I were a piece in a game of chess, when my opponent says of it: That piece cannot be moved.','Soren Kierkegaard','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(85798,'The chess-board is the world, the pieces are the phenomena of the universe, the rules of the game are what we call the laws of Nature. The player on the other side is hidden from us.','Thomas H. Huxley','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89108,'Every time I win a tournament I have to think that there is something wrong with modern chess.','Viktor Korchnoi','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89109,'It is a gross overstatement, but in chess, it can be said I play against my opponent over the board and against myself on the clock.','Viktor Korchnoi','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89470,'Chess is an infinitely complex game, which one can play in infinitely numerous and varied ways.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89472,'For me art and chess are closely related, both are forms in which the self finds beauty and expression.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89473,'For us chess players the language of artist is something natural.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89474,'I believe every chess player senses beauty, when he succeeds in creating situations, which contradict the expectations and the rules, and he succeeds in mastering this situation.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89475,'In chess one cannot control everything. Sometimes a game takes an unexpected turn, in which beauty begins to emerge. Both players are always instrumental in this.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89482,'The development of beauty in chess never depends on you alone. No matter how much imagination and creativity you invest, you still do not create beauty. Your opponent must react at the same highest level.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(89484,'When I speak of the beauty of a game of chess, then naturally this is subjective. Beauty can be found in a very technical, mathematical game for example. That is the beauty of clarity.','Vladimir Kramnik','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(93627,'I failed to make the chess team because of my height.','Woody Allen','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `mcc_quotes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
