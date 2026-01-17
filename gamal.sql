-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 يوليو 2024 الساعة 01:21
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamal`
--

-- --------------------------------------------------------

--
-- بنية الجدول `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_art` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `img_art` varchar(255) NOT NULL,
  `like_art` varchar(255) NOT NULL,
  `note_art` varchar(255) NOT NULL,
  `link_note` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `like_books` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `links` varchar(255) NOT NULL,
  `img_books` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `book` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `fetawes`
--

CREATE TABLE `fetawes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_fet` varchar(255) NOT NULL,
  `body_fet` varchar(255) NOT NULL,
  `note_fet` varchar(255) NOT NULL,
  `link_note` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_21_135836_create_sections_table', 1),
(5, '2024_07_25_172330_create_books_table', 1),
(6, '2024_07_25_173400_create_articles_table', 1),
(7, '2024_07_25_173519_create_fetawes_table', 1),
(8, '2024_07_25_175344_add_book_to_books_table', 1),
(9, '2024_07_27_065118_create_posts_table', 1),
(10, '2024_07_27_070155_create_poste_table', 1),
(11, '2024_07_27_073554_add_teypsection_to_posts', 1),
(12, '2024_07_27_074139_add_teypsection_to_posts_table', 1),
(13, '2024_07_25_214019_create_videos_table', 2),
(14, '2024_07_28_151737_add_videos_to_posts_table', 2),
(15, '2024_07_28_151815_add_audioes_to_posts_table', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `poste`
--

CREATE TABLE `poste` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titleart` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `imgart` varchar(255) DEFAULT NULL,
  `likeart` varchar(255) DEFAULT NULL,
  `noteart` varchar(255) DEFAULT NULL,
  `linknote` varchar(255) DEFAULT NULL,
  `idsection` bigint(20) UNSIGNED DEFAULT NULL,
  `userid` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teypsection` varchar(255) DEFAULT NULL,
  `fileVid` varchar(255) DEFAULT NULL,
  `fileAud` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `posts`
--

INSERT INTO `posts` (`id`, `titleart`, `body`, `imgart`, `likeart`, `noteart`, `linknote`, `idsection`, `userid`, `created_at`, `updated_at`, `teypsection`, `fileVid`, `fileAud`) VALUES
(16, 'ما هي رسالة النبي محمد إلى المقوقس؟', 'بعث رسول الله صل الله عليه وسلم بوفد إلى المقوقس عظيم مصر برئاسة الصحابي حاطب بن أبي بلتعة رضي الله عنه، ومعه كتاب من رسول الله يدعو فيه المقوقس إلى الإسلام والسلام ويبشره بأنه في حالة إسلامه فإنه سوف يحصل على الأجر مرتين، وإن رفض فإن عليه إثم القبط، فأكرم المقوقس رسول رسول الله “حاطب” وقبل خطاب رسول الله، وقام على جمع بطارقته ورهبانه وبدأ في توجيه الأسئلة إلى حاطب حتى أجاب عليه حاطب في ذكاء وأدب حيث كان رسول الله يختار سفرائه بعناية، وحينما رد على أسئلة المقوقس أعجب به وبذكائه ورد على كتاب رسول الله بكتاب \r\n              آخر من عنده يبلغه فيه أنه يؤمن في نبوته وأنه بعث له بالهدايا إكرامًا وتقديرًا له وكانت الهدايا عبارة عن جاريتين وبغلة، وقد قبل رسول الله بهديته.\r\n              نص كتاب رسول الله الى المقوقس\r\n\r\n              بسم الله الرحمن الرحيم\r\n              من محمد رسول الله صل الله عليه وسلم، إلى المقوقس عظيم القبط سلام على من اتبع الهدى، أما بعد:\r\n              «فإني أدعوك بدعاية الإسلام، أسلم تسلم يؤتك الله أجرك مرتين، وإن توليت فإنما عليك إثم القبط.\r\n              {قُلْ يَا أَهْلَ الْكِتَابِ تَعَالَوْا إِلَى كَلِمَةٍ سَوَاءٍ بَيْنَنَا وَبَيْنَكُمْ أَلَّا نَعْبُدَ إِلَّا اللَّهَ وَلَا نُشْرِكَ بِهِ شَيْئًا وَلَا يَتَّخِذَ بَعْضُنَا بَعْضًا أَرْبَابًا مِنْ دُونِ اللَّهِ فَإِنْ تَوَلَّوْا فَقُولُوا اشْهَدُوا بِأَنَّا مُسْلِمُونَ} [آل عمران:64].»\r\n              \r\n              نص رد المقوقس على كتاب رسول الله\r\n              لمحمد بن عبدالله من المقوقس عظيم القبط، سلام عليك أما بعد:\r\n              «فقد قرأت كتابك وفهمت ما ذكرت فيه، وما تدعوا إليه، وقد علمت أن نبيًا قد بقى وكنت أظنه بالشام، وقد أكرمت رسولك، وبعثت لك بجاريتين لهما مكان عظيم في القبط، وبثياب وأهديت إليك بغلة تركبها والسلام.»\r\n              \r\n              الدروس المستفادة من كتاب رسول الله للمقوقس\r\n              – حرص رسول الله صل الله عليه وسلم على تبليغ دعوته إلى جميع الناس.\r\n              – الأسلوب الراقي واستخدام الألفاظ المناسبة للتحدث إلى ملك القبط.\r\n              – حسن اختيار الرسول للوفد الذي عليه تبليغ الرسالة والرد على أسئلة المقوقس.\r\n              – عدم إسلام المقوقس لا يعني عدم تصديقه لرسالة النبي ولكن قد يكون فيه ما يهدد منصبه.\r\n              – حرص المقوقس على البعث بهدية إلى رسول الله تقديرًا له وإظهارًا لروح المودة والحب.\r\n              – هدية المقوقس، كانت جاريتين إحداهما السيدة مارية القبطية التي أعتقها رسول الله وتزوجها وأنجب منها ولده إبراهيم.\r\n              – عدم إرغام الرسول لأحد من الملوك على الإسلام ولكنه استخدم أسلوب الترغيب والترهيب وليس كما يشاع أن الإسلام جاء بالسيف', '1722226825.jpeg', NULL, 'ww.com.gamal', NULL, 4, NULL, '2024-07-29 08:20:25', '2024-07-29 08:20:25', '4', NULL, NULL),
(17, 'سيرة أم المؤمنين ” مارية القبطية ” هدية المقوقس', 'نسبها وسيرتها: هي السيدة مارية بنت شمعون القبطية، ولدت في قرية “حفن”، وكلمة قبط يقصد بها أهل مصر، أهداها الملك المقوقس حاكم مصر للنبي عليه السلام سنة 7 هجريا، وكانت ابنة أحد أشراف القبط. تزوجها النبي عليه الصلاة والسلام وأنجب منها “إبراهيم” الذي توفي في صغره.\r\n\r\nقصة إرسال المقوقس بمارية القبطية للنبي عليه السلام:\r\nاهتم النبي عليه السلام بعد صلح الحديبية بنشر الدعوة في بلاد العالم، وبدأ يكتب للحكام والملوك بالاستعانة من ذوي الرأي والحكمة الخطابات يدعوهم فيها إلى الدخول إلى الإسلام. ومنهم كسرى ملك فارس، وهرقل ملك الروم، والمقوقس ملك مصر، والنجاشي ملك الحبشة.\r\nكانت ردودهم أجمعين على خطابات النبي بالحسنى، وردوها ردا جميلا، إلا كسرى الذي مزق كتاب النبي عليه السلام.\r\nوقد أرسل عليه الصلاة والسلام كتابه إلى المقوقس مع “حاطب بن أبي بلتعة” البليغ الفصيح، فدخل عليه وأخذ يقرأ عليه كتاب رسول الله عليه الصلاة والسلام. استمع المقوقس لكلام حاطب وأثار اعجابه وقال: ” إني قد نظرت في أمر هذا النبي فوجدته لا يأمر بزهودٍ فيه، ولا ينهي عن مرغوب فيه، ولم أجدهُ بالساحر الضال، ولا الكاهن الكاذب، ووجدت معه آية النبوة بإخراج الخبء والأخبار بالنجوى وسأنظر”.\r\nأخذ الكتاب وختم عليه بختمه، وكتب للنبي عليه السلام يرد عليه:\r\n” بسم الله الرحمن الرحيم، إلى محمد بن عبد الله، من المقوقس عظيم القبط، سلام عليك، أما بعد فقد قرأت كتابك، وفهمت ما ذكرت فيه، وما تدعو إليه، وقد علمت أن نبياً بقي، وكنت أظن أنه سيخرج بالشام، وقد أكرمت رسولك، وبعثت إليك بجاريتين لهما مكان في القبط عظيم، وبكسوة، وأهديتُ إليك بغلة لتركبها والسلام عليك ”\r\nوالجاريتان هما: مارية بنت شمعون واختها سيرين بنت شمعون، وعشرين ثوبا، وبغلته الخاصة، وشيخ كبير وقور وألف مثقال من الذهب. فاختار النبي عليه الصلاة والسلام مارية القبطية وأهدى شاعره المادح حسان بن ثابت الأنصاري اختها سيرين بنت شمعون.\r\n\r\n\r\nمكانتها عند النبي عليه السلام:\r\nكان النبي يحفظ للسيدة مارية رضي الله عنها نسبها ومكانة قومها. فقال عليه الصلاة والسلام لجيوش الفاتحين: انكم ستفتحون مصر، وهي أرض يسمى فيها القيراط، فإذا فتحتموها فأحسنوا إلى أهلها، فإن لهم ذمة ورحماً، وقيل: نسبًا وصهرًا. والنسب هنا هو من جهة هاجر زوج سيدنا ابراهيم عليه السلام، والصهر هو من جهة زوجته مارية القبطية.\r\n\r\n\r\nنزلت في السيدة مارية كثير من آيات سورة التحريم، وقد ورد ذكرها في أحاديث وتفاسير العلماء والفقهاء في تصنيفاتهم، وقد ارتقى الرسول صلى الله عليه وسلم وهو راض عنها. فقد كانت أم ولده إبراهيم، كما أنها كانت تتفانى في إرضائه رضي الله عنها.\r\n\r\nوحدثت السيدة عائشة رضي الله عنها أنها كانت شديدة الغيرة من مارية القبطية، حيث كانت ذات حسن وجمال وبهاء طلة. فكانت كثيرا ما تراقب كيف يهتم النبي عليه الصلاة والسلام بها فتقول: ” ما غرت على امرأة إلا دون ما غرت على مارية، وذلك أنها كانت جميلة جعدة -أو دعجة- فأعجب بها رسول الله وكان أنزلها أول ما قدم بها في بيتٍ لحارثة بن النعمان، فكانت جارتنا، فكان عامة الليل والنهار عندها، حتى فرغنا لها، فجزعت فحولها إلى العالية، وكان يختلف إليها هناك، فكان ذلك أشد علينا”.', '1722229391.jpeg', NULL, 'ww.com.gamal', NULL, 4, NULL, '2024-07-29 09:03:11', '2024-07-29 09:03:11', '4', NULL, NULL),
(18, 'لحارثة بن النعمان،', 'والجاريتان هما: مارية بنت شمعون واختها سيرين بنت شمعون، وعشرين ثوبا، وبغلته الخاصة، وشيخ كبير وقور وألف مثقال من الذهب. فاختار النبي عليه الصلاة والسلام مارية القبطية وأهدى شاعره المادح حسان بن ثابت الأنصاري اختها سيرين بنت شمعون. مكانتها عند النبي عليه السلام: كان النبي يحفظ للسيدة مارية رضي الله عنها نسبها ومكانة قومها. فقال عليه الصلاة والسلام لجيوش الفاتحين: انكم ستفتحون مصر، وهي أرض يسمى فيها القيراط، فإذا فتحتموها فأحسنوا إلى أهلها، فإن لهم ذمة ورحماً، وقيل: نسبًا وصهرًا. والنسب هنا هو من جهة هاجر زوج سيدنا ابراهيم عليه السلام، والصهر هو من جهة زوجته مارية القبطية. نزلت في السيدة مارية كثير من آيات سورة التحريم، وقد ورد ذكرها في أحاديث وتفاسير العلماء والفقهاء في تصنيفاتهم، وقد ارتقى الرسول صلى الله عليه وسلم وهو راض عنها. فقد كانت أم ولده إبراهيم، كما أنها كانت تتفانى في إرضائه رضي الله عنها. وحدثت السيدة عائشة رضي الله عنها أنها كانت شديدة الغيرة من مارية القبطية، حيث كانت ذات حسن وجمال وبهاء طلة. فكانت كثيرا ما تراقب كيف يهتم النبي عليه الصلاة والسلام بها فتقول: ” ما غرت على امرأة إلا دون ما غرت على مارية، وذلك أنها كانت جميلة جعدة -أو دعجة- فأعجب بها رسول الله وكان أنزلها أول ما قدم بها في بيتٍ لحارثة بن النعمان، فكانت جارتنا، فكان عامة الليل والنهار عندها، حتى فرغنا لها، فجزعت فحولها إلى العالية، وكان يختلف إليها هناك، فكان ذلك أشد علينا”.', '1722236367.jpg', NULL, 'ww.com.gamal', NULL, 4, NULL, '2024-07-29 10:59:27', '2024-07-29 10:59:27', '4', NULL, NULL),
(19, 'خطبة الجمعة تشيخ#محمد بن علي بن جميل المطري', NULL, '1722243032.jpg', NULL, NULL, NULL, 10, NULL, '2024-07-29 12:50:32', '2024-07-29 12:50:32', '10', '1722243032.mp4', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` bigint(20) UNSIGNED DEFAULT NULL,
  `section_Name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sections`
--

INSERT INTO `sections` (`id`, `id_admin`, `section_Name`, `created_at`, `updated_at`) VALUES
(4, NULL, 'مقالات', '2024-07-27 12:48:51', '2024-07-27 12:48:51'),
(6, NULL, 'كتب', '2024-07-27 12:51:00', '2024-07-27 12:51:00'),
(7, NULL, 'صوتيات', '2024-07-27 12:51:10', '2024-07-27 12:51:10'),
(10, NULL, 'video', '2024-07-27 13:00:25', '2024-07-27 13:00:25'),
(16, NULL, 'فتاوى', '2024-07-27 13:05:19', '2024-07-27 13:05:19');

-- --------------------------------------------------------

--
-- بنية الجدول `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uel9xHPhrakZCBGlwq4dYB3lPUCecoMIDx4dehDx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXBsQVlsWlpENVZTVnRXdHg5OG9wV2tMT1VpNWxkbDVFMGVxQUlKMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cy8xOS9zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1722294050),
('XE47yTlUgq7H7xl80QPHE4OMIe6IZIcQ9wTVHijC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWpXOW1VR3R4Nk9YemRmV25zVWxtRVk5WnROZmRoYmVqT0pVMmVuRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cy8xMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722245434);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `link_notes` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fetawes`
--
ALTER TABLE `fetawes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fetawes_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fetawes`
--
ALTER TABLE `fetawes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- قيود الجداول `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- قيود الجداول `fetawes`
--
ALTER TABLE `fetawes`
  ADD CONSTRAINT `fetawes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- قيود الجداول `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
