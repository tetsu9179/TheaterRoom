-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-05-06 21:26:16
-- サーバのバージョン： 5.7.36-log
-- PHP のバージョン: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `theater_room`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `ID` bigint(20) NOT NULL COMMENT '管理ID',
  `user_id` bigint(20) NOT NULL COMMENT 'ユーザーのID',
  `name` varchar(255) NOT NULL COMMENT '名前',
  `password_hash` varchar(255) NOT NULL COMMENT 'ハッシュ化パスワード',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '送信日時',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`ID`, `user_id`, `name`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 13, '愚地　独歩', '$2y$10$oRs7sSrxQtgWs2P7hEjn8.uVOJIjjnL51PVsLFcxLX7N32qBtlTW6', '2022-04-25 20:21:22', '2022-04-25 20:21:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `room_id` bigint(20) NOT NULL COMMENT 'チャットルームのID',
  `send_user_id` bigint(20) NOT NULL COMMENT 'メッセージを送ったユーザーのID',
  `message` varchar(255) NOT NULL COMMENT 'メッセージ',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '送信日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `chats`
--

INSERT INTO `chats` (`id`, `room_id`, `send_user_id`, `message`, `updated_at`, `created_at`) VALUES
(42, 46, 30, 'おしゃれ？？', '2022-04-27 12:51:17', '2022-04-27 12:51:17'),
(43, 34, 13, '酒飲みたい', '2022-04-30 05:13:14', '2022-04-30 05:13:14'),
(44, 49, 20, 'それ二郎やぞ', '2022-05-05 14:34:59', '2022-05-05 14:34:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `contacts`
--

CREATE TABLE `contacts` (
  `ID` bigint(20) NOT NULL COMMENT '管理ID',
  `send_user_id` bigint(20) NOT NULL COMMENT '問い合わせユーザー',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル',
  `message` varchar(255) NOT NULL COMMENT '問い合わせ内容',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `contacts`
--

INSERT INTO `contacts` (`ID`, `send_user_id`, `email`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, 13, 'orotidoppo@gmail.com', '独歩です', 'なんだぁてめぇ？？', '2022-04-25 10:37:50', '2022-04-25 10:37:50'),
(2, 14, 'katsuonotataki@docomo.ne.jp', 'かつおです', 'ごめんねすなおじゃなくて', '2022-04-25 12:58:54', '2022-04-25 12:58:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `send_user_id` bigint(20) NOT NULL COMMENT '友達追加したユーザーID',
  `got_user_id` bigint(20) NOT NULL COMMENT '友達追加されたユーザーID',
  `request_flg` int(11) NOT NULL DEFAULT '0' COMMENT 'リクエスト一覧への非表示フラグ（0＝表示、1＝非表示）',
  `created_at` datetime NOT NULL COMMENT '送信日時',
  `updated_at` datetime NOT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `room_members`
--

CREATE TABLE `room_members` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `room_id` bigint(20) NOT NULL COMMENT 'トークルームID',
  `member_id` bigint(20) NOT NULL COMMENT 'トークルーム参加者のユーザーID',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `room_members`
--

INSERT INTO `room_members` (`id`, `room_id`, `member_id`, `updated_at`, `created_at`) VALUES
(19, 21, 13, '2022-03-27 12:23:40', '2022-03-27 12:23:40'),
(20, 21, 14, '2022-03-27 12:23:40', '2022-03-27 12:23:40'),
(22, 22, 13, '2022-04-10 15:16:31', '2022-04-10 15:16:31'),
(23, 32, 13, '2022-04-22 21:09:14', '2022-04-22 21:09:14'),
(25, 33, 13, '2022-04-22 21:11:59', '2022-04-22 21:11:59'),
(27, 34, 13, '2022-04-24 12:02:45', '2022-04-24 12:02:45'),
(29, 35, 13, '2022-04-24 12:03:38', '2022-04-24 12:03:38'),
(31, 36, 13, '2022-04-24 12:04:08', '2022-04-24 12:04:08'),
(33, 37, 13, '2022-04-26 00:22:13', '2022-04-26 00:22:13'),
(35, 38, 13, '2022-04-26 00:27:02', '2022-04-26 00:27:02'),
(37, 39, 13, '2022-04-26 00:58:35', '2022-04-26 00:58:35'),
(39, 39, 13, '2022-04-26 01:02:51', '2022-04-26 01:02:51'),
(41, 39, 13, '2022-04-26 01:02:54', '2022-04-26 01:02:54'),
(43, 39, 13, '2022-04-26 01:03:00', '2022-04-26 01:03:00'),
(44, 39, 11, '2022-04-26 01:03:00', '2022-04-26 01:03:00'),
(45, 41, 13, '2022-04-26 01:05:27', '2022-04-26 01:05:27'),
(46, 41, 11, '2022-04-26 01:05:27', '2022-04-26 01:05:27'),
(47, 41, 13, '2022-04-26 01:06:11', '2022-04-26 01:06:11'),
(48, 41, 11, '2022-04-26 01:06:11', '2022-04-26 01:06:11'),
(49, 43, 21, '2022-04-27 02:11:35', '2022-04-27 02:11:35'),
(50, 43, 20, '2022-04-27 02:11:35', '2022-04-27 02:11:35'),
(51, 44, 26, '2022-04-27 21:17:43', '2022-04-27 21:17:43'),
(52, 44, 20, '2022-04-27 21:17:43', '2022-04-27 21:17:43'),
(53, 45, 29, '2022-04-27 21:38:27', '2022-04-27 21:38:27'),
(54, 45, 20, '2022-04-27 21:38:27', '2022-04-27 21:38:27'),
(55, 46, 30, '2022-04-27 21:51:00', '2022-04-27 21:51:00'),
(56, 46, 20, '2022-04-27 21:51:00', '2022-04-27 21:51:00'),
(57, 47, 13, '2022-04-30 14:14:31', '2022-04-30 14:14:31'),
(58, 47, 11, '2022-04-30 14:14:31', '2022-04-30 14:14:31'),
(59, 47, 20, '2022-04-30 14:14:31', '2022-04-30 14:14:31'),
(60, 49, 20, '2022-05-03 19:55:12', '2022-05-03 19:55:12'),
(61, 49, 30, '2022-05-03 19:55:12', '2022-05-03 19:55:12');

-- --------------------------------------------------------

--
-- テーブルの構造 `talk_rooms`
--

CREATE TABLE `talk_rooms` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `name` varchar(255) NOT NULL COMMENT 'トークルーム名',
  `thumbnail_pass` varchar(255) NOT NULL COMMENT 'サムネイル画像のパス',
  `host_user_id` bigint(20) NOT NULL COMMENT 'トークルーム作成者のID',
  `del_flg` int(11) NOT NULL DEFAULT '0' COMMENT '削除フラグ（0＝表示、1＝非表示）',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `talk_rooms`
--

INSERT INTO `talk_rooms` (`id`, `name`, `thumbnail_pass`, `host_user_id`, `del_flg`, `updated_at`, `created_at`) VALUES
(32, 'いぬ', '1650629351guide.png', 13, 0, '2022-04-22 12:09:14', '2022-04-22 12:09:11'),
(34, 'テスト用', '1650769362MIYAZAKI19116794_TP_V.jpg', 13, 0, '2022-04-24 03:02:45', '2022-04-24 03:02:42'),
(47, 'おされなおさけ', '16512956603117894_m.jpg', 13, 0, '2022-04-30 05:14:20', '2022-04-30 05:14:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `name` varchar(255) NOT NULL COMMENT 'ハンドルネーム',
  `icon_pass` varchar(255) NOT NULL COMMENT 'アイコン画像のパス',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `tel` varchar(11) DEFAULT NULL COMMENT '電話番号',
  `password_hash` varchar(255) NOT NULL COMMENT 'ハッシュ化したパスワード',
  `profile_messege` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '一言メッセージ',
  `admin_flg` int(11) NOT NULL DEFAULT '0' COMMENT '管理者フラグ(0=権限なし、1=権限あり)',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '送信日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `icon_pass`, `email`, `tel`, `password_hash`, `profile_messege`, `admin_flg`, `updated_at`, `created_at`) VALUES
(13, '管理　司太郎', '1651829412userIcon.png', 'admin@gmail.com', NULL, '$2y$10$oRs7sSrxQtgWs2P7hEjn8.uVOJIjjnL51PVsLFcxLX7N32qBtlTW6', NULL, 1, '2022-05-06 09:30:12', '2022-03-21 10:27:00'),
(14, '磯野カツオ', '1648034496undraw_VR_chat_re_s80u.png', 'katsuonotataki@docomo.ne.jp', NULL, '$2y$10$I5xk5DK4emewPu67y.8QbuXsCC5qCEjdaPEgftc36wJw9BPCzGm3y', 'isonokatsuo', 0, '2022-03-23 11:21:36', '2022-03-23 11:21:36'),
(17, '武藤　叶夢', '16480349931571783369991.jpg', 'tomcat@docomo.ne.jp', NULL, '$2y$10$SXnPLomivfEWXzg0iRcKR.6iCMR0QCszhJd0wYRN3es9G34kROy.S', 'tomiscat', 0, '2022-03-23 11:29:53', '2022-03-23 11:29:53'),
(19, '豊富手　火引', '16480351061571783373507.jpg', 'kusokuso@docomo.ne.jp', NULL, '$2y$10$oCrT1PhFg2.qtlRwKwKNCe9UkzmzDrauU1eYtV8tC7aPXRLczoupq', 'kusokuso', 0, '2022-03-23 11:31:46', '2022-03-23 11:31:46'),
(31, 'テスト　太郎', 'userIcon.png', 'test@gmail.com', NULL, '$2y$10$lTaxkOOWSBDQCDjPAY2hfO3vn4zEwqyOUhPiE/T8.JNNewFYZAM92', 'テストユーザーです', 0, '2022-05-06 08:18:35', '2022-05-06 08:18:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) NOT NULL COMMENT '管理ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーのID',
  `token` varchar(255) NOT NULL COMMENT 'トークン',
  `expire_at` datetime DEFAULT NULL COMMENT 'トークンの有効期限',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '送信日時',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `expire_at`, `created_at`, `updated_at`) VALUES
(1, 11, '5916276666266c7bd7c39e2.41473465', '2022-04-27 16:09:33', '2022-04-08 14:20:28', '2022-04-25 16:09:33'),
(2, 20, '1678021983627345020abda3.19056066', '2022-05-07 03:31:14', '2022-04-10 04:03:38', '2022-05-05 03:31:14');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `room_members`
--
ALTER TABLE `room_members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `talk_rooms`
--
ALTER TABLE `talk_rooms`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=45;

--
-- テーブルの AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `room_members`
--
ALTER TABLE `room_members`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=62;

--
-- テーブルの AUTO_INCREMENT `talk_rooms`
--
ALTER TABLE `talk_rooms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=50;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=33;

--
-- テーブルの AUTO_INCREMENT `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '管理ID', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
