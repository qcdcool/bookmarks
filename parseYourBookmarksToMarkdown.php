<?php
/***
 * 
 * parseYourBookmarksToMarkdown.php
 * 将你的chrome 书签解析成markdown文件
 *
 ***********************************
 * @date: 2016-4-23
 * @author: qcdcool@gmail.com
 * @version: v1.0
 */

// chrome书签文件根目录（本示例仅以Mac OS为例，其他系统chrome书签文件路径请自行Google）

const BOOKMARK_ROOT_PATH = '/Users/{User}/Library/Application Support/Google/Chrome/Default/';

$bookmarks_data = parseBookmark();
//$bookmarks_data['roots']['bookmark_bar']['children'] 为默认的书签
if (isset($bookmarks_data['roots']['bookmark_bar']['children'])) {
	saveToMarkdown($bookmarks_data['roots']['bookmark_bar']['children']);
	echo "save markdown file success!\n";
	exit();
}else {
	echo "sorry, the bookemark_bar is empty!\n";
	exit();
}

/**
 * 解析Bookmarks文件
 */
function parseBookmark() {
	$file = BOOKMARK_ROOT_PATH . 'Bookmarks';
	if (!file_exists($file)) {
		echo "sorry, the bookmarks file not exist!\n";
		exit();
	}
	$json_content = file_get_contents($file);
	if (empty($json_content)) {
		echo "sorry, the bookmarks file is empty!\n";
		exit();
	}
	return json_decode($json_content, true);
}

/**
 * 保存成markdown文件
 * @param array $bookmarks_data
 * @return null
 */
function saveToMarkdown($bookmarks_data) {
	try {
		$fp = fopen('bookmarks.md', 'a+');
		foreach ($bookmarks_data as $value) {
			if ($value['type'] == 'url') {
				$url = "- [" . $value['name'] . "](" . $value['url'] . ")\n\n"; 
				fwrite($fp, $url);
				unset($url);
			}else {
				$categroy = "##" . $value['name'] . ":\n"; 
				fwrite($fp, $categroy);
				unset($categroy);
				saveToMarkdown($value['children']);
			}
		}
		fclose($fp);
	}catch (Exception $e) {
		echo "write the markdown failed！\n";
		exit();
	}
}